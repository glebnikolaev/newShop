import axios from 'axios';

export default {

    addToCart(product) {
        axios.post('/api/v1/cart/add-to-cart', product)
            .then(response => {
                console.log(response);
            });
    },

    getCart() {
        axios.get('/api/v1/cart/get-cart')
            .then(response => {
                console.log(response);
            });
    },

    updateQuantity(product) {
        axios.put('/api/v1/cart/update-quantity', product)
            .then(response => {
                console.log(response);
            });
    },

    deleteFromCart(product) {
        axios.delete('/api/v1/cart/delete-from-cart', product)
            .then(response => {
                console.log(response);
            });
    }
}
