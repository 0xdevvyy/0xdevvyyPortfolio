<script setup lang="ts">
import { Link, usePage } from '@inertiajs/vue3'
import Line from '../lines/Line.vue'

defineProps<{
    url: string
    label: string
    // active?: boolean
}>()

const page = usePage()
</script>

<template>
    <Link
        :href="url"
        class="group relative inline-block font-doodle px-4 py-2"
    >
        {{ label }}

        <Line
            :class="[
                'origin-left transition-transform duration-300 ease-out',
                page.url === url
                    ? 'scale-x-100'
                    : 'scale-x-0 group-hover:scale-x-100', //left to right 
            ]"
        />
    </Link>
</template>