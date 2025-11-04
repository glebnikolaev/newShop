<template>
    <div id="app">
        <main-nav-bar/>
        <featured/>
        <router-view/>
        <footer-bar/>
        <div class="btn-back-to-top" id="myBtn">
		    <span class="symbol-btn-back-to-top"><i class="zmdi zmdi-chevron-up"></i></span>
        </div>
        <product/>
        <cart-aside/>
    </div>
</template>

<script>

    import mainNavBar from './components/MainNavBar';
    import footerBar from "./components/FooterBar";
    import cartAside from "./components/CartAside";
    import product from './components/Product';
    import axios from "axios";
    import bus from './bus';
    import Featured from './components/Featured';

    export default {
        name: 'home',
        components: {
            Featured,
            mainNavBar,
            cartAside,
            footerBar,
            product,
        },
        mounted() {
            this.getCart();
        },
        methods: {
            getCart() {
                axios.get('/api/v1/cart/get-cart')
                    .then(response => {
                        this.$store.dispatch('updateCart', response.data);
                    }).finally(() => {
                    bus.emit('update-cart-count');
                });
            },
        }
    }
</script>
