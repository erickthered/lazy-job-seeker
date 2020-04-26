<template>
  <v-container>
    <label for>Username</label>
    <v-text-field
      :disabled="isLoading || userData !== null"
      placeholder="enter your torre.co username"
      append-icon="mdi-account"
      @change="validateUser"
      @click:append="validateUser"
      v-model="username"
    />
    <v-progress-linear v-if="isLoading" indeterminate></v-progress-linear>
    <skills v-if="userData" :skills="userData.strengths" />
    <opportunities v-if="userData"/>
  </v-container>
</template>

<script>
import { mapActions } from "vuex";
import Skills from "./Skills";
import Opportunities from './Opportunities';

export default {
  name: "Username",
  components: {
    Skills, Opportunities
  },
  data() {
    return {
      isLoading: false,
      username: "",
      userData: null
    };
  },
  methods: {
    fetchJobs() {
        
    },
    validateUser() {
      this.isLoading = true;
      axios
        .get("/api/user/" + this.username)
        .then(res => {
          if (res.data.success) {
            this.userData = res.data.data;
          } else {
            this.userData = null;
          }
          this.isLoading = false;
        })
        .catch(err => {
            console.log(err);
          this.isLoading = false;
        })
    }
  }
};
</script>

<style>
</style>