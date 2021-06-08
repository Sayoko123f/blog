<template>
  <div>
    <h1 class="subtitle-1 grey--text pa-2 d-flex justify-center">Image</h1>
    <v-divider></v-divider>
    <v-container class="my-5">
      <div>
        <v-row>
          <v-col
            v-for="item in items"
            :key="item.id"
            class="d-flex child-flex"
            cols="4"
          >
            <v-img
              :src="item.path"
              contain
              @click.stop="selectedItem = item"
            >
              <template v-slot:placeholder>
                <v-row class="fill-height ma-0" align="center" justify="center">
                  <v-progress-circular
                    indeterminate
                    color="grey lighten-5"
                  ></v-progress-circular>
                </v-row>
              </template>
            </v-img>
          </v-col>
        </v-row>
      </div>
    </v-container>
    <v-overlay v-if="selectedItem" @click.native="selectedItem = null">
      <v-img
        :src="selectedItem.path"
        contain
      ></v-img>
    </v-overlay>
  </div>
</template>
 
<script>
export default {
  mounted() {
    console.log("ImageShow mounted.");
    axios
      .get(window.my.imageShowURL)
      .then((response) => {
        console.log(response);
        this.items = response.data;
      })
      .catch((err) => {
        console.log(err);
      });
  },
  data: () => ({
    selectedItem: null,
    items: [],
  }),
  methods: {
    showUser() {
      console.log(window.app.user);
      console.log(this.$root.user);
    },
  },
};
</script>