<template>
 <div> 
     
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">
      Edit Busdev Email
      </h1> 
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
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="nama">NAMA</label>
<input type="text" @input="allcap($event, forms, 'name')" class="form-control" placeholder="Nama" v-model="forms.name" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['name']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="email">Email</label>
<input type="email" class="form-control" placeholder="Email" v-model="forms.email"  required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['email']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
                                 

   <div class="col-md-12 mb-1">                             
                                <div class="form-actions left">
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
  forms: new CrudForm({id:'' , name:'' , email:'' , created_at:''}), 
 
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
      if(this.typenya === "detail-busdev-email")
      {
          this.forms.setFillItem(this.rowDatanya);
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
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
                axios.put('/karyawan/listbusdev/'+ this.forms.id, this.forms)
                    .then(response => {
                 if(response.data.success)
                      { 
                      this.forms.password=''; 
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