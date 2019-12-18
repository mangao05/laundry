/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');


window.Vue = require('vue');

import VueRouter from 'vue-router'
import Vue from 'vue';
import VueHtmlToPaper from 'vue-html-to-paper';
import VueInputDropdown from 'vue-input-dropdown';
import VueMoment from 'vue-moment';
import { Form, HasError, AlertError } from 'vform'
import VueSweetalert2 from 'vue-sweetalert2';
import Print from '@mathewparet/vue-print';
import Swal from 'sweetalert2';
import VueBarcode from 'vue-barcode';
import vSelect from 'vue-select'
import VueApexCharts from 'vue-apexcharts'
import VuePhoneNumberInput from 'vue-phone-number-input';
import UserTransaction from './components/UserTransaction.vue';
import Vue2Filters from 'vue2-filters'
import VueToastr from "vue-toastr";
import Datepicker from 'vuejs-datepicker';

// Start Modal 

import UserModal from './components/modal/UserModal';
import RoleModal from './components/modal/RoleModal.vue';
import BranchModal from './components/modal/BranchModal';
import ServiceModal from './components/modal/ServiceModal';
import LaundryModal from './components/modal/LaundryModal';
import ReceiptModal from './components/modal/ReceiptModal';
import ReviewModal from './components/Transactions/TransactionReviewModal.vue';


import 'vue-phone-number-input/dist/vue-phone-number-input.css';



// End Modal



const swaloptions = {
  confirmButtonColor: '#41b882',
  cancelButtonColor: '#ff7674'
}

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
});

window.Toast = Toast;
window.Swal = Swal;
window.Form = Form;
window.Fire = new Vue();
Vue.use(Print);
Vue.use(VueSweetalert2, swaloptions)
Vue.use(VueRouter);
Vue.use(VueMoment);
Vue.use(VueRouter);
Vue.use(VueInputDropdown);
Vue.use(Vue2Filters);
Vue.use(VueToastr);
// Start Components
Vue.component('vue-phone-number-input', VuePhoneNumberInput);
Vue.component('apexchart', VueApexCharts)
Vue.component('v-select', vSelect)
Vue.component(HasError.name, HasError)
Vue.component(AlertError.name, AlertError)
Vue.component('service-modal', ServiceModal);
Vue.component('laundry', LaundryModal);
Vue.component('UserModal',UserModal);
Vue.component('barcode', VueBarcode);
Vue.component('RoleModal',RoleModal);
Vue.component('BranchModal',BranchModal);
Vue.component('receipt-modal',ReceiptModal);
Vue.component('review-modal', ReviewModal);
Vue.component('datepicker',Datepicker);

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

// End of Components
let routes = [
  { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/user', component: require('./components/User.vue').default },
    { path: '/home', component: require('./components/Dashboard.vue').default },
    { path: '/addservice', component: require('./components/AddService.vue').default },
    { path: '/newlaundry', component: require('./components/UserTransaction.vue').default },
    { path: '/oldlaundry', component: require('./components/Laundry.vue').default },
    { path: '/developer', component: require('./components/Developer.vue').default },
    { path: '/role', component: require('./components/UserType.vue').default },
    { path: '/branch', component: require('./components/Branch.vue').default },
    { path: '/transaction', component: require('./components/Transactions/Transaction.vue').default },
    { path: '/usertransaction', component: UserTransaction },
    { path: '/customers', component:  require('./components/customer/CustomerComponent.vue').default },
    { path: '/keyboard', component: require('./components/keyboard/NumberKeysComponent.vue').default },
    { 
      path: '/receipt/:id',
      name: 'printReceipt',
      component: require('./components/PrintPreview.vue').default
    }
  ]

  const options = {
    name: '_blank',
    specs: [
      'fullscreen=yes',
      'titlebar=',
      'scrollbars=yes'
    ],
    styles: [
      'https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css',
      'https://unpkg.com/kidlat-css/css/kidlat.css'
    ]
  }

Vue.use(VueHtmlToPaper, options);

const router = new VueRouter({
mode:'history',
routes // short for `routes: routes`
})

Vue.filter('currency', function (value) {
  // return '₱' + parseFloat(value).toFixed(2);

  // let val = (value/1).toFixed(2).replace(',', '.');
  return '₱' +value.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
});

Vue.filter('phone', function (phone) {
  return phone.replace(/[^0-9]/g, '')
              .replace(/(\d{3})(\d{3})(\d{4})/, '($1) $2-$3');
});

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i);
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

// Vue.component('example-component', require('./components/ExampleComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router
});
