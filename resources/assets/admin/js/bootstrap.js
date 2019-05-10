window.Popper = require('popper.js').default;
window.$ = window.jQuery = require('jquery');
require('bootstrap');
window.moment = require('moment');

require('jquery-pjax');

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.token = document.head.querySelector('meta[name="csrf-token"]');
if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': token.content}});
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}