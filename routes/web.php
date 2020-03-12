<?php

use Illuminate\Http\Request;

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


// Auth::routes();

Route::get('/demo', function () {
    return view('demo', ['perm'=> \Spatie\Permission\Models\Permission::paginate(10)]);
});
Route::get('/adminDashboard','AdminDashboardController@index');
Route::get('/posted-jobs','Admin\AdminJobPostsController@index');
Route::post('/savejobs','Admin\AdminJobPostsController@create');

Route::get('/editpostedjobs/{id}','Admin\AdminJobPostsController@edit');
Route::put('/updatejob/{id}','Admin\AdminJobPostsController@update');
Route::delete('/deletepostedjob/{id}','Admin\AdminJobPostsController@destroy');
Route::get('/homepage','HomePageControllers@index');
Route::get('/jobsavailable','AvailablejobspostedController@index');
Route::get('/showshop/{id}','AvailablejobspostedController@show');

Route::fallback(function () {
    return view('index');
});

