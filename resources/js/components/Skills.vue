<template>
  <v-row>
    <v-col cols="12">
      <Skill v-for="skill in skills" :key="`skill-${skill.code}`" :skill="skill" />
    </v-col>
  </v-row>
</template>

<script>
import Skill from "./Skill";

export default {
  name: "Skills",
  components: {
    Skill
  },
  data() {
    return {
      skills: [
        {
          code: "123",
          name: "Laravel",
          selected: true
        },
        {
          code: "124",
          name: "MongoDB",
          selected: false
        },
        {
          code: "125",
          name: "Node.js",
          selected: false
        }
      ]
    };
  }
};
</script>

<style>
</style>