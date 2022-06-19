<template>
    <li class="cart__item">
        <div class="card">
            <button @click="removeProduct(id)" class="card__close">
                <svg
                    width="21"
                    height="21"
                    viewBox="0 0 21 21"
                    fill="none"
                    xmlns="http://www.w3.org/2000/svg"
                >
                    <path
                        d="M16.4497 5.84318L17.1569 6.55029L12.2071 11.5L17.1569 16.4498L16.4497 17.1569L11.5 12.2071L6.55025 17.1569L5.84315 16.4498L10.7929 11.5L5.84315 6.55029L6.55025 5.84318L11.5 10.7929L16.4497 5.84318Z"
                        fill="#58595B"
                    />
                </svg>
            </button>
            <div class="card__image">
                <img class="card__img" :src="img" alt="Фото вещи" />
            </div>
            <div class="card__content">
                <div class="card__header">
                    <p class="card__title">
                        Зелёное платье-рубашка в белую полоску
                    </p>
                    <p class="card__price">{{ price }} $</p>
                </div>
                <div class="card__info">
                    <button class="btn card__btn">{{ size }}</button>
                    <div class="counter card__counter">
                        <button
                            :disabled="number < 2"
                            @click="
                                number--;
                                $emit('decreaseCount', price);
                            "
                            class="counter__btn"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <rect
                                    x="4"
                                    y="11"
                                    width="15"
                                    height="1"
                                    fill="#58595B"
                                />
                            </svg>
                        </button>
                        <span class="counter__number">
                            {{ number }}
                        </span>
                        <button
                            @click="
                                number++;
                                $emit('increaseCount', price);
                            "
                            class="counter__btn"
                        >
                            <svg
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M11 4H12V11H19V12H12V19H11V12H4V11H11V4Z"
                                    fill="#58595B"
                                />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <slot></slot>
    </li>
</template>

<script>
import { ref } from "vue";
import axios from "axios";
import { productsStore } from "../store/productsStore";

export default {
    name: "CartProduct",
    props: ["img", "price", "size", "id"],
    emits: ["decreaseCount", "increaseCount"],
    setup() {
        const store = productsStore();
        let number = ref(1);
        const removeProduct = async (id) => {
            await axios.post(`api/products/${id}`, {
                _method: "delete",
            });
            await store.fetchProducts();
        };
        return {
            number,
            removeProduct,
        };
    },
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";
.card {
    position: relative;
    display: flex;
    justify-content: space-between;
    padding-top: 12px;
    padding-bottom: 18px;
    &__img {
        width: 120px;
        height: 180px;
        margin-right: 10px;
        object-fit: cover;
    }
    &__content {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }
    &__header {
        display: flex;
        justify-content: space-between;
    }
    &__title {
        max-width: 175px;
        font-weight: 300;
        font-size: 16px;
        line-height: 24px;
        color: black;
    }
    &__price {
        font-weight: 300;
        font-size: 17px;
        line-height: 24px;
    }
    &__info {
        display: flex;
        align-items: center;
    }
    &__btn {
        margin-right: 20px;
        padding: 10px 8px 10px 10px;
        font-weight: 400;
        font-size: 14px;
        line-height: 18px;
        text-align: center;
        color: $dark-grey;
        background-color: #f0ded0;
    }
    &__close {
        bottom: 0;
        right: 0;
        padding-right: 8px;
        padding-bottom: 14px;
        position: absolute;
        border-style: none;
        background-color: transparent;
        cursor: pointer;
    }
}
.counter {
    display: flex;
    align-items: center;
    padding: 6px;
    border: $dark-grey 1px solid;
    &__btn {
        width: 24px;
        height: 24px;
        padding: 0;
        border: none;
        background-color: transparent;
        cursor: pointer;
    }
    &__number {
        padding-left: 4px;
        padding-right: 4px;
    }
}
</style>
