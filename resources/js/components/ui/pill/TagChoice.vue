<script setup lang="ts">
import { Check } from "@lucide/vue";

defineProps<{
    name: string;
    selected: boolean;
}>();
</script>

<template>
    <span
        class="tag-choice cursor-pointer"
        :class="{ 'tag-choice-selected': selected }"
    >
        {{ name }}

        <Check v-if="selected" :size="14" />
    </span>
</template>
