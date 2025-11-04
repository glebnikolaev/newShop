import './bootstrap';
import { createApp } from 'vue';
import App from './App.vue';
import store from './store';
import router from './router';
import bus from './bus';
import utilities from './utilities';

if (!localStorage.getItem('cartiny_cart')) {
    localStorage.setItem('cartiny_cart', JSON.stringify({}));
}

const app = createApp(App);

app.config.globalProperties.$bus = bus;
app.config.globalProperties.$_ = utilities;

app.use(store);
app.use(router);

app.mount('#app');

// keep a small init hook similar to previous behavior
document.documentElement.classList.remove('has-spinner-active');

export default app;
