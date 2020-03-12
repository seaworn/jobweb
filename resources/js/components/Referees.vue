<template>
  <div v-if="referees.length">
    <div class="justify-content-center">
      <table class="table">
        <thead class="thead-light font-weight-bold">
          <tr>
            <th>Full Name</th>
            <th>Occupation</th>
            <th>Phone Number</th>
            <th>Email Address</th>
            <th>Relationship</th>
            <th>Length of Relationship</th>
            <th colspan="2" v-if="showActions">Action</th>
          </tr>
        </thead>
        <tr v-for="referee in referees" :key="referee.id">
          <td>{{referee.full_name}}</td>
          <td>{{referee.occupation}}</td>
          <td>{{referee.phone_no}}</td>
          <td>{{referee.email}}</td>
          <td>{{referee.relationship}}</td>
          <td>{{referee.length_of_relationship}}</td>
          <td v-if="showActions">
            <div class="btn-group" role="group" aria-label>
              <button class="btn text-primary" @click="$emit('edit-referees')">
                <i class="fa fa-edit" />&nbsp;Edit
              </button>
              <button class="btn text-danger" @click="deleteReferee(referee.id)">
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
  name: "Referees",
  props: { showActions: { type: Boolean, default: true } },
  data() {
    return {
      referees: [],
      resourcePath: "/referees"
    };
  },
  created() {
    axios
      .get(this.resourcePath)
      .then(response => {
        //console.log(response);
        this.referees = response.data;
      })
      .catch(error => {
        //console.error(error.response);
      });
    this.$root.$on("referee-added", referee => {
      this.referees.append(referee);
    });
  },
  methods: {
    deleteReferee(id) {
      axios
        .delete(`${this.resourcePath}/${id}`)
        .then(response => {
          //console.log(response);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          //console.error(error.response);
          this.$notify({ type: "error", text: error.response.data.message });
        });
    }
  }
};
</script>

<style scoped>
</style>