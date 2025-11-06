import { createStore } from 'vuex';

const defaultCartState = () => ({
    data: [],
    count: 0,
    subTotal: 0,
    total: 0,
});

const defaultProductState = () => ({
    id: null,
    images: [],
    image: '',
    name: '',
    price: 0,
    variations: [],
    options: [],
    quantity: 1,
});

const normalizeCart = (cart) => {
    const fallback = defaultCartState();
    if (!cart || typeof cart !== 'object') {
        return fallback;
    }

    const rawItems = cart.data || [];

    return {
        data: Array.isArray(rawItems) ? rawItems : Object.values(rawItems),
        count: cart.count ?? fallback.count,
        subTotal: cart.subTotal ?? fallback.subTotal,
        total: cart.total ?? fallback.total,
    };
};

const normalizeProduct = (product) => {
    const fallback = defaultProductState();
    if (!product || typeof product !== 'object') {
        return fallback;
    }

    return {
        ...fallback,
        ...product,
        images: Array.isArray(product.images) ? product.images : fallback.images,
        options: Array.isArray(product.options) ? product.options : fallback.options,
        variations: Array.isArray(product.variations) ? product.variations : fallback.variations,
    };
};

export default createStore({
    state: {
        /* NavBar */
        isNavBarVisible: true,

        /* FooterBar */
        isFooterBarVisible: true,

        topNavBarLinks: [
            { sort: 0, label: 'Главная', href: '', child: [] },
            { sort: 1, label: 'Доставка и оплата', href: '', child: [] },
            { sort: 2, label: 'Контакты', href: '', child: [] },
        ],
        cart: defaultCartState(),
        product: defaultProductState(),
    },
    getters: {
        cart: (state) => state.cart,
        topNavBarLinks: (state) => state.topNavBarLinks,
        product: (state) => state.product,
    },
    mutations: {
        UPDATE_CART(state, cart) {
            state.cart = normalizeCart(cart);
        },
        SET_PRODUCT_MODAL(state, product) {
            state.product = normalizeProduct(product);
        },
    },
    actions: {
        updateCart({ commit }, cart) {
            commit('UPDATE_CART', cart);
        },
        setProduct({ commit }, product) {
            commit('SET_PRODUCT_MODAL', product);
        },
    },
});
