<template>
    <div>
        <categories/>
        <banners/>
        <featured/>
    </div>
</template>

<script>
    import banners from '../components/Banners';
    import featured from '../components/Featured';
    import categories from '../components/Categories';

    export default {
        name: 'home',
        components: {
            banners,
            featured,
            categories
        },
    }
</script>
