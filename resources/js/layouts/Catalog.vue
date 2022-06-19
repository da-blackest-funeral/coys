<template>
    <modal-goods
        v-if="showModal"
        @close-modal="showModal = false"
    ></modal-goods>
    <div class="catalog">
        <div class="catalog__filtration">
            <ul class="catalog__list">
                <li class="catalog__item">
                    <a href="#" class="catalog__link">Sale</a>
                </li>
                <li class="catalog__item">
                    <a href="#" class="catalog__link">New</a>
                </li>
                <li class="catalog__item">
                    <a href="#" class="catalog__link">Специальные позиции</a>
                </li>
                <li class="catalog__item">
                    <a href="#" class="catalog__link">Bestsellers</a>
                </li>
                <li class="catalog__item">
                    <a href="#" class="catalog__link">Вся одежда</a>
                </li>
                <li class="catalog__item">
                    <a href="#" class="catalog__link">Цвет</a>
                </li>
            </ul>
        </div>
        <div class="catalog__goods">
            <catalog-product
                @add-product="addProduct"
                v-for="good in goods"
                :key="good"
                :src="good.img"
                :price="good.price"
                :id="good.id"
                :color="good.color"
            ></catalog-product>
        </div>
    </div>
</template>

<script>
import CatalogProduct from "../components/CatalogProduct";
import { onMounted, ref, watch } from "vue";
import { storeToRefs } from "pinia";
import ModalGoods from "../components/ModalGoods";
import { goodsStore } from "../store/goodsStore";
import axios from "axios";
import { userStore } from "../store/userStore";
import CatalogFiltration from "../components/CatalogFiltration";

export default {
    name: "Catalog",
    setup() {
        const store = goodsStore();
        const { goods } = storeToRefs(store);
        const storeUser = userStore();
        let showModal = ref(false);
        const addProduct = async (clotheSize, id) => {
            if (storeUser.isAuth) {
                await axios.post("/api/products", {
                    size: clotheSize,
                    clothe_id: id,
                });
                showModal.value = true;
            } else {
                console.log("not auth");
            }
        };

        watch(showModal, () => {
            showModal.value
                ? (document.body.style.overflow = "hidden")
                : (document.body.style.overflow = "auto");
        });
        onMounted(async () => {
            await store.fetchGoods();
        });

        return {
            goods,
            showModal,
            addProduct,
        };
    },
    components: {
        CatalogFiltration,
        ModalGoods,
        CatalogProduct,
    },
};
</script>

<style lang="scss">
@import "resources/sass/app";
.catalog {
    display: flex;

    &__filtration {
        margin-right: 25px;
        width: 330px;
    }

    &__list {
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    &__item {
        display: flex;

        border-top: 1px solid #58595b;

        &:last-of-type {
            border-bottom: 1px solid #58595b;
        }
    }

    &__link {
        width: 322px;
        padding-top: 10px;
        padding-bottom: 10px;
        font-weight: 300;
        font-size: 14px;
        line-height: 18px;
        letter-spacing: 0.3em;
        text-decoration: none;
        text-align: center;
        color: $dark-grey;
        &:hover {
            background-color: #e4c5ad;
        }
        &:active {
            background-color: $beige;
        }
    }

    &__goods {
        display: flex;
        justify-content: space-between;
        flex-wrap: wrap;
    }
}

@media (max-width: 834px) {
    .catalog {
        &__filtration {
            display: none;
        }
        &__goods {
            justify-content: center;
        }
    }
}
</style>
