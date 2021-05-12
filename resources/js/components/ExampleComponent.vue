<template>
  <div>
    <v-alert type="success">I'm an Alert Usage Example </v-alert>
    <p>Login Status: {{ hello }}</p>
    <v-btn @click="logout">Log out</v-btn>
    <v-btn @click="showUser">checkUser</v-btn>
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
      return this.$root.user ? this.$root.user.toString() : "null";
    },
  },
  methods: {
    showUser() {
      console.log(window.app.user);
      console.log(this.$root.user);
    },
    logout() {
      console.log("Send logout.");
      axios
        .post("/logout")
        .then((res) => {
          location.href = "/";
        })
        .catch((err) => {
          console.log("logout error");
          console.log(err);
        });
    },
  },
};
</script>

<style scoped>
</style>