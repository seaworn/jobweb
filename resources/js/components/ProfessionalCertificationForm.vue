<template>
  <div>
    <h3 class="font-weight-bold">Professional Certifications</h3>
    <hr class="my-2" />
    <pre>formData: {{JSON.stringify(formData, null, 2)}}</pre>
    <form action="" method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-group">
        <label for="certificateName">Certificate Name</label>
        <input
          type="text"
          name="certificateName"
          id="certificateName"
          class="form-control"
          placeholder="e.g. CCNA"
          v-model="formData.certificateName"
        />
      </div>
      <div class="form-group">
        <label for="issuigBody">Issuing Body</label>
        <input
          type="text"
          name="issuigBody"
          id="issuigBody"
          class="form-control"
          placeholder="e.g. Cisco"
          v-model="formData.issuingBody"
        />
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          name="description"
          id="description"
          class="form-control"
          v-model="formData.description"
        ></textarea>
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="year">Year</label>
          <input
            type="date"
            name="year"
            id="year"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="formData.year"
          />
        </div>
        <div class="form-group col-md-4" v-show="expiryToggle">
          <label for="expiry">Expiry</label>
          <input
            type="date"
            name="expiry"
            id="expiry"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="formData.expiry"
          />
        </div>
        <div class="form-group form-check-inline col-md-4">
          <label for="expiryToggle" class="form-check-label">Does not expire</label>
          <input type="checkbox" id="expiryToggle" :value="expiryToggle" class="form-check-input" @change="expiryToggle = !expiryToggle">
        </div>
      </div>
      <div style="display: flex; flex-direction: row-reverse;">
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'ProfessionalCertificationForm',
  props: { eventBus: Vue },
  data() {
    return {
      formId: 'certifications',
      formData: {
        certificateName: '',
        issuingBody: '',
        description: '',
        year: '',
        expiry: ''
      },
      expiryToggle: true
    }
  },
  methods: {
    handleSubmit() {this.$emit('validated', this)}
  }
}
</script>

<style scoped>
</style>