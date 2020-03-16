export const ValidationOptionsMixin = {
  props: {
    v: {
      type: Object,
      required: true
    },
    path: {
      type: String,
      required: true
    }
  },
  computed: {
    field() {
      return _.get(this.v.values, this.path);
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

export const FormValidationMixin = {
  components: {
    RequiredError,
    AlphaError,
    AlphanumError,
    MinlengthError,
    NameError,
    EmailError,
    PhoneNoError
  },
  methods: {
    validationClass(path) {
      const field = _.get(this.$v.values, path);
      return field.$dirty ? (field.$invalid ? 'is-invalid' : 'is-valid') : '';
    }
  }
}

export const CRUDMixin = {
  created() {
    const req = ['defaultValues', 'values', 'resourceName', 'resourcePath'];
    const undef = req.find(prop => this[prop] === undefined);
    if (undef) throw new Error(`Property '${undef}' is undefined.`);
    axios
      .get(this.resourcePath)
      .then(response => {
        // console.log(response);
        this[this.resourceName.collection] = response.data;
      })
      .catch(error => {
        console.error(error.response);
      });
  },
  methods: {
    handleSubmit() {
      (this.values.id ? this.update : this.create)();
    },
    create() {
      axios
        .post(this.resourcePath, this.values)
        .then(response => {
          // console.log(response);
          this[this.resourceName.collection].push(response.data[this.resourceName.single]);
          this.$notify({
            type: "success",
            text: response.data.message
          });
        })
        .catch(error => {
          console.error(error.response);
          this.$notify({
            type: "error",
            text: error.response.data.message
          });
        });
    },
    update() {
      axios
        .patch(`${this.resourcePath}/${this.values.id}`, this.values)
        .then(response => {
          // console.log(response);
          const updated = response.data[this.resourceName.single];
          const idx = this[this.resourceName.collection].findIndex(res => res.id === updated.id);
          this[this.resourceName.collection].splice(idx, 1, updated);
          this.$notify({
            type: "success",
            text: response.data.message
          });
        })
        .catch(error => {
          console.error(error.response);
          this.$notify({
            type: "error",
            text: error.response.data.message
          });
        });
    },
    delete_(res) {
      axios
        .delete(`${this.resourcePath}/${res.id}`)
        .then(response => {
          // console.log(response);
          const idx = this[this.resourceName.collection].indexOf(res);
          this[this.resourceName.collection].splice(idx, 1);
          this.$notify({
            type: "success",
            text: response.data.message
          });
        })
        .catch(error => {
          console.error(error.response);
          this.$notify({
            type: "error",
            text: error.response.data.message
          });
        });
    },
    reset() {
      this.values = _.cloneDeep(this.defaultValues);
      if (this.$v) this.$v.$reset();
    }
  }
}