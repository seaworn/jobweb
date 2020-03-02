<template>
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card">
        <div class="card-header">Login</div>
        <div class="card-body">
          <form action method="POST" @submit.prevent="handleSubmit" novalidate>
            <div class="form-group row">
              <label for="email" class="col-md-4 col-form-label text-md-right">E-Mail Adress</label>
              <div class="col-md-6">
                <input
                  id="email"
                  type="email"
                  class="form-control"
                  name="email"
                  required
                  autocomplete="email"
                  autofocus
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
                  autocomplete="current-password"
                  v-model="$v.values.password.$model"
                  :class="[validationClass('password')]"
                />
                <span class="invalid-feedback" role="alert">
                  <required-error :v="$v" path="password" />
                </span>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-md-6 offset-md-4">
                <div class="form-check">
                  <input
                    class="form-check-input"
                    type="checkbox"
                    name="remember"
                    id="remember"
                    v-model="values.remember"
                    :checked="values.remember"
                  />
                  <label class="form-check-label" for="remember">Remember Me</label>
                </div>
              </div>
            </div>
            <div class="form-group row mb-0">
              <div class="col-md-8 offset-md-4">
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="btn btn-link" href="#">Forgot Your Password?</a>
                <p>
                  Don't have an account?
                  <router-link :to="{name: 'register'}" class="btn btn-link">Register</router-link>
                </p>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
const { required, email } = require("vuelidate/lib/validators");
const { mapMutations } = require("vuex");
const { FormMixin } = require("./mixins");
const initialValues = {
  email: "",
  password: "",
  remember: false
};

export default {
  name: "LoginForm",
  mixins: [FormMixin],
  data: function() {
    return {
      values: { ...initialValues }
    };
  },
  validations: {
    values: {
      email: { required, email },
      password: { required }
    }
  },
  methods: {
    ...mapMutations(["updateSession"]),
    handleSubmit: function() {
      axios
        .post("/login", this.values)
        .then(response => {
          // console.log(response);
          this.updateSession(response.data.session);
          const next = this.$route.query.next || {
            name: "profile",
            params: { username: response.data.session.user.username }
          }
          this.$router.push(next);
          this.$notify({ type: "success", text: response.data.message });
        })
        .catch(error => {
          console.error(error.response);
          this.$notify({ type: "error", text: error.response.data.message });
        });
    }
  }
};
</script>

<style scoped>
</style>