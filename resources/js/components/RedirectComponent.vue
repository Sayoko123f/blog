<template>
  <div>
    <v-alert type="success">I'm an Alert Usage Example </v-alert>
  </div>
</template>

<script>
export default {
  mounted() {
    if (this.$route.query.redirect) {
      const param = this.URLSearchParamsToObject(new URL(location.href));
      this.$router.push({
        name: param.redirect,
        query: param,
      });
    }
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
    URLSearchParamsToObject(url) {
      const obj = {};
      for (const [key, val] of [...url.searchParams]) {
        obj[key] = val;
      }
      return obj;
    },
  },
};
</script>

<style scoped>
</style>