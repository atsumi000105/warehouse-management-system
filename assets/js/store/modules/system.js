import axios from 'axios';

// initial state
const state = {
    user: null
};

// getters
const getters = {
    userHasRole: (state) => (role) => {
        if (state.user == null) return false;
        let roles = [];
        state.user.groups.forEach((group) => {
            roles.push(...group.roles);
        });
        return roles.includes(role);
    },
    userActivePartner: (state) => {
        if (state.user == null) return false;
        return state.user.activePartner
    },
    userPartners: (state) => {
        if (state.user == null) return false;
        return state.user.partners
    },
};

// actions
const actions = {
    loadCurrentUser ({ commit }) {
        return new Promise((resolve, reject) => {
            axios
                .get('/api/system/current-user', {
                    params: {
                        include: ['groups', 'partners', 'activePartner']
                    }
                })
                .then((response) => {
                    commit('setUser', { user: response.data.data });
                    resolve(response);
                },
                    (err) => {
                    reject(err);
            });
        });
    },
    clearCurrentUser ({commit}) {
        commit('clearUser');
    }
};

// mutations
const mutations = {
    setUser (state, { user }) {
        state.user = user;
    },
    clearUser (state) {
        state.user = null;
    }
};

export default {
    state,
    getters,
    actions,
    mutations
};