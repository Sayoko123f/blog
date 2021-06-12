<template>
  <div>
    <div id="map" class="map"></div>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate color="primary"></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("OpenStreetMap mounted.");
    // import OSM js & css
    let jsurl =
      "https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v4.6.5/build/ol.js";
    let cssurl =
      "https://cdn.rawgit.com/openlayers/openlayers.github.io/master/en/v4.6.5/css/ol.css";
    Promise.all([window.my.importScript(jsurl), window.my.importCSS(cssurl)])
      .then(() => {
        this.initMap();
      })
      .catch((err) => {
        alert("Unexpected Error:(");
        console.log(err);
      });
  },
  data: () => ({
    loading: true,
  }),

  methods: {
    initMap() {
      let OSMLayer = new ol.layer.Tile({
        source: new ol.source.OSM(),
      });
      let map = new ol.Map({
        target: "map",
        layers: [OSMLayer],
        view: new ol.View({
          center: [121, 23.5],
          projection: "EPSG:4326",
          zoom: 7.5,
        }),
      });
      this.loading = false;
    },
  },
};
</script>

<style scoped>
</style>