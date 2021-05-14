<template>
  <div class="ma-4">
    <div class="text-h3">關於本站</div>
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