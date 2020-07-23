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


Route::get('/qui-sommes-nous', 'WhoController@display_who')->name('who');
Route::get('/la-plateforme-elektra', 'WhatController@display_what')->name('what');
Route::get('/mes-factures/{id?}', 'HomeController@display_bills')->name('mes-factures');
Route::post('/mes-factures/{id?}', 'HomeController@display_bills')->name('mes-factures');
Route::get('/mes-services/{id?}', 'HomeController@display_services')->name('platform');
Route::post('/mes-services/{id?}', 'HomeController@display_services')->name('platform');
Route::get('/mon-contrat/{id?}', 'HomeController@display_contract')->name('mon-contrat');
Route::get('/infos-personnelles/{id?}', 'HomeController@display_personal_infos')->name('infos-personnelles');
Route::post('/infos-personnelles/{id?}', 'HomeController@display_personal_infos')->name('infos-personnelles');
Route::get('/infos-services/{id?}', 'HomeController@display_services_infos')->name('infos-services');
Route::post('/infos-services/{id?}', 'HomeController@display_services_infos')->name('infos-services');
Route::post('/infos-personnelles/{id?}/update', 'HomeController@update_personal_infos')->name('infos-personnelles.update');
Route::post('/infos-proprietaire/update', 'HomeController@update_personal_infos')->name('infos-proprietaire.update');
Route::get('/suivi-conso/{id?}', 'HomeController@suivi_conso')->name('suivi-conso');
Route::post('/infos-services/{id?}/update', 'HomeController@update_services_infos')->name('infos-services.update');
Route::post('/infos-services-pro/update', 'HomeController@update_services_pro_infos')->name('infos-services-pro.update');


//Route::get('/home', 'HomeController@index')->name('home');
//Route::post('/home', 'HomeController@index')->name('home');
//Route::get('/home', 'HomeController@index')->name('home-woyofal');
Route::post('/mes-factures/{id?}/pay','billController@pay')->name('mes-factures.pay');
Route::get('/mes-factures/{id?}/pay','billController@pay')->name('mes-factures.pay');
Route::post('/mes-factures/{id?}/facture_a_payer','billController@pay_bill')->name('mes-factures.facture_a_payer');
Route::get('/mes-factures/{id?}/buy','ApiController@index')->name('mes-factures.buy');
Route::get('/mes-factures/{id?}/bought','billController@buy')->name('mes-factures.bought');
Route::post('/mes-factures/{id?}/bought','billController@buy')->name('mes-factures.bought');
Route::get('/home/quick',function(){
	return view('quick');
});
Route::get('/admin/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
Route::get('/admin', 'AdminController@index')->name('admin.dashboard');
Route::post('/admin', 'AdminController@index')->name('admin.dashboard');
Route::post('/admin/store','billController@store')->name('admin.store');
Route::post('/admin/updaterate','billController@updaterate')->name('admin.updaterate');
//++++++++++++++++++++++++++++ ROUTES OF THE PARTNER DASHBOARD ++++++++++++++++++++++++++++++++++++++++
Route::get('/admin/dashboard', 'Auth\AdminLoginController@display_dashboard')->name('admin.panel');
Route::post('/admin/dashboard', 'Auth\AdminLoginController@display_dashboard')->name('admin.panel');

Route::post('/dashboard/accueil', 'Auth\AdminLoginController@dashboardLogin')->name('welcome.dashboard');
Route::get('/dashboard/accueil', 'Auth\AdminLoginController@display_panel')->name('welcome.get.dashboard');

Route::post('/dashboard/clients', 'DashboardController@clients_dashboard')->name('clients.dashboard');
Route::get('/dashboard/clients', 'DashboardController@clients_dashboard')->name('clients.dashboard');

Route::post('/dashboard/transactions', 'DashboardController@transactions_dashboard')->name('transactions.dashboard');
Route::get('/dashboard/transactions', 'DashboardController@transactions_dashboard')->name('transactions.dashboard');

Route::post('/dashboard/factures', 'DashboardController@bills_dashboard')->name('bills.dashboard');
Route::get('/dashboard/factures', 'DashboardController@bills_dashboard')->name('bills.dashboard');

Route::post('/dashboard/profil', 'DashboardController@profile_dashboard')->name('profile.dashboard');
Route::get('/dashboard/profil', 'DashboardController@profile_dashboard')->name('profile.dashboard');

Route::post('/dashboard/general', 'DashboardController@company_dashboard')->name('company.dashboard');
Route::get('/dashboard/general', 'DashboardController@company_dashboard')->name('company.dashboard');

Route::post('/dashboard/import', 'DashboardController@import_dashboard')->name('import.dashboard');
Route::get('/dashboard/import/{name?}', 'DashboardController@import_dashboard')->name('import.dashboard');

Route::post('/dashboard/import/download_contacts_tpl','DashboardController@download_contacts_tpl')->name('import.dashboard.download_contacts_tpl');
Route::get('/dashboard/import/download_contacts_tpl','DashboardController@download_contacts_tpl')->name('import.dashboard.download_contacts_tpl');

Route::post('/dashboard/import/download_invoices_tpl','DashboardController@download_invoices_tpl')->name('import.dashboard.download_invoices_tpl');
Route::get('/dashboard/import/download_invoices_tpl','DashboardController@download_invoices_tpl')->name('import.dashboard.download_invoices_tpl');

Route::post('/dashboard/import/load_invoices','DashboardController@load_invoices')->name('import.dashboard.load_invoices');
Route::post('/dashboard/import/load_contacts','DashboardController@load_contacts')->name('import.dashboard.load_contacts');
Route::get('/dashboard/import/load_invoices','DashboardController@load_invoices')->name('import.dashboard.load_invoices');
Route::get('/dashboard/import/load_contacts','DashboardController@load_contacts')->name('import.dashboard.load_contacts');


Route::post('/dashboard/import/final_load_invoices','DashboardController@final_load_invoices')->name('import.dashboard.final_load_invoices');
Route::post('/dashboard/import/final_load_contacts','DashboardController@final_load_contacts')->name('import.dashboard.final_load_contacts');
Route::get('/dashboard/import/final_load_invoices','DashboardController@final_load_invoices')->name('import.dashboard.final_load_invoices');
Route::get('/dashboard/import/final_load_contacts','DashboardController@final_load_contacts')->name('import.dashboard.final_load_contacts');
//++++++++++++++++++++++++++++ END ROUTES OF THE PARTNER DASHBOARD ++++++++++++++++++++++++++++++++++++++++

Route::post('/mes-factures/{id?}/pdf_bill','billController@pdf_bill')->name('mes-factures.pdf_bill');
Route::get('/mes-factures/pdf_buy','billController@pdf_buy')->name('mes-factures.pdf_buy');
Route::post('/mes-factures/{id?}/pdf_bill','billController@pdf_bill')->name('home.pdf_bill');
Route::post('/admin/create-users-demo','Auth\RegisterController@create_users_demo')->name('admin.create_users_demo');
Route::post('/admin/import-bills','AdminController@imports_bills')->name('admin.imports_bills');
Route::post('/admin/import-occupants-bills','AdminController@imports_occupants_bills')->name('admin.imports_occupants_bills');
Route::post('/admin/import-bills-six-months','AdminController@imports_bills_previous_six_month')->name('admin.imports_bills_six_months');

Route::post('/admin/add-service','AdminController@add_service')->name('admin.add_service');
Route::post('/admin/add-partner','AdminController@add_partner')->name('admin.add_partner');

Route::get('/transactions-proprietaire/{id?}','realEstateOwnerController@display_transactions')->name('ownerTransactions');
Route::get('/mes-logements','realEstateOwnerController@display_properties')->name('ownerProperties');
Route::post('/mes-logements/add','realEstateOwnerController@add_housing')->name('mes-logements.add');
Route::post('/mes-logements/update','realEstateOwnerController@update_housing')->name('mes-logements.update');
Route::get('/mes-logements/delete/{id?}','realEstateOwnerController@delete_housing')->name('mes-logements.delete');
Route::post('/mes-logements/delete/{id?}','realEstateOwnerController@delete_housing')->name('mes-logements.delete');
Route::post('/occupant/add','realEstateOwnerController@add_occupant')->name('occupant.add');
Route::get('/mes-locataires/{id?}','realEstateOwnerController@display_locataires')->name('mes-locataires');
Route::post('/mes-locataires-update','realEstateOwnerController@update_occupant')->name('mes-locataires.update');
Route::post('/mes-locataires/delete/{id}','realEstateOwnerController@delete_occupant')->name('mes-locataires.delete');
Route::get('/mes-locataires/delete/{id}','realEstateOwnerController@delete_occupant')->name('mes-locataires.delete');

Route::get('/infos-proprietaire', 'HomeController@display_proprio_infos')->name('infos-proprietaire');
Route::post('/infos-proprietaire', 'HomeController@display_proprio_infos')->name('infos-proprietaire');

Route::get('/infos-services-pro', 'HomeController@display_services_pro_infos')->name('infos-services-pro');
Route::post('/infos-services-pro', 'HomeController@display_services_pro_infos')->name('infos-services-pro');

Route::get('json-api', 'ApiController@index');
