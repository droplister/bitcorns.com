<template>
    <div>
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
      <form>
        <hr class="mb-4" />
        <div class="row">
          <div class="form-group col-sm-6">
            <label for="latitude">Latitude</label>
            <input id="latitude" type="text" class="form-control" :value="coords ? coords.lat : ''">
          </div>
          <div class="form-group col-sm-6">
            <label for="longitude">Longitude</label>
            <input id="longitude" type="text" class="form-control" value="coords ? coords.lng : '' ">
          </div>
        </div>
        <hr class="mb-4" />
        <div class="form-group">
          <label for="message">Message</label>
          <input id="message" type="text" class="form-control :value="message" required>
          <small id="messageHelp" class="form-text text-muted">Sign this message to authorize update.</small>
        </div>
        <div class="form-group">
          <label for="signature">Signature</label>
          <input id="signature" type="text" class="form-control" required>
          <small id="signatureHelp" class="form-text text-muted">
            Enter your signed message. <a href="https://youtu.be/AvPdaNb35qY" target="_blank"><i class="fa fa-external-link"></i> Tutorial</a>
          </small>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary">
            <i class="fa fa-save"></i> Update
          </button>
        </div>
      </form>
    </div>
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
      var api = '/api/map';
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