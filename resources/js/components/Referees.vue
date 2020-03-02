<template>
  <div>
    <h4 class="font-weight-bold">Referees</h4>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>Full Name</th>
            <th>Occupation</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Relationship</th>
            <th>Length of Relationship</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.full_name}}</td>
          <td>{{entry.occupation}}</td>
          <td>{{entry.phone_no}}</td>
          <td>{{entry.email}}</td>
          <td>{{entry.relationship}}</td>
          <td>{{entry.length_of_relationship}}</td>
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
    <button type="button" class="btn btn-primary" @click="showForm = true" v-if="!showForm">Add</button>
    <div v-if="showForm">
      <referee-form :initial-values="entryToEdit" />
    </div>
  </div>
</template>

<script>
const RefereeForm = require("./RefereeForm").default;
const { ViewMixin } = require("./mixins");

export default {
  components: { RefereeForm },
  mixins: [ViewMixin],
  data() {
    return {
      resourcePrefix: "/referees"
    };
  },
  created() {
    this.$on("ref-saved", function() {
      this.showForm = false;
    });
  }
};
</script>

<style scoped>
</style>