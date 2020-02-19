<template>
  <div>
    <h3 class="font-weight-bold">Referees</h3>
    <hr class="my-2" />
    <pre>values: {{JSON.stringify(values, null, 2)}}</pre>
    <!-- <pre>$v: {{JSON.stringify($v, null, 2)}}</pre> -->
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>Full Name</th>
            <th>Organization</th>
            <th>Address</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Relationship</th>
            <th>Length of Relationship</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{`${entry.firstName} ${entry.middleName} ${entry.otherName}`}}</td>
          <td>{{entry.organization}}</td>
          <td>{{entry.address}}</td>
          <td>{{entry.phoneNo}}</td>
          <td>{{entry.email}}</td>
          <td>{{entry.relationship}}</td>
          <td>{{entry.lengthOfRelationship}}</td>
          <td>
            <a href="#" @click.prevent="()=>editEntry(entry.id)">
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
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="firstName">First Name</label>
          <input
            type="text"
            name="firstName"
            id="firstName"
            class="form-control"
            placeholder="First Name"
            v-model="$v.values.firstName.$model"
            :class="[validationClass('firstName')]"
          />
          <name-error path="firstName" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="middleName">Middle Name</label>
          <input
            type="text"
            name="middleName"
            id="middleName"
            class="form-control"
            placeholder="Middle Name"
            v-model="$v.values.middleName.$model"
          />
          <name-error path="middleName" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="otherNames">Other Name</label>
          <input
            type="text"
            name="otherNames"
            id="otherNames"
            class="form-control"
            placeholder="Other Name"
            v-model="$v.values.otherNames.$model"
          />
          <name-error path="otherNames" :v="$v" />
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
        />
        <div class="invalid-feedback">
          <required-error path="organization" :v="$v" />
          <alphanum-error path="organization" :v="$v" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="address">Address</label>
          <input
            type="date"
            name="address"
            id="address"
            class="form-control"
            placeholder="e.g. 010-00100, Nairobi"
            v-model="$v.values.address.$model"
          />
          <required-error path="address" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="phoneNo">Phone Number</label>
          <input
            type="telephone"
            name="phoneNo"
            id="phoneNo"
            class="form-control"
            placeholder="e.g. 07********"
            v-model="$v.values.phoneNo.$model"
          />
          <phone-no-error path="phoneNo" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="email">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            placeholder="e.g. name@example.com"
            v-model="$v.values.email.$model"
          />
          <email-error path="email" :v="$v" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="relationship">Relationship</label>
          <input
            type="text"
            name="relationship"
            id="relationship"
            class="form-control"
            placeholder="e.g. Supervisor"
            v-model="$v.values.relationship.$model"
          />
          <div class="invalid-feedback">
            <required-error path="relationship" :v="$v" />
            <alpha-error path="relationship" :v="$v" />
          </div>
        </div>
        <div class="form-group col-md-6">
          <label for="lengthOfRelationship">How long have known each other?</label>
          <input
            type="text"
            name="lengthOfRelationship"
            id="lengthOfRelationship"
            class="form-control"
            placeholder="e.g. 3 Years"
            v-model="$v.values.lengthOfRelationship.$model"
          />
          <alphnum-error path="lengthOfRelationship" :v="$v" />
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
const {
  required,
  alpha,
  numeric,
  alphaNum,
  email,
  minLength,
  maxLength,
  minValue,
  maxValue
} = require("vuelidate/lib/validators");
const { FormMixin } = require("./mixins");

const initialValues = {
  firstName: "",
  middleName: "",
  otherNames: "",
  organization: "",
  address: "",
  phoneNo: "",
  email: "",
  relationship: "",
  lengthOfRelationship: ""
};

export default {
  name: "RefereeForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...initialValues },
      entries: [],
      resourcePath: '/referees'
    };
  },
  validations: {
    values: {
      firstName: { required, alpha, minLength: minLength(2) },
      middleName: { required, alpha, minLength: minLength(2) },
      otherNames: { required, alpha, minLength: minLength(2) },
      organization: { required, alphaNum },
      address: { alphaNum },
      phoneNo: {
        required,
        numeric,
        minValue: minValue(10),
        maxValue: maxValue(10)
      },
      email: { required, email },
      relationship: { required, alpha },
      lengthOfRelationship: { required, alphaNum }
    }
  },
  created() {
    axios
      .get(this.resourcePath)
      .then(respnse => {console.log(response)})
      .catch(error => {console.error(response)});
  },
  methods: {
    handleSubmit: function() {
      axios
        .post(this.resourcePath, this.values)
        .then(response => {console.log(response)})
        .catch(error => {console.error(response)});
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