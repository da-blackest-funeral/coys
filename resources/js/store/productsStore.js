import { defineStore } from "pinia";
import axios from "axios";

export const productsStore = defineStore("products", {
    state: () => {
        return {
            products: null,
            total: 0,
        };
    },
    actions: {
        async fetchProducts() {
            const {
                data: {
                    data: { ...data },
                },
            } = await axios.get("api/products");
            this.products = data;
            this.total = 0;
            Object.keys(this.products).forEach((key) => {
                this.total += +this.products[key].clothe.price.replace(
                    / /g,
                    ""
                );
            });
        },
    },
});
