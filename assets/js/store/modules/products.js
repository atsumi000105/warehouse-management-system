import axios from 'axios';

// initial state
const state = {
    all: [],
    loading: false,
};

// getters
const getters = {
    allProducts: state => {
        return state.all
    },
    allActiveProducts: state => {
        return state.all.filter(product => product.status == "ACTIVE")
    },
    allOrderableProducts: state => {
        return state.all.filter(product => product.productCategory.isPartnerOrderable)
    },
    getProductById: (state) => (id) => {
        return state.all.find(product => product.id == id)
    }
};

// actions
const actions = {
    loadProducts ({ commit }, force = false) {
        if ((state.all.length > 0 || state.loading) && !force) return;

        state.loading = true;
        return new Promise((resolve, reject) => {
            axios
                .get('/api/products')
                .then((response) => {
                    commit('setProducts', { list: response.data.data });
                    resolve(response);
                    state.loading = false;
                },
                (err) => {
                    reject(err);
                }
            );
        });
    },
};

// mutations
const mutations = {
    setProducts (state, { list }) {
        state.all = list;
    },
};

export default {
    state,
    getters,
    actions,
    mutations
};