<script setup lang="ts">
import { Book, CookingPot, Gamepad2, Music, TrophyIcon } from '@lucide/vue';

const hobbies = [
    {
        name: 'Gaming',
        icon: Gamepad2,
    },
    {
        name: 'Listening to Music',
        icon: Music,
    },
    {
        name: 'Playing Basketball',
        icon: TrophyIcon,
    },
    {
        name: 'Reading (Novels, Books, Manga, Manhwa)',
        icon: Book,
    },
    {
        name: 'Cooking',
        icon: CookingPot,
    },
];
</script>

<template>
    <div class="mt-4 pb-2">
        <h2 class="font-display mt-3 text-4xl sm:text-5xl">
            <slot name="title" />
        </h2>

        <div
            class="font-hand text-primary/65 max-w-2xl text-xl leading-relaxed sm:text-2xl"
        >
            <div class="mt-6 flex flex-wrap gap-x-5 gap-y-3">
                <span
                    v-for="hobbie in hobbies"
                    :key="hobbie.name"
                    class="flex items-center gap-2"
                >
                    <component :is="hobbie.icon" class="size-4" />
                    {{ hobbie.name }}
                </span>
            </div>
        </div>
    </div>
</template>
