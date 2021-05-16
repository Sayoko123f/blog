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
    items: [{ text: "Todolist", to: "/demo/todolist" }],
  }),
};
</script>