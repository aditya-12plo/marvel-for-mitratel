<template>
 <div> 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>



    <section class="content-header">

      <h1 align="center">
      Revisi Dokumen Rfi & Baut
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
      <td><label>Date From :</label></td>
      <td><datepicker v-model="startTime.time" class="form-control"  :typeable="true" :format="customFormatter" placeholder="YYYY-MM-DD" @keyup.enter="doFilter"></datepicker> </td>
      <td><label>&nbsp;&nbsp;Date To :</label></td>
      <td><datepicker v-model="endtime.time" class="form-control"  :typeable="true" :format="customFormatter" placeholder="YYYY-MM-DD" @keyup.enter="doFilter"></datepicker></td>
    </tr>
    <tr>
      <td colspan="4" style="padding-top: 1%;"></td>
    </tr>
      <tr>
      <td><label>Infratype :</label></td>
      <td>      	<select v-model="infratypenya" class="form-control" @keyup.enter="doFilter"> 
      		<option v-for="opti in optionsnya">
      			{{opti}}
      		</option>
      	</select></td>
        <td><label>Tinggi Tower :</label></td>
      <td>
        <select v-model="towernya" class="form-control" @keyup.enter="doFilter"> 
          <option v-for="optit in optionstowernya">
            {{ optit }}
          </option>
        </select></td>
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
      api-url="/karyawan/GetJobsRfiBautRevisi"
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
import Datepicker from 'vuejs-datepicker'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import loading from '../Loading'
import VueEvents from 'vue-events'
import Hashids from 'hashids'
Vue.use(VueEvents)
Vue.component('vieweditcustom-actions', require('../Button/ViewEditActions.vue'))
window.axios = require('axios')
window.eventBus = new Vue()
export default {
  components: {
    Datepicker,
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
    optionsnya: [],
    optionstowernya: [],
    infratypenya: '',
    towernya: '',
    errors: new Errors() ,
     errorNya: [],
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[] ,
    displayItems:[] ,
     dataNya: {area:'' , level:'' , regional:''},
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
          name: 'projectid',
      title: 'Project ID',
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
          dataClass: 'text-center',
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
          name: 'created_at',
		  title: 'Tanggal Input',
          titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: '__component:vieweditcustom-actions',
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
               this.$events.fire('filter-set', this.filterText,this.towernya,this.infratypenya)
            },
            'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {

      customFormatter(date) {
      return moment(date).format('YYYY-MM-DD');
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
  fetchIt(){
   this.isLoading = true;
                axios.get('/karyawan/CekUserProfileAkses/DocumentSISAdd').then((response) => {
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
           
editItem(item ,index = this.indexOf(item)){
this.$router.push({name:'revisiRfiBaut', params: {id: this.diacak(item.id),typenya:'RfiBaut-edit-data',rowDatanya:{dataNya:this.dataNya,project:item} }});
            }  ,
                        viewItem(item ,index = this.indexOf(item)){
let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(item.id) }});
window.open(routeData.href, '_blank');
            }  ,
     doFilter () {
        		if(!this.startTime.time && !this.endtime.time)
		{
		this.$events.fire('filter-set', this.filterText,this.towernya ,this.infratypenya, this.startTime.time, this.endtime.time )
		}
		else if(this.startTime.time && !this.endtime.time)
		{
       var startTime = this.customFormatter(this.startTime.time)
		this.$events.fire('filter-set', this.filterText, this.towernya ,this.infratypenya,startTime, this.endtime.time )
		}
		else if(!this.startTime.time && this.endtime.time)
		{
      var endtime = this.customFormatter(this.endtime.time)
		this.$events.fire('filter-set', this.filterText,this.towernya ,this.infratypenya, this.startTime.time, endtime)
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
		this.$events.fire('filter-set', this.filterText,this.towernya ,this.infratypenya,startTime,endtime)
		}
		}
		else
		{
		this.$events.fire('filter-set', this.filterText,this.towernya ,this.infratypenya, this.startTime.time, this.endtime.time )
		}
      },
      resetFilter () {
      	this.komunikasi = '';
        this.filterText = '';
         this.startTime.time = '';
        this.towernya = ''; 
        this.infratypenya = ''; 
        this.endtime.time = '';
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


onLoading() {
     this.isLoading = true;
    },
    onLoaded() {
       this.isLoading = false;
    },
    onLoadingError() {
               this.isLoading = true;
                axios.get('karyawan/GetJobsRfiBautRevisi').then((response) => { 
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
    'filter-set' (filterText,towernya,infratypenya,startTime,endtime) {
      this.moreParams = {
        filter: filterText,towernya:towernya, infratypenya:infratypenya , min: startTime, max: endtime
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
            this.fetchIt();
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