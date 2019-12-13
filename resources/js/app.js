/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
 import Chart from 'chart.js';
// let myChart = new Chart();

window.Vue = require('vue');
import { Form, HasError, AlertError } from 'vform';

import Swal from 'sweetalert2';
window.Swal = Swal;

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});
// window.$ = require('jquery')
// window.JQuery = require('jquery')
//  var dt = require( 'datatables.net' )();

window.Toast = Toast;


window.Form = Form
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)

Vue.component('pagination', require('laravel-vue-pagination'));

import VueRouter from 'vue-router'
Vue.use(VueRouter);

let routes = [
    { path: '/dashboard', component: require('./components/admin/Dashboard.vue').default },
    { path: '/criminals', component: require('./components/admin/Criminals.vue').default },
    { path: '/users', component: require('./components/admin/Users.vue').default },
    { path: '/userProfile', component: require('./components/admin/UserProfile.vue').default },
    { path: '/locationUpdate', component: require('./components/admin/LocationUpdate.vue').default },
    { path: '/complains', component: require('./components/admin/WorkPlaceComplain.vue').default },
    { path: '/publicPlaceComplain', component: require('./components/admin/PublicPlaceComplain.vue').default },
    { path: '/socialMediaComplain', component: require('./components/admin/SocialMediaComplain.vue').default },
    { path: '/missingPerson', component: require('./components/admin/MissingPersons.vue').default },
    { path: '/missingPersonLocation', component: require('./components/admin/MissingPersonLocation.vue').default },
    { path: '/policeStation', component: require('./components/admin/PoliceStation.vue').default },
    { path: '/safety', component: require('./components/admin/Safety.vue').default },


    { path: '/', component: require('./components/front/Home.vue').default },
    { path: '/mostWanted', component: require('./components/front/MostWanted.vue').default },
    { path: '/complainBox', component: require('./components/front/ComplainBox.vue').default },
    { path: '/showAllMissingPerson', component: require('./components/front/ShowAllMissingPerson.vue').default },
    { path: '/safetyAndEdu', component: require('./components/front/SafetyAndEdu.vue').default },
    { path: '*', component: require('./components/front/NotFound.vue').default },
    
    { path: '/criminal/:id', component: require('./components/admin/CriminalProfile.vue').default, name: 'showCriminal' },
    { path: '/mostWanted/:id', component: require('./components/front/MostWantedProfile.vue').default, name: 'showMostWanted' },
    { path: '/offender/:id', component: require('./components/front/OffenderProfile.vue').default, name: 'showOffender' },
    { path: '/missingPerson/:id', component: require('./components/admin/MissingPersonProfile.vue').default, name: 'showMissingPerson' },
    { path: '/missingPersonProfileFront/:id', component: require('./components/front/MissingPersonProfileFront.vue').default, name: 'showMissingPersonProfile' },
    
  ]

const router = new VueRouter({
    
    routes ,// short for `routes: routes`
    mode:'hash',
})

window.Fire = new Vue();

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.component('example-component', require('./components/admin/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});

// const front = new Vue({
//   el: '#front',
//   router
// });
