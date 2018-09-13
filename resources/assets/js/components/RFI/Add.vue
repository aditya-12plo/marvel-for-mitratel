<template>
 <div> 
  <loading :show="isLoading"></loading>
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header" align="center">Form Penambahan Dokumen Rfi Detail Project ID {{this.rowDatanya.project.projectid}}</div>
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

                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_detail_start_date">TANGGAL MULAI RFI</label>
                                        <br>
 <date-picker :date="rfi_detail_start_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_start_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

 
 
                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_detail_end_date">TANGGAL BERAKHIR RFI</label>
                                        <br>
 <date-picker :date="rfi_detail_end_date" :option="option"></date-picker>
  <div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_end_date']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>

 
                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_detail_price_month">Harga Sewa / Bulan</label>
                                        <br>
<money v-model="forms.rfi_detail_price_month" class="form-control border-input" placeholder="Harga Sewa / Bulan" v-bind="duit"></money> 
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_price_month']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>


                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
                                    <fieldset class="form-group">
                                        <label for="rfi_detail_price_year">Harga Sewa / Tahun</label>
                                        <br>
{{this.perkalianTahun(this.forms.rfi_detail_price_month)}}
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['rfi_detail_price_year']"><span style="color:red;">{{ error }}</span></li></ul></div>
                                    </fieldset>
                                </div>
  


                                <div class="col-xl-3 col-lg-6 col-md-12 mb-1">
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
import Hashids from 'hashids'
import {Money} from 'v-money'
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
  Money,
  },
 data () {
    return {
    duit: {
        decimal: ',',
        thousands: '.',
        prefix: 'Rp. ',
        suffix: '',
        precision: 0,
        masked: false
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
    rfi_detail_start_date: {
        time: ''
      }, 
    rfi_detail_end_date: {
        time: ''
      }, 
  isLoading: false,
  modal:new CrudModal({komunikasiproject: false,approve: false,drop: false}),
    formErrors:{},
     file_name:'',
     file_name_baut:'',
     message:'',
	GetLevel:'', 
	forms: new CrudForm({id:'' , project_id:'' , rfidetailid:'' ,  rfi_detail_start_date:'' ,  rfi_detail_end_date:'' ,rfi_detail_price_month:'' , rfi_detail_price_year:'' , created_at:''}), 
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
      if(this.typenya === "RfiDetail-add-data")
      {
           this.resetforms();
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
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
     newAvatarBaut(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name_baut = files[0];
                
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
			   this.$router.push('/cme-rfi-detail');
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
   masuk.set('kata', 'Project '+this.rowDatanya.project.projectid+' Menunggu Approval Anda')
   masuk.set('infratype', this.rowDatanya.project.infratype)
   masuk.set('message', this.message)
   masuk.set('statusmessage', 'SUBMIT RFI DETAIL')
   masuk.set('rfi_detail_start_date', this.rfi_detail_start_date.time)
   masuk.set('rfi_detail_end_date', this.rfi_detail_end_date.time)
   masuk.set('rfi_detail_price_month', this.forms.rfi_detail_price_month)  
   masuk.set('rfi_detail_price_year', this.forms.rfi_detail_price_year)  
   masuk.set('document', 'SUBMIT RFI DETAIL')
   masuk.set('status', 41)
                axios.post('/karyawan/AddDocumentRfiDetail', masuk)
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
                        this.errorNya = {document_sis:[response.data.error]};
                      }
                    })
                    .catch(error => {
                    if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                         this.modal.set('approve', false);
                         this.isLoading = false;
                       this.errorNya = error.response.data;
                    }
                   else if (error.response.status = 500) {
                         this.modal.set('approve', false);
                        this.isLoading = false;
                        this.$router.push('/server-error');
                    }
                    else
                    {
                         this.modal.set('approve', false);
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
   masuk.set('status', 107)
                axios.post('/karyawan/DropProjectHaki', masuk)
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
   perkalianTahun (value) {
       this.forms.rfi_detail_price_year = value*12;
      var tahunan = value*12;
      return accounting.formatMoney(tahunan,  "Rp. ", 0, ".", ",")
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