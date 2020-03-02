<template>
  <div>
    <h4 class="font-weight-bold">Professional Certifications</h4>
    <form
      action
      method="POST"
      @submit.prevent="handleSubmit"
      novalidate
      enctype="multipart/form-data"
    >
      <div class="form-group">
        <label for="certificateName">Certificate Name</label>
        <input
          type="text"
          name="certificateName"
          id="certificateName"
          class="form-control"
          placeholder="e.g. CCNA"
          v-model="$v.values.certificate_name.$model"
          :class="[validationClass('certificate_name')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="certificate_name" />
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
          v-model="$v.values.issuing_body.$model"
          :class="[validationClass('issuing_body')]"
        />
        <div class="invalid-feedback">
          <required-error :v="$v" path="issuing_body" />
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
            v-model="$v.values.issued_on.$model"
            :class="[validationClass('issued_on')]"
          />
          <div class="invalid-feedback">
            <required-error :v="$v" path="issued_on" />
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
        <label for="attachment">Attach Copy</label>
        <input
          type="file"
          name="attachment"
          id="attachment"
          class="form-control-file"
          @change="values.attachment = $event.target.files[0]"
        />
        <div class="invalid-feedback">
          <!-- <required-error :v="$v" path="file" /> -->
        </div>
      </div>
      <button type="submit" class="btn btn-primary">Save</button>
    </form>
  </div>
</template>

<script>
const { required, requiredIf } = require("vuelidate/lib/validators");
const { FormMixin } = require("./mixins");
const ProfessionalCertifications = require("./ProfessionalCertifications")
  .default;

const defaultValues = {
  certificate_name: "",
  issuing_body: "",
  description: "",
  issued_on: "",
  expires: true,
  expiry: "",
  attachment: null
};

export default {
  name: "ProfessionalCertificationForm",
  props: { eventBus: Vue },
  mixins: [FormMixin],
  components: { ProfessionalCertifications },
  data() {
    return {
      values: { ...(this.initialValues || defaultValues) },
      resourcePrefix: "/professional-certifications"
    };
  },
  validations: {
    values: {
      certificate_name: { required },
      issuing_body: { required },
      description: {},
      issued_on: { required },
      expires: {},
      expiry: { requiredIfExpires: requiredIf("expires") }
    }
  }
};
</script>

<style scoped>
</style>