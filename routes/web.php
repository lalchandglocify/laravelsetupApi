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

Auth::routes(['verify' => true]);

/*WEB SECION*/
Route::get('/', 'HomeController@index');
Route::get('home','HomeController@home');
/*USER SECTION*/
Route::post('resendVerificationEmail','UserController@resendVerificationEmail');
Route::get('verifyEmail/{id}','UserController@verifyEmail');



Route::post('userLogout','UserController@logout');
Route::post('userLogin','UserController@userLogin');
Route::middleware(['auth','userLogin','verified'])->group(function () {
	Route::get('dashboard','UserController@dashboard');
	Route::match(['get', 'post'],'updateUserProfile','UserController@updateUserProfile');
    Route::match(['get', 'post'],'updateUserPassword','UserController@updateUserPassword');
    Route::get('asset','UserController@asset');
    // Route::get('reports','UserController@reports');
    // Route::match(['get','post'],'addReport','UserController@addReport');
});




/*ADMIN SECTION*/

Route::post('adminLogout','AdminController@logout');
Route::get('admin','AdminController@admin');
Route::post('adminLogin','AdminController@adminLogin');

// Route::get('test','AdminController@test');
Route::middleware(['adminLogin'])->group(function () {
    Route::get('adminDashboard','AdminController@dashboard');
    Route::match(['get', 'post'],'updateAdminProfile','AdminController@updateAdminProfile');
    Route::match(['get', 'post'],'updateAdminPassword','AdminController@updateAdminPassword');
    Route::match(['get', 'post'],'userList','AdminController@userList');
    Route::match(['get','post'],'editUser/{id}','AdminController@editUser');
    Route::get('blockUser/{id}','AdminController@blockUser');
    Route::get('unblockUser/{id}','AdminController@unblockUser');
    Route::get('deleteUser/{id}','AdminController@deleteUser');
});

