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
    import { fetchCart } from './services/cartService';
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
            async getCart() {
                try {
                    const cart = await fetchCart();
                    this.$store.dispatch('updateCart', cart);
                } catch (error) {
                    if (process.env.NODE_ENV !== 'production') {
                        console.error('Не удалось загрузить корзину', error);
                    }
                }
            },
        }
    }
</script>
