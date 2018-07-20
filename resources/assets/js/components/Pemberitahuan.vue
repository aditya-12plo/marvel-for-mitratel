<template>
 <div> 
    <section class="content-header">
 <vue-toast ref='toast'></vue-toast>
      <h1 align="center">
       Pemberitahuan Masuk
      </h1>
    </section>

<div class="container-fluid display-page" id="display-post-category" >
 
<!-- @view --->
        <modal  v-if="modal.get('view')" @close="modal.set('view', false)"  >
        <template slot="header"><h4>BILL OF QUANTITY ACTUAL</h4></template>
        <div v-show="loading"><i class="fa fa-spinner fa-spin"></i> Loading Data</div>
        <template slot="body" >
        <form method="POST" enctype="multipart/form-data">
                <div class="modal-body">
<!-- for header  -->            
                    <div class="form-group">
                    <div class="table-responsive">
  <table class="table">
      <tr>
        <td><h5 align="left"><b>Project Deskripsi</b></h5></td>
        <td colspan="5"><h5 align="left"><b>{{PesanData.projectdescription }}</b></h5></td>
      </tr>
      <tr>
        <td><h5 align="left"><b>Project ID</b></h5></td>
        <td colspan="5"><h5 align="left"><b>{{PesanData.projectid}}</b></h5></td>
      </tr>  
	  <tr>
        <td><h5 align="left"><b>Tenant</b></h5></td>
        <td colspan="5"><h5 align="left"><b>{{PesanData.name}}</b></h5></td>
      </tr>
      <tr>
        <td><h5 align="left"><b>Nama Lokasi</b></h5></td>
        <td colspan="5"><h5 align="left"><b>{{PesanData.sitename}}</b></h5></td>
      </tr>
      <tr>
        <td><h5 align="left"><b>Daerah</b></h5></td>
        <td colspan="5"><h5 align="left"><b>{{PesanData.regional}}</b></h5></td>
      </tr>
      <tr>
        <td><h5 align="left"><b>Tinggi Tower</b></h5></td>
        <td colspan="5"><h5 align="left"><b>{{PesanData.tower}} M</b></h5></td>
      </tr>
      <tr>
        <td><h5 align="left"><b>Nilai Project</b></h5></td>
        <td colspan="5"><h5 align="left"><b>{{formatNumberRupiah(formatNumber(PesanData.projectprice))}}</b></h5></td>
      </tr>
      <tr>
        <td><h5 align="left"><b>File Download</b></h5></td>
        <td colspan="5"><div class="form-group"><div v-if="PesanData.filename"><a v-bind:href="url+PesanData.filename" target="_blank"> download </a></div>
                    </div></td>
      </tr>
      <tr v-if="PesanData.status_id > 0">
        <td><h5 align="left"><b>Komunikasi Project</b></h5></td>
        <td colspan="5"><button type="submit" class="btn btn-default" @click.prevent="CheckMessage()">Lihat Pesan</button></td>
      </tr>
      <tr>
        <td colspan="6"> <div style="height: 50px; overflow:hidden;">
    
  </div></td>
      </tr>
       
      <tr>
        <td colspan="6"> <div style="height: 50px; overflow:hidden;">
   
  </div></td>
      </tr>
      <tr>
        <td colspan="6"><h4 align="center"><b>IMPLEMENTASI PEKERJAAN STANDART</b></h4></td>
      </tr>
      <tr>
	  
        <td><center><b>ITEM PEKERJAAN</b></center></td>
        <td><center><b>SAT</b></center></td>
        <td><center<b>VOLUME</b></center></td>
        <td><center><b>HARGA SATUAN</b></center></td>
        <td><center><b>HARGA TOTAL</b></center></td>
		<td align="center"></td>
      </tr>
       <tr v-for="item of this.standart">
		<td>{{item.workitem}}</td>
        <td><center>{{item.unit}}</center></td>
        <td>{{item.volume}}</td>
        <td>{{formatNumberRupiah(item.unitprice)}}</td>
        <td>{{formatNumberRupiah(formatNumber(item.unitprice * item.volume))}}</td>
		<td align="center"></td>
       
      </tr>
	  <tr>
        <td colspan="5"><center><b>Total Biaya Pekerjaan Standart</b></center></td>
        <td><center><b>{{formatNumberRupiah(formatNumber(total(this.standart)))}}</b></center></td>
      </tr>
	  <tr>
        <td colspan="6"> <div style="height: 50px; overflow:hidden;">
    
  </div></td>
      </tr>
       
      <tr>
        <td colspan="6"> <div style="height: 50px; overflow:hidden;">
   
  </div></td>
      </tr>
	  <tr>
        <td align="center" colspan="6"><h4 align="center"><b>BIAYA IMPLEMENTASI TAMBAHAN</b></h4></td>
      </tr>
	  
		<tr>
        <td align="center" colspan="6"><button class="button btn-primary" @click="addRow">+ Biaya</button></td>
      </tr>
	  <tr>
         <td><center><b>ITEM PEKERJAAN</b></center></td>
        <td><center><b>SAT</b></center></td>
        <td><center<b>VOLUME</b></center></td>
        <td><center><b>HARGA SATUAN</b></center></td>
        <td><center><b>HARGA TOTAL</b></center></td>
		<td align="center"></td>
      </tr>
	  <tr v-for="(row,index) in this.tambahan">
        <td><input type="text" v-model="row.workitem" class="form-control" required></td>
      <td><input type="text" v-model="row.unit"  maxlength="10" class="form-control" required></td>
      <td><input v-on:keypress="isNumber()"  maxlength="4" v-model="row.volume" class="form-control" required></td>
      <td><input v-on:keypress="isNumber()"  maxlength="13" v-model="row.unitprice" class="form-control" required></td>
      <td>{{formatNumberRupiah(formatNumber(row.volume * row.unitprice))}}</td>
      <td><button class="button btn-danger" @click="removeRow(index)">Hapus</button></td>
    </tr>
	<tr>
        <td align="center" colspan="5">Total Biaya Pekerjaan Tambahan</td>
        <td><center><b>{{formatNumberRupiah(formatNumber(total(this.tambahan)))}}</b></center></td>
      </tr>
	  <tr>
        <td colspan="6"> <div style="height: 50px; overflow:hidden;">
    
  </div></td>
      </tr>
       
      <tr>
        <td colspan="6"> <div style="height: 50px; overflow:hidden;">
   
  </div></td>
      </tr>
	  <tr>
        <td align="center" colspan="6"><h4 align="center"><b>PENGURANGAN BIAYA IMPLEMENTASI</b></h4></td>
      </tr>
	  
		<tr>
        <td align="center" colspan="6"><button class="button btn-primary" @click="addRowMin">+ Biaya</button></td>
      </tr>
	  <tr>
        <td><center><b>ITEM PEKERJAAN</b></center></td>
        <td><center><b>SAT</b></center></td>
        <td><center<b>VOLUME</b></center></td>
        <td><center><b>HARGA SATUAN</b></center></td>
        <td><center><b>HARGA TOTAL</b></center></td>
		<td align="center"></td>
      </tr>
	  <tr v-for="(row,index) in pengurangan">
        <td><input type="text" v-model="row.workitem" class="form-control" required></td>
      <td><input type="text" v-model="row.unit"  maxlength="10" class="form-control" required></td>
      <td><input v-on:keypress="isNumber()"  maxlength="4" v-model="row.volume" class="form-control" required></td>
      <td><input v-on:keypress="isNumber()"  maxlength="13" v-model="row.unitprice" class="form-control" required></td>
      <td>{{formatNumberRupiah(formatNumber(row.volume * row.unitprice))}}</td>
      <td><button class="button btn-danger" @click="removeRowMin(index)">Hapus</button></td>
    </tr>
    <tr>
        <td align="center" colspan="5">Total Pengurangan Biaya Pekerjaan</td>
        <td><center><b>{{formatNumberRupiah(formatNumber(total(pengurangan)))}}</b></center></td>
      </tr>
	  <tr>
        <td colspan="6"> <div style="height: 50px; overflow:hidden;">
    
  </div></td>
      </tr>
       
      <tr>
        <td colspan="6"> <div style="height: 50px; overflow:hidden;">
   
  </div></td>
      </tr>
    <tr>
        <td align="center" colspan="5"><h4>Grand Total Biaya Pekerjaan</h4></td>
        <td><center><b>{{formatNumberRupiah(formatNumber((total(this.standart) + total(this.tambahan)) - total(this.pengurangan)))}}</b></center></td>
      </tr>
  </table>
</div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('view', false)" >Close</button>
					<a v-bind:href="urlDetail+PesanData.id" target="_blank"><button type="button" class="btn btn-success">Download Excel</button></a>
                    <button type="button" class="btn btn-primary" @click.prevent="ApproveData()">Approve</button>
                     <button type="submit" class="btn btn-warning" @click.prevent="RepairItem()">Repair</button>
                     <button type="submit" class="btn btn-danger" @click.prevent="RejectItem()">Reject</button>
                </div>
                </form>
        </template>
        </modal>

		
		
<!-- @approve --->
        <modal  v-if="modal.get('approve')" @close="modal.set('approve', false)">
        <template slot="header" ><h4>Alasan Approve Project</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="ApproveItem()">
                <div class="modal-body">

				
                    <!-- form Group -->
                    <div class="form-group" v-for="(row,index) in this.pesannya">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Jabatan : {{row.level}}</label><br>
                        <label for="stts">Status Project : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
				
                   <div class="form-group">
  <label for="message">Pesan:</label>
  <textarea v-model="message" class="form-control" rows="5" id="message" placeholder="Pesan" required></textarea>
<span class="label label-danger" v-for="error of errorNya['message']">
                        {{ error }}
                    </span>
  </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('approve', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </template>
        </modal>

		
		
<!-- @reject --->
        <modal  v-if="modal.get('reject')" @close="modal.set('reject', false)">
        <template slot="header" ><h4>Alasan Reject Project</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="updateItem()">
                <div class="modal-body">

				
                    <!-- form Group -->
                    <div class="form-group" v-for="(row,index) in this.pesannya">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Jabatan : {{row.level}}</label><br>
                        <label for="stts">Status Project : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
				
                   <div class="form-group">
  <label for="message">Pesan:</label>
  <textarea v-model="message" class="form-control" rows="5" id="message" placeholder="Pesan" required></textarea>
<span class="label label-danger" v-for="error of errorNya['message']">
                        {{ error }}
                    </span>
  </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('reject', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </template>
        </modal>

		
<!-- @repair --->
        <modal  v-if="modal.get('repair')" @close="modal.set('repair', false)">
        <template slot="header" ><h4>Alasan Repair Project</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="perbaikanItem()">
                <div class="modal-body">

				
                    <!-- form Group -->
                    <div class="form-group" v-for="(row,index) in this.pesannya">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Jabatan : {{row.level}}</label><br>
                        <label for="stts">Status Project : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>
				
                   <div class="form-group">
  <label for="message">Pesan:</label>
  <textarea v-model="message" class="form-control" rows="5" id="message" placeholder="Pesan" required></textarea>
<span class="label label-danger" v-for="error of errorNya['message']">
                        {{ error }}
                    </span>
  </div>



                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('repair', false)" >Close</button>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </div>
            </form>
        </template>
        </modal>

		
			
		
<!-- @message --->
        <modal  v-if="modal.get('message')" @close="modal.set('message', false)"  >
        <template slot="header" ><h4>Detail Pesan Project</h4></template>
		<div v-show="loading"><i class="fa fa-spinner fa-spin"></i> Loading Data</div>
        <template slot="body" >
                <div class="modal-body">

				
                    <!-- form Group -->
                    <div class="form-group" v-for="(row,index) in this.pesannya">
                        <label for="pengirim">Pengirim : {{row.name}}</label><br>
                        <label for="jabatan">Jabatan : {{row.level}}</label><br>
                        <label for="stts">Status Project : {{row.status}}</label><br>
                        <label for="pesan">Pesan : {{row.message}}</label><br>
                        <label for="time">Waktu : {{row.created_at}}</label><br>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('message', false)" >Close</button>
					
                </div>
				</form>
        </template>
        </modal>

		

</div>


   <section class="content">
      <div class="row">
      <div class="col-md-12">

<div class="filter-bar">

<div class="dropdown form-inline pull-right">
                <label>Per Page:</label>

                <select class="form-control" v-model="perPage">
                    <option :value=10>10</option>
                    <option :value=25>25</option>
                    <option :value=50>50</option>
                    <option :value=75>75</option>
                    <option :value=100>100</option>
                </select>
            </div>
             <form class="form-inline">
<div style="overflow-x:auto;">
  <table>
      <tr>
      <td><label>Date From :</label></td>
      <td><date-picker :date="startTime" :option="option" @keyup.enter="doFilter"></date-picker></td>
      <td><label>&nbsp;&nbsp;Date To :</label></td>
      <td><date-picker :date="endtime" :option="option" @keyup.enter="doFilter"></date-picker></td>
    </tr>
    <tr>
      <td colspan="4" style="padding-top: 1%;"></td>
    </tr>
    <tr>
      <td><label>Search for:</label></td>
      <td colspan="3"><input type="text" v-model="filterText" class="form-control" @keyup.enter="doFilter" placeholder="Project ID / Site Name"></td>
    </tr>
     <tr>
      <td colspan="4" style="padding-top: 2%;"></td>
    </tr>
    <tr>
      <td colspan="4"><button class="btn btn-success" @click.prevent="doFilter">Go</button>
          <button class="btn" @click.prevent="resetFilter">Reset</button></td>
    </tr>
         
</table>
 </div>
       </form>
       
    




    </div>
    <br>
    <div style="overflow-x:auto;">
  <div v-show="loading"><i class="fa fa-spinner fa-spin"></i> Loading Data</div>
    <vuetable ref="vuetable"
      api-url="/karyawan/GetPemberitahuanMasuk"
      :fields="fields"
      pagination-path=""
      :selected-to="selectedRow"
      :per-page="perPage"
      track-by="id"
      :css="css.table"
      :multi-sort="true"
      :append-params="moreParams"
      @vuetable:cell-clicked="onCellClicked"
      @vuetable:pagination-data="onPaginationData"
    @vuetable:loading="onLoading"        
    @vuetable:load-error="onLoadingError"        
    @vuetable:load-success="onLoaded"
    ></vuetable>
    <div class="vuetable-pagination">
      <vuetable-pagination-info ref="paginationInfo"
        info-class="pagination-info"
      ></vuetable-pagination-info>
      <vuetable-pagination ref="pagination"
        :css="css.pagination"
        @vuetable-pagination:change-page="onChangePage"
      ></vuetable-pagination>
    </div>
    </div>


      </div>
      </div>
      </section>
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
        /* ------------------------------------------------------------------------------------- CRUD FORM
         ---------------------------------------------------------------------------------------------------- */
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
        // -----------------------------------------------------------------------------------------------  COMPONENT MODAL
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
    
    
    
Vue.component('project-button-actions', require('./ProjectCustomActions.vue'))
Vue.component('DynamicForm', require('./DynamicForm.vue'))
import accounting from 'accounting'
import moment from 'moment'
import '!!vue-style-loader!css-loader!vue-toast/dist/vue-toast.min.css'
import VueToast from 'vue-toast'
import myDatepicker from 'vue-datepicker'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import VueEvents from 'vue-events'
import SimpleVueValidation from 'simple-vue-validator'
var Validator = SimpleVueValidation.Validator
Vue.use(SimpleVueValidation);
Vue.use(VueEvents)
window.axios = require('axios')
window.eventBus = new Vue()
 Vue.component('modal', Modal)
export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
     'vue-toast': VueToast,
     'date-picker': myDatepicker,
  },
  data () {
    return {
	
    selectedRow: [],
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
    PesanData:[],
	message: '',
    errors: new Errors() ,
    file_name:'',
	pesannya:[],
    modal:new CrudModal({view:false, reject:false, approve:false,  repair:false, message:false}),
     berhasilNya: [],
     errorNya: [],
     workitem:[],
     url:'/files/',
     urlDetail:'/karyawan/downloadExcel/',
     unit:[],
     volume:[],
     unitprice:[],
     tambahan: [],
     pengurangan: [],
     standart: [],
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[],
    displayItems:[] ,
    perPage: 10,
    loading: false,
    loading2: false,
      fields: [
      {
          name: '__sequence',
          title: 'No',
          titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'name',
      title: 'Tenant',
      titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: 'projectid',
      title: 'Project ID',
      titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: 'sitename',
      title: 'Project Site Name',
      titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: 'tower',
      title: 'Tower',
      titleClass: 'text-center',
          dataClass: 'text-center',
          callback: 'formatTower'
        },
        {
          name: 'projectprice',
      title: 'Nilai Project',
      titleClass: 'text-center',
          dataClass: 'text-center',
          callback: 'formatNumberRupiah'
        },
        {
          name: 'created_at',
          title: 'Tanggal Input Project',
          titleClass: 'text-center',
          dataClass: 'text-center',
		  callback: 'formatDate|DD-MM-YYYY'
        },
        {
          name: '__component:project-button-actions',
          title: 'Actions',
          titleClass: 'text-center',
          dataClass: 'text-center'
        }
      ],
      filterText: '', 
      css: {
        table: {
          tableClass: 'table table-bordered table-striped table-hover',
          ascendingIcon: 'glyphicon glyphicon-chevron-up',
          descendingIcon: 'glyphicon glyphicon-chevron-down'
        },
        pagination: {
          wrapperClass: 'pagination',
          activeClass: 'active',
          disabledClass: 'disabled',
          pageClass: 'page',
          linkClass: 'link',
          icons: {
            first: '',
            prev: '',
            next: '',
            last: '',
          },
        },
        icons: {
          first: 'glyphicon glyphicon-step-backward',
          prev: 'glyphicon glyphicon-chevron-left',
          next: 'glyphicon glyphicon-chevron-right',
          last: 'glyphicon glyphicon-step-forward',
        },
      },
      moreParams: {}
    }
  },
          watch: {
            'perPage'(newValue, oldValue) {
               this.$events.fire('filter-set', this.filterText)
            },
            'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {
     isNumber: function(evt) {
      evt = (evt) ? evt : window.event;
      var charCode = (evt.which) ? evt.which : evt.keyCode;
      if ((charCode > 31 && (charCode < 48 || charCode > 57)) && charCode !== 46) {
        evt.preventDefault();;
      } else {
        return true;
      }
    },
   newAvatar(event) {
               let files = event.target.files || e.dataTransfer.files;
               if (files.length) this.file_name = files[0];
                
           },
  addRow: function(){
      this.tambahan.push({workitem:"",unit:"",volume:"",unitprice:""});
    },
  addRowMin: function(){
      this.pengurangan.push({workitem:"",unit:"",volume:"",unitprice:""});
    },
    removeRow: function(row){
    //console.log(row);
    this.tambahan.splice(row,1)
    },
    removeRowMin: function(row){
    //console.log(row);
    this.pengurangan.splice(row,1)
    },
  total: function(data){

  let total = [];

  Object.entries(data).forEach(([key, val]) => {
      total.push(val.volume * val.unitprice) // the value of the current key.
  });

  return total.reduce(function(total, num){ return total + num }, 0);

},
   CheckMessage() {
			axios.get('/karyawan/GetMessageNya/'+this.PesanData.id).then((response) => {
                this.pesannya=response.data;
                this.modal.set('message', true);
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.$router.push('/server-error');
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                         this.$router.push('/page-not-found');
					}
					}
                    }); 	
            },

   updateItem() {
 var masuk ={projectid:this.PesanData.id,tenantid:this.PesanData.tenantscode,message:this.message};

              axios.post('/karyawan/RejectProject', masuk)
                    .then(response => {
if(response.data.success)
{
                  this.errorNya = '';
                  this.message = '';
                this.resetFilter();
                 this.modal.set('view', false);
                 this.modal.set('reject', false);
                 this.submitted = this.showTime('success',response.data.success);
}
                    })
                    .catch(error => {
                        this.errorNya = error.response.data;
                    });  


            },
   perbaikanItem() {
 var masuk ={projectid:this.PesanData.id,tenantid:this.PesanData.tenantscode,message:this.message,standart:this.standart,addtional:this.tambahan,reduction:this.pengurangan,statusnya:'REPAIR AREA - APPROVAL 1'};

              axios.post('/karyawan/RepairProject', masuk)
                    .then(response => {
if(response.data.success)
{
                  this.errorNya = '';
                  this.message = '';
                  this.pengurangan = [];
                  this.tambahan = [];
                  this.standart = [];
                this.resetFilter();
                 this.modal.set('view', false);
                 this.modal.set('repair', false);
                 this.submitted = this.showTime('success',response.data.success);
}
                    })
                    .catch(error => {
                        this.errorNya = error.response.data;
                    });  


            },
  RepairItem(){
			axios.get('/karyawan/GetMessageNya/'+this.PesanData.id).then((response) => {
                this.pesannya=response.data;
				 this.message = '';
                 this.modal.set('repair', true); 
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.$router.push('/server-error');
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                         this.$router.push('/page-not-found');
					}
					}
                    }); 	
               
               
            }  ,
  ApproveData(){
			axios.get('/karyawan/GetMessageNya/'+this.PesanData.id).then((response) => {
                this.pesannya=response.data;
				 this.message = '';
                 this.modal.set('approve', true); 
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.$router.push('/server-error');
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                         this.$router.push('/page-not-found');
					}
					}
                    }); 	
               
               
            }  ,
   ApproveItem() {
 var masuk ={projectid:this.PesanData.id,tenantid:this.PesanData.tenantscode,message:this.message,standart:this.standart,addtional:this.tambahan,reduction:this.pengurangan};

              axios.post('/karyawan/AreaApproval2Project', masuk)
                    .then(response => {
if(response.data.success)
{
                  this.errorNya = '';
				   this.message = '';
				   this.standart = [];
				   this.tambahan = [];
				   this.pengurangan = [];
                this.resetFilter();
                 this.modal.set('approve', false);
                 this.modal.set('view', false);
                 this.submitted = this.showTime('success',response.data.success);
}
                    })
                    .catch(error => {
                        this.errorNya = error.response.data;
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
            viewItem(item ,index = this.indexOf(item)){

 axios.get('/karyawan/GetProjectDetailProses/'+ item.id).then((response) => {

                   this.errorNya = '';
                   this.PesanData= response.data.header;
                   this.standart=response.data.standart;
                   this.tambahan=response.data.additional;
                   this.pengurangan=response.data.reduction;
                this.modal.set('view', true); 
                }).catch(error => {
        if (! _.isEmpty(error.response)) {
                    if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
          }
                    });
               
            }  ,
            RejectItem(){
			axios.get('/karyawan/GetMessageNya/'+this.PesanData.id).then((response) => {
                this.pesannya=response.data;
				 this.message = '';
                 this.modal.set('reject', true); 
                }).catch(error => {
				if (! _.isEmpty(error.response)) {
                    if (error.response.status = 422) {
                       this.$router.push('/server-error');
                    }
                   else if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
					else
					{
                         this.$router.push('/page-not-found');
					}
					}
                    }); 	
               
               
            }  ,
        doFilter () {
    if(!this.startTime.time && !this.endtime.time)
    {
    this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
    }
    else if(this.startTime.time && !this.endtime.time)
    {
    this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
    }
    else if(!this.startTime.time && this.endtime.time)
    {
    this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
    }
    else if(this.startTime.time && this.endtime.time)
    { 
    if(this.endtime.time < this.startTime.time)
    {
    alert('Input Date Wrong');
    }
    else
    {
    this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
    }
    }
    else
    {
    this.$events.fire('filter-set', this.filterText, this.startTime.time, this.endtime.time )
    }
      },
      resetFilter () {
        this.filterText = ''
         this.startTime.time = ''
        this.endtime.time = ''
        this.$events.fire('filter-reset')
      },
    allcap (value) {
      return value.toUpperCase()
    },
    formatNumber (value) {
      return accounting.toFixed(value, 0)
    },
    formatNumberRupiah (value) {
      return accounting.formatMoney(value,  "Rp. ", 2, ".", ",")
    },
    formatTower (value) {
      return accounting.formatMoney(value,  {
  symbol: " M",precision: 0,format: "%v %s"})
    },
    formatDate (value, fmt = 'D MMM YYYY') {
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
      //console.log('cellClicked: ', field.title)
      this.$refs.vuetable.toggleDetailRow(data.id)
    },       
onLoading() {
     this.loading = true;
    },
    onLoaded() {
      this.loading = false;
    },
    onLoadingError() {
                this.loading = true;
                axios.get('/karyawan/GetPemberitahuanMasuk').then((response) => {
                    this.loading = false
                }).catch(error => {
        if (! _.isEmpty(error.response)) {
                    if (error.response.status = 500) {
                        this.$router.push('/server-error');
                    }
          else
          {
                        this.loading = false;
          }
          }
                    });
    },      
  },
  validators: {
       workitem: function(value) {
        return Validator.value(value).required();
      },
      unit: function(value) {
        return Validator.value(value).required();
      },
      volume: function(value) {
        return Validator.value(value).required().digit();
      },
      unitprice: function(value) {
        return Validator.value(value).required().digit();
      },
    },
  events: {
    'filter-set' (filterText,startTime,endtime) {
      this.moreParams = {
        filter: filterText,min: startTime, max: endtime
      }
      Vue.nextTick(() => this.$refs.vuetable.refresh() )
    },
    'filter-reset' () {
      this.moreParams = {}
      Vue.nextTick(() => this.$refs.vuetable.refresh() )
    }
  },
 created: function() {
  let self = this;
            this.$root.$on('viewitem', function(data,index){
                //console.log(data);
               self.viewItem(data,index);
            });
        },
              mounted() {
            //console.log(this.token);
             this.resetOptions();

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