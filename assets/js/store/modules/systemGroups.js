import axios from 'axios';

const state = {
    all: [],
    loading: false,
};

const getters = {
    allSystemGroups: (state) => {
        return state.all;
    },
};

const actions = {
    loadSystemGroups({ commit }, force = false) {
        if ((state.all.length > 0 || state.loading) && !force) return;

        state.loading = true;

        return new Promise((resolve, reject) => {
            axios.get('/api/groups')
                .then((response) => {
                    commit('setSystemGroups', {
                        list: response.data.data
                    });
                    resolve(resolve);
                    state.loading = false;
                },
                (error) => {
                    reject(error);
                });
        });
    }
};

const mutations = {
    setSystemGroups(state, { list }) {
        state.all = list;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};

