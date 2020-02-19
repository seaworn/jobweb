<template>
  <div>
    <h3 class="font-weight-bold">Skills</h3>
    <hr class="my-2" />
    <pre>values: {{JSON.stringify(values, null, 2)}}</pre>
    <pre>$v.values.skill: {{JSON.stringify($v.values.skill, null, 2)}}</pre>
    <div class="d-flex flex-wrap">
      <div class="d-flex shadow p-2 m-1" v-for="entry in entries" :key="entry.id">
        <span>{{entry.skill}}</span>&nbsp;
        <button
          type="button"
          class="close"
          aria-label="Dismiss"
          @click="()=>deleteEntry(entry.id)"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
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
    <div class="d-flex flex-row-reverse">
      <button type="button" class="btn btn-success" @click="$emit('next')">Next</button>
    </div>
  </div>
</template>

<script>
const { required } = require("vuelidate/lib/validators");
const { FormMixin } = require("./mixins");

const initialValues = {
  skill: ""
};

export default {
  name: "SkillForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...initialValues },
      entries: [],
      resourcePath: '/skills'
    };
  },
  validations: {
    values: { skill: { required } }
  },
  created: function() {
    axios
      .get(this.resourcePath)
      .then(response => {
        this.entries = response.data;
        // console.log(this.entries);
      })
      .catch(error => {});
  },
  methods: {
    handleSubmit: function() {
      axios
        .post(this.resourcePath, this.values)
        .then(response => {
          this.entries.push(response.data.skill);
        })
        .catch(error => {
          console.error(error.response);
        });
      this.values = { ...initialValues };
      this.$v.$reset();
    },
    deleteEntry: function(id) {
      axios
        .delete(`${resourcePath}/${id}`)
        .then(response => {
          this.entries = this.entries.filter(entry => entry.id !== id);
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
};
</script>

<style scoped>
</style>