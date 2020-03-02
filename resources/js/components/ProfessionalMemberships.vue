<template>
  <div>
    <h4 class="font-weight-bold">Professional Memberships</h4>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>Professional Body</th>
            <th>Registration Number</th>
            <th>Membership Type</th>
            <th>Registration Date</th>
            <th>Expiry Date</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.professional_body}}</td>
          <td>{{entry.reg_no}}</td>
          <td>{{entry.membership_type}}</td>
          <td></td>
          <td>{{entry.expiry}}</td>
          <td>
            <button class="btn text-primary" @click="showForm = true; entryToEdit = entry">
              <i class="fa fa-edit" />&nbsp;Edit
            </button>
            <button class="btn text-danger" @click="()=>deleteEntry(entry.id)">
              <i class="fa fa-trash" />&nbsp;Delete
            </button>
          </td>
        </tr>
      </table>
    </div>
    <div v-if="showForm">
      <professional-membership-form :initial-values="entryToEdit" />
    </div>
    <button class="btn btn-primary" @click="showForm = true" v-if="!showForm">Add</button>
  </div>
</template>

<script>
const {
  default: ProfessionalMembershipForm
} = require("./ProfessionalMembershipForm");
const { ViewMixin } = require("./mixins");

export default {
  components: { ProfessionalMembershipForm },
  mixins: [ViewMixin],
  data() {
    return {
      resourcePrefix: "/professional-memberships"
    };
  },
  created() {
    this.$on("pm-saved", function() {
      this.showForm = false;
    });
  }
};
</script>

<style scoped>
</style>