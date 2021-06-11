<template>
  <div>
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
        :disabled="submitDisabled && !valid"
        color="success"
        class="mr-4"
        @click="submit"
      >
        Sumbit
      </v-btn>
    </v-form>
    <v-overlay :value="submitDisabled">
      <v-progress-circular indeterminate color="primary"></v-progress-circular>
    </v-overlay>
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
    console.log("admin_ArticleCreate mounted.");
    this.editor = new markdown.Editor({
      el: document.querySelector("#editor"),
      height: "500px",
      initialEditType: "markdown",
      previewStyle: "vertical",
      plugins: [
        [window.markdown.codeSyntaxHighlight, { hljs: window.markdown.hljs }],
      ],
    });
  },
  data: () => ({
    tags: [],
    tagItems: [],
    valid: true,
    title: "",
    titleRules: [(v) => !!v || "Name is required"],
    editor: Object,
    submitDisabled: false,
  }),
  computed: {},
  methods: {
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
      const headers = {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": window.my.csrf(),
      };
      axios
        .post(window.my.articleCreateURL, data, { headers })
        .then((response) => {
          this.$router.push({ name: "admin_articleIndex" });
        })
        .catch((err) => {
          console.log(err);
        });
    },
  },
};
</script>

<style>
</style>