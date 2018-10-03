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

<style>
.vuejs-countdown {
  margin: 6rem 0 !important;
  text-align: center !important;
  font-family: Helvetica, Geneva, sans-serif !important; /* Any font would work, but SansSerif looks better */
  text-shadow: -0.15em 0 red,  0.15em 0 cyan !important; /* This creates the 3D effect, pretty easy, eh? */
  letter-spacing: 0.20em !important; /* make sure the letters don't overlap */
}
.vuejs-countdown li:after {
  right: -27px !important;
  font-size: 7em !important;
}
.vuejs-countdown .digit {
  font-size: 8em !important;
}
.vuejs-countdown .text {
  font-size: 1.5em !important;
}
.vuejs-countdown .text:focus,
.vuejs-countdown .digit:focus {
  outline: none !important;
}
.vuejs-countdown .text,
.vuejs-countdown .digit {
  vertical-align: middle;
  line-height: 1.5em !important;
  transition: font-size 2s cubic-bezier(0, 1, 0, 1) !important;
}
.vuejs-countdown .text:hover {
  font-size: 2em !important; /* This adds a hover effect */
  transition: font-size .2s cubic-bezier(0, 0.75, 0, 1) !important;
}
.vuejs-countdown .digit:hover {
  font-size: 10em !important; /* This adds a hover effect */
  transition: font-size .2s cubic-bezier(0, 0.75, 0, 1) !important;
}
.vuejs-countdown .text:active {
  font-size: 2em !important;
  text-shadow: none !important; /* Click to disable the 3D effect */
}
.vuejs-countdown .digit:active {
  font-size: 10em !important;
  text-shadow: none !important; /* Click to disable the 3D effect */
}
.vuejs-countdown .text::selection,
.vuejs-countdown .digit::selection {
  background-color: red !important; /* This hides the selection */
}
</style>