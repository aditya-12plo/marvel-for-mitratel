<template>
 <div> 
    <section class="content-header">
        <div class="alert alert-success" v-if="submitted" role="alert">
               Success
            </div>
      <h1 align="center">
       Administrator List
      </h1>
    </section>

<div class="container-fluid display-page" id="display-post-category" >
 <!-- @create Modal--->
        <modal  v-if="modal.get('create')" @close="modal.set('create', false)" >
        <template slot="header" ><h4>Create New Administrator Account</h4></template>
        <template slot="body" >
            <form method="POST" action="" @submit.prevent="submitBooks()">
                <div class="modal-body">
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control border-input" placeholder="Name" v-model="forms.name"  type="text" required>
                        <span class="label label-danger" v-for="error of errorNya['name']">
                        {{ error }}
                    </span>
                    </div>

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control border-input" placeholder="Email" v-model="forms.email"  type="email" required>
                        <span class="label label-danger" v-for="error of errorNya['email']">
                        {{ error }}
                    </span>
                    </div>

					
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="suspend">Account Suspend</label>
                        <select class="form-control border-input" v-model="forms.suspend" required >
						<option value="">Choose One</option>
						<option v-for="pilih in pilihan" :value="pilih">{{ pilih }}</option>
						</select>
                         <span class="label label-danger" v-for="error of errorNya['suspend']">
                        {{ error }}
                    </span>
                    </div>
						
                    <!-- form Group -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control border-input" placeholder="Password" v-model="forms.password"  type="text" required>
                        <span class="label label-danger" v-for="error of errorNya['password']">
                        {{ error }}
                    </span>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('create', false)" >Close</button>
                    <button type="submit" class="btn btn-success">Create</button>
                </div>

            </form>
        </template>
        </modal>


<!-- @view --->
        <modal  v-if="modal.get('view')" @close="modal.set('view', false)"  >
        <template slot="header" ><h4>View Administrator Account</h4></template>
        <template slot="body" >
                <div class="modal-body">

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="name">Name :  {{forms.name}}</label>
                      
                    </div>

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="email">Email :  {{forms.email}}</label>
                        
                    </div>

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="suspend">Account Suspend :  {{forms.suspend}}</label>
                        
                    </div>


                    <!-- form Group -->
                    <div class="form-group">
                        <label for="created_at">Created At :  {{forms.created_at}}</label>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('view', false)" >Close</button>
                </div>
        </template>
        </modal>


<!-- @update --->
        <modal  v-if="modal.get('edit')" @close="modal.set('edit', false)"  >
        <template slot="header" ><h4>Edit Administrator Account</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="updateItem()">
                <div class="modal-body">

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input class="form-control border-input" placeholder="Name" v-model="forms.name"  type="text" required>
                        <span class="label label-danger" v-for="error of errorNya['name']">
                        {{ error }}
                    </span>
                    </div>

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input class="form-control border-input" placeholder="Email" v-model="forms.email"  type="email" required>
                        <span class="label label-danger" v-for="error of errorNya['email']">
                        {{ error }}
                    </span>
                    </div>


                    <!-- form Group -->
                    <div class="form-group">
                        <label for="suspend">Account Suspend</label>
                        <select class="form-control border-input" v-model="forms.suspend" required >
						<option value="">Choose One</option>
						<option v-for="pilih in pilihan"
        :selected="pilih == forms.suspend ? 'selected' : ''"
        :value="pilih">
       {{ pilih }}
    </option>
						</select>
                         <span class="label label-danger" v-for="error of errorNya['suspend']">
                        {{ error }}
                    </span>
                    </div>

                    <!-- form Group -->
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input class="form-control border-input" placeholder="Password" v-model="forms.password"  type="text">
                        <span class="label label-danger" v-for="error of errorNya['password']">
                        {{ error }}
                    </span>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('edit', false)" >Close</button>
                    <button type="submit" class="btn btn-success">Edit</button>
                </div>
            </form>
        </template>
        </modal>


 <!-- @delete --->
        <modal v-if="modal.get('delete')" @close="modal.set('delete', false)"  >
        <template slot="header" ><h4>Delete Administrator Account</h4></template>
        <template slot="body" >

            <form method="POST" action="" @submit.prevent="destroyItem( submitSelectedItems )">
                <div class="modal-body">
                    <p>Are you Sure that you want to delete this  ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" @click="modal.set('delete', false)" >Close</button>
                    <button type="submit" class="btn btn-success">Delete</button>
                </div>
            </form>
        </template>
        </modal>
</div>


   <section class="content">
      <div class="row">
      <div class="col-md-12">

        <button type="button" class="btn btn-primary"  @click="createItem()">
            <i class="glyphicon glyphicon-plus"></i>
            Create New Administrator
        </button>
<br>
<br>

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
      <td><label>Search for:</label></td>
      <td colspan="3"><input type="text" v-model="filterText" class="form-control" @keyup.enter="doFilter" placeholder="email or name"></td>
    </tr>
     <tr>
      <td colspan="4" style="padding-top: 1%;"></td>
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
      api-url="/kevler/listkevler"
      :fields="fields"
      pagination-path=""
      :per-page="perPage"
      :css="css.table"
      :sort-order="sortOrder"
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



import accounting from 'accounting'
import moment from 'moment'
import Vuetable from 'vuetable-2/src/components/Vuetable'
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination'
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo'
import Vue from 'vue'
import VueEvents from 'vue-events'
import BooksCustomActions from './BooksCustomActions'
Vue.use(VueEvents)
Vue.component('custom-actions', BooksCustomActions)
window.axios = require('axios')
window.eventBus = new Vue()
 Vue.component('modal', Modal)
export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
  },
  data () {
    return {
    formErrors:{},
	pilihan: ['TRUE','FALSE'],
    errors: new Errors() ,
    forms:new CrudForm({index:'',  id:'' , name:'' , email:'' , suspend:'' , created_at:''}) ,
    modal:new CrudModal({create:false , view:false  , edit:false , delete:false }),
     errorNya: [],
     token: localStorage.getItem('token'),
    submitted: false,
    submitSelectedItems:[] ,
    displayItems:[] ,
    perPage: 10,
    loading: false,
      fields: [
        {
          name: '__sequence',
          title: 'No',
          titleClass: 'text-center',
          dataClass: 'text-center'
        },
        
        {
          name: '__checkbox',
          titleClass: 'text-center',
          dataClass: 'text-center',
        },
        {
          name: 'name',
		  title: 'Name',
          sortField: 'name',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'email',
		  title: 'Email',
          sortField: 'email',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'suspend',
		  title: 'Account Suspend',
          sortField: 'suspend',
		  titleClass: 'text-center',
          dataClass: 'text-center'
        },
        {
          name: 'created_at',
          sortField: 'created_at',
          titleClass: 'text-center',
          dataClass: 'text-center',
          callback: 'formatDate|DD-MM-YYYY'
        },
        {
          name: '__component:custom-actions',
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
      sortOrder: [
        { field: 'title', sortField: 'title', direction: 'asc'}
      ],
      moreParams: {}
    }
  },
          watch: {
            'perPage'(newValue, oldValue) {
               this.$events.fire('filter-set', this.filterText)
            },
        },
  methods: {
            deleteItem(item ,index = this.indexOf(item)){
               this.submitSelectedItems = item.id;
                this.modal.set('delete', true);
            }  ,
            editItem(item ,index = this.indexOf(item)){
                this.forms.setFillItem(item , index );
                this.modal.set('edit', true);
            }  ,
            viewItem(item ,index = this.indexOf(item)){
                this.forms.setFillItem(item , index );
                this.modal.set('view', true);
            }  ,
            createItem() {
                this.forms.reset();
                this.errors.clearAll();
                this.modal.set('create', true);
            } ,
        doFilter () {
        this.$events.fire('filter-set', this.filterText)
      },
      resetFilter () {
        this.filterText = ''
        this.$events.fire('filter-reset')
      },
    allcap (value) {
      return value.toUpperCase()
    },
    formatNumber (value) {
      return accounting.formatNumber(value, 2)
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
    submitBooks() {
            axios.post('/kevler/AddAdministrator', this.forms)
                    .then(response => {
                this.errorNya = '';
                this.submitted = true;
                this.resetFilter();
                 this.modal.set('create', false);
                    })
                    .catch(error => {
                        this.errorNya = error.response.data;
                    });
                
                    
            },

   updateItem() {
            axios.put('/kevler/UpdateAdministrator/'+ this.forms.id , this.forms)
                    .then(response => {
                this.errorNya = '';
                this.submitted = true;
                this.resetFilter();
                 this.modal.set('edit', false);

                    })
                    .catch(error => {
                        this.errorNya = error.response.data;
                    });
            },

            destroyItem(kode){
                axios.delete('/kevler/DeleteAdministrator/'+ kode)
                    .then(response => {
                this.errorNya = '';
                this.submitted = true;
                this.resetFilter();
                 this.modal.set('delete', false);

                    })
                    .catch(error => {
                        this.errorNya = error.response.data;
                    });
                   

            },
onLoading() {
     this.loading = true;
    },
    onLoaded() {
      this.loading = false;
    },
    onLoadingError() {
                this.loading = true;
                axios.get('/kevler/listkevler').then((response) => {
                    this.dataNya = response.data;
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
  events: {
    'filter-set' (filterText) {
      this.moreParams = {
        filter: filterText
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
            this.$root.$on('edititem', function(data,index){
               self.editItem(data,index);
            });
            this.$root.$on('deleteitem', function(data,index){
               self.deleteItem(data,index);
            });
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
.modal-container {
  width: 50%;
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
/*
 * The following styles are auto-applied to elements with
 * transition="modal" when their visibility is toggled
 * by Vue.js.
 *
 * You can easily play with the modal transition by editing
 * these styles.
 */
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