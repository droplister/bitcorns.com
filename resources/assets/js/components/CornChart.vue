<template>
  <div>
    <highcharts :options="chartOptions"></highcharts>
  </div>
</template>

<script>
import {Chart} from 'highcharts-vue'

export default {
  props: ['crops'],
  components: {
    highcharts: Chart
  },
  data() {
    return {
      chartOptions: {
        chart: {
          events: {
            load() {
              setTimeout(this.reflow.bind(this))
            }
          }
        },
        title: {
          text: 'Bitcorn Forecast'
        },
        subtitle: {
          text: this.crops + ' Crops'
        },
        xAxis: {
          type: 'datetime'
        },
        yAxis: [{
          title: {
            text: 'Bitcorn'
          },
        },{
          title: {
            text: 'Cumulative'
          },
          opposite: true
        }],
        tooltip: {
          shared: true
        },
        credits: {
          enabled: false
        },
        series: []
      }
    }
  },
  mounted() {
    this.$_corn_chart_update()
  },
  computed: {
    source() {
      return '/api/cornculator?crops=' + this.crops
    }
  },
  watch:{
    source() {
      this.redraw()
    }
  },
  methods: {
    $_corn_chart_update() {
      var api = this.source
      var self = this
      $.get(api, function (response) {
        self.chartOptions.series.push({
          name: 'Bitcorn',
          data: response.data,
          yAxis: 0,
          zIndex: 2,
        })
        self.chartOptions.series.push({
          name: 'Cumulative',
          yAxis: 1,
          zIndex: 1,
          data: self.$_corn_chart_accumulate(response.data),
        })
      })
    },
    $_corn_chart_accumulate(data) {
      var accumulation = new Array()
      var runningTotal = 0
      var i = 0
      for (i = 0; i < data.length; i++) {
        runningTotal += data[i][1]
        accumulation.push([data[i][0], runningTotal])
      }
      return accumulation
    }
  },
}
</script>