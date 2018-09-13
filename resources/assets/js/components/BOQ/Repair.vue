<template>
 <div> 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>
    <section class="content-header">

      <h1 align="center">
      Detail Project BOQ
      </h1>
    </section>


    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
<button type="button" class="btn btn-raised btn-warning" @click="backLink()"> <i class="ft-arrow-left position-left"></i> Kembali</button>  
<button type="button" class="btn btn-raised btn-primary" @click="ApproveItem()">
    <i class="fa fa-check-square-o"></i> Submit
</button>
</div>

<div class="card-body">


<div class="col-sm-12">

<div class="row">
  <div class="form-group col-md-12 mb-2">
<label for="title">TITLE</label>
<input type="text" @input="allcap($event, forms, 'title')" class="form-control" placeholder="TITLE" v-model="forms.title" required>
<div class="help-block">
  <ul role="alert"><li v-for="error of errorNya['title']"><span style="color:red;">{{ error }}</span></li></ul>
</div>
  </div>
                                 
</div>

<div class="row">
<div class="form-group col-md-6 mb-2">
<label for="nama_telkomsel">NAMA PIC TELKOMSEL</label>
<input type="text" @input="allcap($event, forms, 'nama_telkomsel')" class="form-control" placeholder="NAMA PIC TELKOMSEL" v-model="forms.nama_telkomsel" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['nama_telkomsel']"><span style="color:red;">{{ error }}</span></li></ul></div>
                              </div>

<div class="form-group col-md-6 mb-2">
<label for="posisi_telkomsel">POSISI PIC TELKOMSEL</label>
<input type="text" @input="allcap($event, forms, 'posisi_telkomsel')" class="form-control" placeholder="POSISI PIC TELKOMSEL" v-model="forms.posisi_telkomsel" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['posisi_telkomsel']"><span style="color:red;">{{ error }}</span></li></ul></div>
                              </div>

 </div>
 
<div class="row">
<div class="form-group col-md-6 mb-2">
<label for="nama_manager">NAMA MANAGER PT. MITRATEL</label>
<input type="text" @input="allcap($event, forms, 'nama_manager')" class="form-control" placeholder="NAMA MANAGER PT. MITRATEL" v-model="forms.nama_manager" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['nama_manager']"><span style="color:red;">{{ error }}</span></li></ul></div>
                              </div>

<div class="form-group col-md-6 mb-2">
<label for="posisi_manager">POSISI MANAGER PT. MITRATEL</label>
<input type="text" @input="allcap($event, forms, 'posisi_manager')" class="form-control" placeholder="POSISI MANAGER PT. MITRATEL" v-model="forms.posisi_manager" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['posisi_manager']"><span style="color:red;">{{ error }}</span></li></ul></div>
                              </div>

 </div>
 
 
 
<div class="row">
<div class="form-group col-md-6 mb-2">
<label for="nama_user">NAMA ACCOUNT MANAGER PT. MITRATEL</label>
<input type="text" @input="allcap($event, forms, 'nama_user')" class="form-control" placeholder="NAMA ACCOUNT MANAGER PT. MITRATEL" v-model="forms.nama_user" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['nama_user']"><span style="color:red;">{{ error }}</span></li></ul></div>
                              </div>

<div class="form-group col-md-6 mb-2">
<label for="posisi_user">POSISI ACCOUNT MANAGER PT. MITRATEL</label>
<input type="text" @input="allcap($event, forms, 'posisi_user')" class="form-control" placeholder="POSISI ACCOUNT MANAGER PT. MITRATEL" v-model="forms.posisi_user" required>
<div class="help-block"><ul role="alert"><li v-for="error of errorNya['posisi_user']"><span style="color:red;">{{ error }}</span></li></ul></div>
                              </div>

 </div> 


</div>


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
                                    <th><b>HARGA SEWA / BULAN </b></th>
                                    <th><b>HARGA SEWA / TAHUN </b></th>
                                    <th><b>ACTION</b></th>
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
                                    <td>{{formatNumberRupiah(data.harga_bulan)}} </td> 
                                    <td>{{formatNumberRupiah(data.harga_tahun)}} </td> 
                                    <td><button type="button" class="btn btn-raised btn-primary" @click="viewEvent(data.id)"> <i class="ft-zoom-in"></i> Detail</button><button type="button" class="btn btn-raised btn-danger" @click="deleteEvent(index,data)"> <i class="ft-trash-2"></i> Delete</button></td> 
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
                                    <td><b>TOTAL</b> </td> 
                                    <td><b>{{formatNumberRupiah(total(this.dataBoqNya))}}</b> </td><td> </td> 
                                </tr>


                            </tbody>
                        </table>


</div>
</div>
</div>
</div>




<!-- @approve -->
<modal  v-if="modal.get('approve')" @close="modal.set('approve', false)">
        <template slot="header" align="center"><h4 align="center">Kirim Pesan</h4></template>
        <template slot="body" >
        	<form method="POST" action="" @submit.prevent="submitData()">
                <div class="modal-body">

<div class="col-sm-12">
  <div class="row">
	<div class="form-group col-md-12 mb-2">
<label for="message">MESSAGE</label>
<textarea v-model="message" class="form-control" rows="5" id="message" placeholder="Pesan" required></textarea>
<div class="help-block">
	<ul role="alert"><li v-for="error of errorNya['message']"><span style="color:red;">{{ error }}</span></li></ul>
</div>
	</div>
                                 
</div>


</div>

                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-default" @click="modal.set('approve', false)" >Close</button>
                     <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
                </form>
        </template>
        </modal>
        
<!-- approve -->



    </div>
</template>

<script>
     /* ------------------------------------------------------------------------------------- ERRORS
         ---------------------------------------------------------------------------------------------------- */
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
import Hashids from 'hashids'
Vue.use(VueEvents)
Vue.component('view-custom-actions', require('../Button/ViewActions.vue'))
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
    startTime: {
        time: ''
      },
      endtime: {
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
    formErrors:{},
     message:'',
     status:'',
     statusboq:'',
	kata:'',  
	statusmessage:'',
    errors: new Errors() ,
     errorNya: [],
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[] ,
    komunikasi:[] ,
    dataBoqNya:[] ,
    dataBoqCancel:[] ,
    modal:new CrudModal({approve: false}),
      forms: new CrudForm({id:'' , title:'' , nama_telkomsel:'' , posisi_telkomsel:'' , nama_manager:'' , posisi_manager:'',boq_code:'' , nama_user:'' , posisi_user:'', message:'', created_at:''}), 
    displayItems:[] ,
     dataNya: {area:'' , level:'' , regional:''},
    perPage: 10,
    loading: false,    
    }
  },
          watch: {  
            'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {
 backLink() {
 this.$router.push('/boq-repair');
            } ,
 success(kata) {
      this.$swal({
  position: 'top-end',
  type: 'success',
  title: kata,
  showConfirmButton: false,
  timer: 1500
})
    },
      ApproveItem(){ 
this.errorNya = '';
this.message = '';
this.modal.set('approve', true); 
               
            }  , 

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
    deleteEvent: function(index,data) {
  this.dataBoqNya.splice(index, 1);
  this.dataBoqCancel.push(data); 
},
     newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
total: function(data){

  let total = [];

  Object.entries(data).forEach(([key, val]) => {
      total.push(val.harga_tahun) // the value of the current key.
  });

  return total.reduce(function(total, num){ return total + num }, 0);

},
viewEvent: function(id) {
let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(id) }});
window.open(routeData.href, '_blank');
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
dataAction () {
      if(this.typenya === "approval-boq-repair")
      {
            this.forms = this.rowDatanya.project;
            this.dataBoqCancel = [];
           this.GetDetailData(this.rowDatanya.project.project_id);
      }
      else
      {
      this.$router.push('/page-not-found');
      }
        
      },
 
        submitData(){
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
var jointtl = Array.prototype.map.call(this.dataBoqNya, function(item) { return item.id; }).join(",") ;
var jointtlcancel = Array.prototype.map.call(this.dataBoqCancel, function(item) { return item.id; }).join(",") ;
var masuk = {
  'id' : this.forms.id,
  'title' : this.forms.title,
  'nama_telkomsel' : this.forms.nama_telkomsel,
  'posisi_telkomsel' : this.forms.posisi_telkomsel,
  'nama_manager' : this.forms.nama_manager,
  'posisi_manager' : this.forms.posisi_manager,
  'nama_user' : this.forms.nama_user,
  'posisi_user' : this.forms.posisi_user,
  'boq_code' :  this.forms.boq_code,
  'project_id' : jointtl,
  'project_id_cancel' : jointtlcancel,
  'statusboq': 0,
  'status': 15,
  'detailproject':this.dataBoqNya,
  'document':'BOQ SUBMIT',
  'statusmessage': 'APPROVAL SUBMIT BOQ',
  'kata': 'Dokumen BOQ Nomor '+this.rowDatanya.project.boq_code+' Menunggu Approval Anda',
  'message': this.message
};
 axios.post('/karyawan/SubmitBOQApprovalRevisi', masuk)
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
        GetDetailData(id){
                axios.get('/karyawan/GetDetailProjectBOQ/'+id).then((response) => {
                    this.dataBoqNya = response.data;
                });
            },
  resetOptions() {
          this.$refs.toast.setOptions({
            delayOfJumps: this.delayOfJumps,
            maxToasts: this.maxToasts,
            position: this.position
          })
        },
        showTime(kode,pesan) {
          this.$refs.toast.showToast(pesan, {
            theme: kode,
            timeLife: 3000,
          })
        }, 
    allcap (e, o, prop) {
  const start = e.target.selectionStart;
    e.target.value = e.target.value.toUpperCase();
    this.$set(o, prop, e.target.value);
    e.target.setSelectionRange(start, start);
    },
    formatNumber (value) {
      return accounting.formatNumber(value, 2)
    },
	
	formatTower (value) {
      return accounting.formatMoney(value,  {
  symbol: " M",precision: 0,format: "%v %s"})
    },
	formatNumberRupiah (value) {
      return accounting.formatMoney(value,  "Rp. ", 0, ".", ",")
    },
    formatDate (value, fmt = 'D M YYYY') {
      return (value == null)
        ? ''
        : moment(value, 'YYYY-MM-DD').format(fmt)
    },
    onPaginationData (paginationData) {
      this.$refs.pagination.setPaginationData(paginationData)
      this.$refs.paginationInfo.setPaginationData(paginationData)
    },
    onChangePage (page) {
      this.$refs.vuetable.changePage(page)
    },
    onCellClicked (data, field, event) {
      this.$refs.vuetable.toggleDetailRow(data.id)
    },            

 		
  },
  events: { 
  }, 
		          mounted() {  
               this.dataAction();

        }

}
</script>
<style>
.pagination {
  margin: 0;
  float: right;
}
.pagination a.page {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.page.active {
  color: white;
  background-color: #337ab7;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 10px;
  margin-right: 2px;
}
.pagination a.btn-nav {
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
}
.pagination a.btn-nav.disabled {
  color: lightgray;
  border: 1px solid lightgray;
  border-radius: 3px;
  padding: 5px 7px;
  margin-right: 2px;
  cursor: not-allowed;
}
.pagination-info {
  float: left;
}
</style>   