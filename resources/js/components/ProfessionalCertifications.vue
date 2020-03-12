<template>
  <div v-if="certifications.length">
    <div class="justify-content-center">
      <table class="table table-striped">
        <thead class="thead-light font-weight-bold">
          <tr>
            <th>Certificate Name</th>
            <th>Issuing Body</th>
            <th>Description</th>
            <th>Year</th>
            <th>expiry</th>
            <th colspan="2" v-if="showActions">Action</th>
          </tr>
        </thead>
        <tr v-for="cert in certifications" :key="cert.id">
          <td>{{cert.certificate_name}}</td>
          <td>{{cert.issuing_body}}</td>
          <td>{{cert.description}}</td>
          <td>{{cert.issued_on}}</td>
          <td>{{cert.expiry}}</td>
          <td v-if="showActions">
            <div class="btn-group" role="group" aria-label>
              <button
                type="button"
                class="btn btn-primary"
                @click="$emit('edit-certification', cert)"
              >
                <i class="fa fa-edit" />&nbsp;Edit
              </button>
              <button type="button" class="btn btn-danger" @click="deleteCert(cert.id)">
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
  name: "ProfessionalCertifications",
  props: { showActions: { type: Boolean, default: true } },
  data() {
    return {
      certifications: [],
      resourcePath: "/professional-certifications"
    };
  },
  created() {
    this.$root.$on("certification-added", (cert) => {
      this.certifications.push(cert);
    });
    axios
      .get(this.resourcePath)
      .then(response => {
        // console.log(response);
        this.certifications = response.data;
      })
      .catch(error => {
        // console.error(error.response);
      });
  },
  methods: {
    deleteCert(id) {
      axios
        .delete(`${this.resourcePath}/${id}`)
        .then(response => {
          // console.log(response);
          this.certifications = this.certifications.filter(cert => {
            return cert.id !== id;
          });
          this.$notify({type: 'success', text: response.data.message});
        })
        .catch(error => {
          // console.error(error.response);
          this.$notify({type: 'error', text: error.response.data.message});
        });
    }
  }
};
</script>

<style scoped>
</style>