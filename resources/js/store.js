import { createStore } from 'vuex';

export default createStore({
    state: {
        deals: [],
        history: []
    },
    mutations: {
        setDeals(state, deals) {
            state.deals = deals;
        },
        setHistory(state, history) {
            state.history = history;
        }
    },
    actions: {
        async fetchDeals({ commit }) {
            const response = await axios.get('/api/deals');
            commit('setDeals', response.data._embedded.leads);
        },
        async fetchHistory({ commit }) {
            const response = await axios.get('/api/history');
            commit('setHistory', response.data);
        },
        async bindContact({ dispatch }, { dealId, contactData }) {
            await axios.post(`/api/deals/${dealId}/bind-contact`, contactData);
            dispatch('fetchDeals');
            dispatch('fetchHistory');
        }
    },
    getters: {
        getDeals: (state) => state.deals,
        getHistory: (state) => state.history
    }
});
