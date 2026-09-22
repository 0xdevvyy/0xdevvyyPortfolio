<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    url?: string;
}>()
</script>


<template>
    <Link :href="url">
        <button 
            class="cursor-pointer inline-flex h-12 items-center justify-center rounde-lg
            bg-primary px-6 font-sans text-sm font-bold tracking-wide 
            text-primary-foreground shadow-[3px_3px_0_0_var(--color-ink-dark)] 
            transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[5px_5px_0_0_var(--color-ink-dark)] 
            active:translate-y-0 active:shadow-[2px_2px_0_0_var(--color-ink-dark)]"

        >
            <slot />
        </button>
    </Link>
</template>