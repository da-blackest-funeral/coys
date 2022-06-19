<template>
    <back-button></back-button>
    <div class="cart">
        <div class="cart__order">
            <div class="cart__header">
                <h2 class="cart__title">Оформление заказа</h2>
                <div class="line"></div>
            </div>
            <form action="#" id="cartForm" class="form cart__form">
                <div class="form__element">
                    <label for="name" class="form__label"
                        >Ваше имя и фамилия</label
                    ><input
                        placeholder="Ваше имя и фамилия"
                        id="name"
                        type="text"
                        class="form__input"
                        required
                    />
                </div>
                <div class="form__element">
                    <label for="country" class="form__label">Страна</label
                    ><input
                        placeholder="Страна"
                        id="country"
                        type="text"
                        class="form__input"
                        required
                    />
                </div>
                <div class="form__element">
                    <label for="email" class="form__label">Email</label
                    ><input
                        placeholder="Ваш Email"
                        id="email"
                        type="email"
                        class="form__input"
                        required
                    />
                </div>
                <div class="form__element">
                    <label for="city" class="form__label">Город</label
                    ><input
                        placeholder="Город"
                        id="city"
                        type="text"
                        class="form__input"
                        required
                    />
                </div>
                <div class="form__element">
                    <label for="phone" class="form__label">Телефон</label
                    ><input
                        placeholder="+7"
                        id="phone"
                        type="text"
                        class="form__input"
                        required
                    />
                </div>
            </form>
        </div>
        <div class="cart__products">
            <div class="line"></div>
            <ul class="cart__list">
                <cart-product
                    v-for="product in products"
                    @increase-count="increasePrice"
                    @decrease-count="decreasePrice"
                    :key="product"
                    :img="product.clothe.img"
                    :price="product.clothe.price"
                    :size="product.size"
                    :id="product.id"
                >
                    <div class="line"></div>
                </cart-product>
            </ul>
            <p class="cart__text">Доставка: 70$</p>
            <p class="cart__text">
                Общая цена:
                <span class="cart__span">{{ store.total + 70 }}</span>
            </p>
            <div class="line"></div>
            <button class="btn" type="submit" form="cartForm">Оформить</button>
        </div>
    </div>
</template>

<script>
import BackButton from "../components/BackButton";
import CartProduct from "../components/CartProduct";
import { onMounted } from "vue";
import { productsStore } from "../store/productsStore";
import { storeToRefs } from "pinia";
export default {
    name: "Cart",
    components: { CartProduct, BackButton },
    setup() {
        const store = productsStore();
        const { products } = storeToRefs(store);
        const increasePrice = (price) => {
            store.total += +price.replace(/ /g, "");
        };
        const decreasePrice = (price) => {
            store.total -= +price.replace(/ /g, "");
        };
        onMounted(async () => {
            await store.fetchProducts();
        });

        return {
            store,
            products,
            decreasePrice,
            increasePrice,
        };
    },
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";
.cart {
    display: flex;
    justify-content: space-between;
    &__order {
        max-width: 686px;
    }
    &__title {
        font-weight: 300;
        font-size: 24px;
        line-height: 36px;
        text-transform: uppercase;
        text-align: center;
        color: $dark-grey;
    }
    &__header {
        margin-bottom: 30px;
    }
    &__products {
        min-width: 480px;
        padding-top: 36px;
        display: flex;
        flex-direction: column;
    }
    &__span {
        color: red;
    }
    &__list {
        margin-bottom: 17px;
    }
    &__text {
        margin-bottom: 15px;
    }
}
.line {
    width: 100%;
    border-top: 1px solid #58595b;
}
@media (max-width: 1231px) {
    .cart {
        flex-direction: column;
        align-items: center;
        &__products {
            min-width: 686px;
        }
    }
}
@media (max-width: 740px) {
    .cart {
        &__order {
            min-width: 90vw;
        }
        &__products {
            min-width: 90vw;
        }
    }
}
</style>
