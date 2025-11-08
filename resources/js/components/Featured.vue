<template>
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">Рекомендуем</h3>
            </div>
            <div class="row isotope-grid">
                <div v-for="product in featuredProducts"
                    :key="product.id || product.slug || product.name"
                    class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item"
                >
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img
                                :src="product.image ? product.image : '/photos/1/no-photo.jpg'"
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
                                    {{ product.name }}
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
import bus from '../bus';
import { ref, onMounted } from 'vue';
import { useStore } from 'vuex';
import { fetchFeatured } from '../services/catalogService';

export default {
    name: 'featured',
    setup() {
        const store = useStore();
        const featuredProducts = ref([]);
        const loadFeaturedProducts = async () => {
            try {
                featuredProducts.value = await fetchFeatured();
            } catch (error) {
                featuredProducts.value = [];
                if (process.env.NODE_ENV !== 'production') {
                    console.error('Не удалось загрузить рекомендуемые товары', error);
                }
            }
        };
        onMounted(() => {
            loadFeaturedProducts();
        });
        const openProductModal = (product) => {
            store.dispatch('setProduct', product);
            bus.emit('toggle-product-modal');
        };
        return {
            featuredProducts,
            openProductModal,
        };
    },
};
</script>
