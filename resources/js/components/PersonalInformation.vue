<template>
  <div>
    <div v-if="!showForm">
      <div class="d-flex justify-content-between">
        <h4 class="font-weight-bold">Personal Information</h4>
        <button class="btn bg-light text-primary" @click="showForm = true" v-if="!showForm">
          <i class="fa fa-edit" />&nbsp;Edit
        </button>
      </div>
      <div class="row">
        <div class="col-6">Full Name:</div>
        <div class="col-6">{{personalInformation.full_name}}</div>
      </div>
      <div class="row">
        <div class="col-6">Date of Birth:</div>
        <div class="col-6">{{personalInformation.dob}}</div>
      </div>
      <div class="row">
        <div class="col-6">Address:</div>
        <div class="col-6">{{personalInformation.address}}</div>
      </div>
      <div class="row">
        <div class="col-6">Phone Number:</div>
        <div class="col-6">{{personalInformation.phone_no}}</div>
      </div>
      <div class="row">
        <div class="col-6">Disablity:</div>
        <div class="col-6">{{personalInformation.disability}}</div>
      </div>
      <div class="row">
        <div class="col-6">Criminal Record:</div>
        <div class="col-6">{{personalInformation.criminal_record}}</div>
      </div>
    </div>
    <div v-if="showForm">
      <personal-information-form :initial-values="personalInformation" @saved="showForm = false" />
    </div>
  </div>
</template>

<script>
const { mapGetters } = require("vuex");
const {
  default: PersonalInformationForm,
  defaultValues
} = require("./PersonalInformationForm");

export default {
  components: { PersonalInformationForm },
  data: function() {
    return {
      ...mapGetters(["session"]),
      personalInformation: { ...defaultValues },
      showForm: false
    };
  },
  created() {
    axios
      .get(`/personal-information/${this.session.user.username}`)
      .then(response => {
        // console.log(response);
        if (response.data) this.personalInformation = response.data;
      })
      .catch(error => {
        console.log(error.response);
      });
  }
};
</script>

<style scoped>
</style>