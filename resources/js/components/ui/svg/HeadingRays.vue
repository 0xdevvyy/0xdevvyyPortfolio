<script setup lang="ts">
defineProps<{
    side: "left" | "right";
}>();
</script>

<template>
    <svg
        class="heading-rays"
        :class="side === 'left' ? 'heading-rays-left' : 'heading-rays-right'"
        viewBox="0 0 100 100"
        fill="none"
        xmlns="http://www.w3.org/2000/svg"
        aria-hidden="true"
    >
        <path
            d="M18 24 L5 16"
            stroke="#032240"
            stroke-width="1.8"
            stroke-linecap="round"
        />

        <path
            d="M16 48 L2 49"
            stroke="#032240"
            stroke-width="1.8"
            stroke-linecap="round"
        />

        <path
            d="M19 72 L7 82"
            stroke="#032240"
            stroke-width="1.8"
            stroke-linecap="round"
        />
    </svg>
</template>

<style scoped>
.heading-rays {
    position: absolute;
    width: 60px;
    height: 90px;
    overflow: visible;
    pointer-events: none;
}

.heading-rays-left {
    left: -35px;
    top: 0;
}

.heading-rays-right {
    right: -35px;
    top: 0;
    transform: scaleX(-1);
}
</style>
