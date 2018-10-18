<template>
 <div> 
  <loading :show="isLoading"></loading>

<div class="card-header-banner"> </div> 

<form method="POST" class="form" enctype="multipart/form-data" action="" @submit.prevent="ApproveItem()"> 
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Form Penambahan Dokumen DRM Project ID {{this.rowDatanya.project.projectid}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>
<button type="submit" class="btn btn-raised btn-primary">
  <i class="fa fa-check-square-o"></i> Save
</button>
<button type="button" @click="DetailData()" class="btn btn-raised btn-info">
    <i class="ft-trending-up"></i> Detail
</button>
<button type="button" @click="drop()" class="btn btn-raised btn-danger">
    <i class="ft-trash-2"></i> Drop
</button>
                </div>
                <div class="card-body">
                    <div class="px-3">
              <div class="form-body">
                            <div class="row">  



<!-- Ducument DRM --> 
<div class="col-xl-12 col-lg-12 col-md-12 mb-1">
<fieldset class="form-group">
<label for="documentsis"><h4>DOKUMEN DRM</h4></label>
</fieldset>
</div>                              
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_actual">AKTUAL SITE ID</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_id_actual')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.site_id_actual" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_id_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_actual">AKTUAL SITE NAME</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'site_name_actual')" class="form-control" placeholder="AKTUAL SITE NAME" v-model="forms.site_name_actual" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_name_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="province">PROVINSI</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'province')" class="form-control" placeholder="PROVINSI" v-model="forms.province" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['province']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="city">KOTA</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'city')" class="form-control" placeholder="KOTA" v-model="forms.city" required>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['city']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_actual">ALAMAT</label>
                                        <br>
  <textarea @input="allcap($event, forms, 'address_actual')" v-model="forms.address_actual" class="form-control" rows="5" id="message" placeholder="ALAMAT" required></textarea>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['address_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="longitude_actual">KOORDINAT</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'longitude_actual')" class="form-control" placeholder="LONGITUDE" v-model="forms.longitude_actual" required>
<br>
<input type="text" @input="allcap($event, forms, 'latitude_actual')" class="form-control" placeholder="LATITUDE" v-model="forms.latitude_actual" required>
<br>
<a :href="'http://www.google.com/maps/place/'+this.forms.latitude_actual+','+this.forms.longitude_actual" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['longitude_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['latitude_actual']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="kom_date">TANGGAL KOM</label>
                                        <br>
<date-picker :date="kom_date" :option="option"></date-picker>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['kom_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_kom">DOKUMEN KOM</label>
                                        <br>
                                       <br>
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" name="file_name" id="file_name" v-on:change="newAvatar" required="required"> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_kom']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="drm_date">TANGGAL DRM</label>
                                        <br>
<date-picker :date="drm_date" :option="option"></date-picker>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['drm_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_drm">DOKUMEN DRM</label>
                                        <br>
                                       <br>
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" name="file_drm" id="file_drm" v-on:change="newAvatarDRM" required="required"> 
            <span class="file-custom"></span>
                    </label>        
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_drm']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">KOMUNIKASI PROJECT</label>
                                        <br>
                                        
<div v-if="this.komunikasi.length > 0">
<button type="button" class="btn btn-raised btn-success" @click="modal.set('komunikasiproject', true)">
  <i class="ft-message-square"></i> Lihat Komunikasi
</button>
</div>

  

                                    </fieldset>
                                </div>
<!-- Ducument DRM -->

   

                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
            </form>
<!-- Basic Inputs end -->

 

<!-- @drop -->
        <modal  v-if="modal.get('drop')" @close="modal.set('drop', false)">
        <template slot="header" align="center"><h4 align="center">Kirim Komunikasi Project</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="dropData()">
                <div class="modal-body">
                
<div class="col-sm-12" v-if="this.komunikasi.length > 0">             
<div v-for="(row,index) in this.komunikasi" style="border: 1px solid grey;">              
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Posisi : {{row.posisi}}</label><br>
                        <label for="stts">Status : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
</div>
</div>
<div class="col-sm-12" v-else>
 <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Belum Ada Komunikasi Project</label><br>
                    </div>
</div>

                   <div class="form-group">
  <label for="message">Pesan:</label>
  <textarea v-model="message" class="form-control" rows="5" id="message" placeholder="Pesan" required></textarea>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya"><span style="color:red;">{{ error }}</span></li></ul></div>
  </div>

                

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('drop', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </template>
        </modal>




<!-- @approve -->
        <modal  v-if="modal.get('approve')" @close="modal.set('approve', false)">
        <template slot="header" align="center"><h4 align="center">Kirim Komunikasi Project</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="submitData()">
                <div class="modal-body">
                
<div class="col-sm-12" v-if="this.komunikasi.length > 0">             
<div v-for="(row,index) in this.komunikasi" style="border: 1px solid grey;">              
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Posisi : {{row.posisi}}</label><br>
                        <label for="stts">Status : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
</div>
</div>
<div class="col-sm-12" v-else>
 <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Belum Ada Komunikasi Project</label><br>
                    </div>
</div>

                   <div class="form-group">
  <label for="message">Pesan:</label>
  <textarea v-model="message" class="form-control" rows="5" id="message" placeholder="Pesan" required></textarea>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya"><span style="color:red;">{{ error }}</span></li></ul></div>
  </div>

                

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('approve', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </template>
        </modal>


<!-- @komunikasiproject -->
<modal  v-if="modal.get('komunikasiproject')" @close="modal.set('komunikasiproject', false)">
        <template slot="header" align="center"><h4 align="center">Komunikasi Project</h4></template>
        <template slot="body" >
                <div class="modal-body">

<div class="col-sm-12" v-if="this.komunikasi.length > 0">             
<div v-for="(row,index) in this.komunikasi" style="border: 1px solid grey;">              
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Posisi : {{row.posisi}}</label><br>
                        <label for="stts">Status : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
</div>
</div>
<div class="col-sm-12" v-else>
 <!-- form Group -->
                    <div class="form-group">
                        <label for="pengirim">Belum Ada Komunikasi Project</label><br>
                    </div>
</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('komunikasiproject', false)" >Close</button>
                    
                </div>
                </form>
        </template>
        </modal>
        
<!-- komunikasiproject -->
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
                                <div class="modal">
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
import Hashids from 'hashids'
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
  modal:new CrudModal({komunikasiproject: false,approve: false , drop: false}),
    formErrors:{},
     file_name:'',
     file_drm:'',
     message:'',
    kom_date: {
        time: ''
      },
      drm_date: {
        time: ''
      },
  GetLevel:'', 
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
  forms: new CrudForm({id:'' , project_id:'' , documentdrmid:'' , site_id_actual:'' , province:'' , city:'' , address_actual:'' , longitude_actual:'' , latitude_actual:'' , kom_date:'' , drm_date:'' , document_kom:'' , document_drm:'' , created_at:''}), 
    errors: new Errors() ,
    errorNya: [],
    komunikasi:[] ,
    dataNya: {name : '', level:''}, 
    loading: false,
      moreParams: {}
    }
  },
 watch: {
        },
        methods: {
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
                  DetailData(){
let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(this.rowDatanya.project.id) }});
window.open(routeData.href, '_blank');
               
            }  ,
               dataAction () {
      if(this.typenya === "add-document-drm")
      {
           this.resetforms();
           this.GetKomunikasi(this.rowDatanya.project.id);
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
      },
                  ApproveItem(){

                   this.errorNya = '';
                   this.message = '';
                this.modal.set('approve', true); 
               
            }  ,
             drop(){

                   this.errorNya = '';
                   this.message = '';
                this.modal.set('drop', true); 
               
            }  ,
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
     newAvatarDRM(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_drm = files[0];
                
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
         this.$router.push('/documents-drm');
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

      /*
if(this.drm_date.time < this.kom_date.time)
{
        this.modal.set('approve', false);
        this.error('Input DRM Date Wrong');
}
        else
{
}
*/
    this.isLoading = true;
   let masuk = new FormData();
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('kata', 'Project '+this.rowDatanya.project.projectid+' Menunggu Approval Anda')
   masuk.set('infratype', this.rowDatanya.project.infratype)
   masuk.set('site_id_actual', this.forms.site_id_actual)
   masuk.set('site_name_actual', this.forms.site_name_actual)
   masuk.set('city', this.forms.city)
   masuk.set('address_actual', this.forms.address_actual)
   masuk.set('longitude_actual', this.forms.longitude_actual)
   masuk.set('latitude_actual', this.forms.latitude_actual)
   masuk.set('kom_date', this.kom_date.time)
   masuk.set('drm_date', this.drm_date.time)
   masuk.set('province', this.forms.province)
   masuk.set('message', this.message)
   masuk.set('statusmessage', 'APPROVAL DOKUMEN DRM')
   masuk.set('document_kom', this.file_name)
   masuk.set('document_drm', this.file_drm)
   masuk.set('document', 'DOKUMEN DRM')
   masuk.set('status', 5)
                axios.post('/karyawan/AddDocumentDRM', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      } 
                      else if(response.data.error)
                      {
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
                      }
                      else
                      {
                         this.modal.set('approve', false);
                          this.isLoading = false; 
                        this.errorNya = {document_drm:[response.data.error]};
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
                        
                    })
  
}
})
            },
            dropData() {
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
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('kata', 'DROP Project '+this.rowDatanya.project.projectid+' Menunggu Approval Anda')
   masuk.set('infratype', this.rowDatanya.project.infratype)
   masuk.set('message', this.message)
   masuk.set('statusmessage', 'APPROVAL DROP PROJECT') 
   masuk.set('document', 'DROP PROJECT')
   masuk.set('status', 104)
                axios.post('/karyawan/DropProject', masuk)
                    .then(response => { 
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      
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
                        
                    })
  }
})
            },

  GetKomunikasi(id){
                axios.get('/karyawan/GetKomunikasiProject/'+id).then((response) => {
                    this.komunikasi = response.data;
                });
            },
              DeleteSIS(id,projectid,fileNya){
    var masuk = {kode:id , projectid:projectid , file:fileNya};
                axios.post('/karyawan/DeleteSIS',masuk).then((response) => {
                    return response.data.success;
                });
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
.modal {
    display: none;
    height: 100%;
    left: 0;
    position: fixed;
    top: 0;
    width: 100%;
}
.modal.open {
   display: block;
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
  -webkit-transform: scale(1);
  -moz-transform: scale(1);
  -ms-transform: scale(1);
  transform: scale(1);
  opacity: 1;
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
  width: 90%;
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