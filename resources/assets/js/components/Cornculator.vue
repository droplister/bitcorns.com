<template>
<div>
  <!-- the button -->
  <b-btn v-b-modal.cornculatorModal variant="primary" class="float-right mt-3">
    <i class="fa fa-calculator"></i> Cornculator
  </b-btn>

  <!-- the modal -->
  <b-modal id="cornculatorModal" size="lg" title="Cornculator">
    <corn-chart source="http://moon.bitcorns.com/api/cornculator?crops=1"></corn-chart>
  </b-modal>
</div>
</template>

<script>
export default {}
</script>
