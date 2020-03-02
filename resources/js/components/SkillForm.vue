<template>
  <div>
    <form action method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-group">
        <label for="skill">Add Skill</label>
        <input
          type="text"
          name="skill"
          id="skill"
          class="form-control"
          placeholder="e.g. Public speaking"
          v-model="$v.values.skill.$model"
          :class="[validationClass('skill')]"
        />
        <div class="invalid-feedback">
          <required-error path="skill" :v="$v" />
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</template>

<script>
const { required } = require("vuelidate/lib/validators");
const { FormMixin } = require("./mixins");

const defaultValues = {
  skill: ""
};

export default {
  name: "SkillForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...this.initialValues || defaultValues },
      resourcePrefix: '/skills'
    };
  },
  validations: {
    values: { skill: { required } }
  }
};
</script>

<style scoped>
</style>