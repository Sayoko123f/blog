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
      <v-textarea
        auto-grow
        v-model="ctx_md"
        :rules="ctx_mdRules"
        label="Markdown content"
        required
      ></v-textarea>
      <v-switch v-model="showPreview" label="Preview"></v-switch>
      <v-card-text
        v-if="showPreview"
        v-html="ctx_html"
        class="markdown-body"
      ></v-card-text>
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
    marked.setOptions({
      headerIds: false,
    });
  },
  data: () => ({
    valid: true,
    title: "",
    titleRules: [(v) => !!v || "Name is required"],
    ctx_md: "",
    ctx_mdRules: [(v) => !!v || "Content is required"],
    showPreview: true,
  }),
  computed: {
    hello() {
      return "hello";
    },
    ctx_html() {
      return marked(this.ctx_md);
    },
  },
  methods: {
    submit() {
      if (!this.$refs.form.validate()) {
        return;
      }
      console.log(this.ctx_html);
      // if (!confirm("Are you sure?")) {
      //   return;
      // }
      const data = JSON.stringify({
        title: this.title,
        ctx_md: this.ctx_md,
        ctx_html: this.ctx_html,
      });
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