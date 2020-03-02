<template>
  <div>
    <form action method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-group">
        <label for="institution">Institition</label>
        <input
          type="text"
          name="institution"
          id="institution"
          class="form-control"
          placeholder="e.g. University of Nairobi"
          v-model="$v.values.institution.$model"
          :class="[validationClass('institution')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="institution" />
        </div>
      </div>
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
            <required-error :v="$v" path="from" />
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="to">To</label>
          <input
            type="date"
            id="to"
            name="to"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="$v.values.to.$model"
            :class="[validationClass('to')]"
          />
          <div class="invalid-feedback">
            <required-error :v="$v" path="to" />
          </div>
        </div>
      </div>
      <div class="form-group">
        <label for="academicLevel">Academic Level</label>
        <input
          type="text"
          name="academicLevel"
          id="academicLevel"
          class="form-control"
          placeholder="e.g. Diploma"
          v-model="$v.values.academic_level.$model"
          :class="[validationClass('academic_level')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="academic_level" />
        </div>
      </div>
      <div class="form-group">
        <label for="course">Course of Study</label>
        <input
          type="text"
          name="course"
          id="course"
          class="form-control"
          placeholder="e.g. Mathematics and Computer Science"
          v-model="$v.values.course.$model"
          :class="[validationClass('course')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="course" />
        </div>
      </div>
      <div class="form-group">
        <label for="specialization">Specialization</label>
        <input
          type="text"
          name="specialization"
          id="specialization"
          class="form-control"
          placeholder="e.g. IT"
          v-model="$v.values.specialization.$model"
          :class="[validationClass('specialization')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="specialization" />
        </div>
      </div>
      <div class="form-group">
        <label for="grade">Qualification Grade</label>
        <input
          type="text"
          name="grade"
          id="grade"
          class="form-control"
          placeholder="eg. Distinction"
          v-model="$v.values.grade.$model"
          :class="[validationClass('grade')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="grade" />
        </div>
      </div>
      <div class="form-group">
        <label for="attachment">Attach Copy</label>
        <input
          type="file"
          name="attachment"
          id="attachment"
          class="form-control-file"
          @change="values.attachment = $event.target.files[0]"
        />
        <div class="invalid-feedback">
          <!-- <required-error :v="$v" path="attachment" /> -->
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
  institution: "",
  from: "",
  to: "",
  academic_level: "",
  course: "",
  specialization: "",
  grade: "",
  attachment: null
};

export default {
  name: "AcademicQualificationsForm",
  props: { eventBus: Vue, entry: Object },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...this.initialValues || defaultValues },
      resourcePrefix: "/academic-qualifications"
    };
  },
  validations: {
    values: {
      institution: { required },
      from: { required },
      to: { required },
      academic_level: { required },
      course: { required },
      specialization: { required },
      grade: { required }
    }
  }
};
</script>

<style scoped>
</style>