const current = JSON.parse(localStorage.getItem("currency")) || {
    iconTag: "btc",
    text: "BTC",
    value: 1,
};

const state = {
    iconTag: current.iconTag,
    text: current.text,
    value: current.value,
};

const getters = {};

const actions = {
    async ChangeCurrency({ dispatch }, currency) {
        await dispatch("ChangeCurrency", currency);
    },
};

const mutations = {
    setCurrency(state, currency) {
        state.iconTag = currency.iconTag;
        state.text = currency.text;
        state.value = currency.value;
    },
};

export default {
    state,
    getters,
    actions,
    mutations,
};
