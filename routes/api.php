<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', 'Auth\ApiAuthController@register');
Route::post('login', 'Auth\ApiAuthController@login');
Route::middleware('auth:api')->get('logout', 'Auth\ApiAuthController@logout');

Route::middleware('auth:api')->group(function() {
    Route::apiResource('personal-information', 'PersonalInformationController');
    Route::apiResource('contact-person', 'ContactPersonController');
    Route::apiResource('academic-qualifications', 'AcademicQualificationController');
    Route::apiResource('work-experience', 'WorkExperienceController');
    Route::apiResource('professional-certifications', 'ProfessionalCertificationController');
    Route::apiResource('professional-memberships', 'ProfessionalMembershipController');
    Route::apiResource('skills', 'SkillController');
    Route::apiResource('referees', 'RefereeController');
});
    