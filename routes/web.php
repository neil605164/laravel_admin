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
    echo "123";
});

// 會員router
Route::group(['prefix' => 'member', 'middleware' => 'api_auth'], function() {
    Route::post("/create", "Member\UserController@create");
    Route::get("/list", "Member\UserController@userList");
});