/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
import {
    Form,
    HasError,
    AlertError
} from 'vform';
import moment from 'moment';




import Gate from "./Gate";
Vue.prototype.$gate = new Gate(window.user);


import Swal from 'sweetalert2'
window.Swal = Swal;





const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000
});
window.Toast = Toast;




window.Form = Form;
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)


import VueRouter from 'vue-router'
Vue.use(VueRouter)

import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, options)

import BootstrapVue from 'bootstrap-vue'
Vue.use(BootstrapVue)


let routes = [{
        path: '/dashboard',
        component: require('./components/Dashboard.vue').default
    },
    {
        path: '/personal',
        component: require('./components/Personal.vue').default
    },
    {
        path: '/esa',
        component: require('./components/ESA.vue').default
    },
    {
        path: '/contratos',
        component: require('./components/Contratos.vue').default
    },
    {
        path: '/developer',
        component: require('./components/Developer.vue').default
    },
    {
        path: '/profile',
        component: require('./components/Profile.vue').default
    },
    {
        path: '/users',
        component: require('./components/Users.vue').default
    },
    {
        path: '/vem',
        component: require('./components/VEM.vue').default
    },
    {
        path: '/inventario',
        component: require('./components/Inventario.vue').default
    },
    {
        path: '/nomina',
        component: require('./components/Nomina.vue').default
    }
]

const router = new VueRouter({
    mode: 'history',
    routes // short for `routes: routes`
})

const options = {
    color: '#bffaf3',
    failedColor: '#874b4b',
    thickness: '5px',
    transition: {
        speed: '0.2s',
        opacity: '0.6s',
        termination: 300
    },
    autoRevert: true,
    location: 'left',
    inverse: false
}


Vue.filter('upText', function (text) {
    return text.charAt(0).toUpperCase() + text.slice(1)
});

Vue.filter('myDate', function (created) {
    return moment(created).format('MMMM Do YYYY');
});

window.Fire = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


Vue.component(
    'passport-clients',
    require('./components/passport/Clients.vue').default
);

Vue.component(
    'passport-authorized-clients',
    require('./components/passport/AuthorizedClients.vue').default
);

Vue.component(
    'passport-personal-access-tokens',
    require('./components/passport/PersonalAccessTokens.vue').default
);

Vue.component(
    'Error-404',
    require('./components/Error404.vue').default
);

Vue.component('example-component', require('./components/ExampleComponent.vue').default);


/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
import {
    ValidationProvider,
    ValidationObserver,
    extend
} from "vee-validate";
import {
    required,
    email,
    excluded
} from "vee-validate/dist/rules";
var correos = [],
    razones = [],
    seriales = [];

window.Fuego = new Vue();

Fuego.$on("correos", data => {
    correos = data;
});
Fuego.$on("razones", data => {
    razones = data;
});
Fuego.$on("seriales", data => {
    seriales = data;
});

function comparador(c, array) {
    let validador = false;

    for (let i = 0; i < array.length; i++) {
        if (c === array[i]) {
            validador = true;
        }
    }

    return validador;
}

extend("requerido", {
    ...required,
    message: "El campo {_field_} es obligatorio"
});
extend("correo", {
    ...email,
    message: "Ingrese una direccion de correo válida"
});
extend("excluyeC", {
    validate(value) {
        if (!comparador(value, correos)) {
            return true;
        }
        return "Este correo ya ha sido utilizado";
    }
});
extend("excluyeSerial", {
    validate(value) {
        if (!comparador(value, seriales)) {
            return true;
        }
        return "Este serial ya ha sido utilizado";
    }
});
extend("excluyeR", {
    validate(value) {
        if (!comparador(value, razones)) {
            return true;
        }
        return "Esta razón social ya ha sido utilizado";
    }
});


const app = new Vue({
    el: '#app',
    data: {
        busqueda: '',
        filter: null,
        filterOn: [],
    },
    methods: {
        buscar() {
            this.busqueda = this.filter
            Fire.$emit('buscando');
        }
    },
    router,
});
