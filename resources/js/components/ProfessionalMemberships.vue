<template>
  <div v-if="memberships.length">
    <div class="justify-content-center">
      <table class="table">
        <thead class="thead-light font-weight-bold">
          <tr>
            <th>Professional Body</th>
            <th>Registration Number</th>
            <th>Membership Type</th>
            <th>Registration Date</th>
            <th>Expiry Date</th>
            <th colspan="2" v-if="showActions">Action</th>
          </tr>
        </thead>
        <tr v-for="membership in memberships" :key="membership.id">
          <td>{{membership.professional_body}}</td>
          <td>{{membership.reg_no}}</td>
          <td>{{membership.membership_type}}</td>
          <td></td>
          <td>{{membership.expiry}}</td>
          <td v-if="showActions">
            <div class="btn-group" role="group" aria-label>
              <button class="btn text-primary" @click="$emit('edit-membership', membership.id)">
                <i class="fa fa-edit" />&nbsp;Edit
              </button>
              <button class="btn text-danger" @click="deleteMembership(membership.id)">
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
  name: "ProfessionalMemberships",
  props: { showActions: { type: Boolean, default: true } },
  data() {
    return {
      memberships: [],
      resourcePath: "/professional-memberships"
    };
  },
  created() {
    axios
      .get(this.resourcePath)
      .then(response => {
        //console.log(response);
        this.memberships = response.data;
      })
      .catch(error => {
        //console.error(error.response);
      });
    this.$root.$on("membership-added", membership => {
      this.memberships.push(membership);
    });
  }
};
</script>

<style scoped>
</style>