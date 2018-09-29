<template>
 <div> 
   <loading :show="isLoading"></loading>
   <vue-toast ref='toast'></vue-toast>




      <div class="card-header">
       <h1 style="padding-top: 1%;font-size: 40px;font-family:'arial';" align="center"><strong>PROJECT TAHUN {{this.$route.params.years}}
<br>{{this.dataNya.jumlahsemuanya}} SITE</strong></h1> 

      </div>
   
    

      <div class="row">

  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card">
      <div class="card-body">


<h2 align="center">DOKUMEN PO</h2>
<br>
<pie-chart-history-by-years-all :height="500" :labelnyahistorybyyears="this.dataNya.totallabelsbyyears.labels" :resultnyahistorybyyears="this.dataNya.totallabelsbyyears.result"></pie-chart-history-by-years-all>



      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card">
      <div class="card-body">


<h2 align="center">STATUS PROJECT</h2>
<br>
<pie-chart-history-by-years-all-project :height="500" :labelnyahistorybyyears="this.dataNya.totallabelproject.labels" :resultnyahistorybyyears="this.dataNya.totallabelproject.result"></pie-chart-history-by-years-all-project>



      </div>
    </div>
  </div>

  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card">
      <div class="card-body">
      
      <h2 align="center">Total Site / AREA</h2>
<br>
<pie-chart-home-area-by-years :height="500" :labelnya="this.dataNya.totalareabyyears.labels" :resultnya="this.dataNya.totalareabyyears.result"></pie-chart-home-area-by-years>


      </div>
    </div>
  </div>
  
  <div class="col-xl-3 col-lg-6 col-md-6 col-12">
    <div class="card">
      <div class="card-body">


      <h2 align="center">Total Site / REGIONAL</h2>
<br>
<pie-chart-home-regional-by-years :height="500" :labelnya="this.dataNya.totalregionalbyyears.labels" :resultnya="this.dataNya.totalregionalbyyears.result"></pie-chart-home-regional-by-years>

        
      </div>
    </div>
  </div> 


  <div class="col-xl-4 col-lg-6 col-md-6 col-12">
    <div class="card">
      <div class="card-body">


      <h2 align="center">AVG NASIONAL REVENUE / TAHUN</h2>
<br>
<line-chart-nasional-by-years :height="500" :labelnya="this.dataNya.totallineavg.labels" :resultnya="this.dataNya.totallineavg.result"></line-chart-nasional-by-years>

        
      </div>
    </div>
  </div> 

  <div class="col-xl-8 col-lg-6 col-md-6 col-12">
    <div class="card">
      <div class="card-body">


      <h2 align="center">AVG AREA REVENUE / TAHUN</h2>
<br>
<line-chart-area-by-years :height="500" :labelnya="this.dataNya.totalareanasionalline.labels" :resultnya="this.dataNya.totalareanasionalline.result"></line-chart-area-by-years>

        
      </div>
    </div>
  </div> 


  <div class="col-xl-12 col-lg-6 col-md-6 col-12">
    <div class="card">
      <div class="card-body">


      <h2 align="center">AVG REGIONAL REVENUE / TAHUN</h2>
<br>
<line-chart-regional-by-years :height="500" :labelnya="this.dataNya.totalregionalnasionalline.labels" :resultnya="this.dataNya.totalregionalnasionalline.result"></line-chart-regional-by-years>

        
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





Vue.component("line-chart-regional-by-years", {
  extends: Bar,
  props: ["labelnya","resultnya"],
  data () {
      return {
        datacollection: {
          //Data to be represented on x-axis
          labels: this.labelnya,
        datasets: [
          {
          label: this.labelnya,
          borderColor: [this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()], 
          pointHighlightStroke:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()],  
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()], 
          data: this.resultnya
      }
        ]
        },
        //Chart.js options that controls the appearance of the chart
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
        min: 0,           
        stepSize:10000000,
              },
              gridLines: {
                display: true
              }
            }],
            xAxes: [ {
              gridLines: {
                display: false
              }
            }]
          },
          legend: {
            display: false
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




Vue.component("line-chart-area-by-years", {
  extends: Bar,
  props: ["labelnya","resultnya"],
  data () {
      return {
        datacollection: {
          //Data to be represented on x-axis
          labels: this.labelnya,
        datasets: [
        {
          label: this.labelnya,
          borderColor: [this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()], 
          pointHighlightStroke:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()], 
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()], 
          data: this.resultnya
      }
      ]
        },
        //Chart.js options that controls the appearance of the chart
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
        min: 0,           
        stepSize:10000000,
              },
              gridLines: {
                display: true
              }
            }],
            xAxes: [ {
              gridLines: {
                display: false
              }
            }]
          },
          legend: {
            display: false
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
      this.renderChart(this.datacollection, this.options);
     // this.loopnya(this.labelnya,this.resultnya);
    }
})



Vue.component("line-chart-nasional-by-years", {
  extends: Bar,
  props: ["labelnya","resultnya"],
  data () {
      return { 
        datacollection: {
          //Data to be represented on x-axis
          labels:this.labelnya,
        datasets: [
          {
          label: this.labelnya,
          borderColor: [this.getRandomColorHex(),this.getRandomColorHex()], 
          pointHighlightStroke:[this.getRandomColorHex(),this.getRandomColorHex()],
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex()],
          data: this.resultnya
      }
        ]
        },
        //Chart.js options that controls the appearance of the chart
        options: {
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true,
        min: 0,           
        stepSize:10000000,
              },
              gridLines: {
                display: true
              }
            }],
            xAxes: [ {
              gridLines: {
                display: false
              }
            }]
          },
          legend: {
            display: false
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
      this.renderChart(this.datacollection, this.options); 
    }
})



Vue.component("pie-chart-history-by-years-all", {
  extends: VueCharts.Pie,
  props: ["labelnyahistorybyyears","resultnyahistorybyyears"],
  data () {
    return {
        datacollection: {
          //Data to be represented on x-axis
          labels: this.labelnyahistorybyyears,
        datasets: [
    {
       
          borderColor: '#05CBE1',
          pointBackgroundColor: 'white',
          pointBorderColor: 'white',
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()],
          data: this.resultnyahistorybyyears,
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



Vue.component("pie-chart-history-by-years-all-project", {
  extends: VueCharts.Pie,
  props: ["labelnyahistorybyyears","resultnyahistorybyyears"],
  data () {
    return {
        datacollection: {
          //Data to be represented on x-axis
          labels: this.labelnyahistorybyyears,
        datasets: [
    { 
          borderColor: '#05CBE1',
          pointBackgroundColor: 'white',
          pointBorderColor: 'white',
          borderWidth: 1,
          backgroundColor:[this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex(),this.getRandomColorHex()],
          data: this.resultnyahistorybyyears,
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



Vue.component("pie-chart-home-area-by-years", {
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



Vue.component("pie-chart-home-regional-by-years", {
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
  isLoading: false,
  dataNya: [],
  tahunya: '',
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
                axios.get('/karyawan/history-project-by-years-pie-chart/'+this.$route.params.years).then((response) => {
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