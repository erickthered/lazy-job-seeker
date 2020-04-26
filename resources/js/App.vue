<template>
  <v-app id="lazy-job-seeker">
    <v-app-bar app dark color="indigo">
      <v-toolbar-title>Page title</v-toolbar-title>
    </v-app-bar>

    <v-content>
      <v-container>
        <router-view></router-view>
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
export default {
  name: "App",
  component: {}
};
</script>

<style>
</style>