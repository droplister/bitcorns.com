<template>
  <div>
    <div class="input-group mb-4">
      <input
        type="number"
        v-model="quantity"
        placeholder="0.01 CROPS"
        class="form-control"
        :class="quantity < 0 || quantity > 100 ? 'is-invalid' : ''"
        @keyup.enter="$_harvest_calculate">
      <div class="input-group-append">
        <button
          type="button"
          class="btn btn-primary"
          v-on:click="$_harvest_calculate"
          :disabled="quantity < 0 || quantity > 100">
        Cornculate!
        </button>
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
            <th scope="row">
              <a href="'/harvests/' + index + 1">
                Harvest #{{ index + 1 }}
              </a>
              <small>
                {{ harvest[0] | moment("MMM Do YYYY") }}
              </small>
            </th>
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
      quantity: 0.1
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
        this.crops = this.quantity
        this.$_harvest_update()
      }
    },
    $_harvest_subtotal(index) {
      return this.harvests.slice(0, index + 1)
        .reduce((sum, harvest) => sum + harvest[1], 0)
        .toLocaleString()
    }
  }
}
</script>