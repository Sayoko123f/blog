<template>
  <div>
    <v-form ref="form" v-model="valid" lazy-validation>
      <v-text-field
        v-model="title"
        :counter="30"
        :rules="titleRules"
        label="Title"
        required
      ></v-text-field>
      <v-textarea
        solo
        auto-grow
        v-model="ctx_md"
        label="# Markdown..."
        required
      ></v-textarea>
    </v-form>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("admin_ArticleCreate mounted.");
  },
  data: () => ({
    valid: true,
    title: "",
    titleRules: [(v) => !!v || "Name is required"],
    ctx_md: "",
  }),
  computed: {
    hello() {
      return "hello";
    },
  },
  methods: {
    hi() {
      console.log("hi");
    },
  },
};
</script>

<style scoped>
</style>