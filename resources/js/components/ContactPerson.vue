<template>
  <div>
    <div>
      <div class="d-flex justify-content-between">
        <h4 class="font-weight-bold">Contact Person</h4>
        <router-link :to="{name: 'add-contact-person'}" class="btn btn-primary">
          <i class="fa fa-edit" />&nbsp;Update
        </router-link>
      </div>
      <div class="row">
        <div class="col-6">Full Name:</div>
        <div class="col-6">{{contact.full_name}}</div>
      </div>
      <div class="row">
        <div class="col-6">Phone Number:</div>
        <div class="col-6">{{contact.phone_no}}</div>
      </div>
      <div class="row">
        <div class="col-6">Email:</div>
        <div class="col-6">{{contact.email}}</div>
      </div>
    </div>
  </div>
</template>

<script>
const { defaultValues } = require("./ContactPersonForm");
export default {
  name: "ContactPerson",
  data() {
    return {
      contact: { ...defaultValues }
    };
  },
  created() {
    axios
      .get("/contact-person")
      .then(response => {
        if (response.data) this.contact = response.data;
      })
      .catch(error => {
        // console.log(error.response);
      });
  }
};
</script>

<style scoped>
</style>