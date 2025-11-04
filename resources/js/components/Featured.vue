<template>
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">Рекомендуем</h3>
            </div>
            <div class="row isotope-grid">
                <div v-for="product in featuredProducts" class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img v-lazyload
                                 src="/photos/1/no-photo.jpg"
                                 :data-src="product.image"
                                 :data-err="product.image"
                                 :alt="product.name"
                            />
                            <a href="#" @click.prevent='openProductModal(product)'
                               class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                Быстрый просмотр
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l ">
                                <a @click.prevent='openProductModal(product)' class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    {{product.name}}
                                </a>

                                <span class="stext-105 cl3">{{ parseInt(product.price) }} ₽</span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                    <img class="icon-heart1 dis-block trans-04"
                                         src="images/icons/icon-heart-01.png"
                                         alt="ICON">
                                    <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                         src="images/icons/icon-heart-02.png"
                                         alt="ICON">
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    import Vue from 'vue'
    import axios from 'axios';
    import VueTinyLazyLoadImg from 'vue-tiny-lazyload-img'
    Vue.use(VueTinyLazyLoadImg);

    export default {
        name: 'featured',

        data() {
            return {
                featuredProducts: [],
            };
        },
        mounted() {
            axios.get('/api/v1/modules/featured')
                .then(response => {
                    this.featuredProducts = response.data.data;
                });
        },
        methods: {
            openProductModal(product) {
                this.$store.dispatch('setProduct', product);
                this.$bus.$emit('toggle-product-modal');
            }
        }
    }
</script>
