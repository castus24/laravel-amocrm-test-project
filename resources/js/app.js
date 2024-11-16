import './bootstrap';

import { createApp } from 'vue';
import vuetify from "./vuetify";
import 'vuetify/styles';
import routes from './routes';
import store from './store';
import { createRouter, createWebHistory } from 'vue-router';

const router = createRouter({
    history: createWebHistory(),
    routes,
});

import App from './App.vue';

const app = createApp(App);

app.use(vuetify);
app.use(router);
app.use(store);
app.mount('#app');
