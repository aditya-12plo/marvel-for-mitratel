<template>
 <div> 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>

    <div class="card-header-banner"> </div>

    
    <section class="content-header">

      <h1 align="center">
      Submit BOQ Proses PR
      </h1>
    </section> 

   <section class="content">
      <div class="row">
      <div class="col-md-12">
		
<div class="filter-bar">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>  
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
      <td>
      	<label>infratypenya</label>
      </td>
      <td> 
      	<select v-model="infratypenya" class="form-control" @keyup.enter="doFilter"> 
      		<option v-for="opti in optionsnya">
      			{{opti}}
      		</option>
      	</select>
      </td> 
       <td>
      	<label>Tinggi Tower</label>
      </td>
      <td> 
      	<select v-model="towernya" class="form-control" @keyup.enter="doFilter"> 
      		<option v-for="optit in optionstowernya">
      			{{optit}}
      		</option>
      	</select>
      </td>
    </tr>
    <tr>
      <td colspan="4" style="padding-top: 1%;"></td>
    </tr>
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
<button class="btn btn-warning" @click.prevent="resetFilter">Reset Form <i class="fa fa-refresh position-right"></i></button> 
<button class="btn btn-danger" @click="CancelBOQ()">Cancel BOQ <i class="ft-check-circle position-right"></i></button>
<button class="btn btn-default" @click="sumSelectedItems()">Ubah Status BOQ Menjadi Proses PR <i class="ft-check-circle position-right"></i></button>
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
      :api-url="URLnya"
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
     
       



import accounting from 'accounting'
import moment from 'moment'
import '!!vue-style-loader!css-loader!vue-toast/dist/vue-toast.min.css'
import VueToast from 'vue-toast'
import myDatepicker from 'vue-datepicker'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import vSelect from 'vue-select'
import loading from '../Loading'
import VueEvents from 'vue-events'
import Hashids from 'hashids'
Vue.use(VueEvents)
Vue.component('view-custom-actions', require('../Button/ViewActions.vue'))
Vue.component('v-select', vSelect)
window.axios = require('axios')
window.eventBus = new Vue()
export default {
		        props: {
      rowDatanya: {
        type: Object,
        required: true
      }, 
      typenya: {
        type: String,
        required: true
      }, 
      urlprosespr: {
        type: String,
        required: true
      }
    },
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
    URLnya:this.urlprosespr,
    errors: new Errors() ,
     errorNya: [],
	 optionsnya: [],
	 optionstowernya: [],
	 datasubmitNya: [],
	 dataBoqNya:this.rowDatanya.project.project_id_boq ,
	 towernya: '',
	 infratypenya: '',
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[] ,
    displayItems:[] ,
     dataNya: {name:'',area:'' , level:'' , regional:''},
    perPage: 10,
    loading: false,
      fields: [ 
        {
          name: 'projectid',
		  title: 'PID',
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
          name: 'infratype',
		  title: 'Infratype',
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
          name: 'harga_bulan',
      title: 'Harga Sewa / Bulan',
      titleClass: 'text-center',
          dataClass: 'text-center',
		  callback: 'formatNumberRupiah'
        }, 
        {
          name: 'harga_tahun',
      title: 'Harga Sewa / Tahun',
      titleClass: 'text-center',
          dataClass: 'text-center',
		  callback: 'formatNumberRupiah'
        },
        {
          name: '__component:view-custom-actions',
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
               this.$events.fire('filter-set', this.filterText , this.infratypenya , this.towernya)
            },
            'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {

dataAction () {
      if(this.typenya === "approved-boq-proses-pr-submit")
      { 
           return true;
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
      },
 backLink() {
 this.$router.push('/boq-proses-pr');
            } ,
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
let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(item.id) }});
window.open(routeData.href, '_blank');
            }  , 
             	CancelBOQ() {
      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {     
 
var masuk = 
{
	'id' : this.rowDatanya.project.id,
	'status' : 6, 
	'project_id' : this.rowDatanya.project.project_id, 
}

axios.post('/karyawan/SubmitBOQCancel', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      } 
                      else 
                      {
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
                      } 
                    })
   
}
})
   
   
  },
             	sumSelectedItems() {
      this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {
  if (result.value) {     

var masuk = 
{
	'id' : this.rowDatanya.project.id,
	'status' : 4, 
	'statusproject' : 19, 
	'project_id' : this.rowDatanya.project.project_id, 
}
axios.post('/karyawan/SubmitBOQApprovalVerifikasi', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      } 
                      else 
                      {
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
                      } 
                    })
    
}
})
   
   
  },
        doFilter () {
        	 
		this.$events.fire('filter-set', this.filterText ,this.infratypenya , this.towernya)
		
      },
      resetFilter () {
      	this.komunikasi = '';
        this.filterText = '';  
        this.towernya = '';  
        this.infratypenya = '';  
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
    formatDate (value, fmt = 'D M YYYY') {
      return (value == null)
        ? ''
        : moment(value, 'YYYY-MM-DD').format(fmt)
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


onLoading() {
     this.isLoading = true;
    },
    onLoaded() {
       this.isLoading = false;
    },
    onLoadingError() {
               this.isLoading = true;
                axios.get(this.URLnya).then((response) => {
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
    'filter-set' (filterText,infratypenya,towernya) {
      this.moreParams = {
        filter: filterText , infratypenya:infratypenya , towernya:towernya
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
            this.$root.$on('edititem', function(data,index){
               self.editItem(data,index);
            });
        },
		          mounted() {
            //console.log(this.token);
             this.dataAction(); 
             this.resetOptions();
             this.resetFilter();
             this.selectInfratype();
             this.selectTowerHigh();

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