<template>
  <div>
    <v-text-field
      v-model="newItem"
      @keyup.enter="addItem"
      label="New"
    ></v-text-field>
    <v-btn-toggle v-model="btnText" tile color="deep-purple accent-3" group>
      <v-btn value="all"> All</v-btn>
      <v-btn value="todo"> Todo </v-btn>
      <v-btn value="finished"> Finished </v-btn>
    </v-btn-toggle>
    <v-list>
      <v-list-item-group>
        <v-list-item v-for="(item, i) in showItems()" :key="i">
          <v-list-item-title v-text="item.text"></v-list-item-title>
          <v-list-item-action
            ><v-btn
              :color="item.finished ? 'success' : ''"
              @click="switchFinished(item.id)"
              ><v-icon>mdi-check</v-icon></v-btn
            ></v-list-item-action
          >
          <v-list-item-action
            ><v-btn color="warning" @click="deleteItem(item.id)"
              ><v-icon>mdi-delete</v-icon></v-btn
            ></v-list-item-action
          >
        </v-list-item>
      </v-list-item-group>
    </v-list>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("TodolistComponent mounted.");
    this.items.push({
      id: ++this.id,
      text: "工作一",
      finished: true,
    });
    this.items.push({
      id: ++this.id,
      text: "工作二",
      finished: false,
    });
    this.items.push({
      id: ++this.id,
      text: "工作三",
      finished: false,
    });
  },
  data: () => ({
    id: 0,
    items: [],
    newItem: "",
    btnText: "all",
  }),
  computed: {
    todoItems() {
      return this.items.filter((v) => {
        return !v.finished;
      });
    },
    finishedItems() {
      return this.items.filter((v) => {
        return v.finished;
      });
    },
  },
  methods: {
    addItem() {
      this.items.push({
        id: ++this.id,
        text: this.newItem,
        finished: false,
      });
      this.newItem = "";
    },
    switchFinished(id) {
      const index = this.items.findIndex((v) => {
        return v.id === id;
      });
      this.items[index].finished = !this.items[index].finished;
    },
    deleteItem(id) {
      const index = this.items.findIndex((v) => {
        return v.id === id;
      });
      this.items.splice(index, 1);
    },
    showItems() {
      switch (this.btnText) {
        case "todo":
          return this.todoItems;
        case "finished":
          return this.finishedItems;
        default:
          return this.items;
      }
    },
  },
};
</script>

<style scoped>
</style>