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
//Route::get('/home','pagescontroller@members');
Route::get('/upgrades', 'pagescontroller@upgrades');
Route::get('/payments', 'pagescontroller@payments');
Route::get('/', function()
{

	return redirect('/login');
}

);
Route::get('/members', 'pagescontroller@members');
Route::get('/agents', 'pagescontroller@agents');
Route::get('/districts', 'pagescontroller@districts');
Route::get('/funding', 'chartsController@funding');
Route::get('/donations', 'pagescontroller@donations');
Route::get('/enrollment', 'chartsController@index');
Route::post('/period', 'chartsController@period');
Route::post('/addagent', 'agentscontroller@store');
Route::post('/search', 'memberscontroller@index');
Route::post('/adddistrict', 'districtscontroller@store');
Route::post('/payments', 'pagescontroller@store');
Route::post('/toagent', 'agentscontroller@upgrade');



Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
