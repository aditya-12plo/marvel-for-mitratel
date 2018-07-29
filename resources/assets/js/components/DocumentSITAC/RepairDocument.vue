<template>
 <div> 
  <loading :show="isLoading"></loading>
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header" align="center">Form Perubahan Dokumen SITAC Project ID {{this.rowDatanya.project.projectid}}</div>
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
                </div>
                <div class="card-body">
                    <div class="px-3">

              <div class="form-body">
                            <div class="row">  



<!-- Ducument SITAC --> 
<div class="col-xl-12 col-lg-12 col-md-12 mb-1">
<fieldset class="form-group">
<label for="documentsis"><h4>DOKUMEN SITAC</h4></label>
</fieldset>
</div>                              
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_ban_bak">NO BAN / BAK</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_ban_bak')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_ban_bak" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="date_ban_bak">TANGGAL DOKUMEN BAN / BAK</label>
                                        <br>
 <date-picker :date="date_ban_bak" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['date_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ban_bak">DOKUMEN BAN / BAK</label>                              
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="file_name" id="file_name" ref="file_name" v-on:change="newAvatar()"> 
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_ban_bak" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>          
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_ban_bak']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="ijin_warga_date">TANGGAL DOKUMEN IJIN WARGA</label>
                                        <br>
 <date-picker :date="ijin_warga_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['ijin_warga_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_ijin_warga">DOKUMEN IJIN WARGA</label>
                                        <br> 
<label id="projectinput8" class="file center-block">
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_ijin_warga" id="document_ijin_warga" ref="document_ijin_warga" v-on:change="newAvatarDRM()">  
            <span class="file-custom"></span>
                    </label>        
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_ijin_warga" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>  <br>  
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_ijin_warga']"><span style="color:red;">{{ error }}</span></li></ul></div>
<br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>
   
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_pks">NO PKS</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_pks')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_pks" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_pks']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="pks_date">TANGGAL DOKUMEN PKS</label>
                                        <br>
 <date-picker :date="pks_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['pks_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_pks">DOKUMEN PKS</label>
                                        
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_pks" id="document_pks" ref="document_pks" v-on:change="newAvatarPKS()">       
<br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_pks" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> <br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_pks']"><span style="color:red;">{{ error }}</span></li></ul></div>
  <br>
<p class="center-block">* Type dokumen .pdf And Max 10 MB</p>
                                    </fieldset>
                                </div>

 
 
                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_imb">NO IMB</label>
                                        <br>
<input type="text" @input="allcap($event, forms, 'no_imb')" class="form-control" placeholder="AKTUAL SITE ID" v-model="forms.no_imb" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['no_imb']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
 

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
<label for="imb_date">TANGGAL IMB (Selamanya ? <input type="checkbox" id="checkbox" v-model="datenyaIMB">)</label>
                                        <br>
 <div v-if="this.datenyaIMB === true">                                       
 SELAMANYA
</div>
<div v-else>
<date-picker :date="imb_date" :option="option"></date-picker>
</div>    
   
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['imb_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

    <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_imb">DOKUMEN IMB</label>
                                        <br>
<input type="file" accept="application/pdf" class="dropzone dropzone-area" name="document_imb" id="document_imb" ref="document_imb" v-on:change="newAvatarIMB()">
 <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_imb" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a> <br>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['document_imb']"><span style="color:red;">{{ error }}</span></li></ul></div>
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

 

<!-- Project -->
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="projectid"><h4>PROJECT DETAIL</h4></label>
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="projectid">PROJECT ID</label>
                                        <br>
{{this.rowDatanya.project.projectid}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="no_wo">NO WO</label>
                                        <br>
{{this.rowDatanya.project.no_wo}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="wo_date">WO DATE</label>
                                        <br>
{{this.rowDatanya.project.wo_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="batch">BATCH</label>
                                        <br>
BATCH#{{this.rowDatanya.project.batch+' '+this.rowDatanya.project.years}} 
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="infratype">INFRATYPE</label>
                                        <br>
{{this.rowDatanya.project.infratype}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="area">AREA</label>
                                        <br>
{{this.rowDatanya.project.area}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="regional">REGIONAL</label>
                                        <br>
{{this.rowDatanya.project.regional}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_spk">SITE ID SPK</label>
                                        <br>
{{this.rowDatanya.project.site_id_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_spk">SITE NAME SPK</label>
                                        <br>
{{this.rowDatanya.project.site_name_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">ALAMAT SPK</label>
                                        <br>
{{this.rowDatanya.project.address_spk}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">KOORDINAT SPK</label>
                                        <br>
Longitude : {{this.rowDatanya.project.longitude_spk}}
<br>
Latitude : {{this.rowDatanya.project.latitude_spk}}
<br>
<a :href="'http://www.google.com/maps/place/'+this.rowDatanya.project.latitude_spk+','+this.rowDatanya.project.longitude_spk" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
                                    </fieldset>
                                </div>


<!-- Project -->

<!-- Ducument SIS -->
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="documentsis"><h4>DOKUMEN SIS</h4></label><br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_sis" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
                                    </fieldset>
                                </div>
<!-- Ducument SIS -->


<!-- Ducument DRM -->

                                    <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                        <fieldset class="form-group">
                                            <label for="documentsis"><h4>Dokumen DRM</h4></label> 

                                        </fieldset>
                                    </div>
                                    

<div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_id_actual">AKTUAL SITE ID</label>
 <br>
{{this.rowDatanya.project.site_id_actual}}
                                    </fieldset>
                                </div>

  <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="site_name_actual">AKTUAL SITE NAME</label>
                                        <br>
{{this.rowDatanya.project.site_name_actual}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="province">PROVINSI</label>
                                        <br>
{{this.rowDatanya.project.province}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="city">KOTA</label>
                                        <br>
{{this.rowDatanya.project.city}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_actual">ALAMAT</label>
                                        <br>
{{this.rowDatanya.project.address_actual}}
                                    </fieldset>
                                </div>
                               

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="address_spk">KOORDINAT AKTUAL</label>
                                        <br>
Longitude : {{this.rowDatanya.project.longitude_actual}}
<br>
Latitude : {{this.rowDatanya.project.latitude_actual}}
<br>
<a :href="'http://www.google.com/maps/place/'+this.rowDatanya.project.latitude_actual+','+this.rowDatanya.project.longitude_actual" target="_blank"><button type="button" class="btn btn-raised btn-success">
  <i class="ft-navigation"></i> Maps
</button></a>
                                    </fieldset>
                                </div>



                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="kom_date">TANGGAL KOM</label>
                                        <br>
{{this.rowDatanya.project.kom_date}}
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_kom">DOKUMEN KOM</label>
                                        <br>
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_kom" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>
 
                                    </fieldset>
                                </div>


                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="drm_date">TANGGAL DRM</label>
                                        <br>
{{this.rowDatanya.project.drm_date}}
                                    </fieldset>
                                </div>

                                <div class="col-xl-4 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="document_drm">DOKUMEN DRM</label>
                                        <br> 
<a v-bind:href="'/files/'+this.rowDatanya.project.projectid+'/'+this.rowDatanya.project.document_drm" target="_blank"><button type="button" class="btn btn-success"><i class="ft-download"></i> Download</button></a>                                        
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
  modal:new CrudModal({komunikasiproject: false,approve: false}),
    formErrors:{},
      file_name:'',
     document_ijin_warga:'',
     document_pks:'',
     document_imb:'',
     datenyaIMB: false,
     message:'',
    ijin_warga_date: {
        time: ''
      },
      date_ban_bak: {
        time: ''
      },
      pks_date: {
        time: ''
      },
      imb_date: {
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
  forms: new CrudForm({id:'' , project_id:'' , documentsitacid:'' , no_ban_bak:'' , date_ban_bak:'' , document_ban_bak:'' , ijin_warga_date:'' , document_ijin_warga:'' , no_pks:'' , pks_date:'' , document_pks:'' , no_imb:'' , imb_date:'' , document_imb:'' , created_at:''}),  
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
      if(this.typenya === "revisi-document-sitac")
      {
           this.forms= this.rowDatanya.project;
           this.ijin_warga_date.time = this.rowDatanya.project.ijin_warga_date;
           this.date_ban_bak.time = this.rowDatanya.project.date_ban_bak;
           this.pks_date.time = this.rowDatanya.project.pks_date;
           if(this.rowDatanya.project.imb_date === 'SELAMANYA')
           {
           this.datenyaIMB = true;
           }
           else
           {
          this.imb_date.time = this.rowDatanya.project.imb_date;  
           }
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
     newAvatar() {
this.isLoading = true;            
this.file_name = this.$refs.file_name.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.documentsitacid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_ban_bak)
   masuk.set('document_ban_bak', this.file_name) 
axios.post('/karyawan/uploaddokumenSITAC' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_ban_bak = response.data.namafilenya;
    this.file_name = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_ban_bak)
{
    this.file_name = '';
  this.errorNya = {document_ban_bak:[response.data.document_ban_bak]}; 
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
this.document_ijin_warga = this.$refs.document_ijin_warga.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.documentsitacid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_ijin_warga)
   masuk.set('document_ijin_warga', this.document_ijin_warga) 
axios.post('/karyawan/uploaddokumenSITACijinWarga' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_ijin_warga = response.data.namafilenya;
    this.document_ijin_warga = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_ijin_warga)
{
    this.document_ijin_warga = '';
  this.errorNya = {document_ijin_warga:[response.data.document_ijin_warga]}; 
}
if(response.data.errorfile)
                      {
    this.document_ijin_warga = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_ijin_warga = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_ijin_warga = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_ijin_warga = '';               
                
           },
     newAvatarPKS() { 
 this.isLoading = true;            
this.document_pks = this.$refs.document_pks.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.documentsitacid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_pks)
   masuk.set('document_pks', this.document_pks) 
axios.post('/karyawan/uploaddokumenSITACPKS' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_pks = response.data.namafilenya;
    this.document_pks = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_pks)
{
    this.document_pks = '';
  this.errorNya = {document_pks:[response.data.document_pks]}; 
}
if(response.data.errorfile)
                      {
    this.document_pks = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_pks = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_pks = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_pks = '';                
           },
     newAvatarIMB() { 
 this.isLoading = true;            
this.document_imb = this.$refs.document_imb.files[0]; 
 let masuk = new FormData();
   masuk.set('id', this.rowDatanya.project.documentsitacid)
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('namafile', this.rowDatanya.project.document_imb)
   masuk.set('document_imb', this.document_imb) 
axios.post('/karyawan/uploaddokumenSITACIMB' , masuk)
                    .then(response => {
if(response.data.success)
{
this.isLoading = false;
    this.rowDatanya.project.document_imb = response.data.namafilenya;
    this.document_imb = '';
    this.errorNya = '';
    this.success(response.data.success);
}
if(response.data.document_imb)
{
    this.document_imb = '';
  this.errorNya = {document_imb:[response.data.document_imb]}; 
}
if(response.data.errorfile)
                      {
    this.document_imb = '';
                 this.error(response.data.errorfile);
                 this.isLoading = false; 
}
if(response.data.error)
                      {
    this.document_imb = '';
                 this.error(response.data.error);
                 this.isLoading = false;
                 this.backLink();
}
                    })
                    .catch(error => {
                    this.document_imb = '';
                     this.isLoading = false;
                        this.errorNya = error.response.data; 
                    });       
    this.document_imb = '';               
                
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
			  this.$router.push('/repair-documents-sitac');
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
    this.isLoading = true;
        if(this.datenyaIMB === false)
    {
var datenya = this.imb_date.time;
    }
    else
    {
var datenya = 'SELAMANYA';
    }
   let masuk = new FormData();
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('kata', 'Project '+this.rowDatanya.project.projectid+' Menunggu Approval Anda')
   masuk.set('infratype', this.rowDatanya.project.infratype)
   masuk.set('documentsitacid', this.rowDatanya.project.documentsitacid)
   masuk.set('no_ban_bak', this.forms.no_ban_bak) 
   masuk.set('date_ban_bak', this.date_ban_bak.time) 
   masuk.set('document_ban_bak', this.file_name)
   masuk.set('ijin_warga_date', this.ijin_warga_date.time) 
   masuk.set('no_pks', this.forms.no_pks)
   masuk.set('pks_date', this.pks_date.time) 
   masuk.set('no_imb', this.forms.no_imb)
   masuk.set('imb_date', datenya) 
   masuk.set('message', this.message)
   masuk.set('statusmessage', 'APPROVAL DOKUMEN SITAC')
   masuk.set('document', 'DOKUMEN SITAC')
   masuk.set('status', 8)
                axios.post('/karyawan/RevisiDocumentSITAC', masuk)
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