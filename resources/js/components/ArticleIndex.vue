<template>
  <div v-if="loaded">
    <v-container class="my-3">
      <v-hover v-slot="{ hover }" v-for="item in items" :key="`${item.id}item`">
        <v-row
          ><v-col>
            <v-card
              :class="{ 'pink--text': hover, pink: hover, 'lighten-5': hover }"
              @click="show(item.id)"
              role="button"
            >
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
          </v-col></v-row
        >
      </v-hover>
      <v-row
        ><v-col>
          <v-pagination
            v-model="page"
            :length="last_page"
            @input="pageMove"
          ></v-pagination
        ></v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  mounted() {
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
      let query = this.$route.query.q ? `&q=${this.$route.query.q}` : "";
      axios
        .get(`${window.my.articleIndexURL}?page=${page}${query}`)
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
    splitTag(str) {
      return str ? str.split(",") : [];
    },
    show(id) {
      let params = { page: this.page };
      if (this.$route.query.q) {
        params.q = this.$route.query.q;
      }
      this.$router.push({
        name: "articleShow",
        params: { id: id },
        query: params,
      });
    },
  },
};
</script>

<style scoped>
</style>