<template>
  <div>
    <h4 class="font-weight-bold">Professional Certifications</h4>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>Certificate Name</th>
            <th>Issuing Body</th>
            <th>Description</th>
            <th>Year</th>
            <th>expiry</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.certificate_name}}</td>
          <td>{{entry.issuing_body}}</td>
          <td>{{entry.description}}</td>
          <td>{{entry.issued_on}}</td>
          <td>{{entry.expiry}}</td>
          <td>
            <button
              type="button"
              class="btn text-primary"
              @click="showForm = true; entryToEdit = entry"
            >
              <i class="fa fa-edit" />&nbsp;Edit
            </button>
            <button type="button" class="btn text-danger" @click="()=>deleteEntry(entry.id)">
              <i class="fa fa-trash" />&nbsp;Delete
            </button>
          </td>
        </tr>
      </table>
    </div>
    <div v-if="showForm">
      <professional-certification-form :initial-values="entryToEdit" />
    </div>
    <button type="button" class="btn btn-primary" @click="showForm = true" v-if="!showForm">Add</button>
  </div>
</template>

<script>
const {
  default: ProfessionalCertificationForm
} = require("./ProfessionalCertificationForm");
const { ViewMixin } = require("./mixins");

export default {
  components: { ProfessionalCertificationForm },
  mixins: [ViewMixin],
  data: function() {
    return {
      resourcePrefix: "/professional-certifications"
    };
  },
  created: function() {
    this.$on("pc-saved", function() {
      this.showForm = false;
    });
  }
};
</script>

<style scoped>
</style>