<?php

use App\Http\Controllers\AccountController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\Profile\ProfileController;

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

    Route::prefix('profile')->group(function () {
        Route::get('/', function () {
            return Inertia::render('Profile/Profile');
        })->name('profile');
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
});

require __DIR__.'/auth.php';
