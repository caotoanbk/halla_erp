window.Vue = require('vue');
import moment from 'moment';
import { Form } from 'vform'

import "babel-polyfill"
import 'whatwg-fetch'

import vSelect from 'vue-select'
Vue.component('v-select', vSelect)

import swal from 'sweetalert2'
window.swal = swal

Vue.filter('myDate', function(created) {
  if(created)
    return moment(created).format('YYYY-MM-DD HH:mm:ss');
  return ''
});

window._ = require('lodash')

const toast = swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 3000
})

window.toast = toast
window.Form = Form

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';


import VueProgressBar from 'vue-progressbar'
Vue.use(VueProgressBar, {
  color: 'rgb(143, 255, 199)',
  failedColor: 'red',
  height: '4px'
})

import money from 'v-money'
Vue.use(money, {precision: 4})

import ShowPaymentplanComponent from './ShowPaymentplanComponent.vue'

const app = new Vue({
    el: '#approval_app',
    components: { 
        'show-paymentplan': ShowPaymentplanComponent
    },
});
