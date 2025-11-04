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
                                            <v-select
                                                v-model="selected[index]"
                                                label="name"
                                                :options="option.parameters"
                                                :clearable="false"
                                                :searchable="false"
                                                @option:selecting="handleSelect(option.parameters, index)">
                                                <template slot="option" slot-scope="option">
                                                    {{ getLabelName(option) }}
                                                </template>
                                            </v-select>
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
    import vSelect from 'vue-select'
    import 'vue-select/dist/vue-select.css'
    import axios from "axios";

    export default {
        name: 'product',
        components: {vSelect},
        data() {
            return {
                isVisible: false,
                mainImage: '',
                quantity: 1,
                product: {
                    id: null,
                    images: {},
                    image: null,
                    name: null,
                    price: 0,
                    options: {},
                },
                selectedProduct: {
                    productId: null,
                    quantity: 1,
                    options: []
                },
                selected: [],
                selectedPrice: 0

            };
        },
        mounted() {
            this.$bus.$on('toggle-product-modal', () => {
                this.product = this.$store.getters.product;
                this.isVisible = !this.isVisible;
                this.mainImage = this.product.image;

                this.product.options.forEach( (value, index) => {
                    this.selected.push(value.parameters[0]);
                });

                this.setSelected();
            });
        },
        watch: {
            selectedProduct:function() {
                this.calculatePrice();
            },
        },
        methods: {
            close() {
                this.isVisible = !this.isVisible;
                this.unselectProduct();
            },
            changeMainImg(image) {
                this.mainImage = image.path;
            },
            isImgChecked(image) {
                return this.mainImage === image.path;
            },
            addToCart() {
                axios.post('/api/v1/cart/add-to-cart', this.selectedProduct)
                    .then(response => {
                        this.$store.dispatch('updateCart', response.data);
                    }).finally(() => {
                        this.$bus.$emit('update-cart-count');
                });
                this.close();
            },
            setSelected() {
                this.selectedProduct = {
                    productId: this.product.id,
                    quantity: this.quantity,
                    options: this.selected
                };
            },
            setQuantity() {
                this.selectedProduct.quantity = this.quantity;
            },
            handleSelect(parameters, index) {
                this.selected[index] = parameters[0];
                this.setSelected();
            },
            increment() {
                this.quantity += 1;
                this.setQuantity();
            },
            decrement() {
                this.quantity -= 1;
                this.quantity = this.quantity < 1 ? 1 : this.quantity;
                this.setQuantity();
            },
            unselectProduct() {
                this.selectedProduct = {
                    productId: null,
                    quantity: 1,
                    options: []
                };
                this.selected = [];
                this.quantity = 1;
                this.selectedPrice = 0;
            },
            calculatePrice() {
                let price = parseInt(this.product.price);
                this.selectedProduct.options.forEach( (value, index) => {
                    price += parseInt(value.variation.price);
                });
                this.selectedPrice = price;
            },
            getLabelName(option) {
                let label;
                if (option.variation.price < 0) {
                    label = ' ('+ option.variation.price +'₽)';
                } else {
                    label = ' (+'+ option.variation.price +'₽)';
                }
                return option.name + label;
            }
        },
    }
</script>
