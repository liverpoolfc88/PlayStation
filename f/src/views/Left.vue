<template>
  <v-navigation-drawer
      app
      v-model="drawer"
      class="drawer"
      color="blue-grey lighten-4"
  >
    <template v-slot:prepend>
      <v-sheet
          color="blue-grey lighten-4"
          class="px-6 justify-center ml-5"
          height="50"
          width="80%"
          dark
      >
<!--        <img src="/img/motors-logo.jpg" alt="GWM" class=""-->
<!--             style="height: 100%; width: 100%; padding: 5px">-->
<!--        <span style="color: #0a53be" class="brand-text"></span>-->
      </v-sheet>
    </template>

    <v-divider></v-divider>
    <v-row>
      <v-col class="pt-10">
        <v-list class="pa-0" dense v-for="item in MenuItems" :key="item.title">
          <v-list-item
              v-if="item.visible"
              router
              :to="item.link"
          >
            <v-list-item-icon>
              <v-icon color="blue">{{ item.icon }}</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>{{ item.title }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-list>

        <v-list dense class="dropdown pa-0">
          <v-list-group
              v-if="item.visible"
              v-for="item in items"
              :key="item.title"
              link
              :to="item.link"
          >
            <template v-slot:activator>
              <v-icon color="blue">{{ item.icon }}</v-icon>
              <v-list-item-content class="ml-8">
                <v-list-item-title v-text="item.title"></v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
                v-if="subItem.visible"
                v-for="subItem in item.items"
                :key="subItem.title"
                link
                :to="subItem.link"

            >
              <v-icon color="blue">{{ subItem.icon }}</v-icon>
              <v-list-item-content class="ml-5">
                <v-list-item-title v-text="subItem.title"></v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
        </v-list>

      </v-col>
    </v-row>

  </v-navigation-drawer>
</template>
