
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

Vue.component('example', require('./components/Example.vue'));

const app = new Vue({
    el: '#app'
});

$(document).ready(function() {
    $('footer').stickyFooter();
});

// Re-render anything bound to page resize when the navbar expands
(function() {
    var interval;
    $('#navbar').on('show.bs.collapse hide.bs.collapse', function() {
        if (interval) {
            clearInterval(interval);
        }
        interval = setInterval(function() {
            $(window).trigger('resize');
        }, 50);
    }).on('hidden.bs.collapse shown.bs.collapse', function() {
        clearInterval(interval);
    });
})();

require('./filter');