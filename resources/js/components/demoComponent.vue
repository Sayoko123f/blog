<template>
  <div>
    <v-breadcrumbs :items="items"></v-breadcrumbs>
  </div>
</template>

<script>
export default {
  mounted() {
    console.log("demoComponent mounted.");
  },
  data: () => ({
    items: [
      { text: "Map ", to: "/demo/osm" },
      { text: "Chartjs ", to: "/demo/chart" },
      { text: "Todolist", to: "/demo/todolist" },
    ],
  }),
};
</script>