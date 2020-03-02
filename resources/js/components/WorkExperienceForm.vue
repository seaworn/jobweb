<template>
  <div>
    <form action method="POST" @submit.prevent="handleSubmit" novalidate>
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
      <div class="form-group">
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
      <div class="form-group">
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
    </form>
  </div>
</template>

<script>
const { required } = require("vuelidate/lib/validators");
const { FormMixin } = require("./mixins");

const defaultValues = {
  from: "",
  to: "",
  position: "",
  organization: "",
  roles: ""
};

export default {
  name: "WorkExperienceForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...this.initialValues || defaultValues },
      resourcePrefix: "/work-experience"
    };
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