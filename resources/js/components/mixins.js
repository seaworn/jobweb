const {
    getProperty
} = require('../utils');

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
    props: {
        initialValues: Object
    },
    components: {
        RequiredError,
        AlphaError,
        AlphanumError,
        MinlengthError,
        NameError,
        EmailError,
        PhoneNoError
    },
    data: function () {
        return {
            values: {},
            editing: this.initialValues ? true : false,
            creating: this.initialValues ? false : true,
            resourceId: this.initialValues ? this.initialValues.id : null,
            resourcePrefix: '/',
        }
    },
    computed: {
        requestMethod() {
            return this.editing ? "PUT" : "POST";
        }
    },
    watch: {
        editing(value) {
            this.creating = !value;
        },
        creating(value) {
            this.editing = !value;
        }
    },
    methods: {
        validationClass: function (path) {
            const field = getProperty(path, this.$v.values);
            return field.$dirty ? (field.$invalid ? 'is-invalid' : 'is-valid') : '';
        },
        handleSubmit: function () {
            const formData = new FormData();
            Object.keys(this.values).map(key => formData.append(key, this.values[key]));
            axios({
                    method: this.requestMethod,
                    url: `${this.resourcePrefix}/${this.resourceId || ''}`,
                    data: formData,
                    headers: {
                        'Content-Type': 'multipart/form-data'
                    }
                })
                .then(response => {
                    console.log(response);
                    this.$notify({
                        type: 'success',
                        text: response.data.message
                    });
                    // this.$v.reset();
                    this.$emit('saved');
                })
                .catch(error => {
                    console.error(error.response);
                    this.$notify({
                        type: 'error',
                        text: error.response.data.message
                    });
                });
        }
    }
}

export const ViewMixin = {
    data: function () {
        return {
            entries: [],
            showForm: false,
            entryToEdit: null,
            resourcePrefix: "/"
        };
    },
    created: function () {
        axios
            .get(this.resourcePrefix)
            .then(response => {
                // console.log(response);
                this.entries = response.data;
            })
            .catch(error => {
                console.log(error.response);
            });
    },
    methods: {
        deleteEntry(id) {
            axios
                .delete(`${this.resourcePrefix}/${id}`)
                .then(response => {
                    // console.log(response);
                    this.$notify({
                        type: 'info',
                        text: response.data.message
                    });
                })
                .catch(error => {
                    console.log(error.response);
                });
        }
    }
}
