<template>
  <main>
    <img @click="toggle" src="/storage/tokens/CORNFETTI.png" width="100%" alt="CORNFETTI" title="PARTY" class="mb-3" style="cursor: pointer" />
  </main>
</template>

<script>
import Vue from 'vue'
import VueConfetti from 'vue-confetti'

Vue.use(VueConfetti)

export default {
  data() {
    return {
      state: 'stop',
    }
  },
  methods: {
    start () {
      this.state = 'start'
      this.$confetti.start({
        shape: 'rect',
        colors: ['Gold', 'Goldenrod', 'Khaki', 'LightGoldenRodYellow', 'LightYellow', 'Yellow']
      })
    },
    stop () {
      this.state = 'stop'
      this.$confetti.stop()
    },
    toggle () {
      if(this.state === 'stop') {
        this.start()
      } else {
        this.stop()
      }
    }
  }
}
</script>