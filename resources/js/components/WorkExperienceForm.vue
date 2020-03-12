<template>
  <div>
    <h4 class="font-weight-bold">Work Experience</h4>
    <work-experience @edit-experience="values = $event"></work-experience>
    <form action method="POST" @submit.prevent="createWorkExperience" novalidate>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="from">From</label>
          <input
            type="date"
            name="from"
            id="from"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="$v.values.from.$model"
            :class="[validationClass('from')]"
          />
          <div class="invalid-feedback">
            <required-error path="position" :v="$v" />
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="to">To</label>
          <input
            type="date"
            name="to"
            id="to"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="$v.values.to.$model"
            :class="[validationClass('to')]"
          />
          <div class="invalid-feedback">
            <required-error path="position" :v="$v" />
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="position">Position</label>
          <input
            type="text"
            name="position"
            id="position"
            class="form-control"
            placeholder="e.g. Head of Security"
            v-model="$v.values.position.$model"
            :class="[validationClass('position')]"
          />
          <div class="invalid-feedback">
            <required-error path="position" :v="$v" />
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="organization">Organization</label>
          <input
            type="text"
            name="organization"
            id="organization"
            class="form-control"
            placeholder="e.g. JobWeb"
            v-model="$v.values.organization.$model"
            :class="[validationClass('organization')]"
          />
          <div class="invalid-feedback">
            <required-error path="position" :v="$v" />
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for>Roles & Responsibilities</label>
        <textarea
          type="text"
          name="roles"
          id="roles"
          class="form-control"
          placeholder="e.g. Conducting safety awareness training, etc."
          v-model="$v.values.roles.$model"
          :class="[validationClass('roles')]"
        ></textarea>
        <div class="invalid-feedback">
          <required-error path="position" :v="$v" />
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="submit" class="btn btn-secondary" @click="reset">Clear</button>
    </form>
  </div>
</template>

<script>
const { required } = require("vuelidate/lib/validators");
const { FormValidationMixin } = require("./mixins");
const WorkExperience = require("./WorkExperience").default;

const defaultValues = {
  from: "",
  to: "",
  position: "",
  organization: "",
  roles: ""
};

export default {
  name: "WorkExperienceForm",
  components: { WorkExperience },
  mixins: [FormValidationMixin],
  data() {
    return {
      values: { ...defaultValues },
      resourcePath: "/work-experience"
    };
  },
  methods: {
    createWorkExperience() {
      axios
        .post(this.resourcePath, this.values)
        .then(response => {
          //console.log(response);
          this.$root.$emit("experience-added", response.data.experience);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          //console.error(error.response);
          this.$notify({ type: "error", text: error.response.data.message });
        });
    },
    reset() {
      this.values = { ...defaultValues };
      this.$v.$reset();
    }
  },
  validations: {
    values: {
      from: { required },
      to: { required },
      position: { required },
      organization: { required },
      roles: { required }
    }
  }
};
</script>

<style scoped>
</style>