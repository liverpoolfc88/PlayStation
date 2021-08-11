<template>
  <v-container class="grey lighten-5">
    <v-row no-gutters>
      <v-col
        cols="12"
        sm="12"
        xs="12"
        md="12"
      >
        <v-card
          class="pa-2 ma-2"
        >
          <v-spacer></v-spacer>
          <v-btn
            class="ml-2"
            rounded
            color="green"
            @click="newRoom"
          >
            Xona qoshish
          </v-btn>
        </v-card>
      </v-col>
    </v-row>
    <v-row no-gutters>
      <v-col
        v-for="r in room"
        :key="r.id"
        cols="12"
        sm="4"
        xs="12"
        md="4"
      >
        <v-card
          elevation="14"
          class="ma-2"
          color="#2b46a8"
        >
          <v-card-title class="white--text">
            {{ r.name }}
            <v-spacer></v-spacer>
            <v-icon
              @click="deleteRoom(r.id)"
              class="red--text" text
            >mdi-delete-forever
            </v-icon>
            <v-icon
              @click="editRoom(r)"
              class="green--text ml-5"
            >mdi-pencil
            </v-icon>
          </v-card-title>
          <v-card-text class="white--text">{{ r.price }} sum
          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
    <v-dialog
    v-model="dialog"
    @keydown.esc="dialog = false"
    persistent
    max-width="600px"
    >
      <v-card>
        <v-card-title class="headline grey lighten-2" primary-title>
          <span class="headline">{{ dialogHeaderText }}</span>
          <v-spacer></v-spacer>
          <v-btn color="red" outlined x-small fab class @click="dialog = false">
            <v-icon>mdi-close</v-icon>
          </v-btn>
        </v-card-title>
        <v-card-text>
          <v-form @keyup.native.enter="save" ref="dialogForm">
            <v-row>
              <v-col cols="12">
                <label for>{{ "med.name_room" }}</label>
                <v-text-field
                  v-model="form.name"
                  :rules="[v => !!v || 'input_required']"
                  hide-details="auto"
                  dense
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <label for>{{ "med.price_room" }}</label>
                <v-text-field
                  v-model="form.price"
                  :rules="[v => !!v || 'input_required']"
                  hide-details="auto"
                  dense
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <label for>{{ "med.photo_room" }}</label>
                <v-text-field
                  v-model="form.photo"
                  hide-details="auto"
                  dense
                  outlined
                ></v-text-field>
              </v-col>
              <v-col cols="12">
                <label for>{{ "med.status_room" }}</label>
                <v-text-field
                  v-model="form.status"
                  hide-details="auto"
                  dense
                  outlined
                ></v-text-field>
              </v-col>
            </v-row>
          </v-form>
          <small color="red">{{ "input_required" }}</small>
        </v-card-text>
        <v-divider></v-divider>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="primary" @click="save">{{ "save" }}</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>
<script>
const axios = require('axios').default
export default {
  data () {
    return {
      form: [],
      room: [],
      dialog: false,
      dialogHeaderText: ''
    }
  },
  methods: {
    newRoom () {
      this.dialogHeaderText = 'Xona qo`shish'
      this.form = {
        id: Date.now(),
        name: '',
        price: '',
        photo: '',
        status: 1
      }
      this.dialog = true
    },
    editRoom (r) {
      this.dialogHeaderText = 'O`zgartirish'
      this.dialog = true
      this.form = JSON.parse(JSON.stringify(r))
    },
    save () {
      axios
        .post(
          this.$store.state.backend_url + 'api/room/update',
          this.form
        )
        .then(() => {
          this.dialog = false
          this.getRoom()
        })
    },
    deleteRoom (id) {
      axios
        .delete(
          this.$store.state.backend_url + 'api/room/delete/' + id
        )
        .then(() => {
          this.getRoom()
        })
    },
    getRoom () {
      // this.Loading = true
      axios
        .get(this.$store.state.backend_url + 'api/room/index')
        .then((response) => {
          console.log(response)
          this.room = response.data
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
