import http from './httpClient';

export async function fetchFeatured() {
    const { data } = await http.get('/api/v1/modules/featured');
    return Array.isArray(data?.data) ? data.data : data;
}

export async function fetchBanners() {
    const { data } = await http.get('/api/v1/banners');
    return Array.isArray(data?.data) ? data.data : data;
}

export async function fetchCategories() {
    const { data } = await http.get('/api/v1/categories');
    return Array.isArray(data?.data) ? data.data : data;
}
