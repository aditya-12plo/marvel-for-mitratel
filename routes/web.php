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
 Route::post('/adduserhaki', 'UserController@adduserhaki');
  Route::match(['put', 'patch'], '/edituserhaki/{id}','UserController@edituserhaki');
 Route::get('/listuserhq', 'UserController@userhq');
 Route::get('/listuserhaki', 'UserController@listuserhaki');
 Route::get('/listuserregionalaccountmanager', 'UserController@userregionalaccountmanager');
 Route::delete('listuserDeleteAll/{id}', 'UserController@deleteAll');
 /* user akses */


/* busdev mail */
Route::resource('/listbusdev', 'BusdevController');
Route::delete('listbusdevDeleteAll/{id}', 'BusdevController@deleteAll');
/* busdev mail */

 /* project */
  Route::resource('/listproject', 'ProjectController');
  Route::delete('/listprojectDeleteAll/{id}', 'ProjectController@deleteAll');
  Route::get('/GetProjectDetail/{id}', 'ProjectController@GetProjectDetail');
  Route::post('uploadproject', 'ProjectController@uploadproject');
  Route::post('updateprojectByAdmin', 'ProjectController@updateprojectByAdmin');
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
   Route::get('GetJobsPO', 'JobsController@GetJobsPO');
   
   Route::get('GetJobsApprovalDrop', 'JobsController@GetJobsApprovalDrop');



Route::get('GetJobsMappingSite', 'JobsController@GetJobsMappingSite');
Route::get('GetJobsMappingSiteApproved', 'JobsController@GetJobsMappingSiteApproved');



Route::get('HistoryDropSite', 'JobsController@HistoryDropSite');
Route::get('HistoryMappingSite', 'JobsController@HistoryMappingSite');



Route::get('GetJobsSubmitBOQ', 'JobsController@GetJobsSubmitBOQ');


Route::get('GetJobsSubmitBOQData', 'JobsController@GetJobsSubmitBOQData');
Route::get('GetJobsSubmitBOQRepair', 'JobsController@GetJobsSubmitBOQRepair');


Route::get('GetJobsSubmitBOQApproved', 'JobsController@GetJobsSubmitBOQApproved');
Route::get('GetJobsApprovalDropHQ', 'JobsController@GetJobsApprovalDropHQ');
Route::get('GetJobsSubmitBOQVerifikasi', 'JobsController@GetJobsSubmitBOQVerifikasi');
Route::get('GetJobsSubmitBOQProsesPR', 'JobsController@GetJobsSubmitBOQProsesPR');
Route::get('GetJobsSubmitBOQPORelease', 'JobsController@GetJobsSubmitBOQPORelease');



Route::get('GetJobsSiteOpening', 'JobsController@GetJobsSiteOpening');
Route::get('GetJobsSiteOpeningRevisi', 'JobsController@GetJobsSiteOpeningRevisi');
Route::get('GetJobsExcavation', 'JobsController@GetJobsExcavation');
Route::get('GetJobsExcavationRevisi', 'JobsController@GetJobsExcavationRevisi');
Route::get('GetJobsRebaring', 'JobsController@GetJobsRebaring');
Route::get('GetJobsRebaringRevisi', 'JobsController@GetJobsRebaringRevisi');
Route::get('GetJobsPouring', 'JobsController@GetJobsPouring');
Route::get('GetJobsPouringRevisi', 'JobsController@GetJobsPouringRevisi');
Route::get('GetJobsCuring', 'JobsController@GetJobsCuring');
Route::get('GetJobsCuringRevisi', 'JobsController@GetJobsCuringRevisi');
Route::get('GetJobsTowerErection', 'JobsController@GetJobsTowerErection');
Route::get('GetJobsTowerErectionRevisi', 'JobsController@GetJobsTowerErectionRevisi');
Route::get('GetJobsMEProcess', 'JobsController@GetJobsMEProcess');
Route::get('GetJobsMEProcessRevisi', 'JobsController@GetJobsMEProcessRevisi');
Route::get('GetJobsFenceYard', 'JobsController@GetJobsFenceYard');
Route::get('GetJobsFenceYardRevisi', 'JobsController@GetJobsFenceYardRevisi');

Route::get('GetJobsRfiBaut', 'JobsController@GetJobsRfiBaut');
Route::get('GetJobsRfiBautRevisi', 'JobsController@GetJobsRfiBautRevisi');
Route::get('GetJobsApprovalDocumentCME', 'JobsController@GetJobsApprovalDocumentCME');


Route::get('GetJobsRfiDetailRevisi', 'JobsController@GetJobsRfiDetailRevisi');
Route::get('GetJobsRfiDetail', 'JobsController@GetJobsRfiDetail');
Route::get('GetJobsSubmitCME', 'JobsController@GetJobsSubmitCME');
Route::get('GetJobsSubmitCMEApproval', 'JobsController@GetJobsSubmitCMEApproval');
Route::get('GetDetailProjectCME/{id}', 'JobsController@GetDetailProjectCME');
Route::get('GetJobsApprovalDocumentCMESubmit', 'JobsController@GetJobsApprovalDocumentCMESubmit');
Route::get('GetJobsApprovalDocumentCMESubmitRevisi', 'JobsController@GetJobsApprovalDocumentCMESubmitRevisi');
Route::get('GetJobsApprovedDocumentCME', 'JobsController@GetJobsApprovedDocumentCME');
Route::get('GetJobsApprovedDocumentCMEReport', 'JobsController@GetJobsApprovedDocumentCMEReport');
Route::get('GetJobsSubmitCMERevisian/{id}/hasil', 'JobsController@GetJobsSubmitCMERevisian');
Route::get('GetJobsSubmitBOQRevisian/{id}/hasil', 'JobsController@GetJobsSubmitBOQRevisian');
Route::get('GetJobsApprovedDocumentCMEToAccrued', 'JobsController@GetJobsApprovedDocumentCMEToAccrued');
Route::get('GetJobsApprovedDocumentCMEAccruedData', 'JobsController@GetJobsApprovedDocumentCMEAccruedData');
Route::get('GetJobsDocumentBaksBauk', 'JobsController@GetJobsDocumentBaksBauk');
Route::get('GetJobsApprovalDocumentBaksBauk', 'JobsController@GetJobsApprovalDocumentBaksBauk');
Route::get('GetJobsDocumentBaksBaukRevisi', 'JobsController@GetJobsDocumentBaksBaukRevisi');
Route::get('GetJobsDocumentBoqBaps', 'JobsController@GetJobsDocumentBoqBaps');
Route::get('GetJobsDocumentBoqBapsRevisi', 'JobsController@GetJobsDocumentBoqBapsRevisi');
Route::get('GetJobsDocumentBaps', 'JobsController@GetJobsDocumentBaps');
Route::get('GetJobsDocumentBapsRevisi', 'JobsController@GetJobsDocumentBapsRevisi');
Route::get('GetJobsDocumentInvoice', 'JobsController@GetJobsDocumentInvoice');
Route::get('GetJobsDocumentInvoiceRevisi', 'JobsController@GetJobsDocumentInvoiceRevisi');
Route::get('GetJobsReportBisnis', 'JobsController@GetJobsReportBisnis');

 /* get jobs */



 /* get infratype */
Route::get('GetInfratype', 'JobsController@GetInfratype');
 /* get infratype */


 /* get tower high */
 Route::get('GetTowerHigh', 'JobsController@GetTowerHigh');
 /* get tower high */


 /* get status */
 Route::get('GetStatus', 'JobsController@GetStatus');
 /* get status */


 /* get batch */
  Route::get('GetBatch', 'JobsController@GetBatch');
 /* get batch */


 /* document sis */
  Route::post('AddDocumentSIS', 'DokumenSISController@store');
   Route::post('RevisiDocumentSIS','DokumenSISController@update');
   Route::post('DeleteSIS','DokumenSISController@delete');
   Route::post('ApprovedSISMassal','DokumenSISController@ApprovedMassal');
   Route::post('updateSISByAdmin','DokumenSISController@updateSISByAdmin');
   Route::get('getSISDocument/{id}','DokumenSISController@getSISDocument');
 /* document sis */

 /* document drm */
  Route::post('AddDocumentDRM', 'DokumenDRMController@store');
   Route::post('RevisiDocumentDRM','DokumenDRMController@update');
   Route::post('DeleteDRM','DokumenDRMController@delete');
   Route::post('ApprovedDRMMassal','DokumenDRMController@ApprovedMassal');
   Route::post('updateDRMByAdmin','DokumenDRMController@updateDRMByAdmin');
   Route::post('uploaddokumenKOMByAdmin','DokumenDRMController@uploaddokumenKOMByAdmin');
   Route::post('uploaddokumenDRMByAdmin','DokumenDRMController@uploaddokumenDRMByAdmin');
   Route::get('getDRMDocument/{id}','DokumenDRMController@getDRMDocument');
 /* document drm */


 /* document sitac */
  Route::post('AddDocumentSITAC', 'DokumenSITACController@store');
   Route::post('RevisiDocumentSITAC','DokumenSITACController@update');
   Route::post('uploaddokumenSITAC','DokumenSITACController@upload');
   Route::post('uploaddokumenSITACijinWarga','DokumenSITACController@uploadIjinWarga');
   Route::post('uploaddokumenSITACPKS','DokumenSITACController@uploadPKS');
   Route::post('uploaddokumenSITACIMB','DokumenSITACController@uploadIMB');
   Route::post('DeleteSITAC','DokumenSITACController@delete');
   Route::post('ApprovedSITACMassal','DokumenSITACController@ApprovedSITACMassal');
   Route::get('getSITACDocument/{id}','DokumenSITACController@getSITACDocument');
   Route::post('uploaddokumenSITACByAdmin','DokumenSITACController@uploaddokumenSITACByAdmin');
   Route::post('uploaddokumenSITACijinWargaByAdmin','DokumenSITACController@uploaddokumenSITACijinWargaByAdmin');
   Route::post('uploaddokumenSITACPKSByAdmin','DokumenSITACController@uploaddokumenSITACPKSByAdmin');
   Route::post('uploaddokumenSITACIMBByAdmin','DokumenSITACController@uploaddokumenSITACIMBByAdmin');
   Route::post('RevisiDocumentSITACByAdmin','DokumenSITACController@RevisiDocumentSITACByAdmin');
 /* document sitac */


 /* document RFC */
  Route::post('AddDocumentRFC', 'DokumenRFCController@store');
   Route::post('RevisiDocumentRFC','DokumenRFCController@update');
   Route::post('uploaddokumenRFC','DokumenRFCController@uploaddokumenRFC');
   Route::post('DeleteRFC','DokumenRFCController@delete');
   Route::post('ApprovedRFCMassal','DokumenRFCController@ApprovedRFCMassal');
   Route::post('uploaddokumenRFCByAdmin','DokumenRFCController@uploaddokumenRFCByAdmin');
   Route::post('RevisiDocumentRFCByAdmin','DokumenRFCController@RevisiDocumentRFCByAdmin');
 /* document RFC */


 /* approval document */
  Route::post('ApprovalDocumentRegional', 'ApprovalController@approvalRegional');
  Route::post('ApprovalDocumentRegionalRFC', 'ApprovalController@approvalRFC');
  Route::post('ApprovalDocumentRegionalCME', 'ApprovalController@approvalCME');
 /* approval document */


 /* drop project */
   Route::post('DeleteProjectData', 'DropController@DeleteProjectData');
   Route::post('DropProject', 'DropController@drop');
   Route::post('ApprovalDropSiteRegional', 'DropController@dropRegional');
   Route::post('DropProjectHQ', 'DropController@DropProjectHQ');
   Route::post('DropProjectHaki', 'DropController@DropProjectHaki');
   Route::post('ApprovalDropSiteHQ', 'DropController@dropHQ');
 /* drop project */



 /* mapping site */
 Route::post('AddMappingSite', 'MappingSiteController@AddMappingSite');
 Route::post('ApprovalMappingSite', 'MappingSiteController@ApprovalMappingSite');
 Route::post('SubmitMappingSite', 'MappingSiteController@SubmitMappingSite');
 Route::post('MappingProjectHQ', 'MappingSiteController@MappingProjectHQ');
 /* mapping site */


 /* boq */
 Route::post('AddBOQ', 'BOQController@store');
 Route::post('SubmitBOQ', 'BOQController@SubmitBOQ');
 Route::post('RevisiDocumentBOQByAdmin', 'BOQController@RevisiDocumentBOQByAdmin');
 Route::post('SubmitBOQCancel', 'BOQController@SubmitBOQCancel');
 Route::post('SubmitBOQApproval', 'BOQController@SubmitBOQApproval');
 Route::post('SubmitBOQApprovalRevisi', 'BOQController@SubmitBOQApprovalRevisi');
 Route::match(['put', 'patch'], 'EditBOQ/{id}','BOQController@update'); 
 Route::get('GetDetailProject/{id}', 'BOQController@GetDetailProject');
 Route::get('GetDetailProjectBOQ/{id}', 'BOQController@GetDetailProjectBOQ');
 Route::post('downloadPDFBOQ', 'BOQController@downloadPDFBOQ');
 Route::post('SubmitBOQApprovalVerifikasi', 'BOQController@SubmitBOQApprovalVerifikasi');
 Route::post('SubmitBOQApprovalProsesPR', 'BOQController@SubmitBOQApprovalProsesPR');
 Route::post('SubmitBOQApprovalPORelease', 'BOQController@SubmitBOQApprovalPORelease');
 Route::get('GetBOQVerifikasi/{id}', 'BOQController@GetBOQVerifikasi');
 Route::get('GetBOQProsesPR/{id}', 'BOQController@GetBOQProsesPR');
 Route::get('GetBOQPORelease/{id}', 'BOQController@GetBOQPORelease');
 Route::post('UpdateBOQRevisi', 'BOQController@UpdateBOQRevisi');
 /* boq */


 /* po */
 Route::post('AddPO', 'POController@AddPO');
 Route::post('RevisiDocumentPOByAdmin', 'POController@RevisiDocumentPOByAdmin');
 /* po */


 /* site opening */
  Route::post('RevisiDocumentSiteOpeningByAdmin', 'SiteOpeningController@RevisiDocumentSiteOpeningByAdmin');
  Route::post('uploaddokumenSiteOpeningByAdmin', 'SiteOpeningController@uploaddokumenSiteOpeningByAdmin');
  Route::post('AddDocumentSiteOpening', 'SiteOpeningController@AddDocumentSiteOpening');
  Route::post('DocumentSiteOpeningPerbaikan', 'SiteOpeningController@DocumentSiteOpeningPerbaikan');
  Route::post('RevisiDocumentSiteOpening', 'SiteOpeningController@RevisiDocumentSiteOpening');
 /* site opening */


 /* excavation */
Route::post('RevisiDocumentExcavationByAdmin', 'ExcavationController@RevisiDocumentExcavationByAdmin');
Route::post('uploaddokumenExcavationByAdmin', 'ExcavationController@uploaddokumenExcavationByAdmin');
Route::post('AddDocumentExcavation', 'ExcavationController@AddDocumentExcavation');
Route::post('DocumentExcavationPerbaikan', 'ExcavationController@DocumentExcavationPerbaikan');
Route::post('RevisiDocumentExcavation', 'ExcavationController@RevisiDocumentExcavation');
 /* excavation */


 /* Rebaring */
Route::post('RevisiDocumentRebaringByAdmin', 'RebaringController@RevisiDocumentRebaringByAdmin');
Route::post('uploaddokumenRebaringByAdmin', 'RebaringController@uploaddokumenRebaringByAdmin');
Route::post('AddDocumentRebaring', 'RebaringController@AddDocumentRebaring');
Route::post('DocumentRebaringPerbaikan', 'RebaringController@DocumentRebaringPerbaikan');
Route::post('RevisiDocumentRebaring', 'RebaringController@RevisiDocumentRebaring');
 /* Rebaring */



 /* Pouring */
Route::post('RevisiDocumentPouringByAdmin', 'PouringController@RevisiDocumentPouringByAdmin');
Route::post('uploaddokumenPouringByAdmin', 'PouringController@uploaddokumenPouringByAdmin');
Route::post('AddDocumentPouring', 'PouringController@AddDocumentPouring');
Route::post('DocumentPouringPerbaikan', 'PouringController@DocumentPouringPerbaikan');
Route::post('RevisiDocumentPouring', 'PouringController@RevisiDocumentPouring');
 /* Pouring */




 /* Curing */
Route::post('RevisiDocumentCuringByAdmin', 'CuringController@RevisiDocumentCuringByAdmin');
Route::post('uploaddokumenCuringByAdmin', 'CuringController@uploaddokumenCuringByAdmin');
Route::post('AddDocumentCuring', 'CuringController@AddDocumentCuring');
Route::post('DocumentCuringPerbaikan', 'CuringController@DocumentCuringPerbaikan');
Route::post('RevisiDocumentCuring', 'CuringController@RevisiDocumentCuring');
 /* Curing */



 /* Tower Erection */
Route::post('uploaddokumenTowerErectionByAdmin', 'TowerErectionController@uploaddokumenTowerErectionByAdmin');
Route::post('RevisiDocumentTowerErectionByAdmin', 'TowerErectionController@RevisiDocumentTowerErectionByAdmin');
Route::post('AddDocumentTowerErection', 'TowerErectionController@AddDocumentTowerErection');
Route::post('DocumentTowerErectionPerbaikan', 'TowerErectionController@DocumentTowerErectionPerbaikan');
Route::post('RevisiDocumentTowerErection', 'TowerErectionController@RevisiDocumentTowerErection');
 /* Tower Erection */



 /* M-E Process */
Route::post('uploaddokumenMEProcessByAdmin', 'MEProcessController@uploaddokumenMEProcessByAdmin');
Route::post('RevisiDocumentMEProcessByAdmin', 'MEProcessController@RevisiDocumentMEProcessByAdmin');
Route::post('AddDocumentMEProcess', 'MEProcessController@AddDocumentMEProcess');
Route::post('DocumentMEProcessPerbaikan', 'MEProcessController@DocumentMEProcessPerbaikan');
Route::post('RevisiDocumentMEProcess', 'MEProcessController@RevisiDocumentMEProcess');
 /* M-E Process */




 /* FenceYard */
Route::post('uploaddokumenFenceYardByAdmin', 'FenceYardController@uploaddokumenFenceYardByAdmin');
Route::post('RevisiDocumentFenceYardByAdmin', 'FenceYardController@RevisiDocumentFenceYardByAdmin');
Route::post('AddDocumentFenceYard', 'FenceYardController@AddDocumentFenceYard');
Route::post('DocumentFenceYardPerbaikan', 'FenceYardController@DocumentFenceYardPerbaikan');
Route::post('RevisiDocumentFenceYard', 'FenceYardController@RevisiDocumentFenceYard');
 /* FenceYard */





 /* Rfi Baut */
Route::post('uploaddokumenBAUTByAdmin', 'RfiBautController@uploaddokumenBAUTByAdmin');
Route::post('uploaddokumenRFIByAdmin', 'RfiBautController@uploaddokumenRFIByAdmin');
Route::post('RevisiDocumentRFIBAUTByAdmin', 'RfiBautController@RevisiDocumentRFIBAUTByAdmin');
Route::post('AddDocumentRfiBaut', 'RfiBautController@AddDocumentRfiBaut');
Route::post('DocumentRfiBautPerbaikan', 'RfiBautController@DocumentRfiBautPerbaikan');
Route::post('RevisiDocumentCME', 'RfiBautController@RevisiDocumentCME');
 /* Rfi Baut */



 /* repair data haki */
Route::post('uploadrfi_document', 'RfiBautController@uploadrfi_document');
Route::post('uploadbaut_document', 'RfiBautController@uploadbaut_document');
Route::post('uploadm_e_process_document', 'RfiBautController@uploadm_e_process_document');
Route::post('uploadtower_erection_document', 'RfiBautController@uploadtower_erection_document');
Route::post('uploadcuring_document', 'RfiBautController@uploadcuring_document');
Route::post('uploadpouring_document', 'RfiBautController@uploadpouring_document');
Route::post('uploadexcavation_document', 'RfiBautController@uploadexcavation_document');
Route::post('uploaddocument_site_opening', 'RfiBautController@uploaddocument_site_opening');
Route::post('ApprovedCMEMassal', 'RfiBautController@ApprovedCMEMassal');
 /* repair data haki */



 /* RFI Detail */ 
Route::post('AddDocumentRfiDetail', 'RfiDetailController@AddDocumentRfiDetail');
Route::post('RevisiDocumentCMEDetail', 'RfiDetailController@RevisiDocumentCMEDetail');
Route::post('SubmitCME', 'RfiDetailController@SubmitCME');
Route::post('SubmitRFIDetailMassal', 'RfiDetailController@SubmitRFIDetailMassal');
Route::post('ApprovalRfiDetail', 'RfiDetailController@ApprovalRfiDetail');
 /* RFI Detail */


 /* CME */
Route::post('SubmitCMEAccrual', 'RfiDetailController@SubmitCMEAccrual');
Route::post('CancelCMEAccrual', 'RfiDetailController@CancelCMEAccrual');
Route::post('UpdateCMEAccrualRevisi', 'RfiDetailController@UpdateCMEAccrualRevisi');
Route::post('UpdateCMEAccrual', 'RfiDetailController@UpdateCMEAccrual');
Route::post('ApprovalDocumentCMEManagerHaki', 'RfiDetailController@ApprovalDocumentCMEManagerHaki');
Route::post('SubmitCMEToAccrued', 'RfiDetailController@SubmitCMEToAccrued');
Route::get('GetCMEAccruedData/{id}', 'RfiDetailController@GetCMEAccruedData');
Route::get('GetCMEAccruedDataNya/{id}', 'RfiDetailController@GetCMEAccruedDataNya');
 /* CME */


 /* BAKS BAUK */
 Route::post('AddDocumentBaksBauk', 'BaksBaukController@AddDocumentBaksBauk');
 Route::post('uploaddokumenBaks', 'BaksBaukController@uploaddokumenBaks');
 Route::post('uploaddokumenWctr', 'BaksBaukController@uploaddokumenWctr');
 Route::post('uploaddokumenBoqProject', 'BaksBaukController@uploaddokumenBoqProject');
 Route::post('uploaddokumenRfiCertificate', 'BaksBaukController@uploaddokumenRfiCertificate');
 Route::post('RevisiDocumentBaksBauk', 'BaksBaukController@RevisiDocumentBaksBauk');
 /* BAKS BAUK */

/* BOQ BAPS  
 Route::post('AddDocumentBoqBaps', 'BoqBapsController@AddDocumentBoqBaps');
 Route::post('RevisiDocumentBoqBaps', 'BoqBapsController@RevisiDocumentBoqBaps');
/* BOQ BAPS  


/* BAPS  
 Route::post('AddDocumentBaps', 'BapsController@AddDocumentBaps'); 
 Route::post('RevisiDocumentBaps', 'BapsController@RevisiDocumentBaps'); 
/* BAPS */


/* Invoice */
 Route::post('AddDocumentInvoice', 'InvoiceController@AddDocumentInvoice');  
 Route::post('AddDocumentRevisiInvoice', 'InvoiceController@AddDocumentRevisiInvoice');  
 Route::post('uploaddokumenBoqBaps', 'InvoiceController@uploaddokumenBoqBaps');    
 Route::post('uploaddokumenBaps', 'InvoiceController@uploaddokumenBaps');  
 Route::post('uploadinvoice', 'InvoiceController@uploadinvoice');
/* Invoice */



 /* tracking site */
  Route::get('TrackingSite', 'TrackingController@index');
  Route::get('history-project-by-years-pie-chart/{years}', 'TrackingController@historyPieChart');
  Route::get('TrackingSiteByYears/{years}', 'TrackingController@TrackingSiteByYears');
 /* tracking site */




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



 /* download file */
 Route::post('DownloadExcelBisnis', 'DownloadController@DownloadExcelBisnis');
 Route::post('DownloadExcelTracking', 'DownloadController@DownloadExcelTracking');
 Route::post('printHaki', 'DownloadController@printHaki');
 Route::post('printHakiAccrual', 'DownloadController@printHakiAccrual');
 Route::post('printHakiAccrued', 'DownloadController@printHakiAccrued');
 /* download file */



 /* home */
    Route::get('/homePage', 'JobsController@homePage');
    Route::get('/homePageNasional', 'JobsController@homePageNasional');
 /* home */
 
	  
	  
	  
});


















