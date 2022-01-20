
window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */
// require('jquery')
try {
    window.$ = window.jQuery = require('jquery');
    require('jquery-ui')

    require('moment');
    require('popper.js/dist/popper.js');
    require('bootstrap');

} catch (e) {
    console.log(e.getMessage())
}

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Next we will register the CSRF Token as a common header with Axios so that
 * all outgoing HTTP requests automatically have it attached. This is just
 * a simple convenience so we don't have to attach every token manually.
 */

let token = document.head.querySelector('meta[name="csrf-token"]');

if (token) {
    window.axios.defaults.headers.common['X-CSRF-TOKEN'] = token.content;
} else {
    console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
}

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo'

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     encrypted: true
// });
const moment = require('moment')
const tempusDominus = require('@eonasdan/tempus-dominus')

document.querySelectorAll('.datetimepicker').forEach(item => {
    new tempusDominus.TempusDominus(item, {
        hooks: {
            inputFormat: (context, date) => { return moment(date).format('YYYY-MM-DD HH:mm:ss') },
        },
        display: { sideBySide: true }
    })
})

document.querySelectorAll('.timepicker').forEach(item => {
    new tempusDominus.TempusDominus(item, {
        localization: { locale: 'en' },
        hooks: {
            inputFormat: (context, date) => { return moment(date).format('LT') }
        }
    })
})
document.querySelectorAll('.datepicker').forEach(item => {
    new tempusDominus.TempusDominus(item, {
        hooks: {
            inputFormat: (context, date) => { return moment(date).format('YYYY-MM-DD') }
        }
    })
})

require('bootstrap-select')
$('.selectpicker').selectpicker({
    size: 5
})
require('datatables.net-bs4')
require('bootstrap-notify')
// require('../../../public/material-dashboard-master/assets/js/core/bootstrap-material-design.min.js')
require('jquery-validation')
require('sweetalert2')
require('perfect-scrollbar')
require('twitter-bootstrap-wizard')
require('bootstrap-tagsinput')
require('jasny-bootstrap')
require('@foxythemes/jvectormap')
require('nouislider')
require('arrive')
require('chartist')
require('../../../public/js/file-input.js')
require('bootstrap-hover-dropdown')
require('cropper')

$('.dropdown-toggle').dropdownHover();
