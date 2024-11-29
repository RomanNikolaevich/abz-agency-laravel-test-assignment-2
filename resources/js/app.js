import './bootstrap';

import {createApp} from 'vue';
import App from './App.vue';
import router from './router/router.js';
import store from './store/store.js';
import '../css/app.css';

const app = createApp(App);
app.use(router);
app.use(store);
app.mount('#app');
