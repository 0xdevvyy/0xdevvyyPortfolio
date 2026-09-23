<script setup lang="ts">
const technologies = [
    {
        name: 'Laravel',
        path: '/images/laravel-tag.png',
    },
    {
        name: 'Vue',
        path: '/images/vue-tag.png',
    },
    {
        name: 'Inertia.js',
        path: '/images/inertia-tag.png',
    },
    {
        name: 'Tailwind CSS',
        path: '/images/tailwind-tag.png',
    },
    {
        name: 'PHP',
        path: '/images/php-tag.png',
    },
];
</script>

<template>
    <div class="mt-4">
        <h2 class="font-display mt-3 text-4xl sm:text-5xl">
            <slot name="title">Technologies</slot>
        </h2>

        <div class="mt-7 flex flex-wrap items-center gap-6">
            <img
                v-for="tech in technologies"
                :key="tech.name"
                :src="tech.path"
                :alt="tech.name"
                class="size-12 object-contain transition duration-200 hover:scale-110"
            />
        </div>
    </div>
</template>
