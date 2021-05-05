<template>
  <div v-if="loaded">
    <v-hover v-slot="{ hover }" v-for="item in items" :key="`${item.id}item`">
      <v-card :class="{ primary: hover }" @click="show(item.id)" role="button">
        <v-card-title>{{ item.title }}</v-card-title>
        <v-card-subtitle>{{ item.created_at }}</v-card-subtitle>
      </v-card>
    </v-hover>
    <v-pagination
      v-model="page"
      :length="last_page"
      @input="pageMove"
    ></v-pagination>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("ArticleIndex.vue mounted.");
    let page = parseInt(this.$route.query.page) || 1;
    this.page = page;
    this.init(page);
  },
  data: () => ({
    loaded: false,
    page: 1,
    last_page: 1,
    items: [],
  }),
  computed: {
    hello() {
      return "hello";
    },
  },
  methods: {
    init(page) {
      this.loaded = false;
      axios
        .get(`${my.articleIndexURL}?page=${page}`)
        .then((response) => {
          this.items = response.data.data;
          this.last_page = response.data.last_page;
          this.loaded = true;
        })
        .catch((err) => {
          console.log(err);
          (this.items = []), (this.loaded = true);
        });
    },
    pageMove() {
      this.init(this.page);
    },
    show(id) {
      this.$router.push({
        name: "articleShow",
        params: { id: id },
        query: { page: this.page },
      });
    },
  },
};
</script>

<style scoped>
</style>