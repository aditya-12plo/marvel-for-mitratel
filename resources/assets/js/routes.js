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