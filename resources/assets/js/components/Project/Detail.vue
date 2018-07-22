<template>
 <div> 
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header" align="center">Detail Data Project ID {{this.formsProject.projectid}}</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>
                </div>
                <div class="card-body">
                    <div class="row">


<div class="col-12">
          <div class="card-header">
<h3>Status Project : <b>{{this.statusProject.detailstatus}}</b></h3>
        </div>
</div>

<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen SIS</h5>
                        </div>
                    </div>
                    
                             <span><button type="button" class="btn btn-raised btn-warning round btn-min-width mr-1 mb-1">Detail</button></span>
                </div>
            </div>
        </div>
    </div>



<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-warning">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen DRM</h5>
                        </div>
                    </div>
                    
                             <span><button type="button" class="btn btn-raised btn-primary round btn-min-width mr-1 mb-1">Detail</button></span>
                </div>
            </div>
        </div>
    </div>





<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-success">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen SITAC</h5>
                        </div>
                    </div>
                    
                             <span><button type="button" class="btn btn-raised btn-secondary round btn-min-width mr-1 mb-1">Detail</button></span>
                </div>
            </div>
        </div>
    </div>



   


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-info">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">Dokumen SITAC</h5>
                        </div>
                    </div>
                    
                             <span><button type="button" class="btn btn-raised btn-danger round btn-min-width mr-1 mb-1">Detail</button></span>
                </div>
            </div>
        </div>
    </div>


   


<div class="col-xl-3 col-lg-6 col-md-6 col-12">
        <div class="card bg-danger">
            <div class="card-body">
                <div class="card-block pt-2 pb-0">
                    <div class="media">
                        <div class="media-body white text-left">
                            <h5 class="font-large-1 mb-0">BOQ</h5>
                        </div>
                    </div>
                    
                             <span><button type="button" class="btn btn-raised btn-primary round btn-min-width mr-1 mb-1">Detail</button></span>
                </div>
            </div>
        </div>
    </div>



   





                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Basic Inputs end -->
 </div> 
</template>



<script>
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
Vue.use(VueEvents)
Vue.component('custom-actions', require('../Button/BooksCustomActions.vue'))
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
    formErrors:{},
	GetLevel:'', 
	woDate: {
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
  statusProject: [], 
  formsProject: [], 
    formsSIS: [], 
	formsDRM: [], 
  formsSITAC: [], 
  formsRFC: [], 
  formsBOQ: [],
  showSIS:false,
  showDRM:false,
  showSITAC:false,
  showRFC:false,
  showBOQ:false,
	pilihaninratype: ['B2S','UNTAPPED'],
	pilihanarea: ['1','2','3','4'],
    errors: new Errors() ,
    errorNya: [],
    dataStatus: '',
    dataNya: {name : '', level:''},
    perPage: 10,
    loading: false,
      moreParams: {}
    }
  },
 watch: {
        },
        methods: {
        	getYears:function(start){
        		var stop = new Date().getFullYear()+1;
            return new Array(stop-start).fill(start).map((n,i)=>n+i);
        },
  GetAllData(kode){
                axios.get('/karyawan/GetProjectDetail/'+kode).then((response) => {

          this.formsSIS = response.data.sis;
          this.formsDRM = response.data.drm;
          this.formsSITAC = response.data.sitac;
          this.formsRFC = response.data.rfc;
          this.formsBOQ = response.data.boq;
                });
            },
               dataAction() {
      if(this.typenya === "detail-project")
      {
          this.GetAllData(this.rowDatanya.id);
          this.formsProject = this.rowDatanya;
          this.statusProject = this.rowDatanya.projectstatus;
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
      },
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
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
            backLink() {
			  this.$router.go(-1);
            } ,
    allcap (e, o, prop) {
  const start = e.target.selectionStart;
    e.target.value = e.target.value.toUpperCase();
    this.$set(o, prop, e.target.value);
    e.target.setSelectionRange(start, start);
    },
    formatDate (value, fmt = 'DD-MM-YYYY HH:mm:ss') {
      return (value == null)
        ? ''
        : moment(value, 'DD-MM-YYYY HH:mm:ss').format(fmt)
    },       
      resetforms() {
         		this.errorNya='';
         		 this.woDate.time = '';
         		this.forms.reset();
                this.errors.clearAll();
        },
    submitData() {
    	this.$swal({
  title: 'Are you sure ?',
  type: 'warning',
  showCancelButton: true,
  confirmButtonColor: '#3085d6',
  cancelButtonColor: '#d33',
  confirmButtonText: 'Yes!'
}).then((result) => {


var masuk ={
 projectid:this.forms.projectid,
 no_wo:this.forms.no_wo,
 wo_date:this.woDate.time,
 batch:this.forms.batch,
 years:this.forms.years,
 infratype:this.forms.infratype,
area:this.forms.area,
 regional:this.forms.regional,
 site_id_spk:this.forms.site_id_spk,
 site_name_spk:this.forms.site_name_spk,
 address_spk:this.forms.address_spk,
 status_id:1,
 project_status_id:0};

 if (result.value) {
                axios.post('/karyawan/listproject', masuk)
                    .then(response => {
                this.resetforms();
                 this.success(response.data.success);
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.$router.push('/page-not-found');
                    }
                    }
                        
                    })
  }



})
            },
		
  },
   events: {

  },
  created: function() {
        },
		          mounted() {
            this.dataAction();

        }
}


</script>



<style>
</style>