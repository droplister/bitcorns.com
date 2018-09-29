<template>
  <GmapMap
    :zoom="zoom"
    :center="center"
    style="width: 100%; height: 400px"
  >
    <GmapInfoWindow
      :options="infoOptions"
      :position="infoPosition"
      :opened="infoWinOpen"
      @closeclick="infoWinOpen=false"
    >
      <a :href="href">{{ name }}</a>
    </GmapInfoWindow>

    <GmapCircle
      :key="index"
      v-for="(m, index) in markers"
      :center="m.position"
      :radius="m.radius"
      :options="m.options"
    ></GmapCircle>

    <GmapMarker
      :key="index"
      v-for="(m, index) in markers"
      :position="m.position"
      :clickable="true"
      :draggable="false"
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
  props: ['lat', 'lng', 'zoom'],
  data () {
    return {
      center: {lat: this.lat, lng: this.lng},
      markers: null,
      name: '',
      href: '',
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
      var api = '/api/map'
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
        this.infoWinOpen = ! this.infoWinOpen
      }
      else {
        this.infoWinOpen = true
        this.currentMidx = idx
      }
    }
  }
}
</script>