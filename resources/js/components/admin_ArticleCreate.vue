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
      <div id="editor" ref="editor"></div>
      <v-btn :disabled="!valid" color="success" class="mr-4" @click="submit">
        Sumbit
      </v-btn>
    </v-form>
  </div>
</template>

<script>
export default {
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
    valid: true,
    title: "",
    titleRules: [(v) => !!v || "Name is required"],
    editor: Object,
  }),
  computed: {
    hello() {
      return "hello";
    },
  },
  methods: {
    submit() {
      if (!this.$refs.form.validate()) {
        return;
      }
      // if (!confirm("Are you sure?")) {
      //   return;
      // }
      console.log(this.editor.getHtml());
      const data = JSON.stringify({
        title: this.title,
        ctx_md: this.editor.getMarkdown(),
        ctx_html: this.editor.getHtml(),
      });
      // console.log(data.ctx_md);
      const headers = {
        "Content-Type": "application/json",
        "X-CSRF-TOKEN": my.csrf(),
      };
      axios
        .post(my.articleCreateURL, data, { headers })
        .then((response) => {
          console.log(response.data);
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