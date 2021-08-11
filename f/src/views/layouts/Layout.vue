<template>
  <v-card elevation="0">
    <v-app-bar color="#2b46a8" dense app>
      <v-app-bar-nav-icon color="white" @click.stop="drawer = !drawer">
        <v-icon>mdi-menu</v-icon>
      </v-app-bar-nav-icon>
      <v-spacer></v-spacer>
      <v-menu offset-y>
        <template v-slot:activator="{ on }">
          <v-btn color="white" text v-on="on">
            <v-icon color="#white" left>mdi-flag</v-icon>
            sasa
          </v-btn>
        </template>
        <v-list>
          <v-list-item>
            <v-list-item-title>sasa</v-list-item-title>
          </v-list-item>
        </v-list>
      </v-menu>
      <v-btn color="white" text>
        <v-icon color="white" class="ml-2">mdi-logout</v-icon>
        username
      </v-btn>
    </v-app-bar>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant.sync="mini"
      class="darken-4"
      color="#2b46a8"
      :expand-on-hover="drawer"
      dark
      permanent
      app
      id="navbar"
    >
      <v-list-item class="px-2">
        <v-list-item-avatar>
          <router-link :to="{ path: 'home' }"><v-icon size="36">mdi-account-tie</v-icon></router-link>
        </v-list-item-avatar>

        <v-list-item-title>username</v-list-item-title>

        <!-- <v-btn icon @click.stop="mini=!mini">
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>-->
      </v-list-item>

      <v-divider></v-divider>

      <v-list dense >
        <v-list-item >
          <v-list-item-icon class="mr-1">
            <v-icon>mdi-home</v-icon>
          </v-list-item-icon>

          <v-list-item-content class="ml-5">
            <v-list-item-title>sardor</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>

      <v-list dense class="dropdown">
        <v-list-group>
          <template v-slot:activator>
            <v-icon>mdi-home</v-icon>
            <v-list-item-content class="ml-5">
              <v-list-item-title>Menu</v-list-item-title>
            </v-list-item-content>
          </template>
          <v-list-item>
            <v-icon>mdi-home</v-icon>
            <v-list-item-content class="ml-2">
              <v-list-item-title><router-link :to="{ path: 'room' }">Xonalar</router-link></v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list-group>
      </v-list>
    </v-navigation-drawer>
    <v-main>
      <router-view></router-view>
    </v-main>
  </v-card>
</template>
<script>

export default {
  data () {
    return {
      drawer: true,
      mini: true
    }
  },
  computed: {
  },
  methods: {
  }
}
</script>
