import http from './httpClient';

export async function fetchCart() {
    const { data } = await http.get('/api/v1/cart/get-cart');
    return data;
}

export async function addToCart(payload) {
    const { data } = await http.post('/api/v1/cart/add-to-cart', payload);
    return data;
}

export async function updateQuantity(payload) {
    const { data } = await http.put('/api/v1/cart/update-quantity', payload);
    return data;
}

export async function removeFromCart(payload) {
    const { data } = await http.delete('/api/v1/cart/delete-from-cart', { data: payload });
    return data;
}
