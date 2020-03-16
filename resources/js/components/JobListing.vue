<template>
  <div class="container">
    <table class="table table-sm table-bordered">
      <thead class="thead-light">
        <th></th>
        <th>Title</th>
        <th>Reference Number</th>
        <th>Actions</th>
      </thead>
      <tr v-for="job in jobs" :key="job.id">
        <td></td>
        <td>{{job.title}}</td>
        <td>{{job.ref_no}}</td>
        <td>
          <router-link :to="{name: 'show-job', params: {id: job.id}}" class="btn border">View details</router-link>
        </td>
      </tr>
    </table>
  </div>
</template>

<script>
export default {
  data() {
    return {
      jobs: []
    }
  },
  created() {
    axios
      .get('/jobs')
      .then(response => {
        //console.log(response);
        this.jobs = response.data;
      })
      .catch(error => {
        //console.error(error.response);
    });
  }
};
</script>

<style>
</style>