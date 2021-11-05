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
    return view('welcome');
});

Auth::routes();

Route::get('/admin' , function() {
    return view('admin.index');
})->middleware('admin');

Route::resource('/admin/pages' , 'Admin\PagesController', ['except' => [
    'show'
]]);

Route::resource('/admin/users' , 'Admin\UsersController', ['except' => [
   'create','store','show'
]]);

Route::get('/home', 'HomeController@index')->name('home');
