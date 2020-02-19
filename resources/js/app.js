/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

// Axios config
window.axios = require('axios').create({baseURL: 'http://localhost:8000/api'});
axios.interceptors.request.use(function(config) {
  const session = JSON.parse(sessionStorage.getItem('session'));
  if (session !== null) {
    config.headers['Authorization'] = `Bearer ${session.accessToken}`; // Attach authorization header
  }
  return config;
});

const UserProfileForm = require('./components/UserProfileForm.vue').default;
const LoginForm = require('./components/LoginForm').default;
const RegForm = require('./components/RegForm').default;

// Validation plugin
const Vuelidate = require('vuelidate').default;
Vue.use(Vuelidate);

// Routing plugin
const VueRouter = require('vue-router').default;
Vue.use(VueRouter);
const router = new VueRouter({
  routes: [
    {path: '/', name: 'index'},
    {path: '/login', component: LoginForm, name: 'login'},
    {path: '/register', component: RegForm, name: 'register'},
    {path: '/u/:username', component: UserProfileForm, name: 'profile'},
  ],
  mode: 'history'
});

// Notification plugin
const Notifications = require('vue-notification').default;
Vue.use(Notifications);

// Global state management plugin: vuex
const Vuex = require('vuex').default;
const { mapGetters, mapMutations } = require('vuex');
Vue.use(Vuex);
const initialState = {
  session: { // Default session state
    login: false,
    username: null,
    accessToken: null,
    refreshToken: null,
  }
};
const store = new Vuex.Store({
  state: { ...initialState },
  mutations: {
    updateSession: function(state, payload) {
      Object.keys(payload).map(key => state.session[key] = payload[key]);
      if (state.session.login === true) {
        sessionStorage.setItem('session', JSON.stringify(state.session)); // Save session
      } else {
        state.session = { ...initialState.session }; // Reset session state
        sessionStorage.removeItem('session'); // Delete session
      }
    }
  },
  getters: {
    session: function({session}) {
      return JSON.parse(sessionStorage.getItem('session')) || session; // Return stored state or initial
    }
  }
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
  el: '#app',
  router,
  store,
  computed: {
    ...mapGetters(['session'])
  },
  watch: {
    'session.login': function(value) {
      value === false && this.$router.replace({name: 'login'});
    }
  },
  methods: {
    ...mapMutations(['updateSession']),
    logout: function() {
      axios
        .get('/logout')
        .then(response => {
          // console.log(response);
          this.updateSession({login: response.data.login});
          this.$notify({type: 'info', text: response.data.message});
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
});
