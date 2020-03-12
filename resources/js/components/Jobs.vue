<template>
  <div>
    <modal id="jobEditor" @close="reset">
      <template #title>Post New Job</template>
      <form method="POST" id="addJobForm" @submit.prevent="addJob" novalidate>
        <div class="form-group">
          <label for="title">Title</label>
          <input
            type="text"
            name="title"
            class="form-control"
            id="title"
            v-model="values.title"
            aria-describedby="titleHelp"
          />
        </div>
        <div class="form-group">
          <label for="refNo">Ref No</label>
          <input
            type="text"
            name="refNo"
            class="form-control"
            id="refNo"
            v-model="values.ref_no"
            aria-describedby="refNoHelp"
          />
        </div>
        <div class="form-group">
          <label for="location">Location</label>
          <input
            type="text"
            name="location"
            class="form-control"
            id="location"
            v-model="values.location"
            aria-describedby="locationHelp"
          />
        </div>
        <div class="form-group">
          <label for="deadline">Deadline</label>
          <input
            type="date"
            name="deadline"
            class="form-control"
            id="deadline"
            v-model="values.expiry"
            aria-describedby="deadlineHelp"
          />
        </div>
        <div class="form-group">
          <label for="requirements">Requirements</label>
          <textarea
            name="requirements"
            class="form-control"
            id="requirements"
            v-model="values.requirements"
            aria-describedby="requirementsHelp"
          ></textarea>
        </div>
        <div class="form-group">
          <label for="roles">Roles</label>
          <textarea
            name="roles"
            class="form-control"
            id="roles"
            v-model="values.roles"
            aria-describedby="detailsHelp"
          ></textarea>
        </div>
      </form>
      <template>
        <button type="submit" form="jobEditor" class="btn btn-primary">Submit</button>
      </template>
    </modal>
    <div class="d-flex justify-content-between py-1">
      <h3>Jobs</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#addJobModal"
      >Post New Job</button>
    </div>
    <div class="table-responsive">
      <table class="table table-sm table-bordered">
        <thead class="thead-light">
          <tr>
            <th></th>
            <th>Title</th>
            <th>Reference Number</th>
            <th>Date Posted</th>
            <th>Location</th>
            <th>Expiry</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-if="job in jobs" :key="job-id">
            <td>{{job.id}}</td>
            <td>{{job.title}}</td>
            <td>{{job.ref_no}}</td>
            <td>{{job.location}}</td>
            <td>{{job.created_at}}</td>
            <td>{{job.expiry}}</td>
            <td>
              <div class="btn-group" role="group" aria-label>
                <div class="btn-group" role="group" aria-label>
                  <button type="button" class="btn btn-primary">Edit</button>
                  <button type="button" class="btn btn-danger">Delete</button>
                </div>
              </div>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
const { CRUDMixin } = require("./mixins");
const { default: Modal } = require("./Modal");

const defaultValues = {
  title: "",
  ref_no: "",
  location: "",
  expiry: "",
  requirements: "",
  roles: ""
};

export default {
  name: "Jobs",
  mixins: [CRUDMixin],
  components: { Modal },
  data() {
    return {
      jobs: [],
      defaultValues,
      values: { ...defaultValues },
      resourceName: { single: "job", collection: "jobs" },
      resourcePath: "/jobs"
    };
  }
};
</script>

<style scoped>
</style>