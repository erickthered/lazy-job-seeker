<template>
  <v-row>
    <v-col cols="12" style="max-height: 160px; overflow: auto">
        <div>
            Select your strongest skill(s):
        </div>
      <Skill
        v-for="skill in userSkills"
        :key="`skill-${skill.code}`"
        :skill="skill"
        @click="toggle"
      />
    </v-col>
  </v-row>
</template>

<script>
import Skill from "./Skill";
import { mapActions, mapState } from 'vuex';

export default {
  name: "Skills",
  props: {
    userSkills: {
      type: Array,
      required: true
    }
  },
  components: {
    Skill
  },
  data() {
    return {
    };
  },
  computed: {
    ...mapState(['skills'])
  },
  methods: {
    ...mapActions(['addSkill', 'removeSkill']),
    toggle(skill) {
      let idx = this.skills.findIndex(item => {
        return item.code == skill.code;
      });
      console.log(idx);
      if (idx < 0) {
        this.addSkill(skill);
      } else {
        this.removeSkill(idx);
      }
    }
  }
};
</script>

<style>
</style>