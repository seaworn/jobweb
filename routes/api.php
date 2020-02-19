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

Route::group(['middleware'=> 'auth:api'], function() {
    
    function api_routes($controller) {
        Route::get('/', "{$controller}@index")->name('index');
        Route::post('/', "{$controller}@store")->name('store');
        Route::get('{id]', "{$controller}@show")->name('show');
        Route::put('{id}', "{$controller}@update")->name('update');
        Route::delete('{id}', "{$controller}@destroy")->name('destroy');
    }
    
    Route::group(['prefix'=> 'personal-information', 'as'=> 'info.'], function() {
        api_routes('PersonalInformationController');
    });
    Route::group(['prefix'=> 'academic-qualifications', 'as'=> 'academics.'], function() {
        api_routes('AcademicQualificationController');
    });
    Route::group(['prefix'=> 'work-experience', 'as'=> 'experience.'], function() {
        api_routes('WorkExperienceController');
    });
    Route::group(['prefix'=> 'professional-certifications', 'as'=> 'certifications.'], function() {
        api_routes('ProfessionalCertificationController');
    });
    Route::group(['prefix'=> 'Professional-memberships', 'as'=> 'memberships.'], function() {
        api_routes('ProfessionalMembershipController');
    });
    Route::group(['prefix'=> 'skills', 'as'=> 'skills.'], function() {
        api_routes('SkillController');
    });
    Route::group(['prefix'=> 'referees', 'as'=> 'experience.'], function() {
        api_routes('RefereeController');
    });
    Route::get('logout', 'Auth\ApiAuthController@logout');
});
    