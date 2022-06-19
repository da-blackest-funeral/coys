<template>
    <router-link to="/" class="back">
        <svg
            width="13"
            height="23"
            viewBox="0 0 13 23"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M12.7071 1.08064L12 0.373535L0.686296 11.6872L12 23.001L12.7071 22.2938L2.10051 11.6872L12.7071 1.08064Z"
                fill="#58595B"
            />
        </svg>
        <span class="back__text"> Назад </span>
    </router-link>
</template>

<script>
export default {
    name: "BackButton",
};
</script>

<style scoped lang="scss">
@import "resources/sass/app";
</style>
