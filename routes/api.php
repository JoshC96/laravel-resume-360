<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\Users\UserController;
use App\Http\Controllers\Api\Jobs\JobsController;
use App\Http\Controllers\Api\Prompts\PromptsController;
use App\Http\Controllers\Api\Prompts\PromptTemplatesController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->prefix('v1')->group(function () {

    Route::prefix('user')->controller(UserController::class)->group(function () {
        Route::get('/', 'getProfile');

        Route::prefix('bio')->group(function () {
            Route::get('/', 'getBio');
            Route::patch('/', 'updateBio');
        }); 

        Route::prefix('referees')->group(function () {
            Route::get('/', 'getReferees');
            Route::post('/', 'createReferee');
            Route::patch('/{referee}', 'updateReferee');
            Route::delete('/{referee}', 'destroyReferee');
        });


        Route::prefix('work-experiences')->group(function () {
            Route::get('/', 'getWorkExperiences');
            Route::post('/', 'createWorkExperience');
            Route::patch('/{workExperience}', 'updateWorkExperience');
            Route::delete('/{workExperience}', 'destroyWorkExperience');
        });


        Route::prefix('qualifications')->group(function () {
            Route::get('/', 'getQualifications');
            Route::post('/', 'createQualification');
            Route::patch('/{qualification}', 'updateQualification');
            Route::delete('/{qualification}', 'destroyQualification');
        });


        Route::prefix('publications')->group(function () {
            Route::get('/', 'getPublications');
            Route::post('/', 'createPublication');
            Route::patch('/{publication}', 'updatePublication');
            Route::delete('/{publication}', 'destroyPublication');
        });


        Route::prefix('certifications')->group(function () {
            Route::get('/', 'getCertifications');
            Route::post('/', 'createCertification');
            Route::patch('/{certification}', 'updateCertification');
            Route::delete('/{certification}', 'destroyCertification');
        });


        Route::prefix('licences')->group(function () {
            Route::get('/', 'getLicences');
            Route::post('/', 'createLicence');
            Route::patch('/{licence}', 'updateLicence');
            Route::delete('/{licence}', 'destroyLicence');
        }); 
    });

    Route::prefix('jobs')->controller(JobsController::class)->group(function () {
        Route::get('/', 'getJobs');
        Route::get('/recommended-jobs', 'getRecommendedJobs');
        Route::get('/applications', 'getApplications');
        Route::get('/{jobListing}/quick-apply', 'quickApply');
        Route::get('/{jobListing}/generate-cover-letter', 'generateCoverLetter');
    });

    Route::prefix('prompts')->controller(PromptsController::class)->group(function () {
        Route::get('/', 'getPrompts');
        Route::post('/', 'createPrompt');
        Route::patch('/{prompt}', 'updatePrompt');
        Route::delete('/{prompt}', 'deletePrompt');
    });

    Route::prefix('templates')->controller(PromptTemplatesController::class)->group(function () {
        Route::get('/', 'getTemplates');
        Route::post('/', 'createTemplate');
        Route::patch('/{template}', 'updateTemplate');
        Route::delete('/{template}', 'deleteTemplate');
    });

});
