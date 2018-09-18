<template>
<div>
  <!-- the button -->
  <b-btn v-b-modal.cornculatorModal variant="primary" class="float-right mt-3">
    <i class="fa fa-calculator"></i> Cornculator
  </b-btn>

  <!-- the modal -->
  <b-modal id="cornculatorModal" size="lg" title="Cornculator">
    <corn-chart :crops="quantity"></corn-chart>
    <div slot="modal-footer" class="w-100">
      <range-slider
        class="slider"
        min="0"
        max="100"
        step="0.1"
        v-model="quantity">
      </range-slider>
    </div>
  </b-modal>
</div>
</template>

<script>
import RangeSlider from 'vue-range-slider'
import 'vue-range-slider/dist/vue-range-slider.css'

export default {
  data () {
    return {
      quantity: 1
    }
  },
  components: {
    RangeSlider
  }
}
</script>

<style>
.slider {
  width: 100%;
}
</style>