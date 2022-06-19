<template>
    <h1 class="admin__title">Создание нового товара</h1>
    <form
        id="adminForm"
        action="#"
        @submit.prevent="createClothe"
        class="form admin__form"
    >
        <div class="form__element">
            <label for="color" class="form__label">Цвет</label>
            <input
                v-model="color"
                id="color"
                type="text"
                class="form__input"
                placeholder="Цвет"
            />
        </div>
        <div class="form__element">
            <label for="img" class="form__label">Изображение (ссылка)</label>
            <input
                v-model="img"
                id="img"
                type="text"
                class="form__input"
                placeholder="Изображение"
            />
        </div>
        <div class="form__element">
            <label for="price" class="form__label">Цена</label>
            <input
                v-model="price"
                id="price"
                type="text"
                class="form__input"
                placeholder="Цена"
            />
        </div>
    </form>
    <button class="btn" form="adminForm" type="submit">Отправить</button>
</template>

<script>
import { ref } from "vue";
import axios from "axios";

export default {
    name: "Admin",
    setup() {
        const color = ref("");
        const img = ref("");
        const price = ref();
        const createClothe = async () => {
            await axios.post("api/clothes", {
                color: color.value,
                img: img.value,
                price: price.value,
            });
        };

        return {
            color,
            img,
            price,
            createClothe,
        };
    },
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";

.admin {
    &__title {
        margin-bottom: 20px;
    }
    &__form {
        max-width: 700px;
    }
}
</style>
