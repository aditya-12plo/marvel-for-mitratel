<template>
 <div> 



<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Form Penambahan Data Akses User</h1>
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
		                                    <label for="nama">NAMA</label>
<input type="text" @input="allcap($event, forms, 'name')" class="form-control" placeholder="Nama" v-model="forms.name" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['name']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>
		                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="email">Email</label>
<input type="email" class="form-control" placeholder="Email" v-model="forms.email"  required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['email']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>
		                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="password">Password</label>
<input type="password" class="form-control" placeholder="Password" v-model="forms.password" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['password']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>
		                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="level">Level</label>
 <select class="form-control border-input" v-model="forms.level" required >
<option value="" selected>Pilih Level User</option>
<option v-for="pilih in pilihan" :value="pilih">{{ pilih }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['level']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>

<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-if="this.forms.level=='REGIONAL'">
<fieldset class="form-group">
<label for="posisi">Posisi</label>
 <select class="form-control border-input" v-model="forms.posisi" required >
<option value="" selected>Pilih Posisi User</option>
<option v-for="pilihposisi in pilihanregional" :value="pilihposisi">{{ pilihposisi }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['posisi']"><span style="color:red;">{{ error }}</span></li></ul></div>
</fieldset>
		                            </div>

<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-else-if="this.forms.level=='HQ'">

<fieldset class="form-group">
		                                    <label for="posisi">Posisi</label>
 <select class="form-control border-input" v-model="forms.posisi" required >
<option value="" selected>Pilih Posisi User</option>
<option v-for="pilihposisihq in pilihanhq" :value="pilihposisihq">{{ pilihposisihq }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['posisi']"><span style="color:red;">{{ error }}</span></li></ul></div>
</fieldset>
		                            </div>



<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-if="this.forms.level=='REGIONAL' && this.forms.posisi=='MANAGER MARKETING' || this.forms.level=='REGIONAL' && this.forms.posisi=='AM SUPPORT' || this.forms.level=='REGIONAL' && this.forms.posisi=='ACCOUNT MANAGER'">
<fieldset class="form-group">
                                        <label for="area">Area</label>
<select class="form-control border-input" v-model="forms.area" required >
<option value="" selected>Pilih Area User</option>
<option v-for="piliharea in pilihanarea" :value="piliharea">{{ piliharea }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['area']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-if="this.forms.level=='HQ' && this.forms.posisi=='ACCOUNT MANAGER' || this.forms.level=='HQ' && this.forms.posisi=='HAKI - ACCOUNT MANAGER' || this.forms.level=='HQ' && this.forms.posisi=='HAKI - MANAGER'">
<fieldset class="form-group">
                                        <label for="area">Area HQ</label>
<select class="form-control border-input" v-model="forms.areahq" required >
<option value="" selected>Pilih Area HQ</option>
<option v-for="pilihareahq in pilihanareahq" :value="pilihareahq">{{ pilihareahq }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['areahq']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<!--
<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-if="this.forms.level=='HQ' && this.forms.posisi=='ACCOUNT MANAGER' || this.forms.level=='HQ' && this.forms.posisi=='ACCOUNT MANAGER' || this.forms.level=='REGIONAL' && this.forms.posisi=='MANAGER MARKETING' || this.forms.level=='REGIONAL' && this.forms.posisi=='AM SUPPORT' || this.forms.level=='REGIONAL' && this.forms.posisi=='ACCOUNT MANAGER' || this.forms.level=='HQ' && this.forms.posisi=='HAKI - ACCOUNT MANAGER' || this.forms.level=='HQ' && this.forms.posisi=='HAKI - MANAGER'">
<fieldset class="form-group">
                                        <label for="area">Area</label>
<select class="form-control border-input" v-model="forms.area" required >
<option value="" selected>Pilih Area User</option>
<option v-for="piliharea in pilihanarea" :value="piliharea">{{ piliharea }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['area']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-if="this.forms.level=='HQ' && this.forms.posisi=='ACCOUNT MANAGER' || this.forms.level=='HQ' && this.forms.posisi=='HAKI - ACCOUNT MANAGER' || this.forms.level=='HQ' && this.forms.posisi=='HAKI - MANAGER'">
<fieldset class="form-group">
		                                    <label for="area">Area 2</label>
<select class="form-control border-input" v-model="forms.area2" required >
<option value="" selected>Pilih Area User</option>
<option v-for="piliharea in pilihanarea" :value="piliharea">{{ piliharea }}</option>
</select>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['area2']"><span style="color:red;">{{ error }}</span></li></ul></div>
		                                </fieldset>
		                            </div>
-->

<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-if="this.forms.level=='REGIONAL' && this.forms.posisi=='AM SUPPORT' || this.forms.level=='REGIONAL' && this.forms.posisi=='ACCOUNT MANAGER'">
<fieldset class="form-group">
		                                    <label for="regional">Regional</label>
<input type="text" class="form-control" placeholder="Regional" v-model="forms.regional" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['regional']"><span style="color:red;">{{ error }}</span></li></ul></div>
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
	forms: new CrudForm({id:'' , name:'' , email:'' , level:'',  posisi:'',  area:'',  area2:'', areahq:'' ,  regional:'',  password:'' , created_at:''}), 
	pilihan: ['REGIONAL','HQ'],
	pilihanregional: ['AM SUPPORT','ACCOUNT MANAGER','MANAGER MARKETING'],
	pilihanhq: ['ACCOUNT MANAGER','MANAGER','HAKI - ACCOUNT MANAGER','HAKI - MANAGER','BISNIS'],
    pilihanarea: ['1','2','3','4'],
    pilihanareahq:['WEST','EAST'],
    errors: new Errors() ,
    errorNya: [],
    dataNya: {name : '', level:''},
    perPage: 10,
    loading: false,
      moreParams: {}
    }
  },
 watch: {
        },
        methods: {
               dataAction () {
      if(this.typenya === "add-user")
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
                axios.get('/karyawan/CekUserProfileAkses/UserAdd').then((response) => {
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
              resetforms() {
         		this.errorNya='';
         		this.forms.reset();
                this.errors.clearAll();
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
            backLink() {
			   this.$router.go(-1);
            } ,
    allcap (e, o, prop) {
  const start = e.target.selectionStart;
    e.target.value = e.target.value.toUpperCase();
    this.$set(o, prop, e.target.value);
    e.target.setSelectionRange(start, start);
    },
    formatDate (value, fmt = 'D M YYYY') {
      return (value == null)
        ? ''
        : moment(value, 'YYYY-MM-DD').format(fmt)
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
  if (result.value) {
                axios.post('/karyawan/listuser', this.forms)
                    .then(response => {
                      if(response.data.success)
                      { 
                this.resetforms();
                 this.success(response.data.success);
                      }
                      else
                      {
                 this.error(response.data.error);

                      }
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