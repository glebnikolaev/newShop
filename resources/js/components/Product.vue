<template>
    <div class="wrap-modal1 js-modal1 p-t-60 p-b-20" :class="{ 'show-modal1': isVisible }">
        <div class="overlay-modal1 js-hide-modal1" @click="close"></div>

        <div class="container">
            <div class="bg0 p-t-60 p-b-30 p-lr-15-lg how-pos3-parent">
                <button class="how-pos3 hov3 trans-04 js-hide-modal1" @click="close">
                    <img src="images/icons/icon-close.png" alt="Закрыть">
                </button>

                <div class="row">
                    <div class="col-md-6 col-lg-7 p-b-30">
                        <div class="p-l-25 p-r-30 p-lr-0-lg">
                            <div class="wrap-slick3 flex-sb flex-w">
                                <div class="wrap-slick3-dots">
                                    <ul class="slick3-dots" v-if="product.images.length > 0">
                                        <li v-for="image in product.images"
                                            @click="changeMainImg(image)"
                                            :class="{ 'slick-active': isImgChecked(image) }">
                                            <img
                                                :src="image.path"
                                                :alt="product.name"
                                            />
                                            <div class="slick3-dot-overlay"></div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="wrap-slick3-arrows flex-sb-m flex-w"></div>

                                <div class="slick3 gallery-lb">
                                    <div class="item-slick3">
                                        <div class="wrap-pic-w pos-relative">
                                            <img :src="mainImage" :alt="product.name">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-lg-5 p-b-30">
                        <div class="p-r-50 p-t-5 p-lr-0-lg">
                            <h4 class="mtext-105 cl2 js-name-detail p-b-14">{{ product.name }}</h4>
                            <span class="mtext-106 cl2">{{ selectedPrice }} ₽</span>
                            <p class="stext-102 cl3 p-t-23">{{ product.description }}</p>
                            <div class="p-t-33">
                                <div class="flex-w flex-r-m p-b-10"
                                     v-if="product && product.options.length > 0"
                                     v-for="(option, index) in product.options" >

                                    <div class="size-203 flex-c-m respon6">{{ option.name }}</div>

                                    <div class="size-204 respon6-next">
                                        <div class="rs1-select2 bor8 bg0">
                                            <multiselect
                                                v-model="selected[index]"
                                                :options="option.parameters"
                                                :reduce="(val) => val"
                                                track-by="id"
                                                label="name"
                                                :close-on-select="true"
                                                :clear-on-select="false"
                                                :preserve-search="true"
                                            >
                                                <template #option="{ option }">{{ getLabelName(option) }}</template>
                                            </multiselect>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-w flex-r-m p-b-10">
                                    <div class="size-204 flex-w flex-m respon6-next">
                                        <div class="wrap-num-product flex-w m-r-20 m-tb-10">
                                            <div class="btn-num-product-down cl8 hov-btn3 trans-04 flex-c-m" @click="decrement()">
                                                <i class="fs-16 zmdi zmdi-minus"></i>
                                            </div>

                                            <input class="mtext-104 cl3 txt-center num-product"
                                                   type="text"
                                                   name="num-product"
                                                   v-model="quantity">

                                            <div class="btn-num-product-up cl8 hov-btn3 trans-04 flex-c-m" @click="increment()">
                                                <i class="fs-16 zmdi zmdi-plus"></i>
                                            </div>
                                        </div>

                                        <button
                                            class="m-t-10 m-tb-10 flex-c-m stext-101 cl0 size-101 bg1 bor1 hov-btn1 p-lr-15 trans-04 js-addcart-detail"
                                            @click.prevent='addToCart()'>
                                            В корзину
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="flex-w flex-m p-l-100 p-t-40 respon7">
                                <div class="flex-m bor9 p-r-10 m-r-11">
                                    <a href="#"
                                       class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 js-addwish-detail tooltip100"
                                       data-tooltip="Добавить в избранное">
                                        <i class="zmdi zmdi-favorite"></i>
                                    </a>
                                </div>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                   data-tooltip="Facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>

                                <a href="#" class="fs-14 cl3 hov-cl1 trans-04 lh-10 p-lr-5 p-tb-2 m-r-8 tooltip100"
                                   data-tooltip="Twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import bus from '../bus';
import Multiselect from 'vue-multiselect'
import 'vue-multiselect/dist/vue-multiselect.min.css'
import { ref, reactive, onMounted, watch } from 'vue';
import { useStore } from 'vuex';

export default {
    name: 'product',
    components: { Multiselect },
    setup() {
        const store = useStore();

        const isVisible = ref(false);
        const mainImage = ref('');
        const quantity = ref(1);
        const product = reactive({ id: null, images: [], image: null, name: null, price: 0, options: [] });
        const selectedProduct = ref({ productId: null, quantity: 1, options: [] });
        const selected = ref([]);
        const selectedPrice = ref(0);

        const setSelected = () => {
            selectedProduct.value = {
                productId: product.id,
                quantity: quantity.value,
                options: selected.value
            };
        };

        const setQuantity = () => {
            selectedProduct.value.quantity = quantity.value;
        };

        const close = () => {
            isVisible.value = !isVisible.value;
            unselectProduct();
        };

        const changeMainImg = (image) => {
            mainImage.value = image.path;
        };

        const isImgChecked = (image) => {
            return mainImage.value === image.path;
        };

        const addToCart = () => {
            axios.post('/api/v1/cart/add-to-cart', selectedProduct.value)
                .then(response => {
                    store.dispatch('updateCart', response.data);
                }).finally(() => {
                bus.emit('update-cart-count');
            });
            close();
        };

        const handleSelect = (option, index) => {
            selected.value[index] = option;
            setSelected();
        };

        const increment = () => {
            quantity.value += 1;
            setQuantity();
        };

        const decrement = () => {
            quantity.value -= 1;
            quantity.value = quantity.value < 1 ? 1 : quantity.value;
            setQuantity();
        };

        const unselectProduct = () => {
            selectedProduct.value = { productId: null, quantity: 1, options: [] };
            selected.value = [];
            quantity.value = 1;
            selectedPrice.value = 0;
        };

        const calculatePrice = () => {
            let price = parseInt(product.price) || 0;
            selectedProduct.value.options.forEach((value) => {
                if (value && value.variation) {
                    price += parseInt(value.variation.price) || 0;
                }
            });
            selectedPrice.value = price;
        };

        const getLabelName = (option) => {
            let label;
            if (option.variation.price < 0) {
                label = ' ('+ option.variation.price +'₽)';
            } else {
                label = ' (+'+ option.variation.price +'₽)';
            }
            return option.name + label;
        };

        onMounted(() => {
            bus.on('toggle-product-modal', () => {
                const p = store.getters.product;
                // copy fields into reactive product
                product.id = p.id;
                product.images = p.images || [];
                product.image = p.image;
                product.name = p.name;
                product.price = p.price;
                product.options = p.options || [];

                isVisible.value = !isVisible.value;
                mainImage.value = product.image;

                selected.value = [];
                product.options.forEach((value) => {
                    selected.value.push(value.parameters[0]);
                });

                setSelected();
            });
        });

        watch(selectedProduct, () => {
            calculatePrice();
        }, { deep: true });

        watch(selected, () => {
            setSelected();
        }, { deep: true });

        return {
            isVisible,
            mainImage,
            quantity,
            product,
            selectedProduct,
            selected,
            selectedPrice,
            close,
            changeMainImg,
            isImgChecked,
            addToCart,
            setSelected,
            setQuantity,
            handleSelect,
            increment,
            decrement,
            unselectProduct,
            calculatePrice,
            getLabelName,
        };
    }
}
</script>
