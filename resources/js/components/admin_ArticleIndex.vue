<template>
  <div v-if="loaded">
    <v-hover v-slot="{ hover }" v-for="item in items" :key="`${item.id}item`">
      <v-card :class="{ primary: hover }" @click="edit(item.id)" role="button">
        <v-card-title>{{ item.title }}</v-card-title>
        <v-card-subtitle>{{ item.created_at }}</v-card-subtitle>
        <v-card-text>
          <v-chip
            v-for="tag in splitTag(item.tags)"
            :key="`${item.id}-${tag}`"
            >{{ tag }}</v-chip
          >
        </v-card-text>
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
    console.log("admin_ArticleIndex.vue mounted.");
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
    splitTag(str) {
      return str ? str.split(",") : [];
    },
    pageMove() {
      this.init(this.page);
    },
    edit(id) {
      this.$router.push({
        name: "articleEdit",
        params: { id: id },
        query: { page: this.page },
      });
    },
  },
};
</script>

<style scoped>
</style>