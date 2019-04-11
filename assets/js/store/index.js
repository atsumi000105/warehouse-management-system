import Vue from 'vue';
import Vuex from 'vuex';
import products from './modules/products';
import storageLocations from './modules/storageLocations';
import suppliers from './modules/suppliers';

Vue.use(Vuex);


export default new Vuex.Store({
    modules: {
        products,
        storageLocations,
        suppliers,
    }
});