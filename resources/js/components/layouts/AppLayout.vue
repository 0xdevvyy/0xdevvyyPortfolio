<script setup lang="ts">
import { ref } from 'vue';
import Loading from '../Loading.vue';
import AppHeader from './navigation/AppHeader.vue';

const loaded = ref(false);
</script>

<template>
    <Loading @complete="loaded = true" />

    <Transition name="page" mode="out-in">
        <div v-if="loaded" key="page">
            <AppHeader />

            <main>
                <slot />
            </main>
        </div>
    </Transition>
</template>

<style scoped>
.page-enter-active,
.page-leave-active {
    transition:
        opacity 0.6s ease,
        transform 0.6s ease;
}

.page-enter-from,
.page-leave-to {
    opacity: 0;
    transform: translateY(12px);
}
</style>
