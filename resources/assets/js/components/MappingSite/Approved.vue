<template>
 <div> 
  <loading :show="isLoading"></loading>



<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <h1 align="center">Form Approval Mapping Site Project ID {{this.rowDatanya.project.projectid}}</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>
<button type="button" class="btn btn-raised btn-danger" @click="RepairItem()">
    <i class="fa ft-x-square"></i> Cancel
</button>
<button type="button" class="btn btn-raised btn-primary" @click="ApproveItem()">
    <i class="fa fa-check-square-o"></i> Setujui
</button>
                </div>
                <div class="card-body">
                    <div class="px-3">
							<div class="form-body">
		                        <div class="row">	 


<!-- Project Detail --> 
                                <div class="col-xl-12 col-lg-12 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="projectid"><h4>PROJECT DETAIL</h4></label>
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

<!-- Project Detail --> 
    

		                            
		                        </div>
		                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
                    <button type="button" class="btn btn-default" @click="modal.set('approve', false)">Close</button>
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
     message:'',
     regional:'',
     status:'',
	kata:'', 
	GetLevel:'', 
	statusmessage:'',
	forms: new CrudForm({id:'' , project_id:'' , document_sis:'' , created_at:''}), 
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
      if(this.typenya === "approval-mapping-site")
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
this.statusmessage = '';
this.status = '';
this.regional = '';  
this.kata = '';                    
this.statusmessage = 'MAPPING SITE';
this.status = 103;
this.regional = this.rowDatanya.project.regional;  
this.kata = 'MAPPING SITE Project ID '+this.rowDatanya.project.projectid+' Di Setujui';
this.errorNya = '';
this.message = '';
this.modal.set('approve', true); 
               
            }  ,
                  RepairItem(){
this.statusmessage = '';
this.status = '';
this.regional = '';  
this.kata = '';
this.statusmessage = 'MAPPING SITE';
this.status = 1;
this.regional = this.rowDatanya.project.regional;  
this.kata = 'MAPPING SITE Project ID '+this.rowDatanya.project.projectid+' DI Tolak';
this.errorNya = '';
this.message = '';
this.modal.set('approve', true); 
               
            }  ,
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
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
			  this.$router.push('/approval-mapping-site');
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
if(this.status === 103)
{
 this.DeleteSIS(this.rowDatanya.project.documentid,this.rowDatanya.project.projectid ,this.rowDatanya.project.document_sis);       
this.DeleteDRM(this.rowDatanya.project.documentdrmid,this.rowDatanya.project.projectid ,this.rowDatanya.project.document_kom ,this.rowDatanya.project.document_drm);       
this.DeleteSITAC(this.rowDatanya.project.documentsitacid,this.rowDatanya.project.projectid ,this.rowDatanya.project.document_ban_bak ,this.rowDatanya.project.document_ijin_warga ,this.rowDatanya.project.document_pks ,this.rowDatanya.project.document_imb);                                      
}

   let masuk = new FormData();
   masuk.set('project_id', this.rowDatanya.project.id)
   masuk.set('projectid', this.rowDatanya.project.projectid)
   masuk.set('kata', this.kata)
   masuk.set('infratype', this.rowDatanya.project.infratype)
   masuk.set('message', this.message)
   masuk.set('regional', this.regional)
   masuk.set('statusmessage', this.statusmessage)
   masuk.set('document', 'MAPPING SITE')
   masuk.set('status', this.status)
                axios.post('/karyawan/ApprovalMappingSite', masuk)
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
    var masuk = {kode:id , projectid:projectid , document_ban_bak:documentbanbak , document_ijin_warga:documentijinwarga , document_pks:documentpks , document_imb:documentimb};
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