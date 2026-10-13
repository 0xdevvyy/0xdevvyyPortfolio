<script setup lang="ts">
import { Upload } from "@lucide/vue";

defineProps<{
    title: string;
}>();
</script>

<template>
    <div class="upload-zone">
        <Upload :size="25" />

        <span class="font-semibold">
            {{ title }}
        </span>

        <span class="text-muted-foreground text-xs"> PNG, JPG or WEBP </span>
    </div>
</template>
