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
	path:'/approval-drop-project/approval',
	name: 'approvaldrop',
	component:require('./components/Drop/Approved'),
	props: true
},
/* drop  */


/* BOQ  */
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
	path:'/approval-boq/:id',
	name: 'approvalboq',
	component:require('./components/BOQ/Approved'),
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