require('./bootstrap')
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

// import './bootstrap';
// window.route = require('./route');
// window.Vue = require('vue');
// import store from './store'
// import Vue from 'vue'
// import axios from 'axios'

// Vue.use(axios)
/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
function studle_case(str) {
    return str.replace(/([a-zA-Z])(?=[A-Z])/g, '$1-').toLowerCase()
}

// const req = require.context('./components/', true, /\.(js|vue)$/i);
// req.keys().map(key => {
//     const value = key.match(/\w+/)[0];
//     const component = require('./components/' + value);
//     const name = studle_case(value)

//     return Vue.component(name, component)
// });


// new Vue({
//     el: '#app',
//     methods: {
//         dobOnChange(e) {
//             console.log(e);
//             console.log('change')
//         }
//     }
// });
