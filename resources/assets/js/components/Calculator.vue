<template>
  <div>
    <div class="input-group mb-4">
      <input v-model="quantity" type="number" min="0" max="100" class="form-control" placeholder="0.01 CROPS">
      <div class="input-group-append">
        <button v-on:click="$_harvest_calculate" class="btn btn-primary" type="button">Cornculate!</button>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th scope="col">Harvesting Schedule</th>
            <th scope="col">Bitcorn Harvested</th>
            <th scope="col">Running Total</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(harvest, index) in harvests">
            <th scope="row">Harvest #{{ index + 1 }}</th>
            <td>{{ harvest[1].toLocaleString() }}</td>
            <td>{{ $_harvest_subtotal(index) }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>

export default {
  props: ['crops'],
  data() {
    return {
      harvests: [],
      quantity: null
    }
  },
  mounted() {
    this.$_harvest_update()
  },
  computed: {
    source() {
      return '/api/calculator?crops=' + this.crops
    }
  },
  methods: {
    $_harvest_update() {
      var api = this.source
      var self = this
      $.get(api, function (response) {
        self.harvests = response.data
      })
    },
    $_harvest_calculate() {
      if(this.quantity !== null) {
        this.crops = this.quantity.toFixed(8)
        this.$_harvest_update()
      }
    },
    $_harvest_subtotal(index) {
      return this.harvests.slice(0, index + 1).reduce((sum, harvest) => sum + harvest[1], 0)
    }
  }
}
</script>