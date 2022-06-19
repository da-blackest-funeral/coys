import { defineStore } from "pinia";
import axios from "axios";

export const goodsStore = defineStore("goods", {
    state: () => {
        return {
            goods: {},
            sizes: ["S", "M", "L", "XL"],
        };
    },
    actions: {
        async fetchGoods() {
            const {
                data: {
                    data: { ...options },
                },
            } = await axios.get("/api/clothes");
            this.goods = options;
        },
    },
    getters: {
        getGoods(state) {
            return state.goods;
        },
    },
});
