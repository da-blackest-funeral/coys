<template>
    <li class="product">
        <img class="product__image" :src="src" alt="Фото товара" />
        <p class="product__name">Джинсовка</p>
        <p class="product__name">{{ color }}</p>
        <p class="product__price">{{ price }}$</p>
        <ul class="product__list">
            <li
                v-for="(size, idx) in store.sizes"
                class="product__item"
                :key="size"
            >
                <button
                    :class="{ active: activeButton === idx }"
                    @click="setSize(idx)"
                    class="btn"
                >
                    {{ size }}
                </button>
            </li>
        </ul>
        <button
            :disabled="!activeSize"
            @click="$emit('addProduct', activeSize, id)"
            class="btn product__btn"
        >
            Добавить в корзину
        </button>
    </li>
</template>

<script>
import { goodsStore } from "../store/goodsStore";
import { ref } from "vue";

export default {
    name: "CatalogGood",
    props: ["src", "name", "price", "id", "color"],
    emits: ["addProduct"],
    setup() {
        const store = goodsStore();
        let activeSize = ref("");
        let activeButton = ref("");
        const setSize = (idx) => {
            // checking for clicking on the same button and toggling values to defaults
            if (idx === activeButton.value) {
                activeButton.value = "";
                activeSize.value = "";
            } else {
                activeButton.value = idx;
                activeSize.value = store.sizes[idx];
            }
        };

        return {
            store,
            activeSize,
            setSize,
            activeButton,
        };
    },
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";
.product {
    display: flex;
    flex-direction: column;
    align-items: center;
    padding-bottom: 45px;
    &__list {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
    }
    &__name,
    &__price {
        font-style: normal;
        font-weight: 300;
        font-size: 18px;
        line-height: 30px;
        color: $dark-grey;
    }
    &__image {
        margin-bottom: auto;
        width: 400px;
    }
    &__btn {
        color: white;
    }
}

.active {
    background-color: #46474a;
}
</style>
