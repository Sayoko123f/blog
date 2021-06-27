<template>
  <div>
    <v-card>
      <v-toolbar color="primary">Login</v-toolbar>
      <v-card-text>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="email"
            :rules="emailRules"
            label="Email"
            prepend-icon="mdi-email"
            required
          >
          </v-text-field>
          <v-text-field
            v-model="password"
            :rules="passwordRules"
            label="Password"
            prepend-icon="mdi-key-variant"
            required
            type="password"
          >
          </v-text-field>
        </v-form>
        <v-btn @click="login" color="primary">Login</v-btn>
      </v-card-text>
    </v-card>
    <v-snackbar v-model="showSnackbar">
      錯誤的帳號密碼，請重試
      <v-btn color="warning" text @click="showSnackbar = false"> 關閉 </v-btn>
    </v-snackbar>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate color="primary"></v-progress-circular>
    </v-overlay>
  </div>
</template>

<script>
export default {
  beforeRouteEnter(to, from, next) {
    if (window.app.user) {
      alert("您已經登入！跳轉至首頁");
      next({ name: "articleIndex" });
    } else {
      next();
    }
  },
  mounted() {
    console.log("LoginComponent mounted.");
  },
  data: () => ({
    showSnackbar: false,
    valid: true,
    email: "",
    emailRules: [
      (v) => !!v || "Email is required.",
      (v) =>
        /^\w{1,63}@[a-zA-Z0-9]{2,63}\.[a-zA-Z]{2,63}(\.[a-zA-Z]{2,63})?$/.test(
          v
        ) || "Email is invalid.",
    ],
    password: "",
    passwordRules: [(v) => !!v || "Password is required."],
    loading: false,
  }),
  methods: {
    login() {
      if (!this.$refs.form.validate()) {
        return;
      }
      this.loading = true;
      axios
        .post("/login", {
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          location.href = "/";
        })
        .catch((err) => {
          this.loading = false;
          this.showSnackbar = true;
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
</style>