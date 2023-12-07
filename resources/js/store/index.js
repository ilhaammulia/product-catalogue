import { createStore } from "vuex";
import createPersistedState from "vuex-persistedstate";
import currency from "./modules/currency";

export default createStore({
    modules: {
        currency,
    },
    plugins: [createPersistedState()],
});
