<template>
    <button class="modal__button" @click="$emit('closeModal')">
        <svg
            width="23"
            height="23"
            viewBox="0 0 23 23"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
        >
            <path
                d="M16.4497 5.84306L17.1569 6.55016L12.2071 11.4999L17.1569 16.4497L16.4497 17.1568L11.5 12.207L6.55025 17.1568L5.84315 16.4497L10.7929 11.4999L5.84315 6.55016L6.55025 5.84306L11.5 10.7928L16.4497 5.84306Z"
                fill="#58595B"
            />
        </svg>
    </button>
</template>

<script>
export default {
    name: "ModalButton",
    emits: ["closeModal"],
};
</script>

<style scoped></style>
