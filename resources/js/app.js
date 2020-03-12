/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');

// Configure axios.
axios.defaults.baseURL = 'http://localhost:8000/api';
axios.interceptors.request.use(config => {
  const session = JSON.parse(sessionStorage.getItem('session'));
  if (session !== null) {
    config.headers['Authorization'] = `Bearer ${session.accessToken}`; // Attach authorization header
  }
  return config;
});

const Profile = require('./components/Profile').default;
const CreateProfile = require('./components/CreateProfile').default;
const LoginForm = require('./components/LoginForm').default;
const RegForm = require('./components/RegForm').default;
const PersonalInformationForm = require("./components/PersonalInformationForm").default;
const ContactPersonForm = require("./components/ContactPersonForm").default;
const AcademicQualificationForm = require("./components/AcademicQualificationForm").default;
const WorkExperienceForm = require("./components/WorkExperienceForm").default;
const ProfessionalCertificationForm = require("./components/ProfessionalCertificationForm").default;
const ProfessionalMembershipForm = require("./components/ProfessionalMembershipForm").default;
const SkillForm = require("./components/SkillForm").default;
const RefereeForm = require("./components/RefereeForm").default
const Dashboard = require('./components/Dashboard').default;
const Users = require('./components/Users').default;
const Jobs = require('./components/Jobs').default;
const Permissions = require('./components/Permissions').default;
const Roles = require('./components/Roles').default;
const Http403 = require('./components/Http403').default;
const Http404 = require('./components/Http404').default;
const Http500 = require('./components/Http500').default;

// State management plugin
const Vuex = require('vuex').default;
const {
  mapGetters,
  mapMutations
} = require('vuex');
Vue.use(Vuex);
const defaultState = {
  session: {
    // Default session state
    login: false,
    user: {},
    accessToken: "",
    refreshToken: "",
  }
};
const store = new Vuex.Store({
  state: {
    ...defaultState
  },
  mutations: {
    updateSession(state, payload) {
      Object.keys(payload).map(key => {
        key in state.session && (state.session[key] = payload[key]);
      });
      if (state.session.login === true) {
        sessionStorage.setItem('session', JSON.stringify(state.session)); // Save session
      } else {
        state.session = {
          ...defaultState.session
        }; // Reset session state
        sessionStorage.removeItem('session'); // Delete stored session
      }
    }
  },
  getters: {
    session({
      session
    }) {
      return JSON.parse(sessionStorage.getItem('session')) || session; // Return stored session or initial
    }
  }
});

// Routing plugin
const VueRouter = require('vue-router').default;
Vue.use(VueRouter);
const router = new VueRouter({
  routes: [{
      name: 'index',
      path: '/',
    },
    {
      name: 'login',
      path: '/login',
      component: LoginForm
    },
    {
      name: 'register',
      path: '/register',
      component: RegForm
    },
    {
      name: 'profile',
      path: '/u/:username',
      component: Profile,
      meta: {
        loginRequired: true
      },
      beforeEnter(to, from, next) {
        if (to.params.username !== store.getters.session.user.username) {
          next({
            name: 'forbidden'
          });
        } else {
          next();
        }
      }
    },
    {
      name: 'create-profile',
      path: '/create-profile',
      component: CreateProfile,
      meta: {
        loginRequired: true
      },
      children: [{
          name: 'add-personal-information',
          path: 'personal-information',
          component: PersonalInformationForm,
          meta: {
            index: 0
          }
        },
        {
          name: 'add-contact-person',
          path: 'contact-person',
          component: ContactPersonForm,
          meta: {
            index: 1
          }
        },
        {
          name: 'add-academic-qualifications',
          path: 'academic-qualifications',
          component: AcademicQualificationForm,
          meta: {
            index: 2
          }
        },
        {
          name: 'add-work-experience',
          path: 'work-experience',
          component: WorkExperienceForm,
          meta: {
            index: 3
          }
        },
        {
          name: 'add-professional-certifications',
          path: 'professional-certifications',
          component: ProfessionalCertificationForm,
          meta: {
            index: 4
          }
        },
        {
          name: 'add-professional-memberships',
          path: 'professional-memberships',
          component: ProfessionalMembershipForm,
          meta: {
            index: 5
          }
        },
        {
          name: 'add-skills',
          path: 'skills',
          component: SkillForm,
          meta: {
            index: 6
          }
        },
        {
          name: 'add-referees',
          path: 'referees',
          component: RefereeForm,
          meta: {
            index: 7
          }
        }
      ],
      redirect: {
        name: 'add-personal-information'
      }
    },
    {
      name: 'dashboard',
      path: '/dashboard',
      component: Dashboard,
      meta: {
        loginRequired: true,
        adminRequired: true
      },
      children: [{
          name: 'users',
          path: 'users',
          component: Users
        },
        {
          name: 'permissions',
          path: 'permissions',
          component: Permissions
        },
        {
          name: 'roles',
          path: 'roles',
          component: Roles
        },
        {
          name: 'jobs',
          path: 'jobs',
          component: Jobs
        }
      ],
      redirect: {
        name: 'jobs'
      }
    },
    {
      name: 'forbidden',
      path: '/403',
      component: Http403
    },
    {
      name: 'server-error',
      path: '/500',
      component: Http500
    },
    {
      name: 'not-found',
      path: '*',
      component: Http404
    }
  ],
  mode: 'history'
});

router.beforeEach((to, from, next) => {
  // Guard for routes requiring login.
  if (to.matched.some(record => record.meta.loginRequired === true) &&
    store.getters.session.login === false) {
    next({
      name: 'login',
      query: {
        next: to.fullPath
      }
    });
  } else {
    next();
  }
});
router.beforeEach((to, from, next) => {
  // Guard for routes requiring admin privileges.
  if (store.getters.session.login === true &&
    to.matched.some(record => record.meta.adminRequired === true) &&
    !store.getters.session.user.givenRole['admin']) {
    next({
      name: 'forbidden'
    });
  } else {
    next()
  }
});

// Validation plugin
const Vuelidate = require('vuelidate').default;
Vue.use(Vuelidate);

// Notification plugin
const Notifications = require('vue-notification').default;
Vue.use(Notifications);

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
  store,
  router,
  computed: {
    ...mapGetters(['session'])
  },
  watch: {
    'session.login': function(value) {
      if (value === false) {
        this.$router.push({
          name: 'login'
        });
      } else {
        this.$router.push(this.$route.query.next || this.session.user.givenRole['admin'] ? {
          name: 'dashboard'
        } : {
          name: 'profile',
          params: {
            username: this.session.user.username
          }
        });
      };
    }
  },
  methods: {
    ...mapMutations(['updateSession']),
    logout() {
      axios
        .get('/logout')
        .then(response => {
          // console.log(response);
          this.updateSession({
            login: response.data.login
          });
          this.$notify({
            type: 'info',
            text: response.data.message
          });
        })
        .catch(error => {
          // console.error(error.response);
        });
    }
  }
});