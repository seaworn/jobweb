<template>
  <div>
    <modal id="jobEditor" @close="reset" size="lg">
      <template #title>{{ values.id ? 'Edit' : 'Post'}} Job</template>
      <form method="POST" id="addJobForm" @submit.prevent="handleSubmit" novalidate>
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
          <label for="refNo">Reference Number</label>
          <input
            type="text"
            name="refNo"
            class="form-control"
            id="refNo"
            v-model="values.ref_no"
            aria-describedby="refNoHelp"
          />
        </div>
        <div class="form-group" col-md-auto>
          <label for="jobFunction">Job Function</label>
          <div class="d-flex flex-nowrap">
            <select
              v-show="jobFunctions.length"
              name="job_function"
              id="jobFunction"
              class="form-control"
              v-model="values.job_function"
            >
              <option v-for="func in jobFunctions" :key="func.id" :value="func.name">{{func.name}}</option>
              <option :value="null">Other</option>
            </select>
            <input
              v-show="!jobFunctions.length || values.job_function === null"
              type="text"
              name="job_function"
              class="form-control"
              v-model="values.new_job_function"
              ref="new_job_function_input"
            />
          </div>
        </div>
        <div class="form-group">
          <label for="contract">Contract Type</label>
          <select
            name="contract"
            class="form-control"
            id="contract"
            v-model="values.contract_type_id"
            aria-describedby="contractHelp"
          >
            <option
              v-for="contract in contractTypes"
              :key="contract.id"
              :value="contract.id"
            >{{contract.name}}</option>
          </select>
        </div>
        <div class="form-group">
          <label>Experience Level</label>
          <select class="form-control" name="experience_level" v-model="values.experience_level">
            <option value="1">Less than 1 Year</option>
            <option value="2">2 Years</option>
            <option value="3">3 Years</option>
            <option value="4">4 Years</option>
            <option value="5-10">5 to 10 Years</option>
            <option value="10+">Over 10 Years</option>
          </select>
        </div>
        <div class="form-group">
          <label for="requirements">Skills Required</label>
          <textarea
            name="requirements"
            rows="3"
            class="form-control"
            id="requirements"
            v-model="values.skills_required"
            aria-describedby="requirementsHelp"
          ></textarea>
        </div>
        <div class="form-group">
          <label for="duties">Duties</label>
          <textarea
            name="duties"
            rows="3"
            class="form-control"
            id="duties"
            v-model="values.duties"
            aria-describedby="dutiesHelp"
          ></textarea>
        </div>
        
        <div class="form-group">
          <label>Salary Range</label>
          <select class="form-control" name="salaryrange" v-model="values.salary_range">
            <option value="Ksh.10,000 - Ksh.20,000">Ksh.10,000 - Ksh.20,000</option>
            <option value="Ksh.20,000 - Ksh.30,000">Ksh.20,000 - Ksh.30,000</option>
            <option value="Ksh.30,000 - Ksh.40,000">Ksh.30,000 - Ksh.40,000</option>
            <option value="Ksh.40,000 - Ksh.50,000">Ksh.40,000 - Ksh.50,000</option>
            <option value="Ksh.50,000 - Ksh.60,000">Ksh.50,000 - Ksh.60,000</option>
          </select>
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
          <label for="openings">No. of Openings</label>
          <input
            type="number"
            name="no_of_openings"
            class="form-control"
            id="openings"
            v-model="values.no_of_openings"
            aria-describedby="openingsHelp"
          />
        </div>
        <div class="form-group">
          <label for="deadline">Application Deadline</label>
          <input
            type="date"
            name="deadline"
            class="form-control"
            id="deadline"
            v-model="values.expiry"
            aria-describedby="deadlineHelp"
          />
        </div>
      </form>
      <template>
        <button type="submit" form="addJobForm" class="btn btn-primary">Submit</button>
      </template>
    </modal>
    <div class="d-flex justify-content-between py-1">
      <h3>Jobs</h3>
      <button
        type="button"
        class="btn btn-primary"
        data-toggle="modal"
        data-target="#jobEditor"
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
            <th>Expiry</th>
            <th colspan="2">Actions</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="(job, idx) in jobs" :key="job.id">
            <td>{{idx + 1}}</td>
            <td>{{job.title}}</td>
            <td>{{job.ref_no}}</td>
            <td>{{job.created_at}}</td>
            <td>{{job.expiry}}</td>
            <td>
              <div class="btn-group" role="group" aria-label>
                <div class="btn-group" role="group" aria-label>
                  <button
                    type="button"
                    class="btn btn-primary"
                    data-toggle="modal"
                    data-target="#jobEditor"
                    @click="edit(job)"
                  >Edit</button>
                  <button type="button" class="btn btn-danger" @click="delete_(job)">Delete</button>
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
  id: null,
  title: "",
  ref_no: "",
  job_function: "",
  new_job_function: "",
  location: "",
  contract_type_id: "",
  no_of_openings: 1,
  experience_level: "",
  skills_required: "",
  duties: "",
  salary_range: "",
  expiry: ""
};

export default {
  name: "Jobs",
  mixins: [CRUDMixin],
  components: { Modal },
  data() {
    return {
      jobs: [],
      jobFunctions: [],
      contractTypes: [],
      defaultValues,
      values: { ...defaultValues },
      resourceName: { single: "job", collection: "jobs" },
      resourcePath: "/jobs",
      otherJobFunction: false
    };
  },
  created() {
    axios
      .all([
        axios.get("/job-functions"),
        axios.get("/contract-types")
      ])
      .then(axios.spread((response_a, response_b) => {
        //console.log(response);
        this.jobFunctions = response_a.data;
        this.contractTypes = response_b.data;
        if (this.jobFunctions)
          this.values.job_function = this.jobFunctions[0].id;
        if (this.contractTypes)
          this.values.contract_type = this.contractTypes[0].id;
      }))
      .catch(error => {
        //console.error(error.response);
        //
      });
  },
  watch: {
    "values.job_function": function(value) {
      if (value === null) this.$refs.new_job_function_input.focus();
    }
  },
  methods: {
    edit(job) {
      this.values = {
        ...job,
        job_function: job.job_function.name,
        contract_type_id: job.contract_type.id
      };
    }
  }
};
</script>

<style scoped>
</style>