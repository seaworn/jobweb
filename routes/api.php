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

Route::post('register', 'UserController@register');
Route::post('login', 'UserController@login');
Route::middleware('auth:api')->get('logout', 'UserController@logout');

Route::middleware('auth:api')->group(function() {
    Route::apiResource('users', 'UserController');
    Route::apiResource('permissions', 'PermissionController');
    Route::apiResource('roles', 'RoleController');
    Route::apiResource('jobs', 'JobController');
    Route::apiResource('personal-information', 'PersonalInformationController');
    Route::apiResource('contact-person', 'ContactPersonController');
    Route::apiResource('academic-qualifications', 'AcademicQualificationController');
    Route::apiResource('work-experience', 'WorkExperienceController');
    Route::apiResource('professional-certifications', 'ProfessionalCertificationController');
    Route::apiResource('professional-memberships', 'ProfessionalMembershipController');
    Route::apiResource('skills', 'SkillController');
    Route::apiResource('referees', 'RefereeController');
    Route::delete('/roles/{rid}/permissions/{pid}', 'RoleController@revokePermission');
});
    