<template>
 <div> 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>



    <section class="content-header">

      <h1 align="center">
      List Project
      </h1>
    </section>



<!-- @modal Upload -->
        <modal  v-if="modal.get('upload')" @close="modal.set('upload', false)"  >
        <template slot="header"><h4 align="center">Upload Project</h4></template> 
        <template slot="body">
          <form method="POST" enctype="multipart/form-data" action="" @submit.prevent="uploadItemToDatabase()">
                <div class="modal-body">

        
                   <div class="form-group col-12 mb-2">
                    <label>Select File</label>
                    <input type="file" class="form-control-file" name="file_name" id="file_name" v-on:change="newAvatar" required><br>
                    <p class="mute">* File hanya berekstensi .xlsx</p>
                  </div>

                   <div class="form-group col-12 mb-2">
                     <label for="name">Download Template Project : <a href="/templates/uploadprojecttemplate.xlsx" target="_blank">Download</a></label>
                  </div>

                   <div class="form-group col-12 mb-2">
                   <div class="help-block"><ul role="alert">
                    <li v-for="error of errorNya['file_name']"><span style="color:red;">{{ error }}</span></li></ul>
                  </div>
                  <br>
                   <div class="help-block">
                    <ul role="alert">
                    <li v-for="error of errorNya['errortable']">
                      <ul role="alert">
                    <li v-for="error2 of error">
                      <span style="color:red;">
                    {{ error2 }}</span>
                  </li>
                </ul>
                  </li>
                </ul>
                  </div>
                  </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('upload', false)" >Close</button>
           <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
        </form>
        </template>
        </modal>

   <section class="content">
      <div class="row">
      <div class="col-md-12">

  <button type="button" class="btn btn-primary"  @click="createItem()">
            <i class="fa fa-plus"></i>
           Tambah Baru
        </button>

  <button type="button" class="btn btn-info"  @click="uploadItem()">
            <i class="fa ft-upload-cloud"></i>
           Upload Project
        </button>
		
		<br>
<br>
		
<div class="filter-bar">

<div class="dropdown form-inline pull-right">
                <label>Per Page:</label>

                <select class="form-control" v-model="perPage">
                    <option :value=10>10</option>
                    <option :value=25>25</option>
                    <option :value=50>50</option>
                    <option :value=75>75</option>
                    <option :value=100>100</option>
                    <option :value=1000>1000</option>
                </select>
            </div>
             <form class="form-inline">
<div style="overflow-x:auto;">
  <table>
  <tr>
      <td colspan="2"><label>Date From :</label></td>
      <td colspan="2"><datepicker v-model="startTime.time" class="form-control"  :typeable="true" :format="customFormatter" placeholder="YYYY-MM-DD" @keyup.enter="doFilter"></datepicker></td>
      <td colspan="2"><label>&nbsp;&nbsp;Date To :</label></td>
      <td colspan="2"><datepicker v-model="endtime.time" class="form-control"  :typeable="true" :format="customFormatter" placeholder="YYYY-MM-DD" @keyup.enter="doFilter"></datepicker></td>
    </tr>
    <tr>
      <td colspan="8" style="padding-top: 1%;"></td>
    </tr>
    <tr>
      <td colspan="2"><label>Infratype :</label></td>
      <td colspan="2">      	<select v-model="infratypenya" class="form-control" @keyup.enter="doFilter"> 
      		<option v-for="opti in optionsnya">
      			{{opti}}
      		</option>
      	</select></td>
        <td colspan="2"><label>Tinggi Tower :</label></td>
      <td colspan="2">
        <select v-model="towernya" class="form-control" @keyup.enter="doFilter"> 
          <option v-for="optit in optionstowernya">
            {{ optit }}
          </option>
        </select></td>
    </tr>
     <tr>
     	<td colspan="8" style="padding-top: 1%;"></td>
    </tr>
     <tr>
     	<td colspan="2"><label>Status :</label></td>
      <td colspan="2">
      	<select v-model="statusnya" class="form-control" @keyup.enter="doFilter"> 
      		<option v-for="optit in optionsstatusnya" v-bind:value="optit.status_id">
      			{{ optit.name }}
      		</option>
      	</select></td>
     	      <td colspan="2"><label>Batch :</label></td>
      <td colspan="2">

        <select v-model="batchnya" class="form-control" @keyup.enter="doFilter"> 
          <option v-for="optit in batchall" v-bind:value="optit.batchnya">
            {{ optit.batchnya }}
          </option>
        </select>

      </td>
    </tr>
     <tr>
      <td colspan="8" style="padding-top: 1%;"></td>
    </tr>

     <tr>
      <td colspan="4"><label>Search for:</label></td>
      <td colspan="4"><input type="text" v-model="filterText" class="form-control" @keyup.enter="doFilter" placeholder="Project ID"></td>
    </tr> 
    <tr>
      <td colspan="8" style="padding-top: 1%;"></td>
    </tr>
     <tr>
     	<td colspan="8" style="padding-top: 5%;"></td>
    </tr>
    <tr>
      <td colspan="8">
<div class="text-left">
<button class="btn btn-primary" @click.prevent="doFilter">Cari <i class="fa fa-thumbs-o-up position-right"></i></button>
<button class="btn btn-warning" @click.prevent="resetFilter">Reset Form <i class="fa fa-refresh position-right"></i></button>    
                                    </div>
</td>
       </tr>
</table>
 </div>
       </form>
       
    




    </div>
    <br>
    <div style="overflow-x:auto;">
	<div v-show="loading"><i class="fa fa-spinner fa-spin"></i> Loading Data</div>
    <vuetable ref="vuetable"
      api-url="/karyawan/listproject"
      :fields="fields"
      pagination-path=""
      :per-page="perPage"
      :css="css.table"
      :append-params="moreParams"
      @vuetable:cell-clicked="onCellClicked"
      @vuetable:pagination-data="onPaginationData"
	  @vuetable:loading="onLoading"        
		@vuetable:load-error="onLoadingError"        
		@vuetable:load-success="onLoaded"
    ></vuetable>
    <div class="vuetable-pagination">
      <vuetable-pagination-info ref="paginationInfo"
        info-class="pagination-info"
      ></vuetable-pagination-info>
      <vuetable-pagination ref="pagination"
        :css="css.pagination"
        @vuetable-pagination:change-page="onChangePage"
      ></vuetable-pagination>
    </div>
    </div>


      </div>
      </div>
      </section>
    </div>
</template>
<script>
     /* ERRORS  */
        class Errors{
            constructor(){
                this.errors = {};
            }
            get(field){
                if(this.errors[field]){
                    return  this.errors[field][0];
                }
            }
            record(errors){
                this.errors = errors.response.data;
            }
            any(){
                return Object.keys(this.errors).length > 0;
            }
            has(field){
                return this.errors.hasOwnProperty(field);
            }
            clear(field){
                if(field) delete this.errors[field];
                this.errors = {};
            }
            clearAll(){
                this.errors = "";
            }
        }
        


       /* CRUD FORM  */
        class CrudForm {
            constructor(data) {
                this.originalData = data;
                for(let field in data){
                    this[field] = data[field];
                }
            }
            reset(){
                for(let field in this.originalData){
                    this[field] = '';
                }
            }
            /*  Set a value to the temp , verify if has this item and update  */
            setFillItem(item , index){
                for(let field in this.originalData){
                    if(field in item){
                        this[field] = item[field];
                    }else{
                        // if is index
                        if(field == 'index'){ this[field] = index; }
                    }
                }
            }
            data(){
                let data = Object.assign({} , this);
                delete data.originalData;
                delete data.errors;
                return data;
            }
        }



        /*  CRUD MODAL  */
        class CrudModal{
            constructor(data){
                this.modal = data;
            }
            get(value){
                if(this.modal[value]){
                    return this.modal[value];
                }
            }
            set(data , value){
                this.modal[data] = value;
            }
        }


        /* COMPONENT MODAL */
        const Modal = {
            template: `   <transition name="modal">
                                <div class="modal-mask">
                                  <div class="modal-wrapper">
                                    <div :class="modalStyle">
                                    <a class="close-modal" @click="$emit('close')" ></a>
                                      <div class="modal-header">
                                           <p class="modal-card-title"><slot name="header" class="modal-card-title "></slot></p>
                                      </div>
                                        <slot name="body">
                                          default body
                                        </slot>
                                    </div>
                                  </div>
                                </div>
                              </transition>` ,
            props: {
                modalsize: {type: String},
            } ,
            computed: {
                modalStyle() {
                    return this.modalsize == null ? 'modal-container' : this.modalsize + ' modal-container';
                },
                created(){

                }
            }
        };



import accounting from 'accounting'
import moment from 'moment'
import '!!vue-style-loader!css-loader!vue-toast/dist/vue-toast.min.css'
import VueToast from 'vue-toast'
import myDatepicker from 'vue-datepicker'
import Datepicker from 'vuejs-datepicker'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import loading from '../Loading'
import VueEvents from 'vue-events'
import Hashids from 'hashids'
Vue.use(VueEvents)
Vue.component('custom-actions', require('../Button/BooksCustomActions.vue'))
window.axios = require('axios')
window.eventBus = new Vue()
export default {
  components: {
    Vuetable,
    Datepicker,
    VuetablePagination,
    VuetablePaginationInfo,
    'vue-toast': VueToast,
    'date-picker': myDatepicker,
	loading,
  },
  data () {
    return {
	isLoading: false,
    startTime: {
        time: ''
      },
      endtime: {
        time: ''
      },
	option: {
        type: 'day',
        week: ['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'],
        month: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
        format: 'YYYY-MM-DD',
        placeholder: 'YYYY-MM-DD',
        inputStyle: {
          'display': 'inline-block',
          'padding': '6px',
          'line-height': '22px',
          'font-size': '16px',
          'border': '2px solid #fff',
          'box-shadow': '0 1px 3px 0 rgba(0, 0, 0, 0.2)',
          'border-radius': '2px',
          'color': '#5F5F5F'
        },
        color: {
          header: '#B799DA',
          headerText: '#f00'
        },
        buttons: {
          ok: 'Ok',
          cancel: 'Cancel'
        },
        overlayOpacity: 0.5, // 0.5 as default 
        dismissible: true // as true as default 
      },
    position: 'up right',
    closeBtn: true,
    formErrors:{},
    errors: new Errors() ,
     errorNya: [],
	 optionsnya: [],
    optionstowernya: [],
    batchall: [],
    optionsstatusnya: [],
     token: localStorage.getItem('token'),
    submitted: false,
  file_name:'',
  sis:'',
  drm:'',
  sitac:'',
  rfc:'',
  boq:'',
    submitSelectedItems:[] ,
    displayItems:[] ,
    infratypenya: '',
    towernya: '',
    batchnya: '',
    statusnya: '',
     dataNya: {name : '', level:''},
     AlldataNya: '',
    modal:new CrudModal({upload:false}),
    perPage: 10,
    loading: false,
      fields: [
       {
          name: '__sequence',
          title: 'No',
          titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: '__checkbox:id',
          titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: 'projectid',
		  title: 'PROJECT ID',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'batchnya',
		  title: 'Batch',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'area',
      title: 'Area',
      titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'regional',
      title: 'Regional',
      titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'towernya',
      title: 'Tower',
      titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'statusnya',
		  title: 'Status Project',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'statusnyaboq',
		  title: 'Status BOQ',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'statusnyahaki',
		  title: 'Status Haki',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'created_at',
		  title: 'Tanggal Input',
          titleClass: 'text-center',
          dataClass: 'text-center',
          callback: 'formatDate|DD-MM-YYYY HH:mm:ss'
        },
        {
          name: '__component:custom-actions',
          title: 'Actions',
          titleClass: 'text-center',
          dataClass: 'text-center'
        }
      ],
      filterText: '', 
      css: {
        table: {
          tableClass: 'table table-bordered table-striped table-hover',
          ascendingIcon: 'glyphicon glyphicon-chevron-up',
          descendingIcon: 'glyphicon glyphicon-chevron-down'
        },
        pagination: {
          wrapperClass: 'pagination',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'page',
          linkClass: 'link',
          icons: {
            first: '',
            prev: '',
            next: '',
            last: '',
          },
        },
        icons: {
          first: 'glyphicon glyphicon-step-backward',
          prev: 'glyphicon glyphicon-chevron-left',
          next: 'glyphicon glyphicon-chevron-right',
          last: 'glyphicon glyphicon-step-forward',
        },
      },
      moreParams: {}
    }
  },
          watch: {
            'perPage'(newValue, oldValue) {
               this.$events.fire('filter-set', this.filterText)
            },
            'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {
      customFormatter(date) {
      return moment(date).format('YYYY-MM-DD');
    },
    selectInfratype() { 
                axios.get('/karyawan/GetInfratype').then((response) => {
                    this.optionsnya = response.data;  
                    });
            } ,
			            selectTowerHigh() { 
                axios.get('/karyawan/GetTowerHigh').then((response) => {
                    this.optionstowernya = response.data;  
                    });
            } ,
			            selectStatus() { 
                axios.get('/karyawan/GetStatus').then((response) => {
                    this.optionsstatusnya = response.data;  
                    });
            } ,
			            selectBatch() { 
                axios.get('/karyawan/GetBatch').then((response) => {
                    this.batchall = response.data;  
                    });
            } ,
         newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
uploadItemToDatabase() {
                      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
  let masuk = new FormData();
   masuk.set('file_name', this.file_name)
              axios.post('/karyawan/uploadproject' , masuk)
                    .then(response => {

 if(response.data.file_name)
{ 
  this.errorNya = {file_name:[response.data.file_name],errortable:[response.data.errornya]};
}
if(response.data.success)
{       
  this.errorNya = '';
  this.$refs.vuetable.selectedTo = [];
  this.resetFilter();
  this.modal.set('upload', false);
  this.success(response.data.success);
}
if (response.data.error) {
    this.errorNya = '';
  this.$refs.vuetable.selectedTo = [];
  this.resetFilter();
  this.modal.set('upload', false);
    this.error(response.data.error);
 } 
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                   if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.$router.push('/page-not-found');
                    }
                    }
                    });  
  }
})
    },
 success(kata) {
      this.$swal({
  position: 'top-end',
  type: 'success',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
    
 error(kata) {
      this.$swal({
  position: 'top-end',
  type: 'error',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
    
 question(kata) {
      this.$swal(
'Ooppss?',
 kata,
  'question'
)
    },

  	sumSelectedItems() {
   var ttl = this.$refs.vuetable.selectedTo;
   if(ttl.length <= 0)
   {
   this.question('Silahkan Pilih Data Terlebih Dahulu');
   }
   else
   {
            	    	this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
  	  var join_selected_values = ttl.join(","); 
                axios.delete('/karyawan/listprojectDeleteAll/'+ join_selected_values)
                    .then(response => {
                this.errorNya = '';
                this.$refs.vuetable.selectedTo = [];
                this.resetFilter();
                this.success(response.data.success);

                    })
                    .catch(error => {
                        this.errorNya = '';
                this.resetFilter();
                this.error(response.data.error);

                    });
  }
})
   }
   
  },
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
diacak(id)
           {
var hashids = new Hashids('',1000,'abcdefghijklmnopqrstuvwxyz0987654321ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // no padding
return hashids.encode(id); 
           },
dibalik(id)
           {
var hashids = new Hashids('',1000,'abcdefghijklmnopqrstuvwxyz0987654321ABCDEFGHIJKLMNOPQRSTUVWXYZ'); // no padding
return hashids.decode(id); 
           },
  fetchIt(){
   this.isLoading = true;
                axios.get('/karyawan/CekUserProfileAkses/ProjectAdd').then((response) => {
                    this.dataNya = response.data;
                    this.isLoading = false;
                }).catch(error => {
        if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.$router.push('/server-error');
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
          else
          {
                         this.$router.push('/page-not-found');
          }
          }
                    });
            },
  resetOptions() {
          this.$refs.toast.setOptions({
            delayOfJumps: this.delayOfJumps,
            maxToasts: this.maxToasts,
            position: this.position
          })
        },
        showTime(kode,pesan) {
          this.$refs.toast.showToast(pesan, {
            theme: kode,
            timeLife: 3000,
          })
        },
            deleteItem(item ,index = this.indexOf(item)){
            	    	this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
                axios.delete('/karyawan/listproject/'+ item.id)
                    .then(response => {
                this.errorNya = '';
                this.resetFilter();
                this.success(response.data.success);

                    })
                    .catch(error => {
                        this.errorNya = '';
                this.resetFilter();
                this.error(response.data.error);
                    });
  }
})
            }  ,
            editItem(item ,index = this.indexOf(item)){
this.$router.push({name:'projectedit', params: {id: this.diacak(item.id),typenya:'edit-project',rowDatanya:{project:item} }});
            }  ,
            viewItem(item ,index = this.indexOf(item)){          
 let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(item.id) }});
window.open(routeData.href, '_blank');   
            }  ,
            createItem() {
            this.$router.push({name:'projectadd', params: {typenya:'add-project'}});
        this.$router.push('/list-project/add-new');
            } ,
            uploadItem() {
                this.errorNya = '';  
                this.errors.clearAll();
                 this.modal.set('upload', true);
            } ,
         doFilter () {
        		if(!this.startTime.time && !this.endtime.time)
		{
		this.$events.fire('filter-set', this.filterText, this.towernya ,this.infratypenya,this.statusnya, this.batchnya, this.startTime.time, this.endtime.time )
		}
		else if(this.startTime.time && !this.endtime.time)
		{
      var startTime = this.customFormatter(this.startTime.time)
		this.$events.fire('filter-set', this.filterText,this.towernya , this.infratypenya,this.statusnya, this.batchnya, startTime, this.endtime.time )
		}
		else if(!this.startTime.time && this.endtime.time)
		{
      var endtime = this.customFormatter(this.endtime.time)
		this.$events.fire('filter-set', this.filterText, this.towernya ,this.infratypenya,this.statusnya, this.batchnya, this.startTime.time, endtime )
		}
		else if(this.startTime.time && this.endtime.time)
		{ 
		if(this.endtime.time < this.startTime.time)
		{
		alert('Input Date Wrong');
		}
		else
		{
      var startTime = this.customFormatter(this.startTime.time)
      var endtime = this.customFormatter(this.endtime.time)
		this.$events.fire('filter-set', this.filterText, this.towernya,this.infratypenya ,this.statusnya , this.batchnya , startTime, endtime )
		}
		}
		else
		{
		this.$events.fire('filter-set', this.filterText, this.towernya,this.infratypenya , this.statusnya , this.batchnya , this.startTime.time, this.endtime.time )
		}
      },
      resetFilter () { 
        this.filterText = '';
         this.startTime.time = '';
        this.endtime.time = '';
        this.towernya = '';
        this.batchnya = '';
        this.infratypenya = ''; 
        this.statusnya = ''; 
        this.$events.fire('filter-reset');
      },
    allcap (value) {
      return value.toUpperCase()
    },
    formatNumber (value) {
      return accounting.formatNumber(value, 2)
    },
	
	formatTower (value) {
      return accounting.formatMoney(value,  {
  symbol: " M",precision: 0,format: "%v %s"})
    },
	formatNumberRupiah (value) {
      return accounting.formatMoney(value,  "Rp. ", 2, ".", ",")
    },
    formatDate (value, fmt = 'DD-MM-YYYY HH:mm:ss') {
      return (value == null)
        ? ''
        : moment(value, 'DD-MM-YYYY HH:mm:ss').format(fmt)
    },
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    onCellClicked (data, field, event) {
      this.$refs.vuetable.toggleDetailRow(data.id)
    },            

			

   updateItem() {
axios.put('/karyawan/Updatekaryawan/'+ this.forms.id , this.forms)
                    .then(response => {
                this.errorNya = '';
                 this.submitted = this.showTime('success',response.data.success);
                this.resetFilter();
                 this.modal.set('edit', false);

                    })
                    .catch(error => {
                        this.errorNya = error.response.data;
                    });
            },


onLoading() {
     this.isLoading = true;
    },
    onLoaded() {
       this.isLoading = false;
    },
    onLoadingError() {
               this.isLoading = true;
                axios.get('karyawan/listproject').then((response) => {
                    this.dataNya = response.data;
                     this.isLoading = false;
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                         this.isLoading = false;
					}
					}
                    });
    },			
  },
  events: {
    'filter-set' (filterText,towernya,infratypenya,statusnya,batchnya,startTime,endtime) {
      this.moreParams = {
        filter: filterText , towernya:towernya, infratypenya:infratypenya , statusnya:statusnya , batchnya:batchnya ,min: startTime, max: endtime
      }
      Vue.nextTick(() => this.$refs.vuetable.refresh() )
    },
    'filter-reset' () {
      this.moreParams = {}
      Vue.nextTick(() => this.$refs.vuetable.refresh() )
    }
  },
 created: function() {
  let self = this;
            this.$root.$on('viewitem', function(data,index){
                //console.log(data);
               self.viewItem(data,index);
            });
            this.$root.$on('edititem', function(data,index){
               self.editItem(data,index);
            });
            this.$root.$on('deleteitem', function(data,index){
               self.deleteItem(data,index);
            });
        },
		          mounted() {
            //console.log(this.token);
            this.fetchIt();
             this.resetOptions();
             this.selectInfratype();
             this.selectTowerHigh();
           this.selectStatus();
           this.selectBatch();

        }

}
</script>
<style>
.pagination {
  margin: 0;
  float: right;
}
.pagination a.page {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.page.active {
  color: white;
  background-color: #337ab7;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.btn-nav {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
}
.pagination a.btn-nav.disabled {
  color: lightgray;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
  cursor: not-allowed;
}
.pagination-info {
  float: left;
}
.modal-backdrop {
z-index: -1;
}
.modal-mask {
  position: fixed;
  z-index: 9998;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0, 0, 0, .5);
  display: table;
  transition: opacity .3s ease;
}
.modal-wrapper {
  display: table-cell;
  vertical-align: middle;
}
.modal-content {
  height: auto;
  min-height: 100%;
  border-radius: 0;
}
.modal-dialog {
  width: 100%;
  height: 100%;
  margin: 0;
  padding: 0;
}
.modal-container {
  width: 50%;
  margin: 0px auto;
  padding: 20px 30px;
  background-color: #fff;
  border-radius: 2px;
  box-shadow: 0 2px 8px rgba(0, 0, 0, .33);
  transition: all .3s ease;
  font-family: Helvetica, Arial, sans-serif;
}
.modal-header h3 {
  margin-top: 0;
  color: #42b983;
}
.modal-body {
  margin: 20px 0;
   max-height: calc(100vh - 210px);
    overflow-y: auto;
}
.modal-default-button {
  float: right;
}

.modal-enter {
  opacity: 0;
}
.modal-leave-active {
  opacity: 0;
}
.modal-enter .modal-container,
.modal-leave-active .modal-container {
  -webkit-transform: scale(1.1);
  transform: scale(1.1);
}
</style>