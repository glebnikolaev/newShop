import bus from './bus';

export default {
    alert(message, danger) {
        bus.emit('alert', {message, danger});
    },

    addToCart(key, value) {
        let data = JSON.parse(localStorage.getItem('cartiny_cart'));
        if (data) {
            data[key] = value;
            localStorage.setItem('cartiny_cart', JSON.stringify(data));
        }
    },

    retrieve(key) {
        let data = JSON.parse(localStorage.getItem('cartiny_cart'));
        return data ? data[key] : false;
    },

    replace(string, index, value) {
        return string.substr(0, index) + value + string.substr(index + value.length);
    },

    getApiHost() {
        return localStorage.getItem('cartiny_api') ? localStorage.getItem('cartiny_api') : 'http://127.0.0.1:8000';
    },

    getUrlParam(name) {
        let url = window.location.href;
        name = name.replace(/[[\]]/g, "\\$&");
        let regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);

        if (!results) {
            return '';
        }

        if (!results[2]) {
            return '';
        }

        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
}
