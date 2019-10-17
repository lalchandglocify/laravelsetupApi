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
// Auth::routes(['verify' => true]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register','Api\AuthController@register'); 
Route::post('login','Api\AuthController@login');
Route::post('forgotPassword','Api\AuthController@forgotPassword'); 
Route::post('refreshToken','Api\AuthController@refreshToken'); 
Route::post('resendVerificationEmail','Api\AuthController@resendVerificationEmail'); 
Route::get('getTerms','Api\AuthController@getTerms');
Route::get('privacyPolicy','Api\AuthController@privacyPolicy');


Route::middleware(['auth:api'])->group(function(){
	Route::get('getUserProfile','Api\AuthController@getUserProfile');
	Route::post('changePassword','Api\AuthController@changePassword');
	Route::get('logout','Api\AuthController@logout');
	Route::post('updateProfile','Api\AuthController@updateProfile');
	Route::post('addInspection','Api\AuthController@addInspection');
	Route::get('getAllUserInspection','Api\AuthController@getAllUserInspection');
	Route::post('editInspection','Api\AuthController@editInspection');
	
}); 