<template>
  <div>
    <v-alert type="success">I'm an Alert Usage Example </v-alert>
    <p>Login Status: {{ login }}</p>
    <v-btn @click="isLogin">Is Login?</v-btn>
    <v-btn @click="logout">Log out</v-btn>
    <v-btn @click="getUser">Get user</v-btn>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("ExampleComponent mounted.");
  },
  data: () => ({
    login: "null",
    user: {},
  }),
  computed: {
    hello() {
      return "hello";
    },
  },
  methods: {
    isLogin() {
      console.log("Check login");
      axios
        .get("/islogin")
        .then((res) => {
          console.log(res.data);
          this.login = "True";
        })
        .catch((err) => {
          console.log(err);
          this.login = "False";
        });
    },
    logout() {
      console.log("Send logout.");
      axios
        .post("/logout")
        .then((res) => {
          console.log(res.data);
          console.log("is logout");
          this.login = "False";
        })
        .catch((err) => {
          console.log("logout error");
          console.log(err);
        });
    },
    getUser() {
      console.log("get User");
      axios
        .get("/getuser")
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