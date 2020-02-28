/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */
require('./bootstrap');

window.Vue = require('vue');
import PortalVue from 'portal-vue'

Vue.use(PortalVue)

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('core', require('./components/Core.vue').default);
Vue.component('lista', require('./components/Lista.vue').default);
Vue.component('modalcomponent', require('./components/ComponenteModal.vue').default);
Vue.component('modalstatus', require('./components/Componentestatus.vue').default);
Vue.component('modaladd', require('./components/ComponenteAdd.vue').default);
Vue.component('login', require('./components/login.vue').default);
Vue.component('asistencia', require('./components/assist-control.vue').default);
Vue.component('boton', require('./components/boton.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
});
