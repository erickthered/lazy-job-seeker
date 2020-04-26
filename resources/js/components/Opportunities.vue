<template>
  <v-row>
    <v-col cols="6">
      <v-switch v-model="onlyRemote" label="Display only remote jobs"></v-switch>
    </v-col>
    <v-col cols="6">
      <v-btn color="indigo" dark @click="search">Search Opportunities</v-btn>
    </v-col>
    <v-col cols="12">
      <v-progress-linear v-if="isLoading" indeterminate></v-progress-linear>
      <v-tabs v-if="querySent">
        <v-tab @click="setType('full-time-employment')">Full-time Jobs</v-tab>
        <v-tab @click="setType('part-time-employment')">Part-time Jobs</v-tab>
        <v-tab @click="setType('freelance-gigs')">Freelance</v-tab>
        <v-tab @click="setType('internships')">Internships</v-tab>
      </v-tabs>
      <v-data-table v-if="querySent" :headers="columns" :items="items"></v-data-table>
    </v-col>
  </v-row>
</template>

<script>
import axios from "axios";

export default {
  name: "Opportunities",
  data() {
    return {
      onlyRemote: false,
      isLoading: false,
      querySent: false,
      currentType: "full-time-employment",
      columns: [
        {
          text: "Company",
          value: "organizations[0].name"
        },
        {
          text: "Title",
          value: "objective"
        },
        {
          text: "Location",
          value: "locations[0]"
        },
        {
          text: "Skills",
          value: "skills.length"
        },
        {
          text: "Match",
          value: ""
        },
        {
          text: "Remote",
          value: "remote"
        }
      ],
      items: []
    };
  },
  methods: {
    search() {
      this.isLoading = true;
      axios
        .post("/api/jobs/search", {
          type: this.currentType,
          remote: this.onlyRemote,
          skills: this.
        })
        .then(res => {
          if (res.data.success) {
            this.items = res.data.data.results;
          } else {
            this.items = [];
          }
          this.isLoading = false;
          this.querySent = true;
        })
        .catch(err => {
          console.log(err);
          this.isLoading = false;
        });
    },
    setType(type) {
      this.currentType = type;
      this.search();
    }
  }
};
</script>

<style>
</style>