<template>
    <div class="wrap-header-cart js-panel-cart" :class="{ 'show-header-cart': isVisible }">
        <div class="s-full js-hide-cart" @click="close"></div>

        <div class="header-cart flex-col-l p-l-65 p-r-25">
            <div class="header-cart-title flex-w flex-sb-m p-b-8">
                <span class="mtext-103 cl2">Корзина</span>

                <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart" @click="close">
                    <i class="zmdi zmdi-close"></i>
                </div>
            </div>

            <div class="header-cart-content flex-w js-pscroll">
                <ul class="header-cart-wrapitem w-full" v-if="cart.count > 0">

                    <li class="header-cart-item flex-w flex-t m-b-12" v-for="product in cart.data">
                        <div class="header-cart-item-img" @click.prevent='openProductModal(product)'>
                            <img
                                 :src="product.image ? product.image : '/photos/1/no-photo.jpg'"
                                 :alt="product.name"

                            />

                        </div>

                        <div class="header-cart-item-txt">
                            <a @click.prevent='openProductModal(product)' class="header-cart-item-name hov-cl1 trans-04">{{ product.name }}</a>

                            <span class="header-cart-item-info">
						{{ product.quantity }} x {{ product.price }}
					</span>
                        </div>
                    </li>
                </ul>

                <div class="w-full" v-if="cart.count > 0">
                    <div class="header-cart-total w-full p-tb-40">
                        К оплате: {{ cart.total }}
                    </div>

                    <div class="header-cart-buttons flex-w w-full">
                        <a href="shoping-cart.html"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                            Корзина
                        </a>

                        <a href="shoping-cart.html"
                           class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-b-10">
                            Оформить заказ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import { useStore } from 'vuex';
import bus from '../bus';

export default {
    name: 'cartAside',
    setup() {
        const store = useStore();

        const isVisible = ref(false);
        const selected = ref(null);
        const cart = ref({ data: {}, count: 0, subTotal: 0, total: 0 });
        const shipping = ref([]);
        const payment = ref([]);

        onMounted(() => {
            bus.on('toggle-cart-modal', () => {
                isVisible.value = !isVisible.value;
                cart.value = store.getters.cart;
            });
        });

        const close = () => {
            isVisible.value = !isVisible.value;
        };

        const openProductModal = (product) => {
            store.dispatch('setProduct', product);
            bus.emit('toggle-product-modal');
        };

        return {
            isVisible,
            selected,
            cart,
            shipping,
            payment,
            close,
            openProductModal,
        };
    }
}
</script>
