<template>
    <v-chip
      class="ma-2"
      :color="(selected === true)?'indigo':''"
      :text-color="(selected === true)?'white':''"
      @click="toggleSelected"
      small
    >{{ skill.name }}</v-chip>
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
  data() {
    return {
      selected: false
    };
  },
  methods: {
    toggleSelected() {
      this.selected = !this.selected ? true : false;
      this.$emit('click', this.skill);
    }
  }
};
</script>

<style>
</style>