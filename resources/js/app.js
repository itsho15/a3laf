/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');
Vue.prototype.laravel = window.Laravel;
Vue.prototype.global = {};

import Pusher from "pusher-js"
import Echo from "laravel-echo"

window.Echo = new Echo({
  broadcaster: 'pusher',
  key: '0540fbb9f7be8f13269e',
  cluster: 'ap2',
  forceTLS: false
});

