<template>
 <div> 
  <loading :show="isLoading"></loading>
<section class="basic-elements">
    <div class="row">
        <div class="col-sm-12">
            <div class="content-header" align="center">Detail Project CME</div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>
<button type="button" class="btn btn-raised btn-danger" @click="RepairItem()">
    <i class="fa ft-x-square"></i> Perbaiki
</button> 
<button type="button" class="btn btn-raised btn-primary" @click="ApproveItem()">
    <i class="fa fa-check-square-o"></i> Setujui
</button>
                </div>

<div class="card-body">

 <table class="table table-responsive-md text-center">
                            <thead>
                                <tr>
                                    <th><b>NO</b></th>
                                    <th><b>BATCH</b></th>
                                    <th><b>PID</b></th>
                                    <th><b>INFRATYPE</b></th>
                                    <th><b>TOWER</b></th>
                                    <th><b>REGIONAL</b></th>
                                    <th><b>SITE ID AKTUAL</b></th>
                                    <th><b>SITE NAME AKTUAL</b></th>
                                    <th><b>ALAMAT AKTUAL</b></th>
                                    <th><b>KOTA </b></th>
                                    <th><b> PROVINSI</b></th>
                                    <th><b>HARGA SEWA / BULAN </b></th>
                                    <th><b>HARGA SEWA / TAHUN </b></th>
                                    <th><b>DETAIL</b></th>
                                </tr>
                            </thead>
                            <tbody>

                                <tr v-for="(data, index) in dataBoqNya">
                                    <td>{{index+1}} </td>
                                    <td>{{data.batchnya}} </td>
                                    <td>{{data.projectid}} </td>
                                    <td>{{data.infratype}} </td> 
                                    <td>{{data.towernya}} </td> 
                                    <td>{{data.regional}} </td> 
                                    <td>{{data.site_id_actual}}</td> 
                                    <td>{{data.site_name_actual}} </td> 
                                    <td>{{data.address_actual}} </td> 
                                    <td>{{data.city}} </td> 
                                    <td>{{data.province}} </td> 
                                    <td>{{formatNumberRupiah(data.harga_bulan)}} </td> 
                                    <td>{{formatNumberRupiah(data.harga_tahun)}} </td> 
                                    <td><button type="button" class="btn btn-raised btn-danger" @click="viewEvent(data.id)"> <i class="ft-zoom-in"></i> Detail</button></td> 
                                </tr>
                                 

                                <tr>
                                    <td> </td>
                                    <td> </td>
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td> </td> 
                                    <td><b>TOTAL</b> </td> 
                                    <td><b>{{formatNumberRupiah(total(this.dataBoqNya))}}</b> </td><td> </td> 
                                </tr>


                            </tbody>
                        </table>


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

                   <div class="form-group">
  <label for="message">Pesan:</label>
{{this.rowDatanya.project.message}}
  
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
  isLoading: false,
  modal:new CrudModal({komunikasiproject: false,approve: false}),
    formErrors:{},
     project_id_accrual:'',
     message:'',
     status:'',
     batch_accrue:'',
	kata:'', 
	GetLevel:'', 
	statusmessage:'',
	forms: new CrudForm({id:'' , project_id:'' , document_sis:'' , created_at:''}), 
    errors: new Errors() ,
    errorNya: [],
    komunikasi:[] ,
    dataBoqNya:[] ,
    dataNya: {name : '', level:''}, 
    loading: false,
      moreParams: {}
    }
  },
 watch: {
        },
        methods: {

                  total: function(data){

  let total = [];

  Object.entries(data).forEach(([key, val]) => {
      total.push(val.rfi_detail_price_year) // the value of the current key.
  });

  return total.reduce(function(total, num){ return total + num }, 0);

},
    formatNumberRupiah (value) {
      return accounting.formatMoney(value,  "Rp. ", 0, ".", ",")
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
viewEvent: function(id) {
let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(id) }});
window.open(routeData.href, '_blank');
},
               dataAction () {
      if(this.typenya === "approval-document-cme")
      {
            this.GetDetailData(this.rowDatanya.project.project_id);
            //console.log(this.rowDatanya.project.project_id);
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
      },
              GetDetailData(id){
                axios.get('/karyawan/GetDetailProjectCME/'+id).then((response) => {
                    this.dataBoqNya = response.data;
                });
            },
                  ApproveItem(){
this.statusmessage = '';
this.status = '';
this.kata = '';                    
this.project_id_accrual = '';                    
this.batch_accrue = '';                    
this.statusmessage = 'APPROVED DOKUMEN CME';
this.status = 47;
this.statuscme = 2;
this.batch_accrue = new Date();
this.project_id_accrual = this.rowDatanya.project.project_id;
this.kata = 'Dokumen CME Project ID '+this.rowDatanya.project.cme_code+' Di Setujui';
this.errorNya = '';
this.message = '';
this.modal.set('approve', true); 
               
            }  ,
                  RepairItem(){
this.statusmessage = '';
this.status = '';
this.kata = '';
this.project_id_accrual = '';
this.batch_accrue = '';
this.statusmessage = 'REVISI DOKUMEN CME';
this.status = 46;
this.statuscme = 3;
this.project_id_accrual = null;
this.batch_accrue = null;
this.kata = 'Harap Perbaiki Dokumen CME '+this.rowDatanya.project.cme_code;
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
			  this.$router.push('/approval-cme');
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
    var ttl = this.dataBoqNya;
var masuk = {'project_id': this.rowDatanya.project.id,'kata': this.kata, 'message': this.message,'statusmessage': this.statusmessage,'document': 'DOKUMEN CME','detailproject': ttl,'statuscme': this.statuscme, 'project_id_accrual':this.project_id_accrual, 'batch_accrue':this.batch_accrue , 'status': this.status};
 


                axios.post('/karyawan/ApprovalDocumentCMEManagerHaki', masuk)
                    .then(response => { 
                      if(response.data.success)
                      {
                 this.success(response.data.success);
                 this.isLoading = false;
                 this.backLink();
                      }
                      else
                      {
                        this.isLoading = false;
                        this.errorNya = response.data.error;
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