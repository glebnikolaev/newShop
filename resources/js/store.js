import { createStore } from 'vuex';

export default createStore({
    state: {

        /* NavBar */
        isNavBarVisible: true,

        /* FooterBar */
        isFooterBarVisible: true,

        topNavBarLinks: [
            {sort:0, label:'Главная', href:'', child:[]},
            {sort:1, label:'Доставка и оплата', href:'', child:[]},
            {sort:2, label:'Контакты', href:'', child:[]},
        ],
        cart: {
            data:{},
            count: 0,
            subTotal: 0,
            total: 0,
        },
        product: {
            images: {},
            image: '',
            name: '',
            price: 0,
            variations: {},
            quantity: 1
        }
    },
    getters: {
        forSale: state => state.forSale,
        cart: state => state.cart,
        topNavBarLinks: state => state.topNavBarLinks,
        product: state => state.product,
    },
    mutations: {
        UPDATE_CART(state, cart) {
            state.cart = cart;
        },
        SET_PRODUCT_MODAL(state, index) {
            state.product = index;
        }
    },
    actions: {
        updateCart(context, cart) {
            context.commit('UPDATE_CART', cart);
        },
        setProduct(context, index) {
            context.commit('SET_PRODUCT_MODAL', index);
        }
    },
});
