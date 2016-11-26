
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

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app',
    data: {
        message: "Hello Vue!"
    }
});

// Echo.channel('chat-room.1')
//     .listen('chat-room.1', 'NewProject', (e) => {
//         console.log(e.project.title);
//     });
    // .notification((AddProjects) => {
    //     console.log(AddProjects.type);
    // });
//

// Pusher.log = function(msg) {
//     console.log(msg);
// };

var channel = pusher.subscribe('chat-room.1');

// var context = { title: 'Pusher' };
// var handler = function(){
//     console.log('My name is ' + this.project);
// };
channel.bind('AddProjects', function (data) {
    console.log(data);
});
// channel.bind('AddProjects', function(project, user) {
//     console.log(project);
// });

// Echo.join('chat-room.1')
//     .here(function (members) {
//         // runs when you join, and when anyone else leaves or joins
//         console.table(members);
//     });
//
// Echo.join('chat-room.1')
//     .here(function (members) {
//         // runs when you join
//         console.table(members);
//     })
//     .joining(function (joiningMember, members) {
//         // runs when another member joins
//         console.table(joiningMember);
//     })
//     .leaving(function (leavingMember, members) {
//         // runs when another member leaves
//         console.table(leavingMember);
//     });