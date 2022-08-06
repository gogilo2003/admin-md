window._ = require('lodash');
require('./bootstrap.js')

import { createApp, h } from 'vue'
import Authors from './components/Authors.vue'
import Vue3EasyDataTable from 'vue3-easy-data-table';
import 'vue3-easy-data-table/dist/style.css';

const app = createApp({
    render: () => h(Authors)
})

app.component('EasyDataTable', Vue3EasyDataTable)

app.mount('#authors_app')
