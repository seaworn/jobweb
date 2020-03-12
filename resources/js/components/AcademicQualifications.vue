<template>
  <div v-if="academics.length">
    <div class="justify-content-center">
      <table class="table">
        <thead class="thead-light font-weight-bold">
          <tr>
            <th>Institution</th>
            <th>From</th>
            <th>To</th>
            <th>Academic Level</th>
            <th>Course of Study</th>
            <th>Specialization</th>
            <th>Qualification Grade</th>
            <th colspan="2" v-if="showActions">Action</th>
          </tr>
        </thead>
        <tr v-for="education in academics" :key="education.id">
          <td>{{education.institution}}</td>
          <td>{{education.from}}</td>
          <td>{{education.to}}</td>
          <td>{{education.academic_level}}</td>
          <td>{{education.course}}</td>
          <td>{{education.specialization}}</td>
          <td>{{education.grade}}</td>
          <td v-if="showActions">
            <div class="btn-group" role="group" aria-label>
              <button class="btn text-primary" @click="$emit('edit-education', education)">
                <i class="fa fa-edit" />&nbsp;Edit
              </button>
              <button class="btn text-danger" @click="deleteQualification(education.id)">
                <i class="fa fa-trash" />&nbsp;Delete
              </button>
            </div>
          </td>
        </tr>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "AcademicQualifications",
  props: { showActions: { type: Boolean, default: true } },
  data() {
    return {
      academics: [],
      resourcePrefix: "/academic-qualifications"
    };
  },
  created() {
    this.$root.$on("education-added", education => {
      this.academics.push(education);
    });
    axios
      .get(this.resourcePrefix)
      .then(response => {
        //console.log(response);
        this.academics = response.data;
      })
      .catch(error => {
        //console.error(error.response);
      });
  },
  methods: {
    deleteQualification(id) {
      axios
        .delete(`${this.resourcePrefix}/${id}`)
        .then(response => {
          //console.log(response);
          this.academics = this.academics.filter(qualification => {
            return qualification.id !== id;
          });
          this.$notify({type: "success", text: response.data.message});
        })
        .catch(error => {
          //console.error(error.response);
          this.$notify({type: "error", text: error.response.data.message});
      });
    }
  }
};
</script>

<style scoped>
</style>