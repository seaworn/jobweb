<template>
  <div>
    <h4 class="font-weight-bold">Skills</h4>
    <skills></skills>
    <form action method="POST" @submit.prevent="createSkill" novalidate>
      <div class="form-group">
        <label for="skill">Add Skill</label>
        <input
          type="text"
          name="skill"
          id="skill"
          class="form-control"
          placeholder="e.g. Public speaking"
          v-model="$v.values.name.$model"
          :class="[validationClass('name')]"
        />
        <div class="invalid-feedback">
          <required-error path="name" :v="$v" />
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</template>

<script>
const { required } = require("vuelidate/lib/validators");
const { FormValidationMixin } = require("./mixins");
const Skills = require("./Skills").default;

const defaultValues = {
  name: ""
};

export default {
  name: "SkillForm",
  components: { Skills },
  mixins: [FormValidationMixin],
  data() {
    return {
      values: { ...defaultValues },
      resourcePath: "/skills"
    };
  },
  validations: {
    values: { name: { required } }
  },
  methods: {
    createSkill() {
      axios
        .post(this.resourcePath, this.values)
        .then(response => {
          // console.log(response);
          this.$root.$emit("skill-added", response.data.skill);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          // console.error(error.response);
          this.$notify({ type: "error", text: error.response.data.message });
        });
    },
    reset() {
      this.values = { ...defaultValues };
      this.$v.$reset();
    }
  }
};
</script>

<style scoped>
</style>