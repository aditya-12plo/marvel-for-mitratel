<template>
 <div> 
  <loading :show="isLoading"></loading>

   


<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
           <h1 align="center">Form Perubahan Dokumen BAKS-BAUK Project ID {{this.rowDatanya.project.projectid}}</h1>
        </div>
    </div>
    <form method="POST" class="form" enctype="multipart/form-data" action="" @submit.prevent="ApproveItem()"> 
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
<button type="button" @click="modal.set('komunikasiproject', true)" class="btn btn-raised btn-success" v-if="this.komunikasi.length > 0">
    <i class="ft-message-square"></i> Lihat Komunikasi
</button> 
                </div>
                <div class="card-body">
                    <div class="px-3">

              <div class="form-body">
 <div class="row" style="padding-bottom:5%;">


                            
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                         <label for="no_baks">NO DOKUMEN BAKS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_baks')" class="form-control" placeholder="NO DOKUMEN BAKS" v-model="forms.no_baks" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_baks">TANGGAL DOKUMEN BAKS</label>
                                        <br>
 <datepicker v-model="forms.date_baks" class="form-control" :typeable="true" :format="customFormatter" placeholder="YYYY-MM-DD"></datepicker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['date_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_baks">DOKUMEN BAKS</label>                              
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="file_name" id="file_name" ref="file_name" v-on:change="newAvatar()"> 
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_baks" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>          
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_baks']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div> 

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_wctr">DOKUMEN WCTR</label>
                                        <br> 
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_wctr" id="document_wctr" ref="document_wctr" v-on:change="newAvatarDRM()">  
            <span class="file-custom"></span>
                    </label>        
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_wctr" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  <br>  
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_wctr']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>
    

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_boq_project">DOKUMEN BOQ PROJECT</label>
                                        
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_boq_project" id="document_boq_project" ref="document_boq_project" v-on:change="newAvatarPKS()">       
<br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_boq_project" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> <br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_boq_project']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

  

    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_rfi_certificate">DOKUMEN RFI CERTIFICATE</label>
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_rfi_certificate" id="document_rfi_certificate" ref="document_rfi_certificate" v-on:change="newAvatarIMB()">
 <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_rfi_certificate" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> <br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_rfi_certificate']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
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
            </form>
</section>
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
import Datepicker from 'vuejs-datepicker'
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
  modal:new CrudModal({komunikasiproject: false,approve: false , drop: false}),
    formErrors:{},
      file_name:'',
     document_wctr:'',
     document_boq_project:'',
     document_rfi_certificate:'',
     datenyaIMB: false,
     message:'',
    date_baks: {
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
  forms: new CrudForm({id:'' , project_id:'' , baksbaukid:'' , no_baks:'' , date_baks:'' , document_baks:'' , document_wctr:'' , document_boq_project:'' , document_rfi_certificate:'' , created_at:''}),  
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
      customFormatter(date) {
      return moment(date).format('YYYY-MM-DD');
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
                  DetailData(){
let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(this.rowDatanya.project.id) }});
window.open(routeData.href, '_blank');
               
            }  ,
               dataAction () {
      if(this.typenya === "revisi-document-baks-bauk")
      {
           this.forms= this.rowDatanya.project; 
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
this.file_name = this.$refs.file_name.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.baksbaukid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_baks)
   masuk.set('document_baks', this.file_name) 
axios.post('/karyawan/uploaddokumenBaks' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_baks = response.data.namafilenya;
    this.file_name = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_baks)
{
    this.file_name = '';
  this.errorNya = {document_baks:[response.data.document_baks]}; 
}
if(response.data.errorfile)
                      {
    this.file_name = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.file_name = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.file_name = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.file_name = '';           
           },
    
     newAvatarDRM() { 
 this.isLoading = true;            
this.document_wctr = this.$refs.document_wctr.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.baksbaukid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_wctr)
   masuk.set('document_wctr', this.document_wctr) 
axios.post('/karyawan/uploaddokumenWctr' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_wctr = response.data.namafilenya;
    this.document_wctr = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_wctr)
{
    this.document_wctr = '';
  this.errorNya = {document_wctr:[response.data.document_wctr]}; 
}
if(response.data.errorfile)
                      {
    this.document_wctr = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_wctr = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_wctr = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_wctr = '';               
                
           },
     newAvatarPKS() { 
 this.isLoading = true;            
this.document_boq_project = this.$refs.document_boq_project.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.baksbaukid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_boq_project)
   masuk.set('document_boq_project', this.document_boq_project) 
axios.post('/karyawan/uploaddokumenBoqProject' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_boq_project = response.data.namafilenya;
    this.document_boq_project = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_boq_project)
{
    this.document_boq_project = '';
  this.errorNya = {document_boq_project:[response.data.document_boq_project]}; 
}
if(response.data.errorfile)
                      {
    this.document_boq_project = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_boq_project = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_boq_project = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_boq_project = '';                
           },
     newAvatarIMB() { 
 this.isLoading = true;            
this.document_rfi_certificate = this.$refs.document_rfi_certificate.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.baksbaukid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_rfi_certificate)
   masuk.set('document_rfi_certificate', this.document_rfi_certificate) 
axios.post('/karyawan/uploaddokumenRfiCertificate' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_rfi_certificate = response.data.namafilenya;
    this.document_rfi_certificate = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_rfi_certificate)
{
    this.document_rfi_certificate = '';
  this.errorNya = {document_rfi_certificate:[response.data.document_rfi_certificate]}; 
}
if(response.data.errorfile)
                      {
    this.document_rfi_certificate = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_rfi_certificate = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_rfi_certificate = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_rfi_certificate = '';               
                
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
    
 question(kata) {
      this.$swal(
'Ooppss?',
 kata,
  'question'
)
    }, 
            backLink() {
			  this.$router.push('/repair-documents-baks-bauk');
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
      
var date_baks = this.customFormatter(this.forms.date_baks)
var dateNow = new Date().toISOString().slice(0,10)
if(date_baks > dateNow)
{
        this.modal.set('approve', false);
        this.error('Input Date Wrong');
}
        else
{ 
    this.isLoading = true;
 
   let masuk = new FormData();
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('kata', 'Project '+this.rowDatanya.project.projectid+' Menunggu Approval Anda')
   masuk.set('infratype', this.rowDatanya.project.infratype)
   masuk.set('baksbaukid', this.rowDatanya.project.baksbaukid)
   masuk.set('no_baks', this.forms.no_baks) 
   masuk.set('date_baks', date_baks)  
   masuk.set('message', this.message)
   masuk.set('statusmessage', 'APPROVAL DOKUMEN BAKS-BAUK')
   masuk.set('document', 'DOKUMEN BAKS-BAUK')
   masuk.set('status', 49)
                axios.post('/karyawan/RevisiDocumentBaksBauk', masuk)
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

DeleteSIS(id,projectid,fileNya){
    var masuk = {kode:id , projectid:projectid , file:fileNya};
                axios.post('/karyawan/DeleteSIS',masuk).then((response) => {
                    return response.data.success;
                });
            },  
DeleteDRM(id,projectid,documentkom,documentdrm){
    var masuk = {kode:id , projectid:projectid , document_kom:documentkom , document_drm:documentdrm};
                axios.post('/karyawan/DeleteDRM',masuk).then((response) => {
                    return response.data.success;
                });
            },  
DeleteSITAC(id,projectid,documentbanbak,documentijinwarga,documentpks,documentimb){
    var masuk = {kode:id , projectid:projectid , document_baks:documentbanbak , document_wctr:documentijinwarga , document_boq_project:documentpks , document_rfi_certificate:documentimb};
                axios.post('/karyawan/DeleteSITAC',masuk).then((response) => {
                    return response.data.success;
                });
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