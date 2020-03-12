<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Register</div>
        <div class="card-body">
          <form action method="POST" @submit.prevent="register" novalidate>
            <div class="form-group row">
              <label for="username" class="col-md-4 col-form-label text-md-right">Name</label>
              <div class="col-md-6">
                <input
                  id="username"
                  type="text"
                  class="form-control"
                  name="username"
                  required
                  autocomplete="username"
                  autofocus
                  v-model="$v.values.username.$model"
                  :class="[validationClass('username')]"
                />
                <name-error :v="$v" path="username" />
              </div>
            </div>
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
              <div class="col-md-6">
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  value
                  required
                  autocomplete="email"
                  v-model="$v.values.email.$model"
                  :class="[validationClass('email')]"
                />
                <email-error :v="$v" path="email" />
              </div>
            </div>
            <div class="form-group row">
              <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
              <div class="col-md-6">
                <input
                  id="password"
                  type="password"
                  class="form-control"
                  name="password"
                  required
                  autocomplete="new-password"
                  v-model="$v.values.password.$model"
                  :class="[validationClass('password')]"
                />
                <div class="invalid-feedback" role="alert">
                  <required-error :v="$v" path="password" />
                  <minlength-error :v="$v" path="password" />
                </div>
              </div>
            </div>
            <div class="form-group row">
              <label
                for="password-confirm"
                class="col-md-4 col-form-label text-md-right"
              >Confirm Password</label>
              <div class="col-md-6">
                <input
                  id="password-confirm"
                  type="password"
                  class="form-control"
                  name="password_confirmation"
                  required
                  autocomplete="new-password"
                  v-model="$v.values.password_confirmation.$model"
                  :class="[validationClass('password_confirmation')]"
                />
                <div class="invalid-feedback" role="alert">
                  <required-error :v="$v" path="password_confirmation" />
                  <span
                    v-if="values.password_confirmation && !$v.values.password_confirmation.sameAsPassword"
                  >Password does not match.</span>
                </div>
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-6 offset-md-4">
                <button type="submit" class="btn btn-primary">Register</button>
                <router-link :to="{name: 'login'}" class="btn btn-link">Login</router-link>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const {
  required,
  alpha,
  email,
  minLength,
  sameAs
} = require("vuelidate/lib/validators");
const { mapMutations } = require("vuex");
const { FormValidationMixin } = require("./mixins");
const defaultValues = {
  username: "",
  email: "",
  password: "",
  password_confirmation: ""
};

export default {
  name: "RegForm",
  mixins: [FormValidationMixin],
  data() {
    return {
      values: { ...defaultValues }
    };
  },
  validations: {
    values: {
      username: { required, alpha, minLength: minLength(2) },
      email: { required, email },
      password: { required, minLength: minLength(8) },
      password_confirmation: { required, sameAsPassword: sameAs("password") }
    }
  },
  methods: {
    ...mapMutations(["updateSession"]),
    register() {
      axios
        .post("/register", this.values)
        .then(response => {
          // console.log(response);
          this.updateSession(response.data.session);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          // console.error(error.response);
          this.$notify({ type: "error", text: error.response.data.message });
        });
    }
  }
};
</script>

<style scoped>
</style>