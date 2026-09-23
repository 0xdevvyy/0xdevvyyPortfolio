<script setup lang="ts">
import { Link, usePage } from "@inertiajs/vue3";
import { computed } from "vue";
import Line from "../svg/Line.vue";
import { RouteDefinition } from "@/wayfinder/index.js";

const props = defineProps<{
    url?: string | RouteDefinition<"get">;
    label: string;
}>();

const page = usePage();

const href = computed(() => {
    if (!props.url) {
        return "";
    }

    return typeof props.url === "string" ? props.url : props.url.url;
});
</script>

<template>
    <Link :href="href" class="group relative inline-block px-2 font-doodle">
        {{ label }}

        <Line
            :class="[
                'origin-left transition-transform duration-300 ease-out',
                page.url === href
                    ? 'scale-x-100'
                    : 'scale-x-0 group-hover:scale-x-100',
            ]"
        />
    </Link>
</template>
