<template>
  
  <div>
    <h3 class="font-weight-bold">Work Experience</h3>
    <hr class="my-2" />
    <pre>values: {{JSON.stringify(values, null, 2)}}</pre>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Position</th>
            <th>Organization</th>
            <th>Roles</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.from}}</td>
          <td>{{entry.to}}</td>
          <td>{{entry.position}}</td>
          <td>{{entry.organization}}</td>
          <td>{{entry.roles}}</td>
          <td>
            <a href="#" @click="()=>editEntry(entry)">
              <i class="fa fa-edit"></i>Edit
            </a>
            <a href="#" @click="()=>deleteEntry(entry.id)">
              <i class="fa fa-trash"></i>Delete
            </a>
          </td>
        </tr>
      </table>
    </div>

    <form action method="POST" @submit.prevent="addEntry" novalidate>
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
      <div class="d-flex flex-row-reverse">
        <button type="button" class="btn btn-success" @click="$emit('next')">Next</button>
      </div>
    </form>
  </div>
</template>

<script>
const { required } = require("vuelidate/lib/validators");
const { FormMixin } = require("./mixins");
const initialValues = {
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
      values: { ...initialValues },
      entries: [],
      resourcePath: '/work-experience'
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
  },
  created: function() {
    axios
      .get(this.resourcePath)
      .then(response => {console.log(response)})
      .catch(error => {console.error(response)})
  },
  methods: {
    addEntry: function() {
      axios
        .post(this.resourcePath, this.values)
        .then(response => {})
        .catch(error => {});
      this.values = { ...initialValues };
      this.$v.$reset();
    },
    deleteEntry: function(id) {
      axios
        .get(`${this.resourcePath}/${id}`)
        .then(response => {console.log(response)})
        .catch(error => {console.error(response)});
    },
    editEntry: function(entry) {}
  }
};
</script>

<style scoped>
</style>