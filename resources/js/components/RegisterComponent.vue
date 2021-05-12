<template>
  <div>
    <v-card>
      <v-toolbar color="primary">Register</v-toolbar>
      <v-card-text>
        <v-form ref="form" v-model="valid" lazy-validation>
          <v-text-field
            v-model="name"
            :rules="nameRules"
            label="Name"
            prepend-icon="mdi-account"
            required
          ></v-text-field>
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
          <v-text-field
            v-model="confirmPassword"
            :rules="confirmPasswordRules"
            label="Confirm Password"
            prepend-icon="mdi-key-variant"
            required
            type="password"
          >
          </v-text-field>
        </v-form>
        <v-btn @click="register" color="primary">Register</v-btn>
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
    console.log("RegisterComponent mounted.");
  },
  data: () => ({
    valid: true,
    name: "",
    nameRules: [(v) => !!v || "Name is required."],
    email: "",
    emailRules: [(v) => !!v || "Email is required."],
    password: "",
    passwordRules: [
      (v) => !!v || "Password is required.",
      (v) => v.length > 7 || "Password length must be at least 8.",
    ],
    confirmPassword: "",
  }),
  computed: {
    confirmPasswordRules() {
      return [
        !!this.confirmPassword || "Confirm password is required.",
        this.confirmPassword === this.password ||
          "Confirm password is different.",
      ];
    },
  },
  methods: {
    register() {
      if (!this.$refs.form.validate()) {
        return;
      }
      console.log("Send register");
      axios
        .post("/register", {
          name: this.name,
          email: this.email,
          password: this.password,
          password_confirmation: this.confirmPassword,
        })
        .then((res) => {
          console.log(res);
          location.href="/";
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