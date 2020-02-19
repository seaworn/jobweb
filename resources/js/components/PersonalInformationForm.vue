<template>
  <div>
    <h3 class="font-weight-bold">Personal Details</h3>
    <hr class="my-2" />
    <!-- <pre>values: {{JSON.stringify(values, null, 2)}}</pre> -->
    <!-- <pre>$v: {{$v}}</pre> -->
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
            v-model.trim="$v.values.firstName.$model"
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
            v-model.trim="$v.values.middleName.$model"
            :class="[validationClass('middleName')]"
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
            placeholder="Other Name(s)"
            v-model="$v.values.otherNames.$model"
            :class="[validationClass('otherNames')]"
          />
          <name-error path="otherNames" :v="$v" />
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
            v-model="$v.values.subCounty.$model"
            :class="[validationClass('subCounty')]"
          />
          <div class="invalid-feedback">
            <required-error path="subCounty" :v="$v" />
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
            v-model="$v.values.phoneNo.$model"
            :class="[validationClass('phoneNo')]"
          />
          <phone-no-error path="phoneNo" :v="$v" />
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
            v-model="$v.values.disability.has.$model"
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
            v-model="$v.values.disability.has.$model"
          />
          <label for="disabilityFalse" class="form-check-label">No</label>
        </div>
      </div>
      <div class="form-group" v-show="values.disability.has">
        <label for="disabilityDetails">If yes, please describe briefly</label>
        <textarea
          type="text"
          name="disabilityDetails"
          id="disabilityDetails"
          class="form-control"
          placeholder="e.g. Albinism, etc."
          v-model="$v.values.disability.details.$model"
          :class="[validationClass('disability.details')]"
        ></textarea>
        <div class="invalid-feedback">
          <required-error path="disability.details" :v="$v" />
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
            v-model="$v.values.criminalRecord.has.$model"
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
            v-model="$v.values.criminalRecord.has.$model"
          />
          <label for="criminalRecordFalse" class="form-check-label">No</label>
        </div>
      </div>
      <div class="form-group" v-show="values.criminalRecord.has">
        <label for="criminalRecordDetails">If yes, please describe briefly</label>
        <textarea
          type="text"
          name="criminalRecordDetails"
          id="criminalRecordDetails"
          class="form-control"
          placeholder="e.g. Drunk driving, etc."
          v-model="$v.values.criminalRecord.details.$model"
          :class="[validationClass('criminalRecord.details')]"
        ></textarea>
        <div class="invalid-feedback">
          <required-error path="criminalRecord.details" :v="$v" />
        </div>
      </div>
      <h3 class="font-weight-bold">Contact Person Details</h3>
      <hr class="my-2" />
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="contactPersonFirstName">First Name</label>
          <input
            type="text"
            name="contactPersonFirstName"
            id="contactPersonFirstName"
            class="form-control"
            placeholder="First Name"
            v-model="$v.values.contactPerson.firstName.$model"
            :class="[validationClass('contactPerson.firstName')]"
          />
          <name-error path="contactPerson.firstName" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="contactPersonMiddleName">Middle Name</label>
          <input
            type="text"
            name="contactPersonMiddleName"
            id="contactPersonMiddleName"
            class="form-control"
            placeholder="Middle Name"
            v-model="$v.values.contactPerson.middleName.$model"
            :class="[validationClass('contactPerson.middleName')]"
          />
          <name-error path="contactPerson.middleName" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="contactPersonOtherNames">Other Name</label>
          <input
            type="text"
            name="contactPersonOtherNames"
            id="contactPersonOtherNames"
            class="form-control"
            placeholder="Other Name(s)"
            v-model="$v.values.contactPerson.otherNames.$model"
            :class="[validationClass('contactPerson.otherNames')]"
          />
          <name-error path="contactPerson.otherNames" :v="$v" />
        </div>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="contactPersonPhoneNo">Phone Number</label>
          <input
            type="telephone"
            name="contactPersonPhoneNo"
            id="contactPersonPhoneNo"
            class="form-control"
            placeholder="e.g. 07********"
            v-model="$v.values.contactPerson.phoneNo.$model"
            :class="[validationClass('contactPerson.phoneNo')]"
          />
          <phone-no-error path="contactPerson.phoneNo" :v="$v" />
        </div>
        <div class="form-group col-md-4">
          <label for="contactPersonEmail">Email</label>
          <input
            type="email"
            name="contactPersonEmail"
            id="contactPersonEmail"
            class="form-control"
            placeholder="e.g. name@example.com"
            v-model="$v.values.contactPerson.email.$model"
            :class="[validationClass('contactPerson.email')]"
          />
          <email-error path="contactPerson.email" :v="$v" />
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
  email,
  minLength,
  maxLength,
  numeric,
  minValue,
  requiredIf
} = require("vuelidate/lib/validators");
const { FormMixin } = require("./mixins");

const initialValues = {
  firstName: "",
  middleName: "",
  otherNames: "",
  nationality: "",
  dob: "",
  gender: "M",
  address: "",
  phoneNo: "",
  county: "",
  subCounty: "",
  disability: {
    has: false,
    details: ""
  },
  criminalRecord: {
    has: false,
    details: ""
  },
  contactPerson: {
    firstName: "",
    middleName: "",
    otherNames: "",
    phoneNo: "",
    email: ""
  }
};

export default {
  name: "PersonalInformationForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...initialValues },
      resourcePath: `/personal-information`
    };
  },
  validations: {
    values: {
      firstName: { required, alpha, minLength: minLength(2) },
      middleName: { required, alpha, minLength: minLength(2) },
      otherNames: { required, alpha, minLength: minLength(2) },
      dob: { required, minValue: minValue(new Date()) },
      gender: { required },
      nationality: { required, alpha },
      address: { required },
      phoneNo: {
        required,
        numeric,
        maxLength: maxLength(10),
        minLength: minLength(10)
      },
      county: { required, alpha },
      subCounty: { required, alpha },
      disability: {
        has: { required },
        details: { requiredIfHasDisability: requiredIf("has") }
      },
      criminalRecord: {
        has: { required },
        details: { requiredIfHasCriminalRecord: requiredIf("has") }
      },
      contactPerson: {
        firstName: { required, alpha, minLength: minLength(2) },
        middleName: { required, alpha, minLength: minLength(2) },
        otherNames: { required, alpha, minLength: minLength(2) },
        phoneNo: {
          required,
          numeric,
          maxLength: maxLength(10),
          minLength: minLength(10)
        },
        email: { required, email }
      }
    }
  },
  methods: {
    
  }
};
</script>

<style scoped>
</style>