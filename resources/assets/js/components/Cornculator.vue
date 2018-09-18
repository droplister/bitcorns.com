<template>
<div>
  <!-- the button -->
  <b-btn v-b-modal.cornculatorModal>
    <i class="fa fa-calculator"></i> Cornculator
  </b-btn>

  <!-- the modal -->
  <b-modal id="cornculatorModal">
    Hello From My Modal!
  </b-modal>
</div>
</template>

<script>
export default {
  mounted() {
    console.log('Component mounted.')
  }
}
</script>
