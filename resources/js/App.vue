<template>
    <the-header></the-header>
    <main class="main">
        <modal-auth v-if="store.showModal"></modal-auth>
        <router-view></router-view>
    </main>
    <the-footer></the-footer>
</template>

<script>
import TheHeader from "./components/TheHeader";
import ModalAuth from "./components/ModalAuth";
import { modalStore } from "./store/modalStore";
import TheFooter from "./components/TheFooter";
import ModalMobile from "./components/ModalMobile";
import { onMounted } from "vue";
import { userStore } from "./store/userStore";

export default {
    name: "App",
    setup() {
        const store = modalStore();
        const storeUser = userStore();
        onMounted(() => {
            storeUser.fetchUser();
        });
        return {
            store,
        };
    },
    components: {
        ModalMobile,
        TheFooter,
        TheHeader,
        ModalAuth,
    },
};
</script>

<style scoped lang="scss">
.main {
    flex-grow: 1;
}
</style>
