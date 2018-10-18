<template>
 <div> 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>

<div class="card-header-banner"> </div> 

    <section class="content-header">

      <h1 align="center">
      Upload Dokumen Invoice
      </h1>
    </section>




   <section class="content">
      <div class="row">
      <div class="col-md-12">
		
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
      <td colspan="3"><input type="text" v-model="filterText" class="form-control" @keyup.enter="doFilter" placeholder="Project ID"></td>
    </tr>
     <tr>
      <td colspan="4" style="padding-top: 1%;"></td>
    </tr>
    <tr>
      <td colspan="4">
<div class="text-left">
<button class="btn btn-primary" @click.prevent="doFilter">Cari <i class="fa fa-thumbs-o-up position-right"></i></button>
<button class="btn btn-warning" @click.prevent="resetFilter">Reset Pencarian <i class="fa fa-refresh position-right"></i></button> 
<button class="btn btn-default" @click="downloadInvoiceTemplate()">Download Template <i class="fa fa-download position-right"></i></button> 
<button class="btn btn-danger" @click="resetFilterData()">Reset Data <i class="fa fa-refresh position-right"></i></button> 
<button class="btn btn-success" @click="uploadData()">Upload Data <i class="fa fa-upload position-right"></i></button> 
                                    </div>
</td>
       </tr>
</table>
 </div>
       </form>
       
    




    </div>
    <br>
    <div style="overflow-x:auto;"> 
    <vuetable ref="vuetable"
      :api-mode="false" 
      :data-total="tableDataTotal"
      :data-manager="dataManager"
      :fields="fields"
      pagination-path="pagination"
      :per-page="perPage"
      :css="css.table"
      :append-params="moreParams" 
      @vuetable:pagination-data="onPaginationData" 
    ></vuetable>
    <div class="vuetable-pagination"> 
      <vuetable-pagination ref="pagination"
        :css="css.pagination"
        @vuetable-pagination:change-page="onChangePage"
      ></vuetable-pagination>
    </div>
    </div>


      </div>
      </div>
      </section>



<!-- upload data -->
<modal  v-if="modal.get('upload')" @close="modal.set('upload', false)">
        <template slot="header" align="center"><h4 align="center">Upload Data</h4></template>
        <template slot="body" >
          <form method="POST" enctype="multipart/form-data" action="" @submit.prevent="uploadItemToDatabase()">
                <div class="modal-body">

 <div class="form-group col-12 mb-2">
                    <label>Select File</label>
                    <input type="file" class="form-control-file" name="file_name" id="file_name" v-on:change="newAvatar" required><br>
                    <p class="mute">* File hanya berekstensi .xlsx / .xls</p>
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
           <button type="submit" class="btn btn-primary">Upload</button>
                    
                </div>
                </form>
        </template>
        </modal>
        
<!-- upload data -->


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


        //   COMPONENT MODAL
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
Vue.component('add-custom-actions', require('../Button/AddActions.vue'))
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
  modal:new CrudModal({upload: false}),
    errors: new Errors() ,
     errorNya: [],
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[] ,
    displayItems:[] ,
     dataNya: {area:'' , level:'' , regional:''},
    perPage: 10,
  file_name:'',
    loading: false,
     tableData: [],
        tableDataTotal:0,
      fields: [ 
        {
          name: 'projectid',
      title: 'Project ID',
      titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'tgl_mulai_sewa',
		  title: 'TGL Mulai Sewa',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'tgL_akhir_sewa',
		  title: 'TGL Berakhir Sewa',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'tgl_target_rfi',
		  title: 'TGL Target RFI',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'no_receive',
      title: 'No Receive',
      titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'no_kontrak',
      title: 'No Kontrak',
      titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'no_invoice',
      title: 'No Invoice',
      titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'tgl_invoice',
		  title: 'Tanggal Invoice',
          titleClass: 'text-center',
          dataClass: 'text-center',
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
               this.$refs.vuetable.refresh()
            },
            'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {
      
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
              axios.post('/karyawan/uploadinvoice' , masuk)
                    .then(response => {

 if(response.data.file_name)
{ 
  this.errorNya = {file_name:[response.data.file_name],errortable:[response.data.errornya]};
}
if(response.data.success)
{       
  this.tableData =response.data.invoice;
  this.resetFilter();
  this.modal.set('upload', false);
}
if (response.data.error) {
    this.errorNya = '';
    this.error(response.data.error);
 } 
                    })
                    .catch(error => {
                   if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
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
dataManager(sortOrder, pagination) {
     // console.log("dataManager: ", sortOrder, pagination, this.localData);

      let data = this.tableData;

      // projectid for search filter
      if (this.filterText) {
        // the text should be case insensitive
        let txt = new RegExp(this.filterText, "i");
        let cari = this.filterText;
        // search on projectid
        data = _.filter(data, function(item) {
          return (
            item.projectid == cari
          );
        });
      }

      // sortOrder can be empty, so we have to check for that as well
      if (sortOrder.length > 0) {
    //    console.log("orderBy:", sortOrder[0].sortField, sortOrder[0].direction);
        data = _.orderBy(data, sortOrder[0].sortField, sortOrder[0].direction);
      }

      // since the filter might affect the total number of records
      // we can ask Vuetable to recalculate the pagination for us
      // by calling makePagination(). this will make VuetablePagination
      // work just like in API mode
      pagination = this.$refs.vuetable.makePagination(data.length);

      // if you don't want to use pagination component, you can just
      // return the data array
      return {
        pagination: pagination,
        data: _.slice(data, pagination.from - 1, pagination.to)
      };
    },
     uploadData(){

                   this.errorNya = '';
                   this.message = '';
                this.modal.set('upload', true); 
               
            }  ,
 success(kata) {
      this.$swal({
  position: 'top-end',
  type: 'success',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
    
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
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
                axios.get('/karyawan/CekUserProfileAkses/DocumentBisnis').then((response) => {
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
           
            viewItem(item ,index = this.indexOf(item)){
                this.$router.push({name:'adddocumentinvoice', params: {id: this.diacak(item.id),typenya:'add-document-invoice',rowDatanya:{project:item} }});
            }  ,
        doFilter () {
		this.$events.fire('filter-set', this.filterText)
      },
      resetFilter () { 
        this.filterText = ''; 
        this.$events.fire('filter-reset');
      },
      resetFilterData () { 
        this.tableData = []; 
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
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },            
    downloadInvoiceTemplate() {

				axios({
  url: '/templates/bisnis-upload-template.xlsx',
  method: 'GET', 
  responseType: 'blob', // important
}).then((response) => {
  const url = window.URL.createObjectURL(new Blob([response.data]));
  const link = document.createElement('a');
  link.href = url;
  link.setAttribute('download', 'bisnis-upload-template.xlsx');
  document.body.appendChild(link);
  link.click();
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
            this.$root.$on('viewitem', function(data,index){ 
               self.viewItem(data,index);
            });
        },
		          mounted() { 
            this.fetchIt();
             this.resetOptions();
               this.resetFilter();
               this.resetFilterData();
            this.$refs.vuetable.setData(this.tableData); 
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