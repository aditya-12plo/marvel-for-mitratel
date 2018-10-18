<template>
 <div> 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>
<div class="card-header-banner"> </div> 


    <section class="content-header">

      <h1 align="center">
      List Dokumen Template Dr. MARVEL
      </h1>
    </section>




   <section class="content">
      <div class="row">
      <div class="col-md-12">

  <button type="button" class="btn btn-primary"  @click="createItem()">
            <i class="fa fa-plus"></i>
           Tambah Dokumen Template
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
                </select>
            </div>
             <form class="form-inline">
<div style="overflow-x:auto;">
  <table> 
    <tr>
      <td><label>Search for:</label></td>
      <td colspan="3"><input type="text" v-model="filterText" class="form-control" @keyup.enter="doFilter" placeholder="Nama Dokumen"></td>
    </tr>
     <tr>
      <td colspan="4" style="padding-top: 1%;"></td>
    </tr>
    <tr>
      <td colspan="4">
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
      api-url="/karyawan/listdokumen"
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



<!-- @create Modal -->
        <modal  v-if="modal.get('create')" @close="modal.set('create', false)" >
        <template slot="header" ><h4 align="center">Upload Dokumen Template</h4></template>
        <template slot="body" >
            <form method="POST" action="" @submit.prevent="submitBooks()">
                <div class="modal-body">

<div class="col-sm-12">     
<div class="form-body">
<div class="row">

<div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="name">Name</label>
                                        <br>
<input @input="allcap($event, forms, 'name')" class="form-control border-input" placeholder="Name" v-model="forms.name"  type="text" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['name']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
 

<div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="file">File</label>
                                        <br>
<input type="file" class="form-control-file" name="filename" id="filename" v-on:change="newAvatar" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['filename']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
 
        </div>
    </div>
</div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('create', false)" >Close</button>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>

            </form>
        </template>
        </modal>



<!-- @update Modal -->
        <modal  v-if="modal.get('edit')" @close="modal.set('edit', false)" >
        <template slot="header" ><h4 align="center">Edit Dokumen Template</h4></template>
        <template slot="body" >
            <form method="POST" action="" @submit.prevent="updateItem()">
                <div class="modal-body">

<div class="col-sm-12">     
<div class="form-body">
<div class="row">

<div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="name">Name</label>
                                        <br>
<input @input="allcap($event, forms, 'name')" class="form-control border-input" placeholder="Name" v-model="forms.name"  type="text" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['name']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
 

<div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="file">File</label>
                                        <br>
<input type="file" class="form-control-file" name="filename" id="filename" v-on:change="newAvatar">
<br> 
<button type="button" class="btn btn-warning" @click="downloadDataFile">Download File <i class="fa fa-download"></i></button> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['filename']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
 
        </div>
    </div>
</div>
                    

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('edit', false)" >Close</button>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>

            </form>
        </template>
        </modal>



    </div>
</template>
<script>
     /* ------------------------------------------------------------------------------------- ERRORS
         ---------------------------------------------------------------------------------------------------- */
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
       /* ------------------------------------------------------------------------------------- CRUD FORM
         ---------------------------------------------------------------------------------------------------- */
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
        /* ------------------------------------------------------------------------------------- CRUD MODAL
         ---------------------------------------------------------------------------------------------------- */
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
        // -----------------------------------------------------------------------------------------------  COMPONENT MODAL
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
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import loading from '../Loading'
import VueEvents from 'vue-events'
import Hashids from 'hashids'
Vue.use(VueEvents)
Vue.component('custom-actions-download', require('../Button/BooksDownloadCustomActions.vue'))
window.axios = require('axios')
window.eventBus = new Vue()
export default {
  components: {
    Vuetable,
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
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[] ,
    displayItems:[] ,
    filename:'',
    modal:new CrudModal({create:false ,edit:false}),
   forms:new CrudForm({index:'',  id:'' , name:'' , filename:''  , created_at:''}) ,
     dataNya: {name : '', level:''},
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
          name: 'name',
		  title: 'Nama Dokumen',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },   
        {
          name: '__component:custom-actions-download',
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
            
    submitBooks() {
                      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
  let masuk = new FormData();
   masuk.set('name', this.forms.name)
   masuk.set('filename', this.filename)
              axios.post('/karyawan/listdokumen' , masuk)
                    .then(response => {
if(response.data.success)
{       
  this.isLoading = false;
  this.errorNya = ''; 
  this.filename = ''; 
  this.forms.name = ''; 
  this.resetFilter();
  this.modal.set('create', false);
  this.success(response.data.success);
}
if (response.data.error) {
    this.isLoading = false;
    this.errorNya = ''; 
  this.filename = ''; 
  this.forms.name = ''; 
  this.resetFilter();
  this.modal.set('create', false);
    this.error(response.data.error);
 } 
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                   if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                        this.isLoading = false;
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
 
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.filename = files[0];
                
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
                axios.get('/karyawan/CekUserProfileAkses/UserAdd').then((response) => {
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
                axios.delete('/karyawan/listdokumen/'+ item.id)
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
                this.errors.clearAll();
                this.forms.setFillItem(item , index );
                this.modal.set('edit', true);
            }  , 
            
           downloadDataFile(){ 
axios({
  url: '/documentsupload/'+this.forms.filename,
  method: 'GET', 
  responseType: 'blob', // important
}).then((response) => {
  const url = window.URL.createObjectURL(new Blob([response.data]));
  const link = document.createElement('a');
  link.href = url;
  link.setAttribute('download', this.forms.filename);
  document.body.appendChild(link);
  link.click();
}); 
            }  , 
           downloadItem(item ,index = this.indexOf(item)){
axios({
  url: '/documentsupload/'+item.filename,
  method: 'GET', 
  responseType: 'blob', // important
}).then((response) => {
  const url = window.URL.createObjectURL(new Blob([response.data]));
  const link = document.createElement('a');
  link.href = url;
  link.setAttribute('download', item.filename);
  document.body.appendChild(link);
  link.click();
}); 
            }  , 
            createItem() {
                this.forms.name='';
                this.filename='';
                this.errors.clearAll();
                this.modal.set('create', true);
            } ,
        doFilter () {
		this.$events.fire('filter-set', this.filterText )
		
      },
      resetFilter () {
        this.filterText = '' 
        this.$events.fire('filter-reset')
      },
    allcap (e, o, prop) {
  const start = e.target.selectionStart;
    e.target.value = e.target.value.toUpperCase();
    this.$set(o, prop, e.target.value);
    e.target.setSelectionRange(start, start);
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
                      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {
    this.isLoading = true;
  let masuk = new FormData();
   masuk.set('id', this.forms.id)
   masuk.set('name', this.forms.name)
   masuk.set('filename_old', this.forms.filename)
   masuk.set('filename', this.filename)
              axios.post('/karyawan/updatelistdokumen' , masuk)
                    .then(response => {
if(response.data.success)
{       
  this.isLoading = false;
  this.errorNya = ''; 
  this.filename = ''; 
  this.forms.name = ''; 
  this.resetFilter();
  this.modal.set('edit', false);
  this.success(response.data.success);
}
if (response.data.error) {
    this.isLoading = false;
    this.errorNya = ''; 
  this.filename = ''; 
  this.forms.name = ''; 
  this.resetFilter();
  this.modal.set('edit', false);
    this.error(response.data.error);
 } 
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                   if (error.response.status = 500) {
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                        this.isLoading = false;
                         this.$router.push('/page-not-found');
                    }
                    }
                    });  
  }
})

            },


onLoading() {
     this.isLoading = true;
    },
    onLoaded() {
       this.isLoading = false;
    },
    onLoadingError() {
               this.isLoading = true;
                axios.get('karyawan/listdokumen').then((response) => {
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
    'filter-set' (filterText) {
      this.moreParams = {
        filter: filterText
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
            this.$root.$on('edititem', function(data,index){
               self.editItem(data,index);
            });
            this.$root.$on('deleteitem', function(data,index){
               self.deleteItem(data,index);
            });
            this.$root.$on('downloaditem', function(data,index){
               self.downloadItem(data,index);
            });
        },
		          mounted() {
            //console.log(this.token);
            this.fetchIt();
             this.resetOptions();

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
</style>