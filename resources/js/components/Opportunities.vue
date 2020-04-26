<template>
  <v-row>
    <v-col cols="6">
      <v-switch v-model="onlyRemote" label="Display only remote jobs"></v-switch>
    </v-col>
    <v-col cols="6">
      <v-btn color="indigo" dark @click="search">Search Opportunities</v-btn>
    </v-col>
    <v-col cols="12">
      <v-tabs v-if="querySent">
        <v-tab @click="setType('full-time-employment')">Full-time Jobs</v-tab>
        <v-tab @click="setType('part-time-employment')">Part-time Jobs</v-tab>
        <v-tab @click="setType('freelance-gigs')">Freelance</v-tab>
        <v-tab @click="setType('internships')">Internships</v-tab>
      </v-tabs>
      <v-progress-linear v-if="isLoading" indeterminate></v-progress-linear>
      <v-data-table
        v-if="!isLoading && querySent"
        @update:items-per-page="setSize"
        @update:page="setPage"
        @item-selected="displayOpportunity"
        :items-per-page="size"
        :headers="headers"
        :items="items"
        :server-items-length="totalItems"
      >
        <template v-slot:item.objective="{ item }">
          <v-icon v-if="item.remote">mdi-access-point</v-icon>
          {{ item.objective }}
        </template>
        <template v-slot:item.match="{ item }">
          <v-chip>{{ item.match }} %</v-chip>
        </template>
      </v-data-table>
    </v-col>
  </v-row>
</template>

<script>
import axios from "axios";
import { mapGetters, mapState, mapActions } from "vuex";

export default {
  name: "Opportunities",
  data() {
    return {
      page: 1,
      size: 10,
      offset: 0,
      totalItems: 0,
      onlyRemote: false,
      isLoading: false,
      querySent: false,
      currentType: "full-time-employment",
      headers: [
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
          value: "match"
        }
      ],
      items: []
    };
  },
  methods: {
    ...mapGetters(['getSkills']),
    ...mapActions(["calculateMatch"]),
    displayOpportunity(item) {
      axios.get('/api/jobs/' + item.id).then(
        res => {
          if (res.data.success) {
            console.log(res.data.data);
          }
        }
      )
    },
    search() {
      this.isLoading = true;
      axios
        .post("/api/jobs/search", {
          type: this.currentType,
          remote: this.onlyRemote,
          size: this.size,
          offset: this.offset,
          skills: this.getSkills()
        })
        .then(res => {
          if (res.data.success) {
            this.items = res.data.data.results;
            this.totalItems = res.data.data.total;
            this.page = res.data.data.offset / this.size + 1;
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
    setSize(q) {
      this.size = q;
      this.search();
    },
    setType(type) {
      this.currentType = type;
      this.search();
    },
    setPage(p) {
      this.page = p;
      this.search();
    }
  }
};
</script>

<style>
</style>