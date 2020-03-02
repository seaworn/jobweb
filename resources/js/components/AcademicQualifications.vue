<template>
  <div>
    <h4 class="font-weight-bold">Academic Qualifications</h4>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>Institution</th>
            <th>From</th>
            <th>To</th>
            <th>Academic Level</th>
            <th>Course of Study</th>
            <th>Specialization</th>
            <th>Qualification Grade</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.institution}}</td>
          <td>{{entry.from}}</td>
          <td>{{entry.to}}</td>
          <td>{{entry.academic_level}}</td>
          <td>{{entry.course}}</td>
          <td>{{entry.specialization}}</td>
          <td>{{entry.grade}}</td>
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
    <div v-if="showForm">
      <academic-qualification-form :initial-values="entryToEdit" />
    </div>
    <button type="button" class="btn btn-primary" @click="showForm = true" v-if="!showForm">Add</button>
  </div>
</template>

<script>
const AcademicQualificationForm = require("./AcademicQualificationForm")
  .default;
const { ViewMixin } = require("./mixins");

export default {
  components: { AcademicQualificationForm },
  mixins: [ViewMixin],
  data: function() {
    return {
      resourcePrefix: "/academic-qualifications"
    };
  },
  created: function() {
    this.$on("aq-saved", function() {
      this.showForm = false;
    });
  }
};
</script>

<style scoped>
</style>