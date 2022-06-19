<template>
    <div class="wrapper">
        <div class="modal catalog__modal">
            <modal-button @close-modal="$emit('closeModal')"></modal-button>
            <div class="modal__content">
                <p class="modal__title">Спасибо!</p>
                <p class="modal__text">Товар успешно добавлен в корзину</p>
                <router-link to="/cart">
                    <button class="btn modal__btn">Оформить заказ</button>
                </router-link>
                <a
                    href="#"
                    @click.prevent="$emit('closeModal')"
                    class="modal__close"
                    >Продолжить покупки</a
                >
            </div>
        </div>
    </div>
</template>

<script>
import ModalButton from "./ModalButton";
export default {
    name: "ModalGoods",
    components: { ModalButton },
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";

.catalog {
    &__modal {
        max-width: 430px;
        padding: 49px 68px 52px;
    }
}

.modal {
    &__content {
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    &__close {
        text-align: center;
    }
    &__title {
        margin-bottom: 10px;
        font-size: 36px;
    }
    &__text {
        margin-bottom: 20px;
    }
    &__btn {
        margin-bottom: 20px;
        font-weight: 300;
        font-size: 14px;
        line-height: 18px;
        letter-spacing: 0.2em;
        color: white;
        text-transform: uppercase;
    }
    &__close {
        font-weight: 300;
        font-size: 17px;
        line-height: 24px;
        text-decoration: underline;
        color: #c18562;
    }
}
</style>
