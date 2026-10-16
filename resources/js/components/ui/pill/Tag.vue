<script setup lang="ts">
defineProps<{
    name: string;
}>();
</script>

<template>
    <span class="tag-chip">
        {{ name }}
    </span>
</template>
