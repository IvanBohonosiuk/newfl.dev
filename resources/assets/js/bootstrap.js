var csrf_token = document.querySelector("meta[name='csrf-token']").getAttribute('content');

window._ = require('lodash');
// window._ = require('underscore');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

window.$ = window.jQuery = require('jquery');
// require('bootstrap-sass');
require('./materialize.min');

/**
 * Vue is a modern JavaScript library for building interactive web interfaces
 * using reactive data binding and reusable components. Vue's API is clean
 * and simple, leaving you to focus on building your next great project.
 */

window.Vue = require('vue');
// require('vue-resource');
var VueResource = require('vue-resource');
var VueAsyncData = require('vue-async-data');

Vue.use(VueResource);
Vue.use(VueAsyncData);

/**
 * We'll register a HTTP interceptor to attach the "CSRF" header to each of
 * the outgoing requests issued by this application. The CSRF middleware
 * included with Laravel will automatically verify the header's value.
 */

Vue.http.interceptors.push((request, next) => {
    request.headers.set('X-CSRF-TOKEN', Laravel.csrfToken);

    next();
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from "laravel-echo"
//
// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: 'f30c876eff6f4e224697',
//     cluster: 'eu',
// });

import Pusher from 'pusher-js';


// window.settings = function() {
//     config = 'http://127.0.0.1:6378';
// };

// window.Pusher = require('./components/pusher');
// Pusher._init(window.settings.config.broadcast.host);
// Pusher._init(window.settings.config);
