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
        <v-btn @click="test" color="secondary">填入測試帳號</v-btn>
      </v-card-text>
    </v-card>
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
    valid: true,
    email: "",
    emailRules: [(v) => !!v || "Email is required."],
    password: "",
    passwordRules: [(v) => !!v || "Password is required."],
  }),
  methods: {
    login() {
      if (!this.$refs.form.validate()) {
        return;
      }
      console.log("Send login");
      axios
        .post("/login", {
          email: this.email,
          password: this.password,
        })
        .then((res) => {
          console.log(res.data);
          location.href = "/";
        })
        .catch((err) => {
          console.log(err);
        });
    },
    test() {
      this.email = "collect123a@gmail.com";
      this.password = "11111111";
    },
  },
};
</script>

<style scoped>
</style>