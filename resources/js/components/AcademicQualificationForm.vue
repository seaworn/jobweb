<template>
  <div>
    <h3 class="font-weight-bold">Academic Qualifications</h3>
    <hr class="my-2" />
    <pre>values: {{JSON.stringify(values, null, 2)}}</pre>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>Institution</th>
            <th>From</th>
            <th>To</th>
            <th>Academic Level</th>
            <th>Course of Study</th>
            <th>Specialization</th>
            <th>Qualification Grade</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.institution}}</td>
          <td>{{entry.from}}</td>
          <td>{{entry.to}}</td>
          <td>{{entry.academic_level}}</td>
          <td>{{entry.course}}</td>
          <td>{{entry.specialization}}</td>
          <td>{{entry.grade}}</td>
          <td>
            <a href="#" @click.prevent="()=>editEntry(entry)">
              <i class="fa fa-edit"></i>Edit
            </a>
            <a href="#" @click.prevent="()=>deleteEntry(entry.id)">
              <i class="fa fa-trash"></i>Delete
            </a>
          </td>
        </tr>
      </table>
    </div>

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
          v-model="$v.values.academicLevel.$model"
          :class="[validationClass('academicLevel')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="academicLevel" />
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
        <label for="file">Attach Copy</label>
        <input
          type="file"
          name="file"
          id="file"
          class="form-control-file"
          @change="file = $event.target.files[0]"
        />
        <div class="invalid-feedback">
          <!-- <required-error :v="$v" path="file" /> -->
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
  institution: "",
  from: "",
  to: "",
  academicLevel: "",
  course: "",
  specialization: "",
  grade: "",
  file: null
};

export default {
  name: "AcademicQualificationsForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...initialValues },
      entries: [],
      resourcePath: "/academic-qualifications"
    };
  },
  validations: {
    values: {
      institution: { required },
      from: { required },
      to: { required },
      academicLevel: { required },
      course: { required },
      specialization: { required },
      grade: { required }
    }
  },
  created: function() {
    axios
      .get(this.resourcePath)
      .then(response => {
        this.entries = response.data;
      })
      .catch(error => {});
  },
  methods: {
    handleSubmit: function() {
      const fd = new FormData();
      const data = Object.keys(this.values).map(key => fd.append(key, this.values[key]));
      axios
        .post(this.resourcePath, fd, {headers: {'Content-Type': 'multipart/form-data'}})
        .then(response => {
          // console.log(response);
          this.$notify({type: 'success', text: response.data.message});
        })
        .catch(error => {
          // console.log(error.response);
          this.$notify({type: 'error', text: error.response.data.message});
        });
      this.values = { ...initialValues };
      this.$v.$reset();
    },
    editEntry: function(entry) {},
    deleteEntry: function(id) {}
  }
};
</script>

<style scoped>
</style>