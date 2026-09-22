<script setup lang="ts">
import { Link } from '@inertiajs/vue3';

defineProps<{
    url?: string;
}>()
</script>


<template>
    <Link
        :href="url"
    >
        <button
            class="cursor-pointer inline-flex h-12 items-center justify-center 
            rounded-lg border-2 border-primary bg-transparent px-6 
            font-sans text-sm font-bold tracking-wide text-primary 
            transition-all duration-200 hover:-translate-y-0.5 hover:bg-primary
             hover:text-primary-foreground"
        >
            <slot />
        </button>
    </Link>
</template>