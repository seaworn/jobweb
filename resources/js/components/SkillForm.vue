<template>
  <div>
    <h3 class="font-weight-bold">Skills</h3>
    <hr class="my-2" />
    <pre>formData: {{JSON.stringify(formData, null, 2)}}</pre>

    <form action="" method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-group">
        <label for="skill">Add Skill</label>
        <input
          type="text"
          name="skill"
          id="skill"
          class="form-control"
          placeholder="e.g. Public speaking"
          v-model="skill"
        />
      </div>
      <button type="button" class="btn btn-primary" @click="addSkill">Add</button>
      <div style="display: flex; flex-direction: row-reverse;">
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'SkillForm',
  props: { eventBus: Vue },
  data() {
    return {
      formId: 'skills',
      skill: '',
      formData: {skills: []},
    }
  },
  methods: {
    addSkill() {
      this.formData.skills.push(this.skill);
      this.skill = '';
    },
    handleSubmit() {this.$emit('validated', this);}
  }
}
</script>

<style scoped>
</style>