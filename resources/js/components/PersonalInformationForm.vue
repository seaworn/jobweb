<template>
  <div>
    <h4 class="font-weight-bold">Personal Information</h4>
    <form action method="POST" @submit.prevent="createPersonalInfo" novalidate>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="firstName">First Name</label>
          <input
            type="text"
            name="firstName"
            id="firstName"
            class="form-control"
            placeholder="First Name"
            v-model.trim="$v.values.first_name.$model"
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
            v-model.trim="$v.values.middle_name.$model"
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
          <label for="dob">Date of Birth</label>
          <input
            type="date"
            name="dob"
            id="dob"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="$v.values.dob.$model"
            :class="[validationClass('dob')]"
          />
          <div class="invalid-feedback"></div>
        </div>
        <div class="form-group col-md-4">
          <p>Gender</p>
          <div class="form-check-inline">
            <input
              type="radio"
              name="gender"
              value="M"
              id="genderMale"
              class="form-check-input"
              v-model="$v.values.gender.$model"
            />
            <label for="genderMale" class="form-check-label">Male</label>
          </div>
          <div class="form-check-inline">
            <input
              type="radio"
              name="gender"
              value="F"
              id="genderFemale"
              class="form-check-input"
              v-model="$v.values.gender.$model"
            />
            <label for="genderFemale" class="form-check-label">Female</label>
          </div>
          <div class="form-check-inline">
            <input
              type="radio"
              name="gender"
              value="X"
              id="genderOther"
              class="form-check-input"
              v-model="$v.values.gender.$model"
            />
            <label for="genderOther" class="form-check-label">Other</label>
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="nationality">Nationality</label>
          <input
            type="text"
            name="nationality"
            id="nationality"
            class="form-control"
            placeholder="e.g. Kenyan"
            v-model="$v.values.nationality.$model"
            :class="[validationClass('nationality')]"
          />
          <div class="invalid-feedback">
            <required-error path="nationality" :v="$v" />
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="county">Home County</label>
          <input
            type="text"
            name="county"
            id="county"
            class="form-control"
            placeholder="e.g. Nairobi"
            v-model="$v.values.county.$model"
            :class="[validationClass('county')]"
          />
          <div class="invalid-feedback">
            <required-error path="county" :v="$v" />
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="subCounty">Sub-County</label>
          <input
            type="text"
            name="subCounty"
            id="subCounty"
            class="form-control"
            placeholder="e.g. Kasarani"
            v-model="$v.values.sub_county.$model"
            :class="[validationClass('sub_county')]"
          />
          <div class="invalid-feedback">
            <required-error path="sub_county" :v="$v" />
          </div>
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="address">Address</label>
          <input
            type="text"
            name="address"
            id="address"
            class="form-control"
            placeholder="e.g. 010-00100, Nairobi"
            v-model="$v.values.address.$model"
            :class="[validationClass('address')]"
          />
          <div class="invalid-feedback">
            <required-error path="address" :v="$v" />
          </div>
        </div>
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
      </div>
      <div class="form-group">
        <p>Do you have any form of disability?</p>
        <div class="form-check-inline">
          <input
            type="radio"
            name="disability"
            :value="true"
            id="disabilityTrue"
            class="form-check-input"
            v-model="$v.values.has_disability.$model"
          />
          <label for="disabilityTrue" class="form-check-label">Yes</label>
        </div>
        <div class="form-check-inline">
          <input
            type="radio"
            name="disability"
            :value="false"
            id="disabilityFalse"
            class="form-check-input"
            v-model="$v.values.has_disability.$model"
          />
          <label for="disabilityFalse" class="form-check-label">No</label>
        </div>
      </div>
      <div class="form-group" v-show="values.has_disability">
        <label for="disabilityDetails">If yes, please describe briefly</label>
        <textarea
          type="text"
          name="disabilityDetails"
          id="disabilityDetails"
          class="form-control"
          placeholder="e.g. Albinism, etc."
          v-model="$v.values.disability.$model"
          :class="[validationClass('disability')]"
        ></textarea>
        <div class="invalid-feedback">
          <required-error path="disability" :v="$v" />
        </div>
      </div>
      <div class="form-group">
        <p>Do you have a criminal record?</p>
        <div class="form-check-inline">
          <input
            type="radio"
            name="criminalRecord"
            :value="true"
            id="criminalRecordTrue"
            class="form-check-input"
            v-model="$v.values.has_criminal_record.$model"
          />
          <label for="criminalRecordTrue" class="form-check-label">Yes</label>
        </div>
        <div class="form-check-inline">
          <input
            type="radio"
            name="criminalRecord"
            :value="false"
            id="criminalRecordFalse"
            class="form-check-input"
            v-model="$v.values.has_criminal_record.$model"
          />
          <label for="criminalRecordFalse" class="form-check-label">No</label>
        </div>
      </div>
      <div class="form-group" v-show="values.has_criminal_record">
        <label for="criminalRecordDetails">If yes, please describe briefly</label>
        <textarea
          type="text"
          name="criminalRecordDetails"
          id="criminalRecordDetails"
          class="form-control"
          placeholder="e.g. Drunk driving, etc."
          v-model="$v.values.criminal_record.$model"
          :class="[validationClass('criminal_record')]"
        ></textarea>
        <div class="invalid-feedback">
          <required-error path="criminal_record" :v="$v" />
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
      <button type="submit" class="btn btn-secondary" @click="reset">Clear</button>
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
  numeric,
  minValue,
  requiredIf
} = require("vuelidate/lib/validators");
const { FormValidationMixin } = require("./mixins");

export const defaultValues = {
  full_name: "",
  first_name: "",
  middle_name: "",
  other_names: "",
  nationality: "",
  dob: "",
  gender: "M",
  address: "",
  phone_no: "",
  county: "",
  sub_county: "",
  has_disability: false,
  disability: "",
  has_criminal_record: false,
  criminal_record: ""
};

export default {
  name: "PersonalInformationForm",
  mixins: [FormValidationMixin],
  data() {
    return {
      values: { ...defaultValues },
      resourcePath: `/personal-information`
    };
  },
  computed: {
    ...mapGetters(["session"])
  },
  created() {
    axios
      .get(`/personal-information/${this.session.user.id}`)
      .then(response => {
        // console.log(response);
        if (response.data) this.values = response.data;
      })
      .catch(error => {
        // console.error(error.response);
      });
  },
  validations: {
    values: {
      first_name: { required, alpha, minLength: minLength(2) },
      middle_name: { required, alpha, minLength: minLength(2) },
      other_names: { required, alpha, minLength: minLength(2) },
      dob: { required, minValue: minValue(new Date()) },
      gender: { required },
      nationality: { required, alpha },
      address: { required },
      phone_no: {
        required,
        numeric,
        maxLength: maxLength(10),
        minLength: minLength(10)
      },
      county: { required, alpha },
      sub_county: { required, alpha },
      has_disability: {},
      disability: { requiredIfHasDisability: requiredIf("has_disability") },
      has_criminal_record: {},
      criminal_record: {
        requiredIfHasCriminalRecord: requiredIf("has_criminal_record")
      }
    }
  },
  methods: {
    createPersonalInfo() {
      axios
        .post(this.resourcePath, this.values)
        .then(response => {
          // console.log(response);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          console.error(error.response);
          this.$notify({ type: "error", text: response.data.message });
          //
        });
    },
    reset() {
      this.values = { ...defaultValues };
      this.$v.$reset();
    }
  }
};
</script>

<style scoped>
</style>