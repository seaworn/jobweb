<template>
  <div>
    <h3 class="font-weight-bold">Professional Certifications</h3>
    <hr class="my-2" />
    <pre>values: {{JSON.stringify(values, null, 2)}}</pre>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>Certificate Name</th>
            <th>Issuing Body</th>
            <th>Description</th>
            <th>Year</th>
            <th>expiry</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.certificateName}}</td>
          <td>{{entry.issuingBody}}</td>
          <td>{{entry.description}}</td>
          <td>{{entry.year}}</td>
          <td>{{entry.expiry}}</td>
          <td>
            <a href="#" @click.prevent="()=>editEntry(entry)">
              <i class="fa fa-edit"></i>Edit
            </a>
            <a href="#" @click.prevent="()=>deleteEntry(entry.id)">
              <i class="fa fa-trash"></i>Delete
            </a>
          </td>
        </tr>
      </table>
    </div>

    <form action method="POST" @submit.prevent="handleSubmit" novalidate enctype="multipart/form-data">
      <div class="form-group">
        <label for="certificateName">Certificate Name</label>
        <input
          type="text"
          name="certificateName"
          id="certificateName"
          class="form-control"
          placeholder="e.g. CCNA"
          v-model="$v.values.certificateName.$model"
          :class="[validationClass('certificateName')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="certificateName" />
        </div>
      </div>
      <div class="form-group">
        <label for="issuingBody">Issuing Body</label>
        <input
          type="text"
          name="issuingBody"
          id="issuingBody"
          class="form-control"
          placeholder="e.g. Cisco"
          v-model="$v.values.issuingBody.$model"
          :class="[validationClass('issuingBody')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="issuingBody" />
        </div>
      </div>
      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          name="description"
          id="description"
          class="form-control"
          v-model="$v.values.description.$model"
          :class="[validationClass('description')]"
        ></textarea>
        <div class="invalid-feedback">
          <required-error :v="$v" path="description" />
        </div>
      </div>
      <div class="form-row d-flex align-items-center">
        <div class="form-group col-md-4">
          <label for="issuedOn">Year</label>
          <input
            type="date"
            name="issuedOn"
            id="issuedOn"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="$v.values.issuedOn.$model"
            :class="[validationClass('issuedOn')]"
          />
          <div class="invalid-feedback">
            <required-error :v="$v" path="issuedOn" />
          </div>
        </div>
        <div class="form-group col-md-4" v-if="values.expires">
          <label for="expiry">Expiry</label>
          <input
            type="date"
            name="expiry"
            id="expiry"
            class="form-control"
            placeholder="MM/DD/YYYY"
            v-model="$v.values.expiry.$model"
            :class="[validationClass('expiry')]"
          />
          <div class="invalid-feedback">
            <required-error :v="$v" path="expiry" />
          </div>
        </div>
        <div class="form-group form-check-inline col-md-4">
          <input
            type="checkbox"
            id="expiresToggle"
            class="form-check-input"
            :value="values.expires"
            :checked="!values.expires"
            @change="values.expires = !values.expires"
          />
          <label for="expiresToggle" class="form-check-label">Does not expire</label>
        </div>
      </div>
      <div class="form-group">
        <label for="file">Attach Copy</label>
        <input
          type="file"
          name="file"
          id="file"
          class="form-control-file"
          @change="file = $event.target.files[0]"
        />
        <div class="invalid-feedback">
          <!-- <required-error :v="$v" path="file" /> -->
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
    <div class="d-flex flex-row-reverse">
      <button type="button" class="btn btn-success" @click="$emit('next')">Next</button>
    </div>
  </div>
</template>

<script>
const { required, requiredIf } = require("vuelidate/lib/validators");
const { FormMixin } = require("./mixins");

const initialValues = {
  certificateName: "",
  issuingBody: "",
  description: "",
  issuedOn: "",
  expires: true,
  expiry: "",
  file: null
};

export default {
  name: "ProfessionalCertificationForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...initialValues },
      entries: [],
      resourcePath: "/professional-certifications"
    };
  },
  validations: {
    values: {
      certificateName: { required },
      issuingBody: { required },
      description: {},
      issuedOn: { required },
      expiry: { requiredIfExpires: requiredIf("expires") }
    }
  },
  created: function() {
    axios
      .get(this.resourcePath)
      .then(response => {})
      .catch(error => {});
  },
  methods: {
    handleSubmit: function() {
      const fd = new FormData();
      const data = Object.keys(this.values).map(key => fd.append(key, this.values[key]));
      axios
        .post(this.resourcePath, fd, {headers: {'Content-Type': 'multipart/form-data'}})
        .then(response => {
          // console.log(response);
          this.$notify({type: 'success', text: response.data.message});
        })
        .catch(error => {
          // console.log(error.response);
          this.$notify({type: 'error', text: error.response.data.message});
        });
      this.values = { ...initialValues };
      this.$v.$reset();
    },
    editEntry: function() {},
    deleteEntry: function() {}
  }
};
</script>

<style scoped>
</style>