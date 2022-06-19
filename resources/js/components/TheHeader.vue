<template>
    <header class="header">
        <nav class="nav">
            <router-link class="nav__link" to="/catalog">Женщинам</router-link>
            <router-link class="nav__link" to="/catalog">Мужчинам</router-link>
            <a class="nav__link" href="#">Контакты</a>
        </nav>
        <div class="burger">
            <button
                class="burger__button"
                @click="showMobileModal = !showMobileModal"
            >
                <svg
                    fill="none"
                    height="12"
                    viewBox="0 0 18 12"
                    width="18"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        clip-rule="evenodd"
                        d="M0 1V0H18V1H0ZM0 6H18V5H0V6ZM0 11H18V10H0V11Z"
                        fill="#58595B"
                        fill-rule="evenodd"
                    />
                </svg>
            </button>
        </div>
        <div class="header__wrapper">
            <router-link to="/">
                <img
                    :src="'assets/header/logo.svg'"
                    alt="Логотип"
                    class="header__logo"
                />
            </router-link>
        </div>
        <div class="header__aside">
            <div class="header__links">
                <router-link v-if="isAdmin" to="/admin" class="header__link">
                    Админ-панель
                </router-link>
                <a class="header__link" href="tel:79034655304"
                    >+7 903 465 53 04
                </a>
                <router-link class="header__link" to="/account"
                    >{{ isAuth ? "Кабинет" : "Войти" }}
                </router-link>
            </div>
            <router-link to="/cart">
                <svg
                    fill="none"
                    height="17"
                    viewBox="0 0 16 17"
                    width="16"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M15.5 4H12C12 1.79 10.21 0 8 0C5.79 0 4 1.79 4 4H0.5C0.22 4 0 4.22 0 4.5V16.5C0 16.78 0.22 17 0.5 17H15.5C15.78 17 16 16.78 16 16.5V4.5C16 4.22 15.78 4 15.5 4ZM8 1C9.65 1 11 2.35 11 4H5C5 2.35 6.35 1 8 1ZM15 16H1V5H15V16Z"
                        fill="#58595B"
                    />
                </svg>
            </router-link>
        </div>
    </header>
    <modal-mobile
        v-if="showMobileModal"
        @close-modal="showMobileModal = false"
        @scroll.prevent
        @touchmove.prevent
        @wheel.prevent
    ></modal-mobile>
</template>

<script>
import { userStore } from "../store/userStore";
import { modalStore } from "../store/modalStore";
import ModalMobile from "./ModalMobile";
import { storeToRefs } from "pinia";
import { onMounted } from "vue";

export default {
    name: "TheHeader",
    emits: ["showModal", "closeModal"],
    setup() {
        const storeUser = userStore();
        const storeAuth = modalStore();
        const { isAuth, isAdmin } = storeToRefs(storeUser);
        const { showMobileModal } = storeToRefs(storeAuth);
        return {
            isAuth,
            showMobileModal,
            isAdmin,
        };
    },
    components: { ModalMobile },
};
</script>

<style lang="scss">
@import "resources/sass/app";

.header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding-top: 40px;
    padding-bottom: 40px;
    z-index: 1;

    &__link {
        margin-right: 22px;
        font-weight: 300;
        font-size: 12px;
        line-height: 21px;
        text-transform: uppercase;
        text-decoration: none;
        color: $dark-grey;
    }

    &__aside {
        display: flex;
        align-items: center;
    }

    &__logo {
        width: 100px;
    }
}

.nav {
    display: flex;

    &__link {
        font-weight: 300;
        font-size: 12px;
        line-height: 21px;
        text-transform: uppercase;
        text-decoration: none;
        color: $dark-grey;
    }
}

.nav__link:not(:last-child) {
    margin-right: 25px;
}

.burger {
    display: none;

    &__button {
        border: none;
        background-color: transparent;
    }
}

@media (max-width: 759px) {
    .header {
        padding-top: 18px;
        padding-bottom: 18px;
        justify-content: normal;

        &__wrapper {
            margin-right: auto;
        }

        &__links {
            display: none;
        }

        &__logo {
            width: 93px;
        }
    }

    .nav {
        display: none;
    }

    .burger {
        display: block;
        margin-right: 15px;
    }
}

.fade-enter-active,
.fade-leave-active {
    opacity: 1;
    transition: opacity 0.3s;
}

.fade-enter,
.fade-leave-to {
    opacity: 0;
    transition: opacity 0.3s;
}
</style>
