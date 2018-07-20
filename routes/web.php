<?php


Route::get('/', function () {
    return view('welcome');
});
Route::get('/test', function () {
    return view('test');
});

Route::get('page-not-found',['as' => 'pagenotfound','uses' => 'IndexController@pagenotfound']);


// for change languge
Route::get('langauage/{locale}', function ($locale) {
  if (in_array($locale, \Config::get('app.locales'))) {
    Session::put('locale', $locale);
  }
  return redirect()->back();
});





//for employee
Route::group(['prefix' => 'karyawan'], function () {
Route::get('/login', 'Karyawan\Auth\LoginController@showLoginForm')->name('karyawan.login');
Route::post('login', 'Karyawan\Auth\LoginController@login')->name('karyawan.login');
Route::post('logout', 'Karyawan\Auth\LoginController@logout')->name('karyawan.logout');
Route::get('password/reset', 'Karyawan\Auth\ForgotPasswordController@showLinkRequestForm')->name('karyawan.password.request');
Route::post('password/email', 'Karyawan\Auth\ForgotPasswordController@sendResetLinkEmail')->name('karyawan.password.email');
Route::get('password/reset/{token}', 'Karyawan\Auth\ResetPasswordController@showResetForm')->name('karyawan.reset');
Route::post('password/reset', 'Karyawan\Auth\ResetPasswordController@reset')->name('karyawan.password.request');



 Route::get('/', 'KaryawanController@index');


 Route::get('/CekUserProfileAkses/{kode}', 'KaryawanController@CekUserProfileAkses');


 Route::get('/GetProfile', 'KaryawanController@GetProfile');
 Route::post('/changePassword', 'KaryawanController@changePassword');




/* user akses */
 Route::resource('/listuser', 'UserController');
 Route::get('/listuserregional', 'UserController@userregional');
 Route::get('/listuserregionalaccountmanager', 'UserController@userregionalaccountmanager');
 Route::delete('listuserDeleteAll/{id}', 'UserController@deleteAll');
 /* user akses */



 /* project */
  Route::resource('/listproject', 'ProjectController');
  Route::delete('/listprojectDeleteAll/{id}', 'ProjectController@deleteAll');
  Route::get('/GetProjectDetail/{id}', 'ProjectController@GetProjectDetail');
  Route::post('uploadproject', 'ProjectController@uploadproject');
 /* project */


 /* status project */
  Route::get('get-status', 'StatusController@GetStatus');
 /* status project */



 /* get jobs */
   Route::get('/GetJobsDocumentSIS', 'JobsController@GetJobsDocumentSIS');
   Route::get('/GetJobsRevisiDocumentSIS', 'JobsController@GetJobsRevisiDocumentSIS');
   Route::get('/GetJobsApprovalDocumentSIS', 'JobsController@GetJobsApprovalDocumentSIS');
 /* get jobs */


 /* document sis */
  Route::post('/AddDocumentSIS', 'DokumenSISController@store');
   Route::match(['put', 'patch'],'RevisiDocumentSIS/{id}','DokumenSISController@RevisiDocumentSIS');
 /* document sis */



 /* approval document */
  Route::post('/ApprovalDocumentRegional', 'ApprovalController@approvalRegional');
 /* approval document */



 /* get komunikasi */
    Route::get('/GetKomunikasiProject/{id}', 'CommunicationController@GetKomunikasiProject');
 /* get komunikasi */
 
	  
	  
	  
});


















