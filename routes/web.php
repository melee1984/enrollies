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

// Display the default page
Route::get('/', 'PasserController@default');

// Get the list of board passer 
Route::get('board/passer', 'RequestController@getBoardPasser');
Route::get('process', 'RequestController@processBoardPasser');
Route::post('examinee/add/submit', 'PasserController@addExaminuee');

