require('./bootstrap');
import Vue from 'vue';
import store from './store';
import router from './router';
import App from './App.vue';

Vue.component('App', App);

if (!localStorage.getItem('cartiny_cart')) {
    localStorage.setItem('cartiny_cart', JSON.stringify({}));
}

Object.defineProperty(Vue.prototype,"$bus",{
    get: function() {
        return this.$root.bus;
    }
});

new Vue({
    store,
    router,
    render: h => h(App),
    mounted() {
        document.documentElement.classList.remove('has-spinner-active')
    },
    data: {
        bus: new Vue({})
    }
}).$mount('#app');
