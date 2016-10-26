<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'HomeController@index');
Route::get('/home', 'HomeController@index');
Route::get('/password/reset', 'Auth\PasswordController@getReset');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');
Route::get('admin/patientreports/{id}/view', [
                            'as'   => 'admin.patientreports.view',
                            'uses' => 'Admin\PatientReportsController@view'
                        ]);
Route::get('admin/patientslooks/{id}/view', [
                            'as'   => 'admin.patientslooks.view',
                            'uses' => 'Admin\PatientsLooksController@view'
                        ]);
Route::any('admin/patientslooks/list', [
                            'as'   => 'admin.patientslooks.list',
                            'uses' => 'Admin\PatientsLooksController@showlist'
                        ]);
Route::any('admin/changepassword',[
                            'as'   => 'changepassword.index',
                            'uses' => 'Admin\ChangePasswordController@index'
                        ]); 
Route::any('admin/change-email',[
                            'as'   => 'changeemail.index',
                            'uses' => 'Admin\ChangeEmailController@index'
                        ]);
Route::any('admin/sitesettings',[
                            'as'   => 'sitesettings.index',
                            'uses' => 'Admin\SiteSettingsController@index'
                        ]); 

Route::controller('/webservice','WebserviceController');


?>
