<template>
  <div>
    <h4 class="font-weight-bold">Work Experience</h4>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Position</th>
            <th>Organization</th>
            <th>Roles</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.from}}</td>
          <td>{{entry.to}}</td>
          <td>{{entry.position}}</td>
          <td>{{entry.organization}}</td>
          <td>{{entry.roles}}</td>
          <td>
            <button class="btn text-primary" @click="showForm = true; entryToEdit = entry">
              <i class="fa fa-edit" />&nbsp;Edit
            </button>
            <button class="btn text-danger" @click="() => deleteEntry(entry.id)">
              <i class="fa fa-trash" />&nbsp;Delete
            </button>
          </td>
        </tr>
      </table>
    </div>
    <button type="button" class="btn btn-primary" @click="showForm = true" v-if="!showForm">Add</button>
    <div v-if="showForm">
      <work-experience-form :initial-values="entryToEdit" />
    </div>
  </div>
</template>

<script>
const WorkExperienceForm = require("./WorkExperienceForm").default;
const { ViewMixin } = require("./mixins");

export default {
  components: { WorkExperienceForm },
  mixins: [ViewMixin],
  data() {
    return {
      resourcePrefix: "/work-experience"
    };
  },
  created() {
    this.$on("wxp-saved", function() {
      this.showForm = false;
    });
  }
};
</script>

<style scoped>
</style>