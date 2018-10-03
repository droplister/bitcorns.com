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
  margin: 6rem 0;
  text-align: center;
  font-family: Helvetica, Geneva, sans-serif; /* Any font would work, but SansSerif looks better */
  text-shadow: -0.12em 0 red,  0.12em 0 cyan; /* This creates the 3D effect, pretty easy, eh? */
  letter-spacing: 0.16em; /* make sure the letters don't overlap */
}
.vuejs-countdown li {
  display: inline-block;
  margin: 0 8px;
  text-align: center;
  position: relative;
}
.vuejs-countdown li p {
    margin: 0;
}
.vuejs-countdown li:after {
  content: ":";
  position: absolute;
  top: 0;
  right: -27px;
  font-size: 7em;
}
.vuejs-countdown li:first-of-type {
  margin-left: 0;
}
.vuejs-countdown li:last-of-type {
  margin-right: 0;
}
.vuejs-countdown li:last-of-type:after {
  content: "";
}
.vuejs-countdown .digit {
  font-size: 8em;
  font-weight: 600;
  line-height: 1.4;
  margin-bottom: 0;
}
.vuejs-countdown .text {
  text-transform: uppercase;
  margin-bottom: 0;
  font-size: 1.5em;
}
.vuejs-countdown .text:focus,
.vuejs-countdown .digit:focus {
  outline: none;
}
.vuejs-countdown .text,
.vuejs-countdown .digit {
  vertical-align: middle;
  line-height: 1.5em;
  transition: font-size 2s cubic-bezier(0, 1, 0, 1);
}
.vuejs-countdown .text:hover,
.vuejs-countdown .digit:hover {
  font-size: 1.5em; /* This adds a hover effect */
  line-height: 1em;
  transition: font-size .2s cubic-bezier(0, 0.75, 0, 1);
}
.vuejs-countdown .text:active,
.vuejs-countdown .digit:active {
  font-size: 1em;
  text-shadow: none; /* Click to disable the 3D effect */
}
.vuejs-countdown .text::selection,
.vuejs-countdown .digit::selection {
  background-color: red; /* This hides the selection */
}
</style>