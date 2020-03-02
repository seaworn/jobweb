<template>
  <div>
    <div v-if="!showForm">
      <div class="d-flex justify-content-between">
        <h4 class="font-weight-bold">Contact Person</h4>
        <button class="btn bg-light text-primary" @click="showForm = true" v-if="!showForm">
          <i class="fa fa-edit" />&nbsp;Edit
        </button>
      </div>
      <div class="row">
        <div class="col-6">Full Name:</div>
        <div class="col-6">{{contactPerson.full_name}}</div>
      </div>
      <div class="row">
        <div class="col-6">Phone Number:</div>
        <div class="col-6">{{contactPerson.phone_no}}</div>
      </div>
      <div class="row">
        <div class="col-6">Email:</div>
        <div class="col-6">{{contactPerson.email}}</div>
      </div>
    </div>
    <div v-if="showForm">
      <contact-person-form :initial-values="contactPerson" @saved="showForm = false" />
    </div>
  </div>
</template>

<script>
const {default: ContactPersonForm, defaultValues} = require("./ContactPersonForm");

export default {
  components: { ContactPersonForm },
  data: function() {
    return {
      contactPerson: {...defaultValues},
      showForm: false
    };
  },
  created() {
    axios
      .get("/contact-person")
      .then(response => {
        if (response.data) this.contactPerson = response.data;
      })
      .catch(error => {
        console.log(error.response);
      });
  }
};
</script>

<style scoped>
</style>