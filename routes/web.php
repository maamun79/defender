<?php

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
    return view('layouts.main');
});
Route::get('/js/dashboard', 'DashboardController@goToDashboard');
///dashboard
Route::get('logout', 'LoginController@logout');
// Route::get('/das', function () {
//     return view('layouts.main');
// });
Route::get('/admin', 'Auth\LoginController@goToLogIn');

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');


Route::get('{path}', 'HomeController@index')->where( 'path' , '([A-z\d\-\/_.]+)?' );
