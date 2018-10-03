<template>
  <div>
    <Countdown :deadline="deadline"></Countdown>
  </div>
</template>

<script>
import Countdown from 'vuejs-countdown'

export default {
  props: ['deadline', 'glasses'],
  components: {
    Countdown
  }
}
</script>