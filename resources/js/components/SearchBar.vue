<template>
  <v-toolbar>
    <v-text-field
      hide-details
      single-line
      v-model="q"
      @keypress.enter="search"
    ></v-text-field>
    <v-btn icon @click.stop="search">
      <v-icon>mdi-magnify</v-icon>
    </v-btn>
  </v-toolbar>
</template>

<script>
export default {
  mounted() {
    console.log("SearchBar mounted.");
  },
  data: () => ({
    q: "",
  }),
  computed: {
    hello() {
      return "hello";
    },
  },
  methods: {
    search() {
      if (!this.q) {
        return;
      }
      console.log(this.q);
      this.$router.push({
        name: "redirect",
        query: { q: this.q, redirect: "articleIndex" },
      });
    },
  },
};
</script>

<style scoped>
</style>