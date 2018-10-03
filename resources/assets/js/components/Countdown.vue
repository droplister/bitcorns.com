<template>
  <div>
    <Countdown :deadline="deadline"></Countdown>
  </div>
</template>

<script>
import Countdown from 'vuejs-countdown'

export default {
  props: ['deadline'],
  components: {
    Countdown
  }
}
</script>

<style>
.vuejs-countdown {
  margin: 6em 0 !important;
  text-align: center !important;
  font-family: Helvetica, Geneva, sans-serif !important; /* Any font would work, but SansSerif looks better */
}
.vuejs-countdown li:after {
  right: -30px !important;
  font-size: 9em !important;
}
.vuejs-countdown .digit {
  font-size: 10em !important;
}
.vuejs-countdown .text {
  font-size: 2em !important;
}
.vuejs-countdown .text:active,
.vuejs-countdown .digit:active {
  text-shadow: none !important;
}
.vuejs-countdown .text::selection,
.vuejs-countdown .digit::selection {
  background-color: red !important;
}
</style>