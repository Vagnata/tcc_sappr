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

#Anúncios
Route::get('/anuncios/meus-anuncios', 'AnnouncementController@list')->name('my-announcements');
Route::get('/anuncios/registro', 'AnnouncementController@showForm')->name('form-announcement');
Route::get('/anuncios/registro/{id}', 'AnnouncementController@showForm')->name('form-announcement-edit');
Route::post('/anuncios/salvar', 'AnnouncementController@store')->name('store-announcement');
Route::post('/anuncios/salvar/{id}', 'AnnouncementController@store')->name('store-announcement-edit');

#Produtos
Route::get('/anuncios/meus-anuncios', 'ProductController@list')->name('products');

Route::get('/home', 'HomeController@index')->name('home');
