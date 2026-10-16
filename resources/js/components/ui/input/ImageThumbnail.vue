<script setup lang="ts">
import { ref, onUnmounted } from "vue";
import { Image as ImageIcon, Upload } from "@lucide/vue";

interface Project {
    title: string;
    thumbnailPath: string | null;
}

defineProps<{
    project: Project;
}>();

const emit = defineEmits<{
    "update:thumbnail": [file: File | null];
}>();

const thumbnailInput = ref<HTMLInputElement | null>(null);
const previewUrl = ref<string | null>(null);

function handleThumbnailChange(event: Event) {
    const input = event.target as HTMLInputElement;
    const file = input.files?.[0] ?? null;

    if (!file) return;

    if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value);
    }

    previewUrl.value = URL.createObjectURL(file);
    emit("update:thumbnail", file);
}

onUnmounted(() => {
    if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value);
    }
});
</script>

<template>
    <div class="space-y-4">
        <input
            ref="thumbnailInput"
            type="file"
            accept="image/png,image/jpeg,image/webp"
            class="hidden"
            @change="handleThumbnailChange"
        />

        <div
            v-if="previewUrl || project.thumbnailPath"
            class="thumbnail-preview cursor-pointer"
            @click="thumbnailInput?.click()"
        >
            <img
                :src="previewUrl ?? project.thumbnailPath!"
                :alt="`${project.title} thumbnail`"
                class="aspect-video w-full rounded-lg object-cover"
            />

            <div class="thumbnail-change">
                <Upload :size="15" />
                Change Image
            </div>
        </div>

        <div
            v-else
            class="upload-zone min-h-44 cursor-pointer"
            @click="thumbnailInput?.click()"
        >
            <ImageIcon :size="30" />

            <span class="font-semibold"> Upload thumbnail </span>

            <span class="text-muted-foreground text-xs">
                Click to choose an image
            </span>
        </div>
    </div>
</template>
