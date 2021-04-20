/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

import VueRouter from 'vue-router'
import swal from 'sweetalert'
import Vue from 'vue'
import VueSuggestion from 'vue-suggestion'

import { Form, HasError, AlertError } from 'vform'

import JsonExcel from 'vue-json-excel'

import * as firebase from 'firebase/app'
import 'firebase/firestore';

Vue.use(VueSuggestion)

const firebaseConfig = {
    apiKey: "AIzaSyDKhw55SP9oMwUm8wHuHHiYLps_buf-CHA",
    authDomain: "login1-b79c2.firebaseapp.com",
    databaseURL: "https://login1-b79c2.firebaseio.com",
    projectId: "login1-b79c2",
    storageBucket: "login1-b79c2.appspot.com",
    messagingSenderId: "346076197050",
    appId: "1:346076197050:web:d46106a801091eac7c5283",
    measurementId: "G-4KVLWGKV8N"
};

firebase.initializeApp(firebaseConfig);
export const db = firebase.firestore();
export const fb_aux = firebase;

Vue.component('downloadExcel', JsonExcel)

Vue.use(VueRouter)

let routes = [
    { path: '/dashboard', component: require('./components/Dashboard.vue').default },
    { path: '/recursos', component: require('./components/Recursos.vue').default },
    { path: '/usuarios', component: require('./components/Usuarios.vue').default },
    { path: '/recursos-necesarios', component: require('./components/RecursosNecesarios.vue').default },
    { path: '/informes', component: require('./components/Informes.vue').default },
    { path: '/preguntas', component: require('./components/Preguntas.vue').default },

]

const router = new VueRouter({

        routes // short for `routes: routes`
    })
    /**
     * The following block of code may be used to automatically register your
     * Vue components. It will recursively scan this directory for the Vue
     * components and automatically register them with their "basename".
     *
     * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
     */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app',
    router,
});