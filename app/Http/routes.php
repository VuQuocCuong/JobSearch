<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/index', function () {
    return view('index');
});

Route::get('/job/{id_social}', "Api\JobController@jobDetail");
Route::get('/joblist', function () {
    return view('joblist');
});


// Route API
Route::get('/api/job', "Api\JobController@getAllJob");
Route::get('/api/job/new', 'Api\JobController@getListNewJob');
Route::get('/api/job/search', 'Api\JobController@jobSearch');
Route::get('/api/job/count', 'Api\JobController@jobCount');

// Source API
Route::get('/api/source', 'Api\SourceController@source');
Route::get('/api/source/new', 'Api\SourceController@sourceNew');
Route::get('/api/source/all', 'Api\SourceController@getAllSource');

// OAuth Sign in FB
Route::get('/auth/facebook', [
    'as' => 'auth_fb',
    'uses' => 'Auth\AuthController@loginWithFacebook'
]);
Route::get('/auth/logout', "Auth\AuthController@logOut");