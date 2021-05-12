<template>
  <div v-if="loaded">
    <v-btn @click="back"> Go Back </v-btn>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-text-field
        v-model="title"
        :counter="26"
        :rules="titleRules"
        label="Title"
        required
      ></v-text-field>
      <v-combobox
        v-model="tags"
        :items="tagItems"
        label="Tags"
        multiple
        chips
      ></v-combobox>
      <div id="editor" ref="editor"></div>
      <v-btn
        :disabled="submitDisabled || !valid"
        color="success"
        class="mr-4"
        @click="submit"
      >
        Sumbit
      </v-btn>
      <v-btn color="warning" class="ma-4" @click="del">Delete</v-btn>
    </v-form>
  </div>
</template>

<script>
export default {
  beforeRouteEnter(to, from, next) {
    if (!window.app.user) {
      next({ name: "login" });
    } else {
      next();
    }
  },
  mounted() {
    console.log("ArticleShow mounted.");
    axios
      .get(my.articleEditURL(this.$route.params.id))
      .then((response) => {
        console.log(response.data);
        this.item = response.data;
        this.title = response.data.title;
        this.tags = response.data.tags ? response.data.tags.split(",") : [];
        this.loaded = true;
      })
      .then(() => {
        this.editor = new markdown.Editor.factory({
          el: document.querySelector("#editor"),
          initialValue: this.item.ctx_md,
          height: "500px",
          initialEditType: "markdown",
          previewStyle: "vertical",
          plugins: [[markdown.codeSyntaxHighlight, { hljs: markdown.hljs }]],
        });
      })
      .catch((err) => {
        console.log(err);
      });
  },
  data: () => ({
    tags: [],
    tagItems: [],
    item: {},
    loaded: false,
    valid: true,
    title: "",
    titleRules: [(v) => !!v || "Name is required"],
    editor: Object,
    submitDisabled: false,
  }),
  computed: {},
  methods: {
    back() {
      let page = this.$route.query.page || 1;
      this.$router.push({
        name: "admin_articleIndex",
        query: { page },
      });
    },
    submit() {
      if (!this.$refs.form.validate()) {
        return;
      }
      if (!this.editor.getHtml()) {
        alert("請填寫內容");
        return;
      }
      if (!confirm("Are you sure?")) {
        return;
      }
      this.submitDisabled = true;
      const data = JSON.stringify({
        title: this.title,
        ctx_md: this.editor.getMarkdown(),
        ctx_html: this.editor.getHtml(),
        tags: this.tags,
      });
      // console.log(data.ctx_md);
      const headers = {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": my.csrf(),
      };
      axios
        .put(my.articleUpdateURL(this.item.id), data, { headers })
        .then((response) => {
          console.log(response.data);
          this.back();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    del() {
      if (!confirm("確定要刪除嗎？")) {
        return;
      }
      const headers = {
        "X-CSRF-TOKEN": my.csrf(),
      };
      axios
        .delete(my.articleUpdateURL(this.item.id), null, { headers })
        .then((response) => {
          console.log(response.data);
          this.back();
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
</style>