<template>
 <div> 
  <loading :show="isLoading"></loading>
<div class="card-header-banner"> </div> 


<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Form Perubahan Dokumen Rfi & Baut Project ID {{this.rowDatanya.project.projectid}}</h1>
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
<button type="button" @click="DetailSite()" class="btn btn-raised btn-info">
    <i class="ft-shuffle"></i> Detail Site
</button>
<button type="button" @click="drop()" class="btn btn-raised btn-danger">
    <i class="ft-trash-2"></i> Drop
</button>
                </div>
                <div class="card-body">
                    <div class="px-3">
	
							<div class="form-body">
		                        <div class="row">	

<div class="col-xl-12 col-lg-6 col-md-12 mb-1">
   <div class="help-block"><ul role="alert"><li v-for="error of errorNya"><span style="color:red;">{{ error }}</span></li></ul></div>
</div>            


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">Komunikasi Project</label>
                                        <br>
                                        
<div v-if="this.komunikasi.length > 0">
<button type="button" class="btn btn-raised btn-success" @click="modal.set('komunikasiproject', true)">
  <i class="ft-message-square"></i> Lihat Komunikasi
</button>
</div>
 
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_date">TANGGAL DOKUMEN RFI</label>
                                        <br>
 <date-picker :date="rfi_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="rfi_document"><h4>DOKUMEN RFI</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
<input type="file" name="rfi_document" id="rfi_document" ref="rfi_document" class="dropzone dropzone-area" v-on:change="newAvatarrfi_document()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.rfi_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
                                        </fieldset>
                                    </div>
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="baut_date">TANGGAL DOKUMEN BAUT</label>
                                        <br>
 <date-picker :date="baut_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['baut_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="baut_document"><h4>DOKUMEN BAUT</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
                        <input type="file" name="baut_document" id="baut_document" class="dropzone dropzone-area" ref="baut_document" v-on:change="newAvatarbaut_document()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.baut_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['baut_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
                                        </fieldset>
                                    </div>
                                    
 
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="m_e_process_date">TANGGAL DOKUMEN M-E Process</label>
                                        <br>
 <date-picker :date="m_e_process_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['m_e_process_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="m_e_process_document"><h4>DOKUMEN M-E PROCESS </h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
<input type="file" name="m_e_process_document" id="m_e_process_document" class="dropzone dropzone-area" ref="m_e_process_document" v-on:change="newAvatarm_e_process_document()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.m_e_process_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['m_e_process_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
                                        </fieldset>
                                    </div>
                                    
    
 
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="tower_erection_date">TANGGAL DOKUMEN Tower Erection</label>
                                        <br>
 <date-picker :date="tower_erection_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_erection_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="tower_erection_document"><h4>DOKUMEN Tower Erection</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
<input type="file" name="tower_erection_document" id="tower_erection_document" class="dropzone dropzone-area" ref="tower_erection_document" v-on:change="newAvatartower_erection_document()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.tower_erection_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['tower_erection_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
                                        </fieldset>
                                    </div>
                                    
 
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="curing_date">TANGGAL DOKUMEN CURING</label>
                                        <br>
 <date-picker :date="curing_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['curing_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="curing_document"><h4>DOKUMEN CURING</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
<input type="file" name="curing_document" id="curing_document" ref="curing_document" class="dropzone dropzone-area" v-on:change="newAvatarcuring_document()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.curing_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['curing_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
                                        </fieldset>
                                    </div>
                                    
 


 
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="pouring_date">TANGGAL DOKUMEN POURING</label>
                                        <br>
 <date-picker :date="pouring_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['pouring_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="pouring_document"><h4>DOKUMEN POURING</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
<input type="file" name="pouring_document" id="pouring_document" ref="pouring_document" class="dropzone dropzone-area" v-on:change="newAvatarpouring_document()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.pouring_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['pouring_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
                                        </fieldset>
                                    </div>
                                    
 

 
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="excavation_date">TANGGAL DOKUMEN EXCAVATION</label>
                                        <br>
 <date-picker :date="excavation_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['excavation_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="excavation_document"><h4>DOKUMEN EXCAVATION</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
<input type="file" name="excavation_document" id="excavation_document" ref="excavation_document" class="dropzone dropzone-area" v-on:change="newAvatarexcavation_document()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.excavation_document" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['excavation_document']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
                                        </fieldset>
                                    </div>
                                    
 

 
       
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="site_opening_date">TANGGAL DOKUMEN SITE OPENING</label>
                                        <br>
 <date-picker :date="site_opening_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['site_opening_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                    <div class="col-xl-4 col-lg-4 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="document_site_opening"><h4>DOKUMEN SITE OPENING</h4></label>
                                        <br>
<label id="projectinput8" class="file center-block">
<input type="file" name="document_site_opening" id="document_site_opening" ref="document_site_opening" class="dropzone dropzone-area" v-on:change="newAvatardocument_site_opening()"> 
            <span class="file-custom"></span>
                    </label>
                <br>
 <a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_site_opening" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  

<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_site_opening']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf/.jpg And Max 10 MB</p>
                                        </fieldset>
                                    </div>
                                    
 


 
		                            
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
    site_opening_date: {
        time: ''
      }, 
    excavation_date: {
        time: ''
      }, 
    pouring_date: {
        time: ''
      }, 
    curing_date: {
        time: ''
      }, 
    tower_erection_date: {
        time: ''
      }, 
    m_e_process_date: {
        time: ''
      }, 
    rfi_date: {
        time: ''
      }, 
    baut_date: {
        time: ''
      }, 
  isLoading: false,
  modal:new CrudModal({komunikasiproject: false,approve: false,drop: false}),
    formErrors:{},
     document_site_opening:'',
     excavation_document:'',
     pouring_document:'',
     curing_document:'',
     tower_erection_document:'',
     m_e_process_document:'',
     rfi_document:'',
     baut_document:'',
     message:'',
	GetLevel:'', 
	forms: new CrudForm({id:'' , project_id:'' , siteopeningid:'' ,  site_opening_date:'' ,  document_site_opening:'' ,excavationid:'' , excavation_date:'' ,  excavation_document:'' ,  pouringid:'' , pouring_date:'' ,  pouring_document:'' ,   curingid:'' ,    curing_date:'' ,   curing_document:'' ,   towererectionid:'' ,    tower_erection_date:'' ,    tower_erection_document:'' , meprocessid:'' ,  m_e_process_date:'' ,  m_e_process_document:'' ,  rfibautid:'' , rfi_date:'' ,  rfi_document:'' ,   baut_date:'' ,    baut_document:'' , created_at:''}), 
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
               dataAction () {
      if(this.typenya === "RfiBaut-edit-data")
      {
           this.resetforms();
           this.rfi_date.time = this.rowDatanya.project.rfi_date;
           this.baut_date.time = this.rowDatanya.project.baut_date;
           this.m_e_process_date.time = this.rowDatanya.project.m_e_process_date;
           this.tower_erection_date.time = this.rowDatanya.project.tower_erection_date;
           this.curing_date.time = this.rowDatanya.project.curing_date;
           this.pouring_date.time = this.rowDatanya.project.pouring_date;
           this.excavation_date.time = this.rowDatanya.project.excavation_date;
           this.site_opening_date.time = this.rowDatanya.project.site_opening_date;
           this.GetKomunikasi(this.rowDatanya.project.id);
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
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


     newAvatarrfi_document() {
this.errorNya = '';
this.isLoading = true;            
this.rfi_document = this.$refs.rfi_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.rfibautid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.rfi_document)
   masuk.set('rfi_document', this.rfi_document) 
axios.post('/karyawan/uploadrfi_document' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.rfi_document = response.data.namafilenya;
    this.rfi_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.rfi_document)
{
    this.rfi_document = '';
  this.errorNya = {rfi_document:[response.data.rfi_document]}; 
}
if(response.data.errorfile)
                      {
              this.rfi_document = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.rfi_document = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.rfi_document = '';
                    this.isLoading = false;
                    this.errorNya = error.response.data; 
                    });       
    this.rfi_document = ''; 
                
           },


     newAvatarbaut_document() {
this.errorNya = '';
this.isLoading = true;            
this.baut_document = this.$refs.baut_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.rfibautid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.baut_document)
   masuk.set('baut_document', this.baut_document) 
axios.post('/karyawan/uploadbaut_document' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.baut_document = response.data.namafilenya;
    this.baut_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.baut_document)
{
    this.baut_document = '';
  this.errorNya = {baut_document:[response.data.baut_document]}; 
}
if(response.data.errorfile)
                      {
              this.baut_document = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.baut_document = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.baut_document = '';
                    this.isLoading = false;
                    this.errorNya = error.response.data; 
                    });       
    this.baut_document = ''; 
                
           },


           


     newAvatarm_e_process_document() {
this.errorNya = '';
this.isLoading = true;            
this.m_e_process_document = this.$refs.m_e_process_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.meprocessid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.m_e_process_document)
   masuk.set('m_e_process_document', this.m_e_process_document) 
axios.post('/karyawan/uploadm_e_process_document' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.m_e_process_document = response.data.namafilenya;
    this.m_e_process_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.m_e_process_document)
{
    this.m_e_process_document = '';
  this.errorNya = {m_e_process_document:[response.data.m_e_process_document]}; 
}
if(response.data.errorfile)
                      {
              this.m_e_process_document = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.m_e_process_document = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.m_e_process_document = '';
                    this.isLoading = false;
                    this.errorNya = error.response.data; 
                    });       
    this.m_e_process_document = ''; 
                
           },



     newAvatartower_erection_document() {
this.errorNya = '';
this.isLoading = true;            
this.tower_erection_document = this.$refs.tower_erection_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.towererectionid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.tower_erection_document)
   masuk.set('tower_erection_document', this.tower_erection_document) 
axios.post('/karyawan/uploadtower_erection_document' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.tower_erection_document = response.data.namafilenya;
    this.tower_erection_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.tower_erection_document)
{
    this.tower_erection_document = '';
  this.errorNya = {tower_erection_document:[response.data.tower_erection_document]}; 
}
if(response.data.errorfile)
                      {
              this.tower_erection_document = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.tower_erection_document = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.tower_erection_document = '';
                    this.isLoading = false;
                    this.errorNya = error.response.data; 
                    });       
    this.tower_erection_document = ''; 
                
           },




     newAvatarcuring_document() {
this.errorNya = '';
this.isLoading = true;            
this.curing_document = this.$refs.curing_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.curingid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.curing_document)
   masuk.set('curing_document', this.curing_document) 
axios.post('/karyawan/uploadcuring_document' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.curing_document = response.data.namafilenya;
    this.curing_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.curing_document)
{
    this.curing_document = '';
  this.errorNya = {curing_document:[response.data.curing_document]}; 
}
if(response.data.errorfile)
                      {
              this.curing_document = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.curing_document = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.curing_document = '';
                    this.isLoading = false;
                    this.errorNya = error.response.data; 
                    });       
    this.curing_document = ''; 
                
           },




     newAvatarpouring_document() {
this.errorNya = '';
this.isLoading = true;            
this.pouring_document = this.$refs.pouring_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.pouringid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.pouring_document)
   masuk.set('pouring_document', this.pouring_document) 
axios.post('/karyawan/uploadpouring_document' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.pouring_document = response.data.namafilenya;
    this.pouring_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.pouring_document)
{
    this.pouring_document = '';
  this.errorNya = {pouring_document:[response.data.pouring_document]}; 
}
if(response.data.errorfile)
                      {
              this.pouring_document = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.pouring_document = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.pouring_document = '';
                    this.isLoading = false;
                    this.errorNya = error.response.data; 
                    });       
    this.pouring_document = ''; 
                
           },




     newAvatarexcavation_document() {
this.errorNya = '';
this.isLoading = true;            
this.excavation_document = this.$refs.excavation_document.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.excavationid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.excavation_document)
   masuk.set('excavation_document', this.excavation_document) 
axios.post('/karyawan/uploadexcavation_document' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.excavation_document = response.data.namafilenya;
    this.excavation_document = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.excavation_document)
{
    this.excavation_document = '';
  this.errorNya = {excavation_document:[response.data.excavation_document]}; 
}
if(response.data.errorfile)
                      {
              this.excavation_document = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.excavation_document = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.excavation_document = '';
                    this.isLoading = false;
                    this.errorNya = error.response.data; 
                    });       
    this.excavation_document = ''; 
                
           },



     newAvatardocument_site_opening() {
this.errorNya = '';
this.isLoading = true;            
this.document_site_opening = this.$refs.document_site_opening.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.siteopeningid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_site_opening)
   masuk.set('document_site_opening', this.document_site_opening) 
axios.post('/karyawan/uploaddocument_site_opening' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_site_opening = response.data.namafilenya;
    this.document_site_opening = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_site_opening)
{
    this.document_site_opening = '';
  this.errorNya = {document_site_opening:[response.data.document_site_opening]}; 
}
if(response.data.errorfile)
                      {
              this.document_site_opening = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_site_opening = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_site_opening = '';
                    this.isLoading = false;
                    this.errorNya = error.response.data; 
                    });       
    this.document_site_opening = ''; 
                
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
			   this.$router.push('/rfi-baut-revisi');
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
   masuk.set('project_id', this.rowDatanya.project.id) 
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('siteopeningid', this.rowDatanya.project.siteopeningid)
   masuk.set('site_opening_date', this.site_opening_date.time)
   masuk.set('excavationid', this.rowDatanya.project.excavationid)
   masuk.set('excavation_date', this.excavation_date.time)
   masuk.set('pouringid', this.rowDatanya.project.pouringid)
   masuk.set('pouring_date', this.pouring_date.time)
   masuk.set('curingid', this.rowDatanya.project.curingid)
   masuk.set('curing_date', this.curing_date.time)
   masuk.set('towererectionid', this.rowDatanya.project.towererectionid)
   masuk.set('tower_erection_date', this.tower_erection_date.time)
   masuk.set('meprocessid', this.rowDatanya.project.meprocessid)
   masuk.set('m_e_process_date', this.m_e_process_date.time)
   masuk.set('rfibautid', this.rowDatanya.project.rfibautid)
   masuk.set('rfi_date', this.rfi_date.time)
   masuk.set('baut_date', this.baut_date.time)
   masuk.set('document', 'APPROVAL DOKUMEN CME')
   masuk.set('statusmessage', 'APPROVAL DOKUMEN CME')
   masuk.set('kata', 'Project '+this.rowDatanya.project.projectid+' Menunggu Approval Anda')
   masuk.set('infratype', this.rowDatanya.project.infratype)
   masuk.set('message', this.message)
   masuk.set('status', 39)
                axios.post('/karyawan/RevisiDocumentCME', masuk)
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
DetailSite(){
let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(this.rowDatanya.project.id) }});
window.open(routeData.href, '_blank');
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

        }
}


</script>



<style>
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