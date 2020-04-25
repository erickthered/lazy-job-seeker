<template>
  <div>
    <v-chip class="ma-2" :color="skill.selected?'indigo':''" @click="toggleSelected">{{ skill.name }}</v-chip>
  </div>
</template>

<script>
export default {
  name: "Skill",
  props: {
    skill: {
      type: Object,
      required: true
    }
  },
  methods: {
    toggleSelected() {
      this.skill.selected = !this.skill.selected;
    }
  }
};
</script>

<style>
</style>