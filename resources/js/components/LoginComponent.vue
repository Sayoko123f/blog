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
          >
          </v-text-field>
        </v-form>
        <v-btn @click="login" color="primary">Login</v-btn>
      </v-card-text>
    </v-card>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("LoginComponent mounted.");
  },
  data: () => ({
    valid: true,
    test: "",
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
          this.isLogin();
        })
        .catch((err) => {
          console.log(err);
        });
    },
    isLogin() {
      console.log("Check islogin()");
      axios
        .get("/islogin")
        .then((res) => {
          console.log(res.data);
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