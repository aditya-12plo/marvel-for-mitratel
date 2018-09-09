<template>
    
<section id="error">
    <div class="container-fluid bg-grey bg-lighten-3">
        <div class="container">
            <div class="row full-height-vh"> 

 <div id="rootnya">
    <gmap-map :center="center" :zoom="7" style="width: 100%; height: 100%">
      <gmap-cluster>
        <gmap-marker v-for="(m, index) in markers"
          :position="m.position"
          :clickable="true" :draggable="true"
          @click="center=m.position"
          :key="index"
          ></gmap-marker>
      </gmap-cluster>
    </gmap-map>
  </div>




</div>
                    </div>
                </div>
            </section>
</template>


<script>
     

import accounting from 'accounting'
import moment from 'moment' 
import Vue from 'vue'
import * as VueGoogleMaps from 'vue2-google-maps'
import Hashids from 'hashids'
import loading from '../Loading'
import VueEvents from 'vue-events'
Vue.use(VueGoogleMaps, {
      load: {
        key: 'AIzaSyBqm-Kv3qfKrXf2Iei3eQ150JsGh4RQQyQ'
      },
    });

    document.addEventListener('DOMContentLoaded', function() {
      // gmapCluster *must* be manually imported
      Vue.component('gmap-cluster', VueGoogleMaps.Cluster);
 new Vue({
        el: '#rootnya',
        data: {
          center: {
            lat: 10.0,
            lng: 10.0
          },
          markers: [{
            position: {
              lat: 10.0,
              lng: 10.0
            }
          }, {
            position: {
              lat: 11.0,
              lng: 11.0
            }
          }]
        },
      });
    });

</script>



<style> 
</style>