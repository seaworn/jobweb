<template>
  <div>
    <h4 class="font-weight-bold">Skills</h4>
    <div class="d-flex flex-wrap">
      <div class="d-flex shadow p-2 m-1" v-for="entry in entries" :key="entry.id">
        <span>{{entry.skill}}</span>&nbsp;
        <button
          type="button"
          class="close"
          aria-label="Dismiss"
          @click="()=>deleteEntry(entry.id)"
        >
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
    </div>
    <div v-if="showForm">
      <skill-form />
    </div>
    <button type="button" class="btn btn-primary" @click="showForm = true" v-if="!showForm">Add</button>
  </div>
</template>

<script>
const SkillForm = require("./SkillForm").default;
const { ViewMixin } = require("./mixins");

export default {
  components: { SkillForm },
  mixins: [ViewMixin],
  data() {
    return {
      entries: [],
      resourcePrefix: '/skills'
    };
  },
  methods: {
    deleteEntry: function(id) {
      axios
        .delete(`${this.resourcePrefix}/${id}`)
        .then(response => {
          this.entries = response.data;
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
};
</script>

<style scoped>
</style>