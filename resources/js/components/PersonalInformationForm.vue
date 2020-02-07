<template>
  <div>
    <h3 class="font-weight-bold">Personal Information</h3>
    <hr class="my-2" />
    <pre>formData: {{JSON.stringify(formData, null, 2)}}</pre>
    <!-- <pre>$v: {{$v}}</pre> -->

      
    <form action="" method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="firstName">First Name</label>
          <input
            type="text"
            name="firstName"
            id="firstName"
            class="form-control"
            placeholder="First Name"
            v-model.trim="$v.formData.firstName.$model"
            :class="[$v.formData.firstName.$error ? 'is-invalid' : $v.formData.firstName.$dirty ? 'is-valid' : '']"
          />
          <div class="invalid-feedback">
            <span v-if="!$v.formData.firstName.required && $v.formData.firstName.$dirty">This field is required.</span>
            <span v-if="!$v.formData.firstName.alpha">Only letters allowed.</span>
            <span v-if="!$v.formData.firstName.minLength">Must be atleast {{$v.formData.firstName.$params.minLength.min}} characters.</span>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="middleName">Middle Name</label>
          <input
            type="text"
            name="middleName"
            id="middleName"
            class="form-control"
            placeholder="Middle Name"
            v-model.trim="$v.formData.middleName.$model"
            :class="[$v.formData.middleName.$error ? 'is-invalid' : $v.formData.middleName.$dirty ? 'is-valid' : '']"
          />
          <div class="invalid-feedback">
            <span v-if="!$v.formData.middleName.required && $v.formData.middleName.$dirty">This field is required.</span>
            <span v-if="!$v.formData.middleName.alpha">Only letters allowed.</span>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="otherName">Other Name</label>
          <input
            type="text"
            name="otherName"
            id="otherName"
            class="form-control"
            placeholder="Other Name(s)"
            v-model="$v.formData.otherName.$model"
            :class="[$v.formData.otherName.$error ? 'is-invalid' : $v.formData.otherName.$dirty ? 'is-valid' : '']"
          />
          <div class="invalid-feedback">
            <span v-if="!$v.formData.otherName.required && $v.formData.otherName.$dirty">This field is required.</span>
            <span v-if="!$v.formData.otherName.alpha">Only letters allowed.</span>
          </div>
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
            v-model="$v.formData.dob.$model"
            :class="[$v.formData.dob.$error ? 'is-invalid' : $v.formData.dob.$dirty ? 'is-valid' : '']"
          />
          <div class="invalid-feedback">
            
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
            v-model="$v.formData.nationality.$model"
            :class="[$v.formData.nationality.$error ? 'is-invalid' : $v.formData.nationality.$dirty ? 'is-valid' : '']"
          />
          <div class="invalid-feedback">
            
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
            v-model="formData.county"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="subCounty">Sub-County</label>
          <input
            type="text"
            name="subCounty"
            id="subCounty"
            class="form-control"
            placeholder="e.g. Kasarani"
            v-model="formData.subCounty"
          />
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
            v-model="formData.address"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="phoneNo">Phone Number</label>
          <input
            type="telephone"
            name="phoneNo"
            id="phoneNo"
            class="form-control"
            placeholder="e.g. 07********"
            v-model="$v.formData.phoneNo.$model"
            :class="[$v.formData.phoneNo.$error ? 'is-invalid' : $v.formData.phoneNo.$dirty ? 'is-valid' : '']"
          />
          <div class="invalid-feedback">
            <span v-if="!$v.formData.phoneNo.required && $v.formData.email.$dirty">This field is required.</span>
            <span v-if="!$v.formData.phoneNo.numeric || !$v.formData.phoneNo.maxLength || !$v.formData.phoneNo.minLength">Enter a valid phone number.</span>
          </div>
        </div>
        <div class="form-group col-md-4">
          <label for="email">Email</label>
          <input
            type="text"
            name="email"
            id="email"
            class="form-control"
            placeholder="e.g. name@example.com"
            v-model="$v.formData.email.$model"
            :class="[$v.formData.email.$error ? 'is-invalid' : $v.formData.email.$dirty ? 'is-valid' : '']"
          />
          <div class="invalid-feedback">
            <span v-if="!$v.formData.email.required && $v.formData.email.$dirty">This field is required.</span>
            <span v-if="!$v.formData.email.email">Enter a valid email.</span>
          </div>
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
            v-model="formData.disability.has"
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
            v-model="formData.disability.has"
          />
          <label for="disabilityFalse" class="form-check-label">No</label>
        </div>
      </div>
      <div class="form-group" v-show="formData.disability.has">
        <label for="disabilityDetails">If yes, please describe briefly</label>
        <textarea
          type="text"
          name="disabilityDetails"
          id="disabilityDetails"
          class="form-control"
          placeholder="e.g. Albinism, etc."
          v-model="formData.disability.details"
        ></textarea>
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
            v-model="formData.criminalRecord.has"
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
            v-model="formData.criminalRecord.has"
          />
          <label for="criminalRecordFalse" class="form-check-label">No</label>
        </div>
      </div>
      <div class="form-group" v-show="formData.criminalRecord.has">
        <label for="criminalRecordDetails">If yes, please describe briefly</label>
        <textarea
          type="text"
          name="criminalRecordDetails"
          id="criminalRecordDetails"
          class="form-control"
          placeholder="e.g. Drunk driving, etc."
          v-model="formData.criminalRecord.details"
        ></textarea>
      </div>
      <p>Contact Person Details</p>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="contactPersonFirstName">First Name</label>
          <input
            type="text"
            name="[contactPerson.FirstName]"
            id="contactPersonFirstName"
            class="form-control"
            placeholder="First Name"
            v-model="formData.contactPerson.firstName"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="contactPersonMiddleName">Middle Name</label>
          <input
            type="text"
            name="contactPersonMiddleName"
            id="contactPersonMiddleName"
            class="form-control"
            placeholder="Middle Name"
            v-model="formData.contactPerson.middleName"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="contactPersonOtherName">Other Name</label>
          <input
            type="text"
            name="contactPersonOtherName"
            id="contactPersonOtherName"
            class="form-control"
            placeholder="Other Name(s)"
            v-model="formData.contactPerson.otherName"
          />
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
            v-model="formData.contactPerson.phoneNo"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="contactPersonEmail">Email</label>
          <input
            type="email"
            name="contactPersonEmail"
            id="contactPersonEmail"
            class="form-control"
            placeholder="e.g. name@example.com"
            v-model="formData.contactPerson.email"
          />
        </div>
      </div>
      <div style="display: flex; flex-direction: row-reverse;">
        <button type="submit" class="btn btn-success" :disabled="$v.formData.$anyError">Next</button>
      </div>
    </form>
  </div>
</template>

<script>
const {required, alpha, email, minLength, maxLength, numeric, minValue} = require('vuelidate/lib/validators')

export default {
  name: 'PersonalInformationForm',
  props: {eventBus: Vue},
  data() {
    return {
      formId: 'personalInfo',
      formData: {
        firstName: '',
        middleName: '',
        nationality: '',
        dob: '',
        address: '',
        email: '',
        phoneNo: '',
        county: '',
        subCounty: '',
        disability: {
          has: false,
          details: ''
        },
        criminalRecord: {
          has: false,
          details: ''
        },
        contactPerson: {
          firstName: '',
          middleName: '',
          otherName: '',
          phoneNo: '',
          email: ''
        }
      }
    }
  },
  validations: {
    formData: {
      firstName: {
        required,
        alpha,
        minLength: minLength(2)
      },
      middleName: {
        required,
        alpha,
        minLength: minLength(2)
      },
      otherName: {
        required,
        alpha,
        minLength: minLength(2)
      },
      dob: {
        minValue: minValue(Date.now())
      },
      nationality: {
        alpha
      },
      address: {
        required
      },
      email: {
        required,
        email
      },
      phoneNo: {
        required,
        numeric,
        maxLength: maxLength(10),
        minLength: minLength(10)
      },
      county: {
        required,
        alpha
      },
      subCounty: {
        required,
        alpha
      },
      disability: {
        has: {
          required
        },
        details: {

        }
      },
      criminalRecord: {
        has: {
          required
        },
        details: {

        }
      },
      contactPerson: {
        firstName: {
          required,
          alpha,
          minLength: minLength(2)
        },
        middleName: {
          required,
          alpha,
          minLength: minLength(2)
        },
        otherName: {
          required,
          alpha,
          minLength: minLength(2)
        },
        phoneNo: {
          required,
          numeric,
          maxLength: maxLength(10),
          minLength: minLength(10)
        },
        email: {
          email
        }
      }
    }
  },
  methods: {
    handleSubmit() {this.$emit('validated', this)}
  }
};
</script>

<style scoped>
</style>