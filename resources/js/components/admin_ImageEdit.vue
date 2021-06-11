<template>
  <v-container>
    <v-list>
      <v-list-item-group>
        <template v-for="(item, index) in items">
          <v-list-item :key="item.path">
            <template>
              <v-list-item-content>
                <v-list-item-title v-text="item.path"></v-list-item-title>
              </v-list-item-content>

              <v-list-item-action>
                <v-list-item-action-text>View</v-list-item-action-text>
                <v-hover v-slot="{ hover }">
                  <v-btn icon @click.stop="selectedItem = item"
                    ><v-icon :color="hover ? 'pink' : ''"
                      >mdi-eye</v-icon
                    ></v-btn
                  >
                </v-hover>
              </v-list-item-action>
              <v-list-item-action>
                <v-list-item-action-text>Delete</v-list-item-action-text>
                <v-hover v-slot="{ hover }">
                  <v-btn icon @click="destroy(item.id)"
                    ><v-icon :color="hover ? 'pink' : ''"
                      >mdi-delete</v-icon
                    ></v-btn
                  >
                </v-hover>
              </v-list-item-action>
            </template>
          </v-list-item>
          <v-divider v-if="index < items.length - 1" :key="index"></v-divider>
        </template>
      </v-list-item-group>
    </v-list>
    <v-overlay :value="loading">
      <v-progress-circular indeterminate color="primary"></v-progress-circular>
    </v-overlay>
    <v-overlay v-if="selectedItem" @click.native="selectedItem = null">
      <v-img :src="'/'+selectedItem.path" contain></v-img>
    </v-overlay>
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
    console.log("admin_ImageEdit mounted.");
    this.getData();
  },
  data: () => ({
    items: [],
    loading: true,
    selectedItem: null,
  }),
  methods: {
    getData() {
      this.loading = true;
      axios
        .get(window.my.imageIndexURL)
        .then((response) => {
          this.items = response.data;
        })
        .catch((err) => {
          console.log(err);
        })
        .finally(() => {
          this.loading = false;
        });
    },
    destroy(id) {
      console.log(id);
      if (!confirm("Are you sure?")) {
        return;
      }
      const headers = {
        "X-CSRF-TOKEN": window.my.csrf(),
      };
      this.loading = true;
      axios
        .delete(window.my.imageDestroyURL(id), null, { headers })
        .then((response) => {
          //
        })
        .catch((err) => {
          console.log(err);
        })
        .finally(() => {
          this.getData();
        });
    },
    view(item) {
      this.selectedItem = item;
    },
  },
};
</script>

<style scoped>
</style>