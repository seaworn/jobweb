<template>
  <div>
    <h4 class="font-weight-bold">Academic Qualifications</h4>
    <academic-qualifications @edit-education="values = $event"></academic-qualifications>
    <form action method="POST" @submit.prevent="createQualification" novalidate>
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
      <div class="form-row">
        <div class="form-group col-md-6">
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
        <div class="form-group col-md-6">
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
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
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
        <div class="form-group col-md-6">
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
      </div>
      <div class="form-row">
        <div class="form-group col-auto">
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
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="submit" class="btn btn-secondary" @click="reset">Clear</button>
    </form>
  </div>
</template>

<script>
const { required } = require("vuelidate/lib/validators");
const { FormValidationMixin } = require("./mixins");
const AcademicQualifications = require("./AcademicQualifications").default;

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
  components: { AcademicQualifications },
  mixins: [FormValidationMixin],
  data() {
    return {
      values: { ...defaultValues },
      resourcePrefix: "/academic-qualifications"
    };
  },
  methods: {
    createQualification() {
      const fd = new FormData();
      Object.keys(this.values).map(key => fd.append(key, this.values[key]));
      axios
        .post(this.resourcePrefix, fd)
        .then(response => {
          //console.log(response);
          this.$root.$emit("education-added", response.data.education);
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