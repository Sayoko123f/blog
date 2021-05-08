<template>
  <div v-if="loaded">
    <div class="text-h2">{{ item.title }}</div>
    <v-btn @click="back"> Go Back </v-btn>
    <div id="viewer"></div>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("ArticleShow mounted.");
    axios
      .get(my.articleShowURL(this.$route.params.id))
      .then((response) => {
        console.log(response.data);
        this.item = response.data;
        this.loaded = true;
      })
      .then(() => {
        const viewer = new markdown.Editor.factory({
          el: document.querySelector("#viewer"),
          initialValue: this.item.ctx_html,
          viewer: true,
          plugins: [[markdown.codeSyntaxHighlight, { hljs: markdown.hljs }]],
        });
      })
      .catch((err) => {
        console.log(err);
      });
  },
  data: () => ({
    item: {},
    loaded: false,
  }),
  computed: {},
  methods: {
    back() {
      let page = this.$route.query.page || 1;
      let params = { page };
      if (this.$route.query.q) {
        params.q = this.$route.query.q;
      }
      this.$router.push({
        name: "articleIndex",
        query: params,
      });
    },
  },
};
</script>

<style scoped>
</style>