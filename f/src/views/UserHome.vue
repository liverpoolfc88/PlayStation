<template>
  <v-container class="grey lighten-5">
    <v-row no-gutters>
      <v-col
          v-for="r in room"
          :key="r.id"
          cols="12"
          sm="4"
          xs="12"
          md="4"
      >
        <v-hover
            v-slot="{ hover }">
          <v-card
              :elevation="hover ? 20 : 2"
              :class="{ 'on-hover': hover }"
              class="ma-2"
              color="primary"
          >
            <v-card-title class="white--text">
              {{ r.name }}
              <v-spacer></v-spacer>
<!--              <v-icon-->
<!--                  @click="deleteRoom(r.id)"-->
<!--                  class="red&#45;&#45;text" text-->
<!--              >mdi-delete-forever-->
<!--              </v-icon>-->
              <v-btn elevation="20" color="white" icon>
                <v-icon x-large v-if="r.status == 0" @click="busy(r.id)" class="orange--text ml-0">mdi-circle-outline</v-icon>
                <v-icon x-large v-if="r.status == 1" @click="busy(r.id)" class="white--text ml-0">mdi-window-close</v-icon>
              </v-btn>
            </v-card-title>
            <v-card-text class="white--text">

              <v-row>
                <v-col class="pt-6" cols="3">$:{{ r.price }} sum</v-col>
                <v-col cols="6">
                  <v-chip-group active-class="deep-purple accent-4 white--text" column>

                    <v-chip>5:30PM</v-chip>

                    <v-chip>7:30PM</v-chip>

                  </v-chip-group>
                </v-col>
                <v-col cols="3">
                  <v-btn icon>
                    <v-icon x-large  @click="busy(r.id)" class="fine--text ml-5">mdi-plus</v-icon>
                  </v-btn>
                </v-col>

              </v-row>

            </v-card-text>
<!--            <v-card-text class="white&#45;&#45;text">{{ r.price }} sum-->
<!--              -->
<!--            </v-card-text>-->
          </v-card>
        </v-hover>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>
// const axios = require('axios').default
export default {
  data () {
    return {
      room: [],
    }
  },
  watch: {
    $route(to, from) {
      this.getRoom();
    },
  },
  methods: {
    busy(id) {
      axios
          .post(this.$store.state.backend_url + 'api/room/busy',{
           id:id
          })
          .then((res) =>{
            this.getRoom ();
            console.log(res);
          })
    },
    getRoom () {
      // this.Loading = true
      axios
          .post(this.$store.state.backend_url + 'api/room/work', {type: this.$route.params.type})
          .then((response) => {
            console.log(this.$route.params.type);
            this.room = response.data
            console.log(this.room);
            // this.Loading = false
          })
          .catch(function (error) {
            console.error(error)
            // this.Loading = false
          })
    }
  },
  mounted () {
    this.getRoom()
  }
}
</script>
