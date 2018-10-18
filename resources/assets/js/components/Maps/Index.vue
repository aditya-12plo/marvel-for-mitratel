<template>
  <div>
 
 
 	<loading :show="isLoading"></loading>
 	 <vue-toast ref='toast'></vue-toast>

<div class="card-header-banner"> </div> 

    <section class="content-header">

      <h1 align="center">
      Project Location
      </h1>
    </section>
 
    <section class="content">
      <div class="row">
      <div class="col-md-12">
	  
	  
 <form class="form-inline">
<div style="overflow-x:auto;">
  <table>
   <tr>
      <td><label>Infratype:</label></td>
      <td>	<select v-model="infratypenya" class="form-control" @keyup.enter="doFilter"> 
      		<option v-for="opti in optionsnya">
      			{{opti}}
      		</option>
          </select>
       </td>
      <td><label>Area</label></td>
      <td><select v-model="area" class="form-control" @keyup.enter="doFilter"> 
      		<option v-for="ar in areanya">
      			{{ar}}
      		</option>
          </select></td>
    </tr>
   <tr>
      <td><label>Search for:</label></td>
      <td><input type="text" v-model="filterText" class="form-control" @keyup.enter="doFilter" placeholder="Project ID / Regional"></td>
	  <td></td>
	  <td></td>
    </tr>
     <tr>
      <td colspan="4" style="padding-top: 1%;"></td>
    </tr>
    <tr>
      <td colspan="4">
<div class="text-left">
<button class="btn btn-primary" @click.prevent="doFilter">Cari <i class="fa fa-thumbs-o-up position-right"></i></button>
<button class="btn btn-warning" @click.prevent="resetFilter">Reset Form <i class="fa fa-refresh position-right"></i></button> 
                                    </div>
</td>
       </tr>
</table>
 </div>
       </form>
	   
	   
	   
 
 <div style="overflow-x:auto;">
    <gmap-map ref="mymap" :center="this.startLocation" :zoom="5"style="width: 100%; height: 800px;">

      <gmap-info-window :options="infoOptions" :position="infoPosition" :opened="infoOpened" @closeclick="infoOpened=false">
       PID : {{infoProjectID}} - {{infoInfratype}}
		<br>
		Tower Hight : {{infoTower}}
		<br>
		Area : {{infoArea}} ({{infoRegional}})
		<br> 
		STATUS : {{infoStatusnya}}
		<br><br>
		<button type="button" @click="DetailSite(infoID)" class="btn btn-raised btn-info round btn-min-width mr-1 mb-1">
     Detail Site
				</button>
      </gmap-info-window>

      <gmap-marker v-for="(item, key) in coordinates" :key="key" :position="getPosition(item)" :clickable="true" @click="toggleInfo(item, key)" :icon="'/public/img/tower.png'"  />

    </gmap-map>
	</div>
	
	
	
       </div>
      </div>
      </section>
	
  </div>
</template>
     
<script>
import accounting from 'accounting'
import moment from 'moment'
import '!!vue-style-loader!css-loader!vue-toast/dist/vue-toast.min.css'
import VueToast from 'vue-toast'
import myDatepicker from 'vue-datepicker'
import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'
import Hashids from 'hashids'
import loading from '../Loading'
import VueEvents from 'vue-events' 
Vue.use(VueEvents) 
window.axios = require('axios')
window.eventBus = new Vue()


Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyDRWYhJY-8FSvpe92w3GhN2UNpnhp91J-s',
	 // libraries: 'places', //// If you need to use place input
  },
});

 
 export default {
  components: { 
    'vue-toast': VueToast,
    'date-picker': myDatepicker,
	loading,
  },
   data () {
   return {
	isLoading: false,
    startLocation: {
      lat: -6.175201,
      lng: 106.827157
    },
	
	 optionsnya: ['B2S','UNTAPPED'],
    infratypenya: '',
	 areanya: [1,2,3,4],
    area: '',
      filterText: '', 
    coordinates: [],
    infoPosition: null,
    infoInfratype: null,
    infoProjectID: null,
    infoStatusnya: null,
    infoTower: null,
    infoRegional: null,
    infoArea: null,
    infoID: null,
    infoOpened: false,
    infoCurrentKey: null,
    infoOptions: {
      pixelOffset: {
        width: 0,
        height: -35
      }
    },
  }
  },
  methods: {
  doFilter () { 
		 this.isLoading = true;
                axios.get('/karyawan/getCoordinates?filter='+this.filterText + '&infratypenya=' + this.infratypenya + '&area=' + this.area).then((response) => {
                    this.coordinates = response.data;
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
      resetFilter () { 
        this.filterText = '';
        this.infratypenya = ''; 
        this.area = ''; 
        this.fetchIt();
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
  DetailSite(kode){
let routeData = this.$router.resolve({name:'approvalboqdetailprojectnya', params: {id: this.diacak(kode) }});
window.open(routeData.href, '_blank');
},
    fetchIt(){
   this.isLoading = true;
                axios.get('/karyawan/getCoordinates').then((response) => {
                    this.coordinates = response.data;
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
    getPosition: function(marker) {
      return {
        lat: parseFloat(marker.lat),
        lng: parseFloat(marker.lng)
      }
    },
    toggleInfo: function(marker, key) {
      this.infoPosition = this.getPosition(marker);
      this.infoProjectID = marker.projectid;
      this.infoInfratype = marker.infratype;
      this.infoStatusnya = marker.statusnya;
      this.infoArea = marker.area;
      this.infoRegional = marker.regional;
      this.infoTower = marker.towernya;
      this.infoID = marker.id;
	  
      if (this.infoCurrentKey == key) {
        this.infoOpened = !this.infoOpened;
      } else {
        this.infoOpened = true;
        this.infoCurrentKey = key;
      }
    }
  },
    events: { 
  },
  		mounted() { 
            this.fetchIt(); 
               this.resetFilter();

        }
 };

</script>
<style>
.vue-map-container,
.vue-map-container .vue-map {
    width: 100%;
    height: 100%;
}
 .google-map {
  width: 800px;
  height: 600px;
  margin: 0 auto;
  background: gray;
}
</style>