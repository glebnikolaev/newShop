<template>
    <div class="sec-banner bg0 p-t-80 p-b-50">
        <div class="container">
            <div class="row">
                <div v-for="banner in banners" class="col-md-6 col-xl-3 p-b-30 m-lr-auto">
                    <div class="block1 wrap-pic-w">
                        <img :src="banner.image" :alt="banner.title">

                        <a :href="banner.link_href" class="block1-txt ab-t-l s-full flex-col-l-sb p-lr-38 p-tb-34 trans-03 respon3">
                            <div class="block1-txt-child1 flex-col-l">
								<span class="block1-name ltext-102 trans-04 p-b-8">{{ banner.title }}</span>
                                <span class="block1-info stext-102 trans-04">{{ banner.description }}</span>
                            </div>

                            <div class="block1-txt-child2 p-b-4 trans-05">
                                <div class="block1-link stext-101 cl0 trans-09">{{ banner.link_text }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
import { ref, onMounted } from 'vue';

export default {
    name: 'banners',
    setup() {
        const banners = ref([]);

        onMounted(() => {
            axios.get('/api/v1/banners')
                .then(response => {
                    banners.value = response.data.data;
                }).catch(() => {
                    banners.value = [];
                });
        });

        return {
            banners,
        };
    }
}
</script>
