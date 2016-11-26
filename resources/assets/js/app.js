
/**
 * First we will load all of this project's JavaScript dependencies which
 * include Vue and Vue Resource. This gives a great starting point for
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the body of the page. From here, you may begin adding components to
 * the application, or feel free to tweak this setup for your needs.
 */

var pusher = new Pusher("f30c876eff6f4e224697", {
    cluster: 'eu'
});

var channel = pusher.subscribe('project');

channel.bind('NewProject', function (data) {
    console.log(data.project.title);
});

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data: {
        message: "Hello Vue!"
    }
});

// Pusher.log = function(msg) {
//     console.log(msg);
// };


