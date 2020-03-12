<template>
  <div>
    <h4 class="font-weight-bold">Contact Person</h4>
    <form action method="POST" @submit.prevent="createContact" novalidate>
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
            placeholder="Other Name(s)"
            v-model="$v.values.other_names.$model"
            :class="[validationClass('other_names')]"
          />
          <name-error path="other_names" :v="$v" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
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
        <div class="form-group col-md-4">
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
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</template>

<script>
const { mapGetters } = require("vuex");
const {
  required,
  alpha,
  email,
  minLength,
  maxLength,
  numeric
} = require("vuelidate/lib/validators");
const { FormValidationMixin } = require("./mixins");

export const defaultValues = {
  full_name: "",
  first_name: "",
  middle_name: "",
  other_names: "",
  phone_no: "",
  email: ""
};

export default {
  name: "ContactPersonForm",
  mixins: [FormValidationMixin],
  data() {
    return {
      values: { ...defaultValues },
      resourcePathPrefix: `/contact-person`
    };
  },
  computed: {
    ...mapGetters(["session"])
  },
  created() {
    axios
      .get(this.resourcePathPrefix)
      .then(response => {
        // console.log(response);
        if (response.data) this.values = response.data;
      })
      .catch(error => {
        // console.error(error.response);
      });
  },
  methods: {
    createContact() {
      axios
        .post(this.resourcePathPrefix, this.values)
        .then(response => {
          // console.log(response);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          // console.error(error.response);
          this.$notify({ type: "error", text: response.data.message });
        });
    },
    reset() {
      this.values = { ...defaultValues };
      this.$v.$reset();
    }
  },
  validations: {
    values: {
      first_name: { required, alpha, minLength: minLength(2) },
      middle_name: { required, alpha, minLength: minLength(2) },
      other_names: { required, alpha, minLength: minLength(2) },
      phone_no: {
        required,
        numeric,
        maxLength: maxLength(10),
        minLength: minLength(10)
      },
      email: { required, email }
    }
  }
};
</script>

<style scoped>
</style>