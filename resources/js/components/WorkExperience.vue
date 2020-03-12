<template>
  <div v-if="workExperience.length">
    <div class="justify-content-center">
      <table class="table table-striped">
        <thead class="font-weight-bold">
          <tr>
            <th>From</th>
            <th>To</th>
            <th>Position</th>
            <th>Organization</th>
            <th>Roles</th>
            <th colspan="2" v-if="showActions">Action</th>
          </tr>
        </thead>
        <tr v-for="experience in workExperience" :key="experience.id">
          <td>{{experience.from}}</td>
          <td>{{experience.to}}</td>
          <td>{{experience.position}}</td>
          <td>{{experience.organization}}</td>
          <td>{{experience.roles}}</td>
          <td v-if="showActions">
            <div class="btn-group" role="group" aria-label>
              <button class="btn text-primary" @click="$emit('edit-experience', experience)">
                <i class="fa fa-edit" />&nbsp;Edit
              </button>
              <button class="btn text-danger" @click="deleteExperience(experience.id)">
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
  name: "WorkExperience",
  props: { showActions: { type: Boolean, default: false } },
  data() {
    return {
      workExperience: [],
      resourcePath: "/work-experience"
    };
  },
  created() {
    this.$on("experience-added", experience => {
      this.workExperience.push(experience);
    });
    axios
      .get(this.resourcePath)
      .then(response => {
        //console.log(response);
        this.workExperience = response.data;
      })
      .catch(error => {
        //console.error(error.response);
      });
  },
  methods: {
    deleteExperience(id) {
      axios
        .delete(`${this.resourcePath}/${id}`)
        .then(response => {
          //console.log(response);
          this.workExperience = this.workExperience.filter(experience => {
            return experience.id !== id;
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