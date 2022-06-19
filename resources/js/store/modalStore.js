import { defineStore } from "pinia";

export const modalStore = defineStore("main", {
    state: () => {
        return {
            showModal: false,
            showMobileModal: false,
        };
    },
    actions: {
        openModal() {
            this.showModal = true;
            document.body.style.overflow = "hidden";
        },
        closeModal() {
            this.showModal = false;
            document.body.style.overflow = "auto";
        },
    },
});
