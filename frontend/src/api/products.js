import { publicApi } from "./public";


export const productsApi = {
    all : () => publicApi.get('/products'),
}