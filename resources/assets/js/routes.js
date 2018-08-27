import VueRouter from 'vue-router';


let routes=[
{
	path:'/',
	component:require('./components/Home/')
},
{
	path:'/KProfile',
	component:require('./components/Users/Profil')
},

{
	path:'*',
	component:require('./components/Error/404')
},
{
	path:'/page-not-found',
	component:require('./components/Error/404')
},
{
	path:'/server-error',
	component:require('./components/Error/500')
},








/* list users akses account manager regional  */
{
	path:'/user-access-for-regional-account-manager',
	component:require('./components/RegionalAccountManager/')
},
{
	path:'/user-access-for-regional-account-manager/add',
	name: 'userregionalaccountmanageradd',
	component:require('./components/RegionalAccountManager/Add'),
	props: true
},
{
	path:'/user-access-for-regional-account-manager/detail/:id',
	name: 'userregionalaccountmanagerdetail',
	component:require('./components/RegionalAccountManager/Detail'),
	 props: true
},
{
	path:'/user-access-for-regional-account-manager/edit/:id',
	name: 'userregionalaccountmanageredit',
	component:require('./components/RegionalAccountManager/Edit'),
	 props: true
},
/* list users akses account manager regional  */




/* document SIS  */
{
	path:'/documents-sis',
	component:require('./components/DocumentSIS/')
},
{
	path:'/approval-documents-sis',
	component:require('./components/DocumentSIS/Approval')
},
{
	path:'/approval-documents-sis/approval',
	name: 'approvaldocumentsis',
	component:require('./components/DocumentSIS/Approved'),
	props: true
},
{
	path:'/documents-sis/add',
	name: 'adddocumentsis',
	component:require('./components/DocumentSIS/Add'),
	props: true
},
{
	path:'/repair-documents-sis', 
	component:require('./components/DocumentSIS/Repair') 
},
{
	path:'/repair-documents-sis/repair',
	name: 'revisidocumentsis',
	component:require('./components/DocumentSIS/RepairDocument'),
	props: true
},
/* document SIS  */


/* document DRM  */
{
	path:'/documents-drm',
	component:require('./components/DocumentDRM/')
},
{
	path:'/documents-drm/add',
	name: 'adddocumentdrm',
	component:require('./components/DocumentDRM/Add'),
	props: true
},
{
	path:'/approval-documents-drm',
	component:require('./components/DocumentDRM/Approval')
},
{
	path:'/approval-documents-drm/approval',
	name: 'approvaldocumentdrm',
	component:require('./components/DocumentDRM/Approved'),
	props: true
},
{
	path:'/repair-documents-drm', 
	component:require('./components/DocumentDRM/Repair') 
},
{
	path:'/repair-documents-drm/repair',
	name: 'revisidocumentdrm',
	component:require('./components/DocumentDRM/RepairDocument'),
	props: true
},
/* document DRM  */



/* document SITAC  */
{
	path:'/documents-sitac',
	component:require('./components/DocumentSITAC/')
},
{
	path:'/documents-sitac/add',
	name: 'adddocumentsitac',
	component:require('./components/DocumentSITAC/Add'),
	props: true
},
{
	path:'/approval-documents-sitac',
	component:require('./components/DocumentSITAC/Approval')
},
{
	path:'/approval-documents-sitac/approval',
	name: 'approvaldocumentsitac',
	component:require('./components/DocumentSITAC/Approved'),
	props: true
},
{
	path:'/repair-documents-sitac', 
	component:require('./components/DocumentSITAC/Repair') 
},
{
	path:'/repair-documents-sitac/repair',
	name: 'revisidocumentsitac',
	component:require('./components/DocumentSITAC/RepairDocument'),
	props: true
},
/* document SITAC  */




/* document RFC  */
{
	path:'/documents-rfc',
	component:require('./components/DocumentRFC/')
},
{
	path:'/documents-rfc/add',
	name: 'adddocumentrfc',
	component:require('./components/DocumentRFC/Add'),
	props: true
},
{
	path:'/approval-documents-rfc',
	component:require('./components/DocumentRFC/Approval')
},
{
	path:'/approval-documents-rfc/approval',
	name: 'approvaldocumentrfc',
	component:require('./components/DocumentRFC/Approved'),
	props: true
},
{
	path:'/repair-documents-rfc', 
	component:require('./components/DocumentRFC/Repair') 
},
{
	path:'/repair-documents-rfc/repair',
	name: 'revisidocumentrfc',
	component:require('./components/DocumentRFC/RepairDocument'),
	props: true
},
/* document RFC  */



/* mapping site  */
{
	path:'/approval-mapping-site',
	component:require('./components/MappingSite/Approval')
},
{
	path:'/input-mapping-site',
	component:require('./components/MappingSite/')
},
{
	path:'/approval-mapping-site/approval',
	name: 'approvalmappingsite',
	component:require('./components/MappingSite/Approved'),
	props: true
},
{
	path:'/input-mapping-site/add',
	name: 'addmappingsite',
	component:require('./components/MappingSite/Add'),
	props: true
},
/* mapping site  */


/* history  */
{
	path:'/history-drop-site',
	component:require('./components/History/Drop')
},
{
	path:'/history-mapping-site',
	component:require('./components/History/Mapping')
},
{
	path:'/history-site/approval',
	name: 'detailHistory',
	component:require('./components/History/Detail'),
	props: true
},

/* history  */

 

/* drop  */
{
	path:'/approval-drop-project',
	component:require('./components/Drop/Approval')
},
{
	path:'/approval-drop-project-hq',
	component:require('./components/Drop/ApprovalHQ')
},
{
	path:'/approval-drop-project/approval',
	name: 'approvaldrop',
	component:require('./components/Drop/Approved'),
	props: true
},
{
	path:'/approval-drop-project-hq/approval',
	name: 'approvaldrophq',
	component:require('./components/Drop/ApprovedHQ'),
	props: true
},
/* drop  */


/* BOQ  */
{
	path:'/boq-po-release',
	component:require('./components/BOQ/BOQPORelease')
},
{
	path:'/boq-proses-pr',
	component:require('./components/BOQ/BOQProsesPR')
},
{
	path:'/boq-verifikasi',
	component:require('./components/BOQ/BOQVerifikasi')
},
{
	path:'/boq-approved',
	component:require('./components/BOQ/ApprovedData')
},
{
	path:'/approval-boq',
	component:require('./components/BOQ/Approval')
},
{
	path:'/boq-input',
	component:require('./components/BOQ/')
},
{
	path:'/boq-submit',
	component:require('./components/BOQ/Submit')
},
{
	path:'/boq-repair',
	component:require('./components/BOQ/RepairIndex')
},
{
	path:'/boq-approved/:id',
	name: 'approvedboq',
	component:require('./components/BOQ/ApprovedDataDetail'),
	props: true
},
{
	path:'/boq-po-release/submit/:id',
	name: 'approvedboqporeleasesubmit',
	component:require('./components/BOQ/BOQPOReleaseSubmit'),
	props: true
},
{
	path:'/boq-proses-pr/submit/:id',
	name: 'approvedboqprosesprsubmit',
	component:require('./components/BOQ/BOQProsesPRSubmit'),
	props: true
},
{
	path:'/boq-verifikasi/submit/:id',
	name: 'approvedboqverifikasisubmit',
	component:require('./components/BOQ/BOQVerifikasiSubmit'),
	props: true
},
{
	path:'/approval-boq/:id',
	name: 'approvalboq',
	component:require('./components/BOQ/Approved'),
	props: true
},
{
	path:'/approval-boq-repair/:id',
	name: 'approvalboqrepair',
	component:require('./components/BOQ/Repair'),
	props: true
},
{
	path:'/approval-boq/detail/:id',
	name: 'approvalboqdetailprojectnya',
	component:require('./components/BOQ/Detailnya'),
	props: true
},
{
	path:'/boq-input/data/:id',
	name: 'adddocumentboq',
	component:require('./components/BOQ/Add'),
	props: true
},
{
	path:'/boq-submit-data/:id',
	name: 'submitboqdetail',
	component:require('./components/BOQ/Detail'),
	props: true
},
{
	path:'/boq-submit-data/edit/:id',
	name: 'editboqdetail',
	component:require('./components/BOQ/Edit'),
	props: true
},
{
	path:'/boq-submit-data/detail',
	name: 'beforesubmitboqdata',
	component:require('./components/BOQ/BeforeSubmit'),
	props: true
},
/* BOQ  */


/* site opening  */
{
	path:'/site-opening-add',
	component:require('./components/SiteOpening/')
},
{
	path:'/site-opening-add/add/:id',
	name: 'addsiteopening',
	component:require('./components/SiteOpening/Add'),
	props: true
},
{
	path:'/site-opening-revisi',
	component:require('./components/SiteOpening/IndexRevisi')
},
{
	path:'/site-opening-revisi/edit/:id',
	name: 'revisisiteopening',
	component:require('./components/SiteOpening/Revisi'),
	props: true
},

/* site opening  */


/* Excavation  */
{
	path:'/excavation-add',
	component:require('./components/Excavation/')
},
{
	path:'/excavation-add/add/:id',
	name: 'addexcavation',
	component:require('./components/Excavation/Add'),
	props: true
},
{
	path:'/excavation-revisi',
	component:require('./components/Excavation/IndexRevisi')
},
{
	path:'/excavation-revisi/edit/:id',
	name: 'revisiexcavation',
	component:require('./components/Excavation/Revisi'),
	props: true
},
/* Excavation  */

/* Rebaring  */
{
	path:'/rebaring-add',
	component:require('./components/Rebaring/')
},
{
	path:'/rebaring-add/add/:id',
	name: 'addrebaring',
	component:require('./components/Rebaring/Add'),
	props: true
},
{
	path:'/rebaring-revisi',
	component:require('./components/Rebaring/IndexRevisi')
},
{
	path:'/rebaring-revisi/edit/:id',
	name: 'revisirebaring',
	component:require('./components/Rebaring/Revisi'),
	props: true
},
/* Rebaring  */




/* pouring  */
{
	path:'/pouring-add',
	component:require('./components/Pouring/')
},
{
	path:'/pouring-add/add/:id',
	name: 'addpouring',
	component:require('./components/Pouring/Add'),
	props: true
},
{
	path:'/pouring-revisi',
	component:require('./components/Pouring/IndexRevisi')
},
{
	path:'/pouring-revisi/edit/:id',
	name: 'revisipouring',
	component:require('./components/Pouring/Revisi'),
	props: true
},
/* pouring  */


/* curing  */
{
	path:'/curing-add',
	component:require('./components/Curing/')
},
{
	path:'/curing-add/add/:id',
	name: 'addcuring',
	component:require('./components/Curing/Add'),
	props: true
},
{
	path:'/curing-revisi',
	component:require('./components/Curing/IndexRevisi')
},
{
	path:'/curing-revisi/edit/:id',
	name: 'revisicuring',
	component:require('./components/Curing/Revisi'),
	props: true
},
/* curing  */



/* tower erection  */
{
	path:'/tower-erection-add',
	component:require('./components/TowerErection/')
},
{
	path:'/tower-erection-add/add/:id',
	name: 'addTowerErection',
	component:require('./components/TowerErection/Add'),
	props: true
},
{
	path:'/tower-erection-revisi',
	component:require('./components/TowerErection/IndexRevisi')
},
{
	path:'/tower-erection-revisi/edit/:id',
	name: 'revisiTowerErection',
	component:require('./components/TowerErection/Revisi'),
	props: true
},
/* tower erection  */




/* M-E Process  */
{
	path:'/m-e-process-add',
	component:require('./components/MEProcess/')
},
{
	path:'/m-e-process-add/add/:id',
	name: 'addMEProcess',
	component:require('./components/MEProcess/Add'),
	props: true
},
{
	path:'/m-e-process-revisi',
	component:require('./components/MEProcess/IndexRevisi')
},
{
	path:'/m-e-process-revisi/edit/:id',
	name: 'revisiMEProcess',
	component:require('./components/MEProcess/Revisi'),
	props: true
},
/* M-E Process  */



/* FenceYard  */
{
	path:'/fence-yard-add',
	component:require('./components/Fence&Yard/')
},
{
	path:'/fence-yard-add/add/:id',
	name: 'addFenceYard',
	component:require('./components/Fence&Yard/Add'),
	props: true
},
{
	path:'/fence-yard-revisi',
	component:require('./components/Fence&Yard/IndexRevisi')
},
{
	path:'/fence-yard-revisi/edit/:id',
	name: 'revisiFenceYard',
	component:require('./components/Fence&Yard/Revisi'),
	props: true
},
/* FenceYard  */



/* FenceYard  */
{
	path:'/rfi-baut-add',
	component:require('./components/RFI&BAUT/')
},
{
	path:'/rfi-baut-add/add/:id',
	name: 'addRfiBaut',
	component:require('./components/RFI&BAUT/Add'),
	props: true
},
{
	path:'/rfi-baut-revisi',
	component:require('./components/RFI&BAUT/IndexRevisi')
},
{
	path:'/rfi-baut-revisi/edit/:id',
	name: 'revisiRfiBaut',
	component:require('./components/RFI&BAUT/Revisi'),
	props: true
},
/* FenceYard  */


/* CME  */
{
	path:'/cme-submit',
	component:require('./components/CME/Submit')
},
{
	path:'/approval-cme',
	component:require('./components/CME/')
},
{
	path:'/approval-cme/detail/:id',
	name: 'approvaldocumentcme',
	component:require('./components/CME/Approved'),
	props: true
},
/* CME  */


/* RFI Detail  */
{
	path:'/cme-rfi-revisi',
	component:require('./components/RFI/IndexRevisi')
},
{
	path:'/cme-rfi-revisi/edit/:id',
	name: 'revisiRfiDetail',
	component:require('./components/RFI/Revisi'),
	props: true
},
{
	path:'/cme-rfi-detail',
	component:require('./components/RFI/')
},
{
	path:'/cme-rfi-detail/add/:id',
	name: 'addRfiDetail',
	component:require('./components/RFI/Add'),
	props: true
},
{
	path:'/approval-documents-rfi-haki',
	component:require('./components/RFI/IndexApproval')
},
{
	path:'/approval-documents-rfi-haki/approved/:id',
	name: 'approvaldocumentrfidetail',
	component:require('./components/RFI/Approved'),
	props: true
},
/* RFI Detail  */




/* list users akses regional  */
{
	path:'/user-access-for-regional',
	component:require('./components/RegionalUsers/')
},
{
	path:'/user-access-for-regional/add',
	name: 'userregionaladd',
	component:require('./components/RegionalUsers/Add'),
	props: true
},
{
	path:'/user-access-for-regional/detail/:id',
	name: 'userregionaldetail',
	component:require('./components/RegionalUsers/Detail'),
	 props: true
},
{
	path:'/user-access-for-regional/edit/:id',
	name: 'userregionaledit',
	component:require('./components/RegionalUsers/Edit'),
	 props: true
},
/* list users akses regional  */



/* list users akses hq  */
{
	path:'/user-access-for-hq',
	component:require('./components/HQUsers/Index')
},
{
	path:'/user-access-for-hq/add',
	name: 'userhqadd',
	component:require('./components/HQUsers/Add'),
	props: true
},
{
	path:'/user-access-for-hq/detail/:id',
	name: 'userhqdetail',
	component:require('./components/HQUsers/Detail'),
	 props: true
},
{
	path:'/user-access-for-hq/edit/:id',
	name: 'userhqedit',
	component:require('./components/HQUsers/Edit'),
	 props: true
},
/* list users akses hq  */


/* list users akses  */
{
	path:'/user-access',
	component:require('./components/Users/')
},
{
	path:'/user-access/add',
	name: 'useradd',
	component:require('./components/Users/Add'),
	props: true
},
{
	path:'/user-access/detail/:id',
	name: 'userdetail',
	component:require('./components/Users/Detail'),
	 props: true
},
{
	path:'/user-access/edit/:id',
	name: 'useredit',
	component:require('./components/Users/Edit'),
	 props: true
},
/* list users akses  */


/* notifications user list  */
{
	path:'/list-notifications',
	component:require('./components/Notifications/')
},
{
	path:'/list-notifications/detail/:id',
	name: 'detailnotification',
	component:require('./components/Notifications/Detail'),
	 props: true
},
/* notifications user list  */




/* tracking site  */
{
	path:'/tracking-site',
	component:require('./components/TrackingSite/')
},
/* tracking site  */

/* project history  */
{
	path:'/project-history/:years',
	component:require('./components/Chart/')
},
{
	path:'/project-history-data/:years',
	component:require('./components/Chart/Data')
},
/* project history  */



/* list project administor  */
{
	path:'/list-project',
	component:require('./components/Project/')
},
{
	path:'/list-project/add-new',
	name: 'projectadd',
	component:require('./components/Project/Add'),
	props: true
},
{
	path:'/list-project/detail/:id',
	name: 'projectdetail',
	component:require('./components/Project/Detail'),
	 props: true
},
{
	path:'/list-project/edit/:id',
	name: 'projectedit',
	component:require('./components/Project/Edit'),
	 props: true
},
/* list project administor  */

{
	path:'/KListUserLog',
	component:require('./components/UserLog')
},



];

export default new VueRouter({
	routes,
	linkActiveClass: 'active'
});