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

// Dropdown menu on hover initialing
$('.dropdown-toggle').dropdownHover();
console.log(contentCSS)
// TinyMCE initializing
tinymce.init({
    plugins: 'code link image lists table paste preview print anchor fullscreen',
    selector: ".tinymce",
    toolbar: 'styleselect | bold italic underline strikethrough removeformat | alignleft aligncenter alignright alignjustify lists | cut copy paste | bullist numlist | outdent indent blockquote | subscript superscript | undo redo | link unlink image table| code print preview fullscreen',
    menubar: false,
    allow_conditional_comments: false,
    content_css: contentCSS,
    images_upload_handler: function (blobInfo, success, failure) {
        var xhr, formData;

        xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', images_upload_url);

        xhr.onload = function () {
            var json;

            if (xhr.status != 200) {
                failure('HTTP Error: ' + xhr.status);
                return;
            }

            json = JSON.parse(xhr.responseText);

            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);
                return;
            }

            success(json.location);
        };

        formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        let token = document.head.querySelector('meta[name="csrf-token"]');

        if (token) {
            formData.append('_token', token.content);
        } else {
            console.error('CSRF token not found: https://laravel.com/docs/csrf#csrf-x-csrf-token');
        }
        xhr.send(formData);
    }
});

// File input
// $("#profile-picture").fileinput({ 'showUpload': false, 'previewFileType': 'any', 'theme': 'fas' });
const moment = require('moment')
const tempusDominus = require('@eonasdan/tempus-dominus')
// Datepicker initializing
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

// Selectpicker initializing
$('.selectpicker').selectpicker({
    size: 5
})
