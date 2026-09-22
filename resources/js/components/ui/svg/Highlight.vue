<script setup lang="ts">
</script>

<template>
    <svg
        class="title-highlight"
        viewBox="0 0 500 75"
        preserveAspectRatio="none"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <path
            d="M9 24 Q18 18 37 20 L472 13
            Q490 14 485 25 L491 45
            Q487 52 466 51 L24 64
            Q7 62 11 49 Z"
            fill="#e7c65b"
            opacity="0.8"
        />
    </svg>
</template>


<style scoped>
.title-highlight {
    position: absolute;

    left: -9px;
    top: 50%;

    width: calc(100% + 18px);
    height: 34px;

    transform:
        translateY(-40%)
        rotate(-2deg);

    overflow: visible;

    pointer-events: none;
}
</style>