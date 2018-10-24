<template>
 <div> 
   <loading :show="isLoading"></loading>
   <vue-toast ref='toast'></vue-toast>




      <div class="card-header-banner"> </div> 
   
      <div class="row">
<div class="col-xl-12 col-lg-6 col-md-6 col-12">
<h1 align="center">{{this.dataNya.jumlahsemuanya}} SITE TAHUN {{this.dataNya.years}}</h1>
</div>



  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-white">
      <div class="card-body">
      
      <h2 align="center">Total Site / AREA</h2>
<br>
<pie-chart-home-area-nasional :height="500" :labelnya="this.dataNya.totalareanasional.labels" :resultnya="this.dataNya.totalareanasional.result"></pie-chart-home-area-nasional>


      </div>
    </div>
  </div>


  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-white">
      <div class="card-body">


<h2 align="center">STATUS PROJECT</h2>
<br>
<pie-chart-home-project :height="500" :labelnya="this.dataNya.totallabelproject.labels" :resultnya="this.dataNya.totallabelproject.result"></pie-chart-home-project>



      </div>
    </div>
  </div>


  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-white">
      <div class="card-body">


<h2 align="center">DOKUMEN PO</h2>
<br>
<pie-chart-home :height="500" :labelnya="this.dataNya.totallabels.labels" :resultnya="this.dataNya.totallabels.result"></pie-chart-home>



      </div>
    </div>
  </div>

 
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card gradient-white">
      <div class="card-body">


      <h2 align="center">STATUS INVOICE </h2>
<br>
<pie-chart-home-regional-nasional :height="500" :labelnya="this.dataNya.totalchartmbadian.labels" :resultnya="this.dataNya.totalchartmbadian.result"></pie-chart-home-regional-nasional>

        
      </div>
    </div>
  </div>


 

<!--
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
-->


</div>


 
 
 


   
</div>
</template>
<script>
 



import accounting from 'accounting'
import {Money} from 'v-money'
import VueCharts from 'vue-chartjs'
import {Pie,Bar,Line} from 'vue-chartjs'
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


Vue.component("pie-chart-home", {
  extends: VueCharts.Pie,
  props: ["labelnya","resultnya"],
  data () {
    return {
        datacollection: {
          //Data to be represented on x-axis
          labels: this.labelnya,
        datasets: [
    { 
          borderColor: '#05CBE1',
          pointBackgroundColor: 'white',
          pointBorderColor: 'white',
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()],
          data: this.resultnya,
        },
        ]
        },
        //Chart.js options that controls the appearance of the chart
        options: {
          scales: { },
          legend: {
            display: true,
            position: 'left',
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
       methods: {  
    
    getRandomColorHex () {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
    },
},
    mounted () {
    //renderChart function renders the chart with the datacollection and options object.
      this.renderChart(this.datacollection, this.options) 
    }
})   




Vue.component("pie-chart-home-project", {
  extends: VueCharts.Pie,
  props: ["labelnya","resultnya"],
  data () {
    return {
        datacollection: {
          //Data to be represented on x-axis
          labels: this.labelnya,
        datasets: [
    { 
          borderColor: '#05CBE1',
          pointBackgroundColor: 'white',
          pointBorderColor: 'white',
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()],
          data: this.resultnya,
        },
        ]
        },
        //Chart.js options that controls the appearance of the chart
        options: {
          scales: { },
          legend: {
            display: true,
            position: 'left',
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
       methods: {  
    
    getRandomColorHex () {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
    },
},
    mounted () {
    //renderChart function renders the chart with the datacollection and options object.
      this.renderChart(this.datacollection, this.options) 
    }
})   



Vue.component("pie-chart-home-area-nasional", {
  extends: VueCharts.Pie,
  props: ["labelnya","resultnya"],
  data () {
    return {
        datacollection: {
          //Data to be represented on x-axis
          labels: this.labelnya,
        datasets: [
    { 
          borderColor: '#05CBE1',
          pointBackgroundColor: 'white',
          pointBorderColor: 'white',
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()],
          data: this.resultnya,
        },
        ]
        },
        //Chart.js options that controls the appearance of the chart
        options: {
          scales: { },
          legend: {
            display: true,
            position: 'left',
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
       methods: {  
    
    getRandomColorHex () {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
    },
},
    mounted () {
    //renderChart function renders the chart with the datacollection and options object.
      this.renderChart(this.datacollection, this.options) 
    }
})   



Vue.component("pie-chart-home-regional-nasional", {
  extends: VueCharts.Pie,
  props: ["labelnya","resultnya"],
  data () {
    return {
        datacollection: {
          //Data to be represented on x-axis
          labels: this.labelnya,
        datasets: [
    { 
          borderColor: '#05CBE1',
          pointBackgroundColor: 'white',
          pointBorderColor: 'white',
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()],
          data: this.resultnya,
        },
        ]
        },
        //Chart.js options that controls the appearance of the chart
        options: {
          scales: { },
          legend: {
            display: true,
            position: 'left',
          },
          responsive: true,
          maintainAspectRatio: false
        }
      }
    },
       methods: {  
    
    getRandomColorHex () {
    var r = Math.floor(Math.random() * 255);
    var g = Math.floor(Math.random() * 255);
    var b = Math.floor(Math.random() * 255);
    return "rgb(" + r + "," + g + "," + b + ")";
    },
},
    mounted () {
    //renderChart function renders the chart with the datacollection and options object.
      this.renderChart(this.datacollection, this.options) 
    }
})   




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
  dataNya: [],
	pienasional: [],
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
                axios.get('/karyawan/homePage').then((response) => {
this.dataNya = response.data; 
                    this.isLoading = false;
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

    formatNumberRupiah (value) {
      return accounting.formatMoney(value,  "Rp. ", 2, ".", ",")
    },
},
  
 created: function() {

        },
              mounted() {
    this.fetchIt();

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