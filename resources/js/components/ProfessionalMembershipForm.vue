<template>
  <div>
    <h4 class="font-weight-bold">Professional Memberships</h4>
    <professional-memberships @edit-membership="values = $event"></professional-memberships>
    <form action method="POST" @submit.prevent="createMembership" novalidate>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="professionalBody">Professional Body</label>
          <input
            type="text"
            name="professionalBody"
            id="professionalBody"
            class="form-control"
            placeholder="e.g. Institution of Engineers of Kenya"
            v-model="$v.values.professional_body.$model"
            :class="[validationClass('professional_body')]"
          />
          <div class="invalid-feedback">
            <required-error :v="$v" path="professional_body" />
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="regNo">Reg. No</label>
          <input
            type="text"
            name="regNo"
            id="regNo"
            class="form-control"
            placeholder="Registration number"
            v-model="$v.values.reg_no.$model"
            :class="[validationClass('reg_no')]"
          />
          <div class="invalid-feedback">
            <required-error :v="$v" path="reg_no" />
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="membershipType">Membership Type</label>
          <input
            type="text"
            name="membershipType"
            id="membershipType"
            class="form-control"
            placeholder="e.g. Consultant"
            v-model="$v.values.membership_type.$model"
            :class="[validationClass('membership_type')]"
          />
          <div class="invalid-feedback">
            <required-error :v="$v" path="membership_type" />
          </div>
        </div>
      </div>
      <div class="form-row d-flex align-items-center">
        <div class="form-group col-md-4">
          <label for="registered_on">Registration Date</label>
          <input
            type="date"
            name="registered_on"
            id="registered_on"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="$v.values.registered_on.$model"
            :class="[validationClass('registered_on')]"
          />
          <div class="invalid-feedback">
            <!-- <required-error :v="$v" path="registered_on.when" /> -->
          </div>
        </div>
        <div class="form-group col-md-4" v-if="values.expires">
          <label for="expiry">Expiry Date</label>
          <input
            type="date"
            name="expiry"
            id="expiry"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="$v.values.expiry.$model"
            :class="[validationClass('expiry')]"
          />
          <div class="invalid-feedback">
            <!-- <required-error :v="$v" path="expiry" /> -->
          </div>
        </div>
        <div class="form-group form-check-inline col-md-4">
          <input
            type="checkbox"
            id="expiresToggle"
            class="form-check-input"
            :value="values.expires"
            :checked="!values.expires"
            @change="values.expires = !values.expires"
          />
          <label for="expiresToggle" class="form-check-label">Does not expire</label>
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="submit" class="btn btn-secondary" @click="reset">Clear</button>
    </form>
  </div>
</template>

<script>
const { required, requiredIf } = require("vuelidate/lib/validators");
const { FormValidationMixin } = require("./mixins");
const ProfessionalMemberships = require("./ProfessionalMemberships").default;

const defaultValues = {
  professional_body: "",
  reg_no: "",
  membership_type: "",
  registered_on: "",
  expires: true,
  expiry: ""
};

export default {
  name: "ProfessionalMembershipForm",
  components: { ProfessionalMemberships },
  mixins: [FormValidationMixin],
  data() {
    return {
      values: { ...defaultValues },
      resourcePath: "/professional-memberships"
    };
  },
  methods: {
    createMembership() {
      axios
        .post(this.resourcePath, values)
        .then(response => {
          //console.log(response);
          this.$root.$emit("membership-added", response.data.membership);
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
      professional_body: { required },
      reg_no: { required },
      membership_type: { required },
      registered_on: { required },
      expires: {},
      expiry: { requiredIf: requiredIf("expires") }
    }
  }
};
</script>

<style scoped>
</style>