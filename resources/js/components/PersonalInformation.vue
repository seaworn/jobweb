<template>
  <div>
    <div>
      <div class="d-flex justify-content-between">
        <h4 class="font-weight-bold">Personal Information</h4>
        <router-link :to="{name: 'add-personal-information'}" class="btn btn-primary">
          <i class="fa fa-edit" />&nbsp;Update
        </router-link>
      </div>
      <div class="row">
        <div class="col-6">Full Name:</div>
        <div class="col-6">{{personalInfo.full_name}}</div>
      </div>
      <div class="row">
        <div class="col-6">Date of Birth:</div>
        <div class="col-6">{{personalInfo.dob}}</div>
      </div>
      <div class="row">
        <div class="col-6">Address:</div>
        <div class="col-6">{{personalInfo.address}}</div>
      </div>
      <div class="row">
        <div class="col-6">Phone Number:</div>
        <div class="col-6">{{personalInfo.phone_no}}</div>
      </div>
      <div class="row">
        <div class="col-6">Disablity:</div>
        <div class="col-6">{{personalInfo.disability}}</div>
      </div>
      <div class="row">
        <div class="col-6">Criminal Record:</div>
        <div class="col-6">{{personalInfo.criminal_record}}</div>
      </div>
    </div>
  </div>
</template>

<script>
const { defaultValues } = require("./PersonalInformationForm");
const { mapGetters } = require("vuex");

export default {
  name: "PersonalInformation",
  data() {
    return {
      personalInfo: { ...defaultValues }
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
        if (response.data) this.personalInfo = response.data;
      })
      .catch(error => {
        console.log(error.response);
      });
  }
};
</script>

<style scoped>
</style>