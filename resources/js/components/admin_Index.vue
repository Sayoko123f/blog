<template>
  <v-container>
    <v-row
      ><v-col>
        <span>文章</span
        ><v-breadcrumbs :items="article"></v-breadcrumbs> </v-col
    ></v-row>
    <v-row
      ><v-col>
        <span>圖片</span><v-breadcrumbs :items="image"></v-breadcrumbs> </v-col
    ></v-row>
    <v-row>
      <v-col>
        <v-btn @click="logout">Log out</v-btn>
      </v-col>
    </v-row>
  </v-container>
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
    console.log("admin_Index mounted.");
  },
  data: () => ({
    article: [
      { text: "管理文章", to: { name: "admin_articleIndex" } },
      { text: "發表文章", to: { name: "articleCreate" } },
    ],
    image: [
      { text: "管理圖片", to: { name: "ImageEdit" } },
      { text: "上傳圖片", to: { name: "adminImageUpload" } },
    ],
  }),
  methods: {
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