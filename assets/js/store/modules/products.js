import axios from 'axios';

// initial state
const state = {
    all: []
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
};

// actions
const actions = {
    loadProducts ({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/products')
                .then((response) => {
                    commit('setProducts', { list: response.data.data });
                    resolve(response);
                },
                    (err) => {
                    reject(err);
            });
        });
    }
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