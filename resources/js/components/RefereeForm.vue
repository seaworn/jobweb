<template>
  <div>
    <h4 class="font-weight-bold">Referees</h4>
    <referees @edit-referee="values = $event"></referees>
    <form action method="POST" @submit.prevent="createReferee" novalidate>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="firstName">First Name</label>
          <input
            type="text"
            name="firstName"
            id="firstName"
            class="form-control"
            placeholder="First Name"
            v-model="$v.values.first_name.$model"
            :class="[validationClass('first_name')]"
          />
          <name-error path="first_name" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="middleName">Middle Name</label>
          <input
            type="text"
            name="middleName"
            id="middleName"
            class="form-control"
            placeholder="Middle Name"
            v-model="$v.values.middle_name.$model"
            :class="[validationClass('middle_name')]"
          />
          <name-error path="middle_name" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="otherNames">Other Name</label>
          <input
            type="text"
            name="otherNames"
            id="otherNames"
            class="form-control"
            placeholder="Other Name"
            v-model="$v.values.other_names.$model"
            :class="[validationClass('other_names')]"
          />
          <name-error path="other_names" :v="$v" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="phoneNo">Phone Number</label>
          <input
            type="telephone"
            name="phoneNo"
            id="phoneNo"
            class="form-control"
            placeholder="e.g. 07********"
            v-model="$v.values.phone_no.$model"
            :class="[validationClass('phone_no')]"
          />
          <phone-no-error path="phone_no" :v="$v" />
        </div>
        <div class="form-group col-md-6">
          <label for="email">Email</label>
          <input
            type="email"
            name="email"
            id="email"
            class="form-control"
            placeholder="e.g. name@example.com"
            v-model="$v.values.email.$model"
            :class="[validationClass('email')]"
          />
          <email-error path="email" :v="$v" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-6">
          <label for="occupation">Occupation</label>
          <input
            type="text"
            name="occupation"
            id="occupation"
            class="form-control"
            placeholder="e.g. Religious Leader"
            v-model="$v.values.occupation.$model"
            :class="[validationClass('occupation')]"
          />
          <div class="invalid-feedback">
            <required-error path="occupation" :v="$v" />
            <alphanum-error path="occupation" :v="$v" />
          </div>
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
            :class="[validationClass('relationship')]"
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
            v-model="$v.values.length_of_relationship.$model"
            :class="[validationClass('length_of_relationship')]"
          />
          <alphanum-error path="length_of_relationship" :v="$v" />
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="submit" class="btn btn-secondary" @click="reset">Clear</button>
    </form>
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
  maxLength
} = require("vuelidate/lib/validators");
const { FormValidationMixin } = require("./mixins");
const Referees = require("./Referees").default;

const defaultValues = {
  first_name: "",
  middle_name: "",
  other_names: "",
  occupation: "",
  phone_no: "",
  email: "",
  relationship: "",
  length_of_relationship: ""
};

export default {
  name: "RefereeForm",
  components: { Referees },
  mixins: [FormValidationMixin],
  data() {
    return {
      values: { ...defaultValues },
      resourcePath: "/referees"
    };
  },
  methods: {
    createReferee() {
      axios
        .post(this.resourcePath)
        .then(response => {
          //console.log(response);
          this.$root.$emit("referee-added", response.data.referee);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          //console.error(error.response);
          this.$notify({ type: "error", text: error.response.data.message });
        });
    },
    reset() {
      this.values = { ...defaultValues };
      this.$v.reset();
    }
  },
  validations: {
    values: {
      first_name: { required, alpha, minLength: minLength(2) },
      middle_name: { required, alpha, minLength: minLength(2) },
      other_names: { required, alpha, minLength: minLength(2) },
      occupation: { required, alphaNum },
      phone_no: {
        required,
        numeric,
        minLength: minLength(10),
        maxLength: maxLength(10)
      },
      email: { required, email },
      relationship: { required, alpha },
      length_of_relationship: { required, alphaNum }
    }
  }
};
</script>

<style scoped>
</style>