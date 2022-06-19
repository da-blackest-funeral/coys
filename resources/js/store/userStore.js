import { defineStore } from "pinia";
import axios from "axios";

export const userStore = defineStore("user", {
    state: () => {
        return {
            user: null,
            logout: null,
            isAdmin: 0,
        };
    },
    actions: {
        async fetchUser() {
            const { data } = await axios.get("/api/account");
            this.user = data;
            const { is_admin } = data;
            this.isAdmin = is_admin;
        },
    },
    getters: {
        isAuth(state) {
            return state.user !== null;
        },
    },
});
