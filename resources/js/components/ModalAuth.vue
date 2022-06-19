<template>
    <div class="wrapper">
        <div class="modal auth__modal">
            <modal-button @close-modal="store.closeModal"></modal-button>
            <div class="modal__card">
                <h2 class="modal__title auth__title">
                    {{ loginModule ? "Вход" : "Регистрация" }}
                </h2>
                <p class="modal__text auth__text">
                    {{
                        loginModule
                            ? "Нет личного аккаунта?"
                            : "У меня уже есть аккаунт."
                    }}
                    <a
                        class="modal__link"
                        href="#"
                        @click.prevent="changeModal"
                        >{{ loginModule ? "Зарегестрироваться" : "Войти" }}</a
                    >
                </p>
                <form
                    class="form auth__form"
                    method="post"
                    id="form"
                    @submit.prevent="auth"
                >
                    <div v-if="!loginModule" class="form__element">
                        <label class="form__label" for="name">Имя</label>
                        <input
                            class="form__input"
                            type="text"
                            name="name"
                            id="name"
                            v-model="name"
                            placeholder="Ваше имя"
                        />
                    </div>
                    <div class="form__element">
                        <label class="form__label" for="email">Email</label>
                        <input
                            class="form__input"
                            type="email"
                            name="email"
                            id="email"
                            v-model="email"
                            placeholder="Ваш email"
                        />
                    </div>
                    <div class="form__element">
                        <label class="form__label" for="password">Пароль</label>
                        <input
                            class="form__input"
                            type="password"
                            v-model="password"
                            name="password"
                            id="password"
                        />
                    </div>
                    <!--        <div class="form__bottom">-->
                    <!--            <div class="form__wrapper">-->
                    <!--                <label for="checkbox">Запомнить меня</label>-->
                    <!--                <input-->
                    <!--                    name="checkbox"-->
                    <!--                    id="checkbox"-->
                    <!--                    type="checkbox"-->
                    <!--                    class="form__checkbox"-->
                    <!--                />-->
                    <!--            </div>-->
                    <!--            <router-link to="/forget">Забыли пароль?</router-link>-->
                    <!--        </div>-->
                </form>
                <button type="submit" form="form" class="btn form__button">
                    {{ loginModule ? "Войти" : "Зарегестрироваться" }}
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref } from "vue";
import { modalStore } from "../store/modalStore";
import axios from "axios";
import router from "../router";
import ModalButton from "./ModalButton";

export default {
    name: "ModalAuth",
    components: {
        ModalButton,
    },
    setup() {
        let loginModule = ref(true);
        const store = modalStore();
        const email = ref();
        const password = ref();
        const name = ref();
        const auth = async () => {
            if (name.value) {
                await axios.post("/api/register", {
                    name: name.value,
                    email: email.value,
                    password: password.value,
                    password_confirmation: password.value,
                });
            } else {
                await axios.post("/api/login", {
                    email: email.value,
                    password: password.value,
                });
            }
            await router.push("/account");
        };
        const changeModal = () => {
            loginModule.value = !loginModule.value;
        };
        return {
            email,
            password,
            name,
            store,
            auth,
            loginModule,
            changeModal,
        };
    },
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";
.auth {
    &__modal {
        max-width: 493px;
        padding: 45px 55px 65px;
    }
    &__title {
        margin-bottom: 12px;
    }
    &__text {
        margin-bottom: 24px;
    }
    &__form {
        flex-direction: column;
        flex-wrap: nowrap;
        margin-bottom: 5px;
    }
}
</style>
