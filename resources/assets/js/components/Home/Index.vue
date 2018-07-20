<template>
 <div> 
   <loading :show="isLoading"></loading>
   <vue-toast ref='toast'></vue-toast>




      <div class="card-header">
       <h1 style="padding-top: 1%;font-size: 40px;font-family:'arial';" align="center"><strong><font color="red">D</font><font color="green">R</font>.<font color="orange">MAR</font><font color="blue">V</font><font color="yellow">EL</font></strong></h1>

      <h3 style="padding-top: 1%;font-size: 30px;font-family:'arial';" align="center"><strong><font color="red">Dokumen </font> <font color="green">Review </font> <font color="orange">MARketing </font> <font color="blue">Validation </font> <font color="yellow">ELectronik</font></strong></h3>

      </div>
   
      <div class="row">
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-blackberry">
      <div class="card-body">
        <div class="card-block pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">2156</h3>
              <span>Total Project Masuk</span>
            </div> 
            <div class="media-right white text-right">
                            <i class="icon-pie-chart font-large-1"></i>
                        </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-ibiza-sunset">
      <div class="card-body">
        <div class="card-block pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">1567</h3>
              <span>Dokumen SIS</span>
            </div> 
            <div class="media-right white text-right">
                            <i class="icon-pie-chart font-large-1"></i>
                        </div>
          </div>
        </div>
        

      </div>
    </div>
  </div>
  
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-green-tea">
      <div class="card-body">
        <div class="card-block pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0"> 566</h3>
              <span>Dokumen DRM</span>
            </div>
            <div class="media-right white text-right">
                            <i class="icon-pie-chart font-large-1"></i>
                        </div>
          </div>
        </div>
        
      </div>
    </div>
  </div>


  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-pomegranate">
      <div class="card-body">
        <div class="card-block pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">95</h3>
              <span>Dokumen SITAC</span>
            </div>
            <div class="media-right white text-right">
                            <i class="icon-pie-chart font-large-1"></i>
                        </div>
          </div>
        </div>
      
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card bg-primary">
      <div class="card-body">
        <div class="card-block pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">95</h3>
              <span>Dokumen RFC</span>
            </div>
            <div class="media-right white text-right">
                            <i class="icon-pie-chart font-large-1"></i>
                        </div>
          </div>
        </div>
      
      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card bg-warning">
      <div class="card-body">
        <div class="card-block pt-2 pb-0">
          <div class="media">
            <div class="media-body white text-left">
              <h3 class="font-large-1 mb-0">95</h3>
              <span>Submit BOQ</span>
            </div>
            <div class="media-right white text-right">
                            <i class="icon-pie-chart font-large-1"></i>
                        </div>
          </div>
        </div>
      
      </div>
    </div>
  </div>



</div>


 
 
 


   
</div>
</template>
<script>
    
import accounting from 'accounting'
import {Money} from 'v-money'
import VueCharts from 'vue-chartjs'
import { Bar, Line } from 'vue-chartjs'
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
import loading from '../Loading'
Vue.use(VueEvents)
window.axios = require('axios')
window.eventBus = new Vue()


export default {
  components: {
    Vuetable,
    VuetablePagination,
    VuetablePaginationInfo,
     'vue-toast': VueToast,
     'date-picker': myDatepicker,
	 Money,
	 loading,
  },
  data () {
    return {
	image:'../img/tokoh-Marvel.png',
	isLoading: false,
      }
  },
          watch: {
        'delayOfJumps': 'resetOptions',
        'maxToasts': 'resetOptions',
        'position': 'resetOptions',
        },
  methods: {

fetchIt(){
this.isLoading = true;
},

    formatNumberRupiah (value) {
      return accounting.formatMoney(value,  "Rp. ", 2, ".", ",")
    },
},
  
 created: function() {

        },
              mounted() {
//this.fetchIt();

        }

}
</script>
<style>
  .small {
    max-width: 100%;
    margin:  5% auto;
  }
  .circularmarvel{
    height: 290px;
    width: 100%;
    background-position: center;
    background-repeat: no-repeat;
    background-size: cover;
}
  .doktor{
    font-size: larger;
}
</style>