<template>
 <div> 
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
             <div class="content-header" align="center">Detail User Akses</div>
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
							<div class="form-body">
		                        <div class="row">	                        	
		                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="nama">NAMA</label>
		                                    <br>
{{this.forms.name}}
		                                </fieldset>
		                            </div>
		                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="email">Email</label>
		                                    <br>
{{this.forms.email}}
		                                </fieldset>
		                            </div>

		                            <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
		                                <fieldset class="form-group">
		                                    <label for="level">Level</label>
		                                    <br>
{{this.forms.level}}
		                                </fieldset>
		                            </div>

<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
<fieldset class="form-group">
<label for="posisi">Posisi</label>
<br>
{{this.forms.posisi}}
</fieldset>
		                            </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-if="this.forms.level=='HQ' && this.forms.posisi=='MANAGER' || this.forms.level=='HQ' && this.forms.posisi=='ACCOUNT MANAGER' || this.forms.level=='REGIONAL' && this.forms.posisi=='MANAGER MARKETING' || this.forms.level=='REGIONAL' && this.forms.posisi=='AM SUPPORT' || this.forms.level=='REGIONAL' && this.forms.posisi=='ACCOUNT MANAGER'">
<fieldset class="form-group">
		                                    <label for="area">Area</label>
		                                    <br>
{{this.forms.area}}
		                                </fieldset>
		                            </div>


<div class="col-xl-4 col-lg-6 col-md-12 mb-1" v-if="this.forms.level=='REGIONAL' && this.forms.posisi=='AM SUPPORT' || this.forms.level=='REGIONAL' && this.forms.posisi=='ACCOUNT MANAGER'">
<fieldset class="form-group">
		                                    <label for="regional">Regional</label>
		                                    <br>
{{this.forms.regional}}
		                                </fieldset>
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
	forms: new CrudForm({id:'' , name:'' , email:'' , level:'',  posisi:'',  area:'',  regional:'',  password:'' , created_at:''}), 
	pilihan: ['REGIONAL','HQ'],
	pilihanregional: ['AM SUPPORT','ACCOUNT MANAGER','MANAGER MARKETING'],
	pilihanhq: ['ACCOUNT MANAGER','MANAGER'],
	pilihanarea: ['1','2','3','4'],
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
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
     dataAction () {
      if(this.typenya === "detail-user")
      {
          this.forms.setFillItem(this.rowDatanya);
      }
      else
      {
			this.$router.push('/page-not-found');
      }
        
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
            backLink() {
			  this.$router.push('/user-access-for-regional-account-manager');
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