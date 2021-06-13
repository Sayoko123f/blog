<template>
  <div class="small">
    <v-btn @click="fillData()">Randomize</v-btn>
    <pie-chart v-if="pieData" :chart-data="pieData"></pie-chart>
    <radar-chart v-if="RadarData" :chart-data="RadarData"></radar-chart>
    <line-chart v-if="lineData" :chart-data="lineData"></line-chart>
    <bar-chart v-if="lineData" :chart-data="lineData"></bar-chart>
  </div>
</template>

<script>
import LineChart from "./demo_ChartLine.js";
import PieChart from "./demo_ChartPie.js";
import BarChart from "./demo_ChartBar.js";
import RadarChart from "./demo_ChartRadar.js";

export default {
  components: {
    LineChart,
    PieChart,
    BarChart,
    RadarChart,
  },
  data() {
    return {
      lineData: null,
      pieData: null,
      barData: null,
      RadarData: null,
    };
  },
  mounted() {
    this.fillData();
  },
  methods: {
    fillData() {
      this.lineData = {
        labels: ["January", "February", "March", "April", "May"],
        datasets: [
          {
            label: "Data A",
            backgroundColor: "rgba(153, 102, 255, 0.2)",
            data: [
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
            ],
          },
          {
            label: "Data B",
            backgroundColor: "rgba(255, 99, 132, 0.2)",
            data: [
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
            ],
          },
        ],
      };

      this.pieData = {
        datasets: [
          {
            data: [
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
            ],
            backgroundColor: [
              this.getRandomHex(),
              this.getRandomHex(),
              this.getRandomHex(),
            ],
          },
        ],
        labels: ["A", "B", "C"],
      };

      this.RadarData = {
        labels: ["Running", "Swimming", "Eating", "Cycling"],
        datasets: [
          {
            label: "Data C",
            fill: true,
            data: [
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
              this.getRandomInt(),
            ],
            backgroundColor: "rgba(54, 162, 235, 0.2)",
            pointBackgroundColor: "rgb(54, 162, 235)",
            borderColor: "rgb(54, 162, 235)",
            pointBorderColor: "#fff",
            pointHoverBackgroundColor: "#fff",
            pointHoverBorderColor: "rgb(54, 162, 235)",
          },
        ],
      };
    },
    getRandomInt() {
      return Math.floor(Math.random() * (50 - 5 + 1)) + 5;
    },
    getRandomHex() {
      return "#" + Math.floor(Math.random() * 16777215).toString(16);
    },
  },
};
</script>

<style>
.small {
  max-width: 600px;
  margin: 150px auto;
}
</style>