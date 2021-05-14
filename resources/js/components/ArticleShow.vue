<template>
  <div v-if="loaded" class="ma-4">
    <div class="text-h2 title">{{ item.title }}</div>
    <v-divider class="mb-2"></v-divider>
    <div class="mx-8">
      <div id="viewer"></div>
    </div>
    <v-divider class="mt-4"></v-divider>
    <v-btn @click="back" class="mt-2"> 上一頁 </v-btn>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("ArticleShow mounted.");
    axios
      .get(window.my.articleShowURL(this.$route.params.id))
      .then((response) => {
        console.log(response.data);
        this.item = response.data;
        document.title = `${this.item.title}${this.$root.titleSuffix}`;
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
.title {
  font-weight: initial;
}
</style>