<template>
 <div> 

<div class="card-header-banner"> </div> 

<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Form Penambahan Data Project</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>
                </div>
                <div class="card-body">
                    <div class="px-3">
<form method="POST" class="form" action="" @submit.prevent="submitData()">	
							<div class="form-body">
		                        <div class="row">	                        	
		                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="projectid">Project ID</label>
<input type="text" @input="allcap($event, forms, 'projectid')" class="form-control" placeholder="Project ID" v-model="forms.projectid" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['projectid']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>


		                            <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="no_wo">No WO</label>
<input type="text" @input="allcap($event, forms, 'no_wo')" class="form-control" placeholder="No WO" v-model="forms.no_wo"  required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_wo']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>
		                            
		                            <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="wo_date">WO Date</label>
<date-picker :date="woDate" :option="option" class="form-control" required></date-picker>                              
<div class="help-block"><ul role="alert">
	<li v-for="error of errorNya['wo_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>
		                            

		                            <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="batch">Batch</label>
 <select class="form-control border-input" v-model="forms.batch" required >
<option value="" selected>Pilih Batch</option>
<option v-for="(n,index) in 25" :value="n">{{ n }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['batch']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>


		                            <div class="col-xl-2 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="years">Tahun Batch</label>
 <select class="form-control border-input" v-model="forms.years" required >
<option value="" selected>Pilih Tahun Batch</option>
<option v-for="n in getYears(2010)" :value="n">{{ n }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['years']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>






<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
		                                    <label for="infratype">Infratype</label>
<select class="form-control border-input" v-model="forms.infratype" required >
<option value="" selected>Pilih Infratype</option>
<option v-for="pilihinfratype in pilihaninratype" :value="pilihinfratype">{{ pilihinfratype }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['infratype']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>



<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
		                                    <label for="area">Area</label>
<select class="form-control border-input" v-model="forms.area" required >
<option value="" selected>Pilih Area User</option>
<option v-for="piliharea in pilihanarea" :value="piliharea">{{ piliharea }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['area']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
		                                    <label for="regional">Regional</label>
<input type="text" @input="allcap($event, forms, 'regional')" class="form-control" placeholder="Regional" v-model="forms.regional" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['regional']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
		                                    <label for="site_id_spk">Site ID SPK</label>
<input type="text" @input="allcap($event, forms, 'site_id_spk')" class="form-control" placeholder="Site ID SPK" v-model="forms.site_id_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_id_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>

<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
		                                    <label for="site_name_spk">Site Name SPK</label>
<input type="text" @input="allcap($event, forms, 'site_name_spk')" class="form-control" placeholder="Site Name SPK" v-model="forms.site_name_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_name_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
		                                    <label for="address_spk">ALamat Site</label>
<textarea type="text" @input="allcap($event, forms, 'address_spk')" class="form-control" placeholder="ALamat Site" v-model="forms.address_spk" rows="5" required></textarea>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['address_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>


<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="longitude_spk">Longitude SPK</label>
<input type="text" @input="allcap($event, forms, 'longitude_spk')" class="form-control" placeholder="Longitude SPK" v-model="forms.longitude_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['longitude_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

<div class="col-xl-2 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="latitude_spk">Latitude SPK</label>
<input type="text" @input="allcap($event, forms, 'latitude_spk')" class="form-control" placeholder="Latitude SPK" v-model="forms.latitude_spk" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['latitude_spk']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>



	 <div class="col-md-12 mb-1">	                            
		                            <div class="form-actions left">
<button type="button" class="btn btn-raised btn-warning mr-1" @click="resetforms()">
	<i class="ft-x"></i> Cancel
</button>
<button type="submit" class="btn btn-raised btn-primary">
	<i class="fa fa-check-square-o"></i> Save
</button>
	                        </div>
	   </div>
		                            
		                        </div>
		                    </div>
						</form>
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
	forms: new CrudForm({id:'' , projectid:'' , no_wo:'' , wo_date:'',  batch:'',  years:'',  infratype:'',  area:'' , regional:'' , site_id_spk:'' , site_name_spk:'' , address_spk:'' , longitude_spk:'' , latitude_spk:'' , status_id:'' , project_status_id:''}), 
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
               dataAction () {
      if(this.typenya === "add-project")
      {
          return true;
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
  fetchIt(){
   this.isLoading = true;
                axios.get('/karyawan/CekUserProfileAkses/ProjectAdd').then((response) => {
                   if(response.data === true)
                   {
                   	this.isLoading = false;
                   }
                   else
                   {
                   	this.$router.push('/page-not-found');
                   }
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
 longitude_spk:this.forms.longitude_spk,
 latitude_spk:this.forms.latitude_spk,
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
            this.fetchIt();
            this.dataAction();

        }
}


</script>



<style>
</style>