<?php

use App\Http\Controllers\AccountController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Resources\Entities\EntityResource;
use App\Models\Entity;
use App\Http\Controllers\User\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');

    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/account', [AccountController::class, 'edit'])->name('account.edit');
    Route::patch('/account', [AccountController::class, 'update'])->name('account.update');
    Route::delete('/account', [AccountController::class, 'destroy'])->name('account.destroy');

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/{uuid}/impersonate', 'impersonateUser')->name('impersonate');
        Route::get('/stop-impersonate', 'stopImpersonateUser')->name('stop-impersonate');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Profile/Profile');
        })->name('profile');
    });

    Route::prefix('entity')->group(function () {
        Route::get('/{entity}', function (Entity $entity ) {
            return Inertia::render('Entity/Entity', ['entity' => new EntityResource($entity)]);
        })->name('entity');
    });

    Route::prefix('jobs')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Jobs/Jobs');
        })->name('jobs');
    });

    Route::prefix('prompts')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Prompts/Prompts');
        })->name('prompts');
    });

    Route::prefix('templates')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Templates/Templates');
        })->name('templates');
    });

    Route::prefix('talent')->group(function () {
        Route::get('/registration', function () {
            return Inertia::render('Entity/Registration');
        })->name('entity.registration');
    });

    Route::prefix('permissions')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Permissions/Permissions');
        })->name('permissions');
    });
    
});

require __DIR__.'/auth.php';
