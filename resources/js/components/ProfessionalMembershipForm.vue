<template>
  <div>
    <h2 class="font-weight-bold">Professional Memberships</h2>
    <hr class="my-2" />
    <pre>values: {{JSON.stringify(values, null, 2)}}</pre>
    <div class="justify-content-center">
      <table class="table">
        <thead class="font-weight-bold">
          <tr>
            <th>Professional Body</th>
            <th>Registration Number</th>
            <th>Membership Type</th>
            <th>Registration Date</th>
            <th>Expiry Date</th>
            <th colspan="2">Action</th>
          </tr>
        </thead>
        <tr v-for="entry in entries" :key="entry.id">
          <td>{{entry.body}}</td>
          <td>{{entry.regNo}}</td>
          <td>{{entry.membershipType}}</td>
          <td></td>
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

    <form action method="POST" @submit.prevent="handleSubmit" novalidate>
      <div class="form-group">
        <label for="professionalBody">Professional Body</label>
        <input
          type="text"
          name="professionalBody"
          id="professionalBody"
          class="form-control"
          placeholder="e.g. Institution of Engineers of Kenya"
          v-model="$v.values.professionalBody.$model"
          :class="[validationClass('professionalBody')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="professionalBody" />
        </div>
      </div>
      <div class="form-group">
        <label for="regNo">Reg. No</label>
        <input
          type="text"
          name="regNo"
          id="regNo"
          class="form-control"
          placeholder="Registration number"
          v-model="$v.values.regNo.$model"
          :class="[validationClass('regNo')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="regNo" />
        </div>
      </div>
      <div class="form-group">
        <label for="membershipType">Membership Type</label>
        <input
          type="text"
          name="membershipType"
          id="membershipType"
          class="form-control"
          placeholder="e.g. Consultant"
          v-model="$v.values.membershipType.$model"
          :class="[validationClass('membershipType')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="membershipType" />
        </div>
      </div>
      <div class="form-row d-flex align-items-center">
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
  professionalBody: "",
  regNo: "",
  membershipType: "",
  expires: true,
  expiry: ""
};

export default {
  name: "ProfessionalMembershipForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...initialValues },
      entries: [],
      resourcePath: '/memberships'
    };
  },
  validations: {
    values: {
      professionalBody: { required },
      regNo: { required },
      membershipType: { required },
      expiry: { requiredIf: requiredIf('expires') },
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
      axios
        .post(this.resourcePath, this.values)
        .then(response => {})
        .catch(error => {});
      this.values = { ...initialValues };
      this.$v.$reset();
    },
    editEntry: function(entry) {
      axios
        .put(`${this.resourcePath}/${entry.id}`)
        .then(response => {})
        .catch(error => {});
    },
    deleteEntry: function(id) {
      axios
        .delete(`${this.resourcePath}/${entry.id}`)
        .then(response => {})
        .catch(error => {});
    }
  }
};
</script>

<style scoped>
</style>