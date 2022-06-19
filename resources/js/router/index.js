import { createRouter, createWebHistory } from "vue-router";
import { userStore } from "../store/userStore";
import { modalStore } from "../store/modalStore";
import Catalog from "../layouts/Catalog";
import { productsStore } from "../store/productsStore";

const routes = [
    {
        path: "/",
        name: "Home",
        component: Catalog,
        meta: {
            auth: false,
        },
    },
    {
        path: "/account",
        name: "Account",
        component: () => import("../layouts/Account"),
        meta: {
            auth: true,
            admin: false,
        },
    },
    {
        path: "/catalog",
        name: "Catalog",
        component: () => import("../layouts/Catalog"),
        meta: {
            auth: false,
            admin: false,
        },
    },
    {
        path: "/cart",
        name: "Cart",
        component: () => import("../layouts/Cart"),
        meta: {
            auth: true,
            admin: false,
        },
    },
    {
        path: "/admin",
        name: "Admin",
        component: () => import("../layouts/Admin"),
        meta: {
            auth: true,
            admin: true,
        },
    },
];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

router.beforeEach(async (to, from, next) => {
    const requiredAuth = to.meta.auth;
    const requiredAdmin = to.meta.admin;
    const store = userStore();
    const storeAuth = modalStore();
    const storeProducts = productsStore();

    // route guards for auth-routes
    if (requiredAuth) {
        try {
            await store.fetchUser();
        } catch (e) {
            console.log(e);
        } finally {
            if (store.isAuth) {
                next();
            } else {
                storeAuth.openModal();
            }
        }
    } else {
        next();
    }

    if (requiredAdmin) {
        if (store.isAuth) {
            if (store.isAdmin) {
                next();
            } else {
                await router.push(from.path);
                alert("Not admin!");
            }
        } else {
            alert("Please log in!");
        }
    }
});

router.afterEach((to, from) => {
    const storeProducts = productsStore();
    const storeAuth = modalStore();
    storeProducts.total = 0;
    storeAuth.closeModal();
    storeAuth.showMobileModal = false;
});
export default router;
