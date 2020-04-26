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
    <skills v-if="userData" :userSkills="userData.strengths" />
    <opportunities v-if="userData" />
  </v-container>
</template>

<script>
import { mapActions, mapState } from "vuex";
import Skills from "./Skills";
import Opportunities from "./Opportunities";

export default {
  name: "Username",
  components: {
    Skills,
    Opportunities
  },
  data() {
    return {
      isLoading: false,
      username: "",
      userData: null
    };
  },
  methods: {
    ...mapActions(["clearSkills"]),
    validateUser() {
      let vm = this;
      vm.isLoading = true;
      axios
        .get("/api/user/" + vm.username)
        .then(res => {
          if (res.data.success) {
            vm.userData = res.data.data;
          } else {
            vm.userData = null;
          }
          vm.clearSkills();
          vm.isLoading = false;
        })
        .catch(err => {
          console.log('trapped error');
          console.log(err);
          vm.isLoading = false;
        });
    }
  }
};
</script>

<style>
</style>