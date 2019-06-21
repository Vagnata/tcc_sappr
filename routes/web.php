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

use Illuminate\Support\Facades\Auth;

Auth::routes();

Route::get('/', 'HomeController@welcome')->name('welcome');


#Usuário
#Route::post('/sair','UserController@logout')->name('logout');
Route::get('/acessar', 'UserController@showLogin')->name('show-login');
Route::get('/registrar', 'UserController@showRegister')->name('show-register');
#Route::get('/login', 'UserController@login')->name('login');



Route::get('/home', 'HomeController@index')->name('home');
