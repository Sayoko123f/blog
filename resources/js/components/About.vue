<template>
  <div>
    <v-row
      class="fill-height"
      :class="[coverSrcSmall ? 'bg1-s' : 'bg1']"
      justify="center"
      align="center"
      no-gutters
    >
      <v-col class="text-center white--text">
        <h1
          class="
            mb-2
            text-h5 text-sm-h5 text-md-h3 text-lg-h2 text-xl-h2
            my-heading-text
          "
        >
          <!-- The social network for epic content -->
          110612304
        </h1>
        <p
          class="
            mb-3
            text-subtitle-1 text-sm-subtitle-1 text-md-h4 text-lg-h4 text-xl-h4
            my-heading-text
          "
        >
          <!-- Unleash your creativity without limitations -->
          Website Design Finial-Project
        </p>
        <v-btn
          class="blue lighten-2 mt-5"
          dark
          large
          href="https://github.com/Sayoko123f/blog"
        >
          Source Code<v-icon color="black">mdi-github-circle</v-icon>
        </v-btn>
        <!-- <v-btn class="blue lighten-2 mt-5" dark large href="#">
          Get Started
        </v-btn> -->
      </v-col>
    </v-row>
    <v-card class="mt-2">
      <v-card-title class="justify-center">關於我</v-card-title>
      <v-card-text>
        <v-row align="center">
          <v-col cols="4" class="text-center"
            ><v-avatar color="red">
              <span class="white--text text-h5">ME</span>
            </v-avatar></v-col
          >
          <v-col cols="8">
            <v-row
              ><v-col class="black--text">Email</v-col
              ><v-col>待補充</v-col></v-row
            >
            <v-row
              ><v-col class="black--text">技能</v-col
              ><v-col>待補充</v-col></v-row
            >
            <v-row
              ><v-col class="black--text">工作年資</v-col
              ><v-col>待補充</v-col></v-row
            >
            <v-row
              ><v-col class="black--text">狀態</v-col
              ><v-col>待補充</v-col></v-row
            >
            <v-row
              ><v-col class="black--text">正在尋找</v-col
              ><v-col>待補充</v-col></v-row
            >
            <v-row
              ><v-col class="black--text">期望工作地點</v-col
              ><v-col>待補充</v-col></v-row
            >
          </v-col>
        </v-row>
        <v-row align="center">
          <v-col
            class="
              text-center
              black--text
              text-h5 text-sm-h5 text-md-h3 text-lg-h2 text-xl-h2
            "
            >前端技能</v-col
          ><v-col>
            <v-list>
              <v-list-item-group
                ><v-list-item>
                  <v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon
                          large
                          v-on="on"
                          v-bind="attrs"
                          color="yellow lighten-1"
                          >mdi-language-javascript</v-icon
                        ></template
                      ><span>Javascript</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content
                    >Javascript</v-list-item-content
                  ></v-list-item
                ><v-list-item
                  ><v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon
                          large
                          v-on="on"
                          v-bind="attrs"
                          color="teal accent-4"
                          >mdi-vuejs</v-icon
                        ></template
                      ><span>Vue</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content>Vue</v-list-item-content></v-list-item
                ><v-list-item
                  ><v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon
                          large
                          v-on="on"
                          v-bind="attrs"
                          color="light-blue lighten-2"
                          >mdi-vuetify</v-icon
                        ></template
                      ><span>Vuetify</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content
                    >Vuetify</v-list-item-content
                  ></v-list-item
                ></v-list-item-group
              >
            </v-list>
          </v-col>
        </v-row>
        <v-row align="center">
          <v-col
            class="
              text-center
              black--text
              text-h5 text-sm-h5 text-md-h3 text-lg-h2 text-xl-h2
            "
            >後端技能</v-col
          ><v-col>
            <v-list>
              <v-list-item-group
                ><v-list-item>
                  <v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon
                          large
                          v-on="on"
                          v-bind="attrs"
                          color="indigo lighten-3"
                          >mdi-language-php</v-icon
                        ></template
                      ><span>PHP</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content>PHP</v-list-item-content></v-list-item
                ><v-list-item
                  ><v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon large v-on="on" v-bind="attrs" color="grey"
                          >mdi-database</v-icon
                        ></template
                      ><span>MySQL</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content>MySQL</v-list-item-content></v-list-item
                ><v-list-item
                  ><v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon
                          large
                          v-on="on"
                          v-bind="attrs"
                          color="red accent-1"
                          >mdi-laravel</v-icon
                        ></template
                      ><span>Laravel</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content
                    >Laravel</v-list-item-content
                  ></v-list-item
                ></v-list-item-group
              >
            </v-list>
          </v-col>
        </v-row>
        <v-row align="center">
          <v-col
            class="
              text-center
              black--text
              text-h5 text-sm-h5 text-md-h3 text-lg-h2 text-xl-h2
            "
            >工具</v-col
          ><v-col>
            <v-list>
              <v-list-item-group
                ><v-list-item>
                  <v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon large v-on="on" v-bind="attrs" color="red"
                          >mdi-git</v-icon
                        ></template
                      ><span>Git</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content>Git</v-list-item-content></v-list-item
                ><v-list-item
                  ><v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon large v-on="on" v-bind="attrs" color="black"
                          >mdi-github-circle</v-icon
                        ></template
                      ><span>Github</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content
                    >Github</v-list-item-content
                  ></v-list-item
                ><v-list-item
                  ><v-list-item-icon
                    ><v-tooltip top
                      ><template v-slot:activator="{ on, attrs }">
                        <v-icon large v-on="on" v-bind="attrs" color="black"
                          >mdi-linux</v-icon
                        ></template
                      ><span>Linux</span>
                    </v-tooltip></v-list-item-icon
                  ><v-list-item-content>Linux</v-list-item-content></v-list-item
                ></v-list-item-group
              >
            </v-list>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
    <v-card class="mt-2">
      <v-card-title
        ><v-alert border="left" color="indigo" dark>
          經歷
        </v-alert></v-card-title
      >
      <v-card-text>
        <v-alert text color="info">
          <h3 class="text-h5">實習經驗</h3>
          <div>
            {{ longText(20) }}
          </div>
        </v-alert>
        <v-alert text color="info">
          <h3 class="text-h5">實習經驗</h3>
          <div>
            {{ longText(20) }}
          </div>
        </v-alert>
      </v-card-text>
    </v-card>
  </div>
</template>
<script>
export default {
  mounted() {
    console.log("About mounted.", this.$vuetify.breakpoint.name);
  },
  data: () => ({}),
  computed: {
    coverSrcSmall() {
      switch (this.$vuetify.breakpoint.name) {
        case "xs":
        case "sm":
          return true;
        case "md":
        case "lg":
        case "xl":
          return false;
      }
    },
  },
  methods: {
    longText(time) {
      let s = "";
      while (time--) {
        s += "Contents to be added. ";
      }
      return s;
    },
  },
};
</script>

<style scoped>
.my-heading-text {
  text-shadow: 2px 2px #000000;
}
.bg1 {
  min-height: 600px;
  background: url("/imgs/resource/cover1-l.jpg") 0% 15%;
}
.bg1-s {
  min-height: 400px;
  background-image: url("/imgs/resource/cover1-m.jpg");
  background-position: right 50% bottom 90%;
}
</style>