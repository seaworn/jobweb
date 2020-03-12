<template>
  <div class="d-flex flex-wrap" v-if="skills.length">
    <div class="rounded-pill border shadow-sm p-1 pl-3 my-1 mr-2" v-for="skill in skills" :key="skill.id">
      <span>{{skill.name}}</span>&nbsp;
      <button type="button" class="btn rounded-circle xbtn" aria-label="Dismiss" @click="deleteSkill(skill.id)">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
</template>

<script>
export default {
  name: "Skills",
  data() {
    return {
      skills: [],
      resourcePath: "/skills"
    };
  },
  created() {
    this.$root.$on('skill-added', skill => {
      this.skills.push(skill);
    });
    axios
      .get(this.resourcePath)
      .then(response => {
        // console.log(response);
        this.skills = response.data;
      })
      .catch(error => {
        // console.log(error.response);
      });
  },
  methods: {
    deleteSkill(id) {
      axios
        .delete(`${this.resourcePath}/${id}`)
        .then(response => {
          // console.log(response);
          this.skills = this.skills.filter(skill => {
            return skill.id !== id;
          });
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          // console.error(error.response);
          this.$notify({ type: "error", text: response.data.message });
        });
    }
  }
};
</script>

<style scoped>
</style>