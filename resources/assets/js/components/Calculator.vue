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
    <div class="row">
      <div class="col-md-6 mb-4">
        <div class="card">
          <div class="card-body">
            <img src="/images/tokens/BITCORN.png" width="60" class="float-left mr-3">
            <h5 class="card-title">Harvested <small class="text-muted d-none d-sm-inline d-md-none d-lg-inline">Harvest #1 to Now</small></h5>
            <h5 class="card-title mb-0">{{ harvested }} BITCORN</h5>
          </div>
        </div>
      </div>
      <div class="col-md-6 mb-4">
        <div class="card">
          <div class="card-body">
            <img src="/images/tokens/BITCORN.png" width="60" class="float-left mr-3">
            <h5 class="card-title">Remaining <small class="text-muted d-none d-sm-inline d-md-none d-lg-inline">Now to Harvest #16</small></h5>
            <h5 class="card-title mb-0">{{ remaining }} BITCORN</h5>
          </div>
        </div>
      </div>
    </div>
    <div class="table-responsive">
      <table class="table table-bordered mb-0">
        <thead>
          <tr>
            <th scope="col">Harvest Schedule <small>For {{ crops }} CROPS</small></th>
            <th scope="col">Bitcorn Harvested</th>
            <th scope="col">Running Total</th>
            <th scope="col">Harvest Date</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(harvest, index) in harvests">
            <th scope="row">
              <a :href="'/harvests/' + (index + 1)" class="text-dark">Bitcorn Harvest #{{ index + 1 }}</a>
              <small v-if="upcoming && upcoming == index" class="text-muted">Upcoming</small>
            </th>
            <td>{{ harvest[1].toLocaleString() }}</td>
            <td>{{ $_harvest_subtotal(index) }}</td>
            <td>{{ harvest[0] | moment("ll") }}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>

export default {
  props: ['crops', 'upcoming'],
  data() {
    return {
      harvests: [],
      quantity: 0.1
    }
  },
  mounted() {
    this.$_harvest_session_get()
    this.$_harvest_update()
  },
  computed: {
    source() {
      return '/api/calculator?crops=' + this.crops
    },
    harvested() {
      return this.harvests.slice(0, this.upcoming)
        .reduce((sum, harvest) => sum + harvest[1], 0)
        .toLocaleString()
    },
    remaining() {
      return this.harvests.slice(-this.upcoming)
        .reduce((sum, harvest) => sum + harvest[1], 0)
        .toLocaleString()
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
        this.$_harvest_session_set()
      }
    },
    $_harvest_subtotal(index) {
      return this.harvests.slice(0, index + 1)
        .reduce((sum, harvest) => sum + harvest[1], 0)
        .toLocaleString()
    },
    $_harvest_session_get() {
      if(this.$session.has('crops')) {
        this.crops = this.$session.get('crops')
        this.quantity = this.$session.get('crops')
      }
    },
    $_harvest_session_set() {
      this.$session.set('crops', this.crops)
    }
  }
}
</script>