<template>
    <div>
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
            :center="farm && farm === m.farm && coords !== null ? coords : m.position"
            :radius="m.radius"
            :options="farm && farm === m.farm ? mapOptions : m.options"
          ></GmapCircle>

          <GmapMarker
            :key="index"
            v-for="(m, index) in markers"
            :position="farm && farm === m.farm && coords !== null ? coords : m.position"
            :clickable="true"
            :draggable="farm && farm === m.farm"
            @dragend="updateCoords"
          ></GmapMarker>
        </GmapMap>
      </div>
      <form @submit.prevent="processForm">
        <hr class="mb-4" />
        <div class="row">
          <div class="form-group col-sm-6">
            <label for="latitude">Latitude</label>
            <input v-model="latitude" id="latitude" type="text" class="form-control">
          </div>
          <div class="form-group col-sm-6">
            <label for="longitude">Longitude</label>
            <input v-model="longitude" id="longitude" type="text" class="form-control">
          </div>
        </div>
        <hr class="mb-4" />
        <div class="form-group">
          <label for="message">Message</label>
          <input v-model="message" id="message" type="text" class="form-control" required>
          <small id="messageHelp" class="form-text text-muted">Sign this message to authorize update.</small>
        </div>
        <div class="form-group">
          <label for="signature">Signature</label>
          <input v-model="signature" id="signature" type="text" class="form-control" required>
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
import * as VueGoogleMaps from 'vue2-google-maps'
import Vue from 'vue'
 
Vue.use(VueGoogleMaps, {
  load: {
    key: 'AIzaSyCrHQQfixq1IVYwzBrK8y20vz60D0I5c3Y',
  }
})

export default {
  props: ['type', 'lat', 'lng', 'zoom', 'farm', 'message'],
  data () {
    return {
      coords: null,
      latitude: '',
      longitude: '',
      signature: '',
      mapOptions: {
        'editable': false,
        'fillColor': '#ADFF2F',
        'strokeColor': '#228B22',
      },
      center: {
        lat: this.lat,
        lng: this.lng,
      },
      markers: null,
      mapType: this.type ? this.type : 'terrain',
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
    updateCoords: function(event) {
      this.coords = {
        lat: event.latLng.lat(),
        lng: event.latLng.lng(),
      }
      this.latitude = event.latLng.lat()
      this.longitude = event.latLng.lng()
    },
    methods: {
      processForm() {
        var api = '/api/farms/' + this.farm + '/map'
        var self = this
        $.post(api, {
          latitude: self.latitude,
          longitude: self.longitude,
          message: self.message,
          signature: self.signature
        }, function (response) {
          console.log(response)
          self.markers = null
          self.fetchData()
        })
      }
    }
  }
}
</script>