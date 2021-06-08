<template>
  <div>
    <v-form ref="form" v-model="valid">
      <v-file-input
        multiple
        accept="image/*"
        placeholder="Upload Images"
        prepend-icon="mdi-image"
        v-model="images"
        :rules="rules"
      ></v-file-input>
      <v-btn
        @click="upload"
        :loading="uploading"
        :disabled="!valid || images.length === 0"
        >Upload</v-btn
      >
    </v-form>
    <v-snackbar v-model="showSnackbar">
      Upload file Success.
      <v-btn color="pink" text @click="showSnackbar = false">
        Close
      </v-btn>
    </v-snackbar>
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
    console.log("UploadImages mounted.");
  },
  data: () => ({
    images: [],
    valid: true,
    rules: [
      (files) =>
        !files ||
        !files.some((file) => file.size > 2097152) ||
        "File size should be less than 2 MB!",
    ],
    uploading: false,
    showSnackbar: false,
  }),
  computed: {},
  methods: {
    upload() {
      if (!this.$refs.form.validate()) {
        return;
      }
      if (this.images.length === 0) {
        return;
      }
      this.uploading = true;
      const url = window.my.uploadImageURL;
      let data = new FormData();
      this.images.forEach((element) => {
        data.append("images[]", element);
      });
      const headers = {
        "Content-Type":
          "multipart/form-data;boundary=" + Math.random().toString().substr(2),
        "X-CSRF-TOKEN": window.my.csrf(),
      };
      axios
        .post(url, data, { headers })
        .then((response) => {
          console.log(response);
          this.uploading = false;
          this.images = [];
          this.showSnackbar = true;
        })
        .catch((err) => {
          console.log(err.response);
          this.uploading = false;
          this.images = [];
        });
    },
  },
};
</script>

<style scoped>
</style>