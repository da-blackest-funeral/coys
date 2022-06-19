<template>
    <div class="account__info">
        <form
            class="form account__form"
            id="saveForm"
            @submit.prevent="changeData"
        >
            <div class="form__element">
                <label for="name" class="form__label"> Ваше имя </label>
                <input
                    type="text"
                    name="name"
                    id="name"
                    v-model="name"
                    placeholder="Ваше имя"
                    class="form__input"
                    tabindex="1"
                />
            </div>
            <div class="form__element">
                <label for="email" class="form__label"> Email </label>
                <input
                    type="email"
                    name="email"
                    id="email"
                    v-model="email"
                    placeholder="Email"
                    class="form__input"
                />
            </div>
            <div class="form__element">
                <label for="password" class="form__label"> Пароль </label>
                <input
                    type="password"
                    name="password"
                    id="password"
                    v-model="password"
                    class="form__input"
                />
            </div>
            <div class="form__element">
                <label for="phone" class="form__label"> Телефон </label>
                <input
                    type="text"
                    name="phone"
                    id="phone"
                    placeholder="+7"
                    v-model="phone"
                    class="form__input"
                />
            </div>
        </form>
        <button form="saveForm" type="submit" class="btn form__button">
            Сохранить
        </button>
    </div>
</template>

<script>
import { userStore } from "../store/userStore";
import axios from "axios";
import { ref } from "vue";

export default {
    name: "AccountInfo",
    setup() {
        const store = userStore();
        const name = ref(store.user.name);
        const phone = ref(store.user.phone);
        const email = ref(store.user.email);
        const password = ref("");
        const changeData = async () => {
            await axios.post("/api/account", {
                email: email.value,
                name: name.value,
                phone: phone.value,
                password: password.value,
            });
        };

        return {
            store,
            changeData,
            name,
            phone,
            email,
            password,
        };
    },
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";
.account {
    &__form {
        max-width: 686px;
    }
}
</style>
