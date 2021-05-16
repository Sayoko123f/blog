<template>
  <v-navigation-drawer
    v-model="sidebarMenuCopy"
    app
    floating
    :permanent="sidebarMenuCopy"
    :mini-variant.sync="mini"
    right
  >
    <v-list dense>
      <v-list-item>
        <v-list-item-action>
          <v-icon @click.stop="$emit('togglemenu', false)"
            >mdi-chevron-right</v-icon
          >
        </v-list-item-action>
        <v-list-item-content>
          <v-list-item-title>
            <!-- <h3 class="font-weight-thin">Vuetify Dashboard</h3> -->
            <h3 class="font-weight-thin"></h3>
          </v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
    <v-list-item class="px-2" @click="navToggleMini = !navToggleMini">
      <v-list-item-avatar>
        <v-icon>mdi-account-outline</v-icon>
      </v-list-item-avatar>
      <v-list-item-content class="text-truncate">
        {{ username }}
      </v-list-item-content>
      <v-btn icon small>
        <v-icon>mdi-chevron-right</v-icon>
      </v-btn>
    </v-list-item>
    <v-divider></v-divider>
    <v-list>
      <v-list-item v-for="item in items" :key="item.title" link :to="item.href">
        <v-list-item-icon>
          <v-icon color="primary">{{ item.icon }}</v-icon>
        </v-list-item-icon>
        <v-list-item-content>
          <v-list-item-title class="primary--text">{{
            item.title
          }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list>
  </v-navigation-drawer>
</template>

<script>
export default {
  mounted() {
    console.log("AppNavbar mounted.");
    this.sidebarMenuCopy = this.sidebarMenu;
  },
  props: {
    sidebarMenu: {
      type: Boolean,
      require: true,
    },
  },
  data: () => ({
    navToggleMini: false,
  }),
  computed: {
    username() {
      return this.$root.user ? this.$root.user.name : "Logout";
    },
    items() {
      const all = [
        { title: "Home", href: "/", icon: "mdi-home-outline" },
        { title: "About", href: "/about", icon: "mdi-information" },
        { title: "Demo", href: "/demo", icon: "mdi-file-code-outline" },
        { title: "Test", href: "/test", icon: "mdi-test-tube" },
      ];
      const guest = [
        ...all,
        {
          title: "Login",
          href: "/login",
          icon: "mdi-shield-account",
        },
        // {
        //   title: "Register",
        //   href: "/register",
        //   icon: "mdi-shield-account",
        // },
      ];
      const auth = [
        ...all,
        {
          title: "文章管理",
          href: "/admin/article",
          icon: "mdi-shield-account",
        },
        {
          title: "文章發表",
          href: "/admin/article/create",
          icon: "mdi-shield-account",
        },
      ];
      return this.$root.user ? auth : guest;
    },
    mini: {
      get() {
        return this.$vuetify.breakpoint.smAndDown || this.navToggleMini;
      },
      set(val) {
        this.navToggleMini = val;
      },
    },
    sidebarMenuCopy: {
      get() {
        return this.sidebarMenu;
      },
      set(val) {
        this.$emit("togglemenu", val);
      },
    },
  },
  methods: {
    hi() {
      console.log("hi");
    },
  },
};
</script>

<style>
</style>