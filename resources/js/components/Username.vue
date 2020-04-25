<template>
  <v-container>
    <label for>Username</label>
    <v-text-field
      placeholder="enter your torre.co username"
      append-icon="mdi-account"
      @change="validateUser"
      @click:append="validateUser"
      v-model="username"
    />
    <skills/>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";
import Skills from './Skills';

export default {
  name: "Username",
  components: {
      Skills
  },
  data() {
    return {
      username: ""
    };
  },
  methods: {
    validateUser() {
      axios
        .get("/api/user/" + this.username)
        .then(res => {
          console.log(res);
        })
        .catch(err => {
          console.log(err);
        });
    }
  }
};
</script>

<style>
</style>