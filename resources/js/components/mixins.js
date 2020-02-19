const { getProperty } = require('../utils');

export const ValidationOptionsMixin = {
  props: {
    v: { type: Object, required: true },
    path: { type: String, required: true }
  },
  computed: {
    field: function () {
      return getProperty(this.path, this.v.values);
    }
  }
}

const {
  RequiredError,
  AlphaError,
  AlphanumError,
  MinlengthError,
  EmailError,
  NameError,
  PhoneNoError
} = require("./mixed");

export const FormMixin = {
  components: {
    RequiredError,
    AlphaError,
    AlphanumError,
    MinlengthError,
    NameError,
    EmailError,
    PhoneNoError
  },
  data: function() {
    return {
      resourcePath: '/'
    }
  },
  methods: {
    validationClass: function(path) {
      const field = getProperty(path, this.$v.values);
      return field.$dirty ? (field.$invalid ? 'is-invalid' : 'is-valid') : '';
    },
    handleSubmit: function() {
      axios
        .post(this.submitUrl, this.values)
        .then(response => {
          // console.log(response);
          this.$notify({type: 'success', text: response.data.message});
          this.$v.reset();
        })
        .catch(error => {
          this.$notify({type: 'error', text: error.response.data.message});
          console.error(error.response);
        });
    }
  }
}