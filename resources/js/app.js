/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue');
window._ = require('lodash');

// Axios config
axios.defaults.baseURL = 'http://localhost:8000/api';
axios.interceptors.request.use(function (config) {
    const session = JSON.parse(sessionStorage.getItem('session'));
    if (session !== null) {
        config.headers['Authorization'] = `Bearer ${session.accessToken}`; // Attach authorization header
    }
    return config;
});

const ProfileForm = require('./components/ProfileForm').default;
const LoginForm = require('./components/LoginForm').default;
const RegForm = require('./components/RegForm').default;
const Profile = require('./components/Profile').default;
const AdminPanel = require('./components/AdminPanel').default;

// State management plugin
const Vuex = require('vuex').default;
const {
    mapGetters,
    mapMutations
} = require('vuex');
Vue.use(Vuex);
const initialState = {
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
        ...initialState
    },
    mutations: {
        updateSession: function (state, payload) {
            Object.keys(payload).map(function (key) {
                key in state.session && (state.session[key] = payload[key]);
            });
            if (payload.login === true) {
                sessionStorage.setItem('session', JSON.stringify(state.session)); // Save session
            } else if (payload.login === false) {
                state.session = {
                    ...defaultState.session
                }; // Reset session state
                sessionStorage.removeItem('session'); // Delete stored session
            }
        }
    },
    getters: {
        session: function ({
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
            }
        },
        {
            name: 'profile-form',
            path: '/u/:username/edit',
            component: ProfileForm,
            meta: {
                loginRequired: true
            }
        }
    ],
    mode: 'history'
});

router.beforeEach(function (to, from, next) {
    if (to.meta.loginRequired && !store.state.session.login)
        next({
            name: 'login',
            query: {
                next: to.fullPath
            }
        });
    else
        next();
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
        'session.login': function (value) {
            if (value === false) this.$router.push({
                name: 'login'
            });
        }
    },
    methods: {
        ...mapMutations(['updateSession']),
        logout: function () {
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
                    console.error(error.response);
                });
        }
    }
});
