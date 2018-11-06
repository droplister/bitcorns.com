<template>
  <GmapMap
    :zoom="zoom"
    :center="center"
    :map-type-id="mapType"
    style="width: 100%; height: 400px"
  >
    <GmapInfoWindow
      :options="infoOptions"
      :position="infoPosition"
      :opened="infoWinOpen"
      @closeclick="infoWinOpen=false"
    >
      <a :href="href" class="font-weight-bold">{{ name }}</a>
    </GmapInfoWindow>

    <GmapCircle
      :key="index"
      v-for="(m, index) in markers"
      :center="m.position"
      :radius="m.radius"
      :options="farm && farm === m.farm || coop && coop === m.coop ? mapOptions : m.options"
    ></GmapCircle>

    <GmapRectangle
      :options="coloring"
      :bounds="rectangle"
    ></GmapRectangle>

    <GmapMarker
      :key="index"
      v-for="(m, index) in markers"
      :position="m.position"
      :clickable="true"
      :draggable="false"
      @click="toggleInfo(m,index)"
      @mouseover="statusText = m.name"
      @mouseout="statusText = null"
    ></GmapMarker>

    <div slot="visible">
      <div style="bottom: 0; left: 0; background-color: #155724; color: #ffffff; position: absolute; z-index: 100">
        {{statusText}}
      </div>
    </div>
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
  props: ['type', 'lat', 'lng', 'zoom', 'coop', 'farm'],
  data () {
    return {
      coloring: {
        'editable': false,
        'fillColor': '#4e8b01',
        'strokeColor': '#143402',
      },
      rectangle: {
        'south': 40.544,
        'west': 46.478,
        'north': 55.482,
        'east': 87.529,
      },
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
      statusText: '',
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
      var api = !this.coop ? '/api/map' : '/api/map/' + this.coop;
      var self = this
      $.get(api, function (response) {
        self.markers = response
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
    }
  }
}
</script>