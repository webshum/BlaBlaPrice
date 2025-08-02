window.$ = window.jQuery = jQuery;
import '../css/index.css';

import { createApp } from 'vue/dist/vue.esm-bundler';
import { getCookie } from './helpers.js';

import { Fancybox } from "@fancyapps/ui/dist/fancybox/";
import "@fancyapps/ui/dist/fancybox/fancybox.css";

import './main.js';
import './order.js';

Fancybox.bind("[data-fancybox]");

const app = createApp({});
app.mount('#vue-app');