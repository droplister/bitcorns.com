<template>
<div>
  <!-- the button -->
  <b-btn v-b-modal.cornculatorModal variant="outline-success" class="float-right mt-3">
    <i class="fa fa-line-chart"></i> <span class="d-none d-sm-inline">Forecast</span>
  </b-btn>

  <!-- the modal -->
  <b-modal id="cornculatorModal" size="lg" title="Forecast" hide-footer>
    <forecast-chart :crops="quantity"></forecast-chart>
  </b-modal>
</div>
</template>

<script>
export default {
  data () {
    return {
      quantity: 100
    }
  }
}
</script>