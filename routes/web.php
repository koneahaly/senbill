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

Route::get('/mes-factures', 'HomeController@display_bills')->name('mes-factures');
Route::get('/mon-contrat', 'HomeController@display_contract')->name('mon-contrat');
Route::get('/infos-personnelles', 'HomeController@display_personal_infos')->name('infos-personnelles');


Route::get('/home', 'HomeController@index')->name('home');
Route::post('/home', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home-woyofal');
Route::post('/mes-factures/pay','billController@pay')->name('mes-factures.pay');
Route::get('/mes-factures/pay','billController@pay')->name('mes-factures.pay');
Route::post('/mes-factures/facture_a_payer','billController@pay_bill')->name('mes-factures.facture_a_payer');
Route::get('/mes-factures/buy','ApiController@index')->name('mes-factures.buy');
Route::get('/mes-factures/bought','billController@buy')->name('mes-factures.bought');
Route::post('/mes-factures/bought','billController@buy')->name('mes-factures.bought');
Route::get('/home/quick',function(){
	return view('quick');
});
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::post('/admin/store','billController@store')->name('admin.store');
Route::post('/admin/updaterate','billController@updaterate')->name('admin.updaterate');
Route::get('/mes-factures/pdf_bill','billController@pdf_bill')->name('mes-factures.pdf_bill');
Route::get('/mes-factures/pdf_buy','billController@pdf_buy')->name('mes-factures.pdf_buy');
Route::post('/home/pdf_bill','billController@pdf_bill')->name('home.pdf_bill');


Route::get('json-api', 'ApiController@index');
