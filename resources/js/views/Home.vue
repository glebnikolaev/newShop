<template>
    <div>
        <banners/>
        <featured/>
    </div>
</template>

<script>
import banners from '../components/Banners';
import featured from '../components/Featured';

export default {
    name: 'home',
    components: {
        banners,
        featured,
    },
};
</script>
