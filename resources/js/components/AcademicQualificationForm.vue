<template>
  <div>
    <h3 class="font-weight-bold">Academic Qualifications</h3>
    <hr class="my-2" />
    <pre>formData: {{JSON.stringify(formData, null, 2)}}</pre>
    <form action="" method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-group">
        <label for="institution">Institition</label>
        <input
          type="text"
          name="institution"
          id="institution"
          class="form-control"
          placeholder="e.g. University of Nairobi"
          v-model="formData.institution"
        />
      </div>
      <div class="form-row">
        <div class="form-group col-md-4">
          <label for="from">From</label>
          <input
            type="date"
            name="from"
            id="from"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="formData.from"
          />
        </div>
        <div class="form-group col-md-4">
          <label for="to">To</label>
          <input
            type="date"
            id="to"
            name="to"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="formData.to"
          />
        </div>
      </div>
      <div class="form-group">
        <label for="academicLevel">Academic Level</label>
        <input
          type="text"
          name="academicLevel"
          id="academicLevel"
          class="form-control"
          placeholder="e.g. Diploma"
          v-model="formData.academicLevel"
        />
      </div>
      <div class="form-group">
        <label for="course">Course of Study</label>
        <input
          type="text"
          name="course"
          id="course"
          class="form-control"
          placeholder="e.g. Mathematics and Computer Science"
          v-model="formData.course"
        />
      </div>
      <div class="form-group">
        <label for="specialization">Specialization</label>
        <input
          type="text"
          name="specialization"
          id="specialization"
          class="form-control"
          placeholder="e.g. IT"
          v-model="formData.specialization"
        />
      </div>
      <div class="form-group">
        <label for="grade">Qualification Grade</label>
        <input
          type="text"
          name="grade"
          id="grade"
          class="form-control"
          placeholder="eg. Distinction"
          v-model="formData.grade"
        />
      </div>
      <div style="display: flex; flex-direction: row-reverse;">
        <button type="submit" class="btn btn-primary">Next</button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: 'AcademicQualificationsForm',
  props: { eventBus: Vue },
  data() {
    return {
      formId: 'education',
      formData: {
        institution: '',
        from: '',
        to: '',
        academicLevel: '',
        course: '',
        specialization: '',
        grade: ''
      }
    }
  },
  methods: {
    handleSubmit() {this.$emit('validated', this)}
  }
}
</script>

<style scoped>
</style>