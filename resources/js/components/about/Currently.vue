<script setup lang="ts">
const currently = [
    'Finding a Job',
    'Doing some Personal Projects using VILT tech stack',
    'Making myself better everyday',
    'Learning Typescript',
];
</script>

<template>
    <div class="mt-4">
        <h2 class="font-display mt-3 text-4xl sm:text-5xl">
            <slot name="title" />
        </h2>
        <div
            class="text-primary/60 mt-7 space-y-4 font-mono text-sm leading-7 sm:text-base"
        >
            <ul class="space-y-2">
                <li
                    v-for="item in currently"
                    :key="item"
                    class="flex items-start"
                >
                    <span>{{ item }}</span>
                </li>
            </ul>
        </div>
    </div>
</template>
