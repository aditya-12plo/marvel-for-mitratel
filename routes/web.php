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
 Route::get('/listuserhq', 'UserController@userhq');
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
   Route::get('GetJobsDocumentSIS', 'JobsController@GetJobsDocumentSIS');
   Route::get('GetJobsRevisiDocumentSIS', 'JobsController@GetJobsRevisiDocumentSIS');
   Route::get('GetJobsApprovalDocumentSIS', 'JobsController@GetJobsApprovalDocumentSIS');
   Route::get('GetJobsApprovalDocumentDRM', 'JobsController@GetJobsApprovalDocumentDRM');
   Route::get('GetJobsRevisiDocumentDRM', 'JobsController@GetJobsRevisiDocumentDRM');


   Route::get('GetJobsDocumentDRM', 'JobsController@GetJobsDocumentDRM');
   Route::get('GetJobsDocumentSITAC', 'JobsController@GetJobsDocumentSITAC');
   Route::get('GetJobsApprovalDocumentSITAC', 'JobsController@GetJobsApprovalDocumentSITAC');
   Route::get('GetJobsRevisiDocumentSITAC', 'JobsController@GetJobsRevisiDocumentSITAC');


   Route::get('GetJobsDocumentRFC', 'JobsController@GetJobsDocumentRFC');
   Route::get('GetJobsApprovalDocumentRFC', 'JobsController@GetJobsApprovalDocumentRFC');
   Route::get('GetJobsRevisiDocumentRFC', 'JobsController@GetJobsRevisiDocumentRFC');
   Route::get('GetJobsBOQ', 'JobsController@GetJobsBOQ');
   Route::get('GetJobsBOQApproval', 'JobsController@GetJobsBOQApproval');
   
   Route::get('GetJobsApprovalDrop', 'JobsController@GetJobsApprovalDrop');



Route::get('GetJobsMappingSite', 'JobsController@GetJobsMappingSite');
Route::get('GetJobsMappingSiteApproved', 'JobsController@GetJobsMappingSiteApproved');



Route::get('HistoryDropSite', 'JobsController@HistoryDropSite');
Route::get('HistoryMappingSite', 'JobsController@HistoryMappingSite');



Route::get('GetJobsSubmitBOQ', 'JobsController@GetJobsSubmitBOQ');


Route::get('GetJobsSubmitBOQData', 'JobsController@GetJobsSubmitBOQData');
 /* get jobs */



 /* get infratype */
Route::get('GetInfratype', 'JobsController@GetInfratype');
 /* get infratype */


 /* get tower high */
 Route::get('GetTowerHigh', 'JobsController@GetTowerHigh');
 /* get tower high */


 /* document sis */
  Route::post('AddDocumentSIS', 'DokumenSISController@store');
   Route::post('RevisiDocumentSIS','DokumenSISController@update');
   Route::post('DeleteSIS','DokumenSISController@delete');
 /* document sis */

 /* document drm */
  Route::post('AddDocumentDRM', 'DokumenDRMController@store');
   Route::post('RevisiDocumentDRM','DokumenDRMController@update');
   Route::post('DeleteDRM','DokumenDRMController@delete');
 /* document drm */


 /* document sitac */
  Route::post('AddDocumentSITAC', 'DokumenSITACController@store');
   Route::post('RevisiDocumentSITAC','DokumenSITACController@update');
   Route::post('uploaddokumenSITAC','DokumenSITACController@upload');
   Route::post('uploaddokumenSITACijinWarga','DokumenSITACController@uploadIjinWarga');
   Route::post('uploaddokumenSITACPKS','DokumenSITACController@uploadPKS');
   Route::post('uploaddokumenSITACIMB','DokumenSITACController@uploadIMB');
   Route::post('DeleteSITAC','DokumenSITACController@delete');
 /* document sitac */


 /* document RFC */
  Route::post('AddDocumentRFC', 'DokumenRFCController@store');
   Route::post('RevisiDocumentRFC','DokumenRFCController@update');
   Route::post('uploaddokumenRFC','DokumenRFCController@uploaddokumenRFC');
   Route::post('DeleteRFC','DokumenRFCController@delete');
 /* document RFC */


 /* approval document */
  Route::post('ApprovalDocumentRegional', 'ApprovalController@approvalRegional');
  Route::post('ApprovalDocumentRegionalRFC', 'ApprovalController@approvalRFC');
 /* approval document */


 /* drop project */
   Route::post('DropProject', 'DropController@drop');
   Route::post('ApprovalDropSiteRegional', 'DropController@dropRegional');
   Route::post('DropProjectHQ', 'DropController@DropProjectHQ');
 /* drop project */



 /* mapping site */
 Route::post('AddMappingSite', 'MappingSiteController@AddMappingSite');
 Route::post('ApprovalMappingSite', 'MappingSiteController@ApprovalMappingSite');
 Route::post('SubmitMappingSite', 'MappingSiteController@SubmitMappingSite');
 /* mapping site */


 /* boq */
 Route::post('AddBOQ', 'BOQController@store');
 Route::post('SubmitBOQ', 'BOQController@SubmitBOQ');
 Route::post('SubmitBOQApproval', 'BOQController@SubmitBOQApproval');
 Route::match(['put', 'patch'], 'EditBOQ/{id}','BOQController@update'); 
 Route::get('GetDetailProject/{id}', 'BOQController@GetDetailProject');
 Route::get('GetDetailProjectBOQ/{id}', 'BOQController@GetDetailProjectBOQ');
 /* boq */





 /* get komunikasi */
    Route::get('GetKomunikasiProject/{id}', 'CommunicationController@GetKomunikasiProject');
 /* get komunikasi */


 /* get detail project all */
Route::get('GetAllDetailProject/{id}', 'ProjectController@GetAllDetailProject'); 
 /* get detail project all */
 
    

 /* get notification */
    Route::get('/GetUserNotifications', 'PesanController@index');
    Route::get('/GetUserNotificationsDetail/{id}', 'PesanController@detail');
 /* get notification */
 
	  
	  
	  
});


















