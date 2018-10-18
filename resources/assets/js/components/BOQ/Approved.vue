<template>
 <div> 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>

      
      <div class="card-header-banner"> </div>


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
    modal:new CrudModal({approve: false}),
      forms: new CrudForm({id:'' , title:'' , nama_telkomsel:'' , posisi_telkomsel:'' , nama_manager:'' , posisi_manager:'',boq_code:'' , nama_user:this.rowDatanya.datanya.name , posisi_user:'', message:'', created_at:''}), 
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
 this.$router.push('/approval-boq');
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
this.statusmessage = '';
this.status = '';
this.statusboq = '';
this.kata = '';                    
this.statusmessage = 'APPROVED BOQ';
this.status = 17;
this.statusboq = 2;
this.kata = 'Dokumen BOQ Nomor '+this.rowDatanya.project.boq_code+' Di Setujui';
this.errorNya = '';
this.message = '';
this.modal.set('approve', true); 
               
            }  ,
                  RepairItem(){
this.statusmessage = '';
this.status = '';
this.statusboq = '';
this.kata = '';
this.statusmessage = 'REVISI BOQ';
this.statusboq = 1;
this.status = 16;
this.kata = 'Harap Perbaiki BOQ Nomor '+this.rowDatanya.project.boq_code;
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
      if(this.typenya === "approval-boq")
      {
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
var masuk = {'id' : this.rowDatanya.project.id,'title' : this.rowDatanya.project.title,'nodoc':this.rowDatanya.project.boq_code,'area':this.rowDatanya.project.area,'area2':this.rowDatanya.project.area2,'boq_code' :  this.rowDatanya.project.id,'area':this.rowDatanya.project.area,'area2':this.rowDatanya.project.area2,'project_id' : jointtl,'statusboq':this.statusboq,'status':this.status,'detailproject':this.dataBoqNya,'document':'BOQ SUBMIT','statusmessage': this.statusmessage,'kata': this.kata,'message': this.message};

 axios.post('/karyawan/SubmitBOQApproval', masuk)
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