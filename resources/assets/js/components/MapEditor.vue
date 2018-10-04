<template>
  <GmapMap
    :zoom="zoom"
    :center="center"
    :map-type-id="mapType"
    style="width: 100%; height: 400px"
  >
    <GmapCircle
      :key="index"
      v-for="(m, index) in markers"
      :center="farm && farm === m.slug && coords !== null ? coords : m.position"
      :radius="m.radius"
      :options="farm && farm === m.slug ? mapOptions : m.options"
    ></GmapCircle>

    <GmapMarker
      :key="index"
      v-for="(m, index) in markers"
      :position="farm && farm === m.slug && coords !== null ? coords : m.position"
      :clickable="true"
      :draggable="farm && farm === m.slug"
      @dragend="updateCoords"
      @click="toggleInfo(m,index)"
    ></GmapMarker>
  </GmapMap>
</template>
 
<script>
import * as VueGoogleMaps from 'vue2-google-maps';
import Vue from 'vue';
 
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCrHQQfixq1IVYwzBrK8y20vz60D0I5c3Y',
  }
});
 
export default {
  props: ['type', 'lat', 'lng', 'zoom', 'farm'],
  data () {
    return {
      coords: null,
      mapOptions: {
        'editable': false,
        'fillColor': '#ADFF2F',
        'strokeColor': '#228B22'
      },
      center: {
        lat: this.lat,
        lng: this.lng
      },
      markers: null,
      name: '',
      href: '',
      mapType: this.type ? this.type : 'terrain',
      infoPosition: {
        lat: 0,
        lng: 0
      },
      infoWinOpen: false,
      currentMidx: null,
      infoOptions: {
        pixelOffset: {
          width: 0,
          height: -35
        }
      }
    }
  },
  mounted() {
    this.fetchData()
  },
  methods: {
    fetchData: function () {
      var api = !this.coop ? '/api/map' : '/api/map/' + this.farm;
      var self = this
      $.get(api, function (response) {
        self.markers = response.data
      })
    },
    toggleInfo(marker, idx) {
      this.infoPosition = marker.position
      this.name = marker.name
      this.href = marker.href
      if (this.currentMidx == idx) {
        this.infoWinOpen = !this.infoWinOpen
      }
      else {
        this.infoWinOpen = true
        this.currentMidx = idx
      }
    },
    updateCoords: function(event) {
      this.coords = {
        lat: event.latLng.lat(),
        lng: event.latLng.lng(),
      }
      console.log(this.coords);
    }
  }
}
</script>