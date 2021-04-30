<template>
  <div>
    <v-alert type="success">I'm an Alert Usage Example </v-alert>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("ExampleComponent mounted.");
  },
  data: () => ({
    test: "",
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