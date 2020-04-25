<template>
  <v-container>
    <label for>Username</label>
    <v-text-field
    placeholder="enter your torre.co username"
    append-icon="mdi-account"
    @change="fetchUser"
    @click:append="fetchUser"
    v-model="username"
    />
  </v-container>
</template>

<script>
export default {
  name: "Username",
  data() {
      return {
          username: ''
      }
  },
  methods: {
      fetchUser() {
          console.log(this.username);
      }
  }
};
</script>

<style>
</style>