<template>
  <v-row>
    <v-col cols="12" style="max-height: 160px; overflow: auto">
        <div>
            Select your strongest skill(s):
        </div>
      <Skill
        v-for="skill in skills"
        :key="`skill-${skill.code}`"
        :skill="skill"
        @click="toggle"
      />
    </v-col>
  </v-row>
</template>

<script>
import Skill from "./Skill";

export default {
  name: "Skills",
  props: {
    skills: {
      type: Array,
      required: true
    }
  },
  components: {
    Skill
  },
  data() {
    return {
      value: []
    };
  },
  methods: {
    toggle(skill) {
      let idx = this.value.findIndex(item => {
        return item.code == skill.code;
      });
      if (idx < 0) {
        this.value.push(skill);
      } else {
        this.value.splice(idx, 1);
      }
    }
  }
};
</script>

<style>
</style>