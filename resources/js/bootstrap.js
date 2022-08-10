import _ from 'lodash';
window._ = _;

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
window.axios.defaults.baseURL = 'http://doopaza.com/api/';
// window.axios.defaults.baseURL = 'http://127.0.0.1:8000/api/';

// try {
//     window.Popper = require('popper.js').default;
//     window.$ = window.jQuery = require('jquery');
//     require('bootstrap');
// } catch (e) {}
//
// window.axios = require('axios');
// // window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
//
// axios.interceptors.request.use(
//     (config) => {
//         let token = localStorage.getItem('token');
//
//         if (token) {
//             config.headers['Authorization'] = `Bearer ${ token }`;
//         }
//
//         return config;
//     },
//
//     (error) => {
//         return Promise.reject(error);
//     }
// );



