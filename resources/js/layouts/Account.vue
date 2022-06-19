<template>
    <back-button></back-button>
    <div class="account">
        <div class="account__panel">
            <h2 class="account__title">Учетная запись</h2>
            <ul class="account__list">
                <li class="account__item">
                    <a href="#" class="account__link">Персональные данные</a>
                </li>
                <li class="account__item">
                    <a href="#" class="account__link">Мои адреса доставки</a>
                </li>
                <li class="account__item">
                    <a href="#" class="account__link">История заказов</a>
                </li>
                <li class="account__item">
                    <a href="#" class="account__link" @click.prevent="logout"
                        >Выйти</a
                    >
                </li>
            </ul>
        </div>
        <component :is="activeComponent"> </component>
    </div>
</template>

<script>
import { userStore } from "../store/userStore";
import axios from "axios";
import router from "../router";
import AccountInfo from "../components/AccountInfo";
import BackButton from "../components/BackButton";

export default {
    name: "Account",
    components: {
        BackButton,
        AccountInfo,
    },
    setup() {
        const store = userStore();
        let activeComponent = "AccountInfo";
        const logout = async () => {
            store.user = null;
            await axios.get("/api/logout");
            await router.push("/");
        };
        return {
            store,
            logout,
            activeComponent,
        };
    },
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";
.account__exit {
    padding: 6px 12px;
    text-transform: uppercase;
    letter-spacing: 0.3em;
    color: white;
}
.account {
    display: flex;
    &__title {
        margin-bottom: 35px;
        font-weight: 300;
        font-size: 48px;
        line-height: 60px;
        color: $dark-grey;
    }
    &__panel {
        margin-right: 100px;
    }
    &__list {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: space-between;
    }
    &__item {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        border-top: 1px solid #58595b;

        &:last-of-type {
            border-bottom: 1px solid #58595b;
        }
    }
    &__link {
        width: 332px;
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: 300;
        font-size: 14px;
        line-height: 18px;
        letter-spacing: 0.3em;
        text-decoration: none;
        text-transform: uppercase;
        text-align: center;
        color: $dark-grey;
        transition: all 0.2s ease-in-out;
        &:hover {
            background-color: #e4c5ad;
        }
        &:active {
            background-color: $beige;
        }
    }
}

@media (max-width: 1200px) {
    .account {
        &__panel {
            margin-right: 30px;
        }
        &__title {
            font-size: 35px;
        }
    }
}

@media (max-width: 810px) {
    .back {
        display: none;
    }
    .account {
        flex-direction: column;
        align-items: center;
        &__title {
            margin-bottom: 10px;
            font-weight: 300;
            font-size: 18px;
            line-height: 21px;
            color: black;
        }
        &__panel {
            margin-right: 0;
            margin-bottom: 30px;
        }
    }
}
@media (max-width: 377px) {
    .account {
        &__link {
            width: auto;
            min-width: 90vw;
        }
    }
}
</style>
