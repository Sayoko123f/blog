<template>
  <div class="ma-4">
    <div class="text-h3">關於本站</div>
    <a href="https://github.com/Sayoko123f/blog" target="_blank"
      ><v-btn color="secondary">
        <v-icon>mdi-github-circle</v-icon>
      </v-btn></a
    >
    <p class="text-justify">待補充</p>
  </div>
</template>
<script>
export default {
  mounted() {
    console.log("About mounted.");
  },
  data: () => ({
    test: "test",
  }),
  computed: {
    hello() {
      return "hello";
    },
  },
  methods: {
    hi() {
      console.log("hi");
    },
  },
};
</script>

<style scoped>
</style>