<template>
 <div> 
  <loading :show="isLoading"></loading>

<div class="card-header-banner"> </div> 

<form method="POST" class="form" enctype="multipart/form-data" action="" @submit.prevent="submitData()"> 
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Form Perubahan Dokumen Invoice Project ID {{this.rowDatanya.project.projectid}}</h1>
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
                </div>
                <div class="card-body">
                    <div class="px-3">
              <div class="form-body">
                            <div class="row">  



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_mulai_sewa">TANGGAL MULAI SEWA</label>
                                        <br>
 <date-picker :date="tgl_mulai_sewa" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_mulai_sewa']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_target_rfi">TANGGAL RFI</label>
                                        <br>
 <date-picker :date="tgl_target_rfi" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_target_rfi']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_boq_baps">DOKUMEN BOQ BAPS</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_boq_baps" id="document_boq_baps" class="dropzone dropzone-area" ref="document_boq_baps" v-on:change="newAvatar()"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_boq_baps']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
  <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_boq_baps" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>   
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgL_akhir_sewa">TANGGAL AKHIR SEWA</label>
                                        <br>
 <date-picker :date="tgL_akhir_sewa" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgL_akhir_sewa']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div> 

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_baps">DOKUMEN BAPS</label>
                                        <br>
<input type="file" accept="application/pdf" name="document_baps" id="document_baps" class="dropzone dropzone-area" ref="document_baps" v-on:change="newAvatarBaps()"> 
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_baps']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
  <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_baps" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>   
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>


                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_receive">NO RECEIVE</label>
                                        <br>
<money v-model="forms.no_receive" class="form-control border-input" placeholder="NO RECEIVE" v-bind="nomorinvoice"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_receive']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  
                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_kontrak">NO KONTRAK</label>
                                        <br>
<money v-model="forms.no_kontrak" class="form-control border-input" placeholder="NO KONTRAK" v-bind="nomorinvoice"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_kontrak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                 <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_kontrak">NO INVOICE</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_invoice')" class="form-control" placeholder="NO INVOICE" v-model="forms.no_invoice" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_invoice']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="tgl_invoice">TANGGAL INVOICE</label>
                                        <br>
 <date-picker :date="tgl_invoice" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tgl_invoice']"><span style="color:red;">{{ error }}</span></li></ul></div>
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
<!-- Ducument RFC -->

 
    

                                
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
import {Money} from 'v-money'
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
  Money,
  },
 data () {
    return { 
    	nomorinvoice: {
        decimal: '',
        thousands: '',
        prefix: '',
        suffix: '',
        precision: 0,
        masked: false
        },
        power_capacity: {
          decimal: ',',
          thousands: '.',
          prefix: '',
          suffix: '',
          precision: 1,
          masked: false
        },
        target_rfi: {
          decimal: '',
          thousands: '.',
          prefix: '',
          suffix: '',
          precision: 0,
          masked: false
        },
  isLoading: false,
  modal:new CrudModal({komunikasiproject: false,approve: false,mapping: false , drop: false}),
    formErrors:{},
     document_boq_baps:'',
     document_baps:'',
     message:'',    
     tgl_invoice: {
        time: ''
      }, 
    tgl_mulai_sewa: {
        time: ''
      }, 
    tgL_akhir_sewa: {
        time: ''
      }, 
    tgl_target_rfi: {
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
  forms: new CrudForm({id:'' , project_id:'' ,tgl_mulai_sewa:'',tgl_target_rfi:'', document_boq_baps:'',tgL_akhir_sewa:'',document_baps:''   ,invoiceid:'' , tgl_invoice:'' , no_receive:'', no_kontrak:'', no_invoice:'', created_at:''}), 
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
      if(this.typenya === "revisi-document-invoice")
      { 
           this.resetforms();
        	this.forms = this.rowDatanya.project;
        	this.tgl_invoice.time  =  this.rowDatanya.project.tgl_invoice;
           this.tgl_mulai_sewa.time = this.rowDatanya.project.tgl_mulai_sewa;
           this.tgL_akhir_sewa.time = this.rowDatanya.project.tgL_akhir_sewa;
           this.tgl_target_rfi.time = this.rowDatanya.project.tgl_target_rfi; 
           console.log(this.rowDatanya.project.tgl_mulai_sewa);
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
     newAvatar() {
this.isLoading = true;            
this.document_boq_baps = this.$refs.document_boq_baps.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.invoiceid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_boq_baps)
   masuk.set('document_boq_baps', this.document_boq_baps) 
axios.post('/karyawan/uploaddokumenBoqBaps' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_boq_baps = response.data.namafilenya;
    this.document_boq_baps = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_boq_baps)
{
    this.file_name = '';
  this.errorNya = {document_boq_baps:[response.data.document_boq_baps]}; 
}
if(response.data.errorfile)
                      {
    this.file_name = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_boq_baps = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_boq_baps = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_boq_baps = ''; 
                
           }, 
     newAvatarBaps() { 
this.isLoading = true;            
this.document_baps = this.$refs.document_baps.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.invoiceid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_baps)
   masuk.set('document_baps', this.document_baps) 
axios.post('/karyawan/uploaddokumenBaps' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_baps = response.data.namafilenya;
    this.document_baps = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_baps)
{
    this.file_name = '';
  this.errorNya = {document_baps:[response.data.document_baps]}; 
}
if(response.data.errorfile)
                      {
    this.file_name = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_baps = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_baps = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_baps = ''; 
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
 this.$router.push('/documents-invoice-revisi');
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
    this.isLoading = true;
   let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.invoiceid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('kata', 'REVISI INVOICE')
   masuk.set('infratype', this.rowDatanya.project.infratype) 
   masuk.set('tgl_mulai_sewa', this.tgl_mulai_sewa.time) 
   masuk.set('tgl_target_rfi', this.tgl_target_rfi.time)
   masuk.set('tgL_akhir_sewa', this.tgL_akhir_sewa.time) 
   masuk.set('tgl_invoice', this.tgl_invoice.time)  
   masuk.set('no_receive', this.forms.no_receive)
   masuk.set('no_kontrak', this.forms.no_kontrak)
   masuk.set('no_invoice', this.forms.no_invoice)
   masuk.set('statusmessage', 'REVISI DOKUMEN INVOICE')
   masuk.set('document', 'REVISI INVOICE')
   masuk.set('status', 54)
  axios.post('/karyawan/AddDocumentRevisiInvoice', masuk)
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
                        this.errorNya = {document_baps:[response.data.error]};
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
    
  },
   events: {

  },
  created: function() {
        },
              mounted() {
            this.dataAction();

        }, 
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