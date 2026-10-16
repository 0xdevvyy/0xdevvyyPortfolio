<script setup lang="ts">
import { ref, onUnmounted } from "vue";
import { Image as ImageIcon, Upload } from "@lucide/vue";

defineProps<{
    title?: string;
    thumbnailPath?: string | null;
    modelValue: File | null;
    error?: string;
}>();

const emit = defineEmits<{
    "update:modelValue": [file: File | null];
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
    emit("update:modelValue", file);
}

onUnmounted(() => {
    if (previewUrl.value) {
        URL.revokeObjectURL(previewUrl.value);
    }
});
</script>

<template>
    <div class="space-y-3">
        <input
            ref="thumbnailInput"
            type="file"
            accept="image/png,image/jpeg,image/webp"
            class="hidden"
            @change="handleThumbnailChange"
        />

        <button
            v-if="previewUrl || thumbnailPath"
            type="button"
            class="thumbnail-preview group relative block w-full overflow-hidden rounded-lg"
            @click="thumbnailInput?.click()"
        >
            <img
                :src="previewUrl ?? thumbnailPath!"
                :alt="`${title ?? 'Project'} thumbnail`"
                class="aspect-video w-full rounded-lg object-cover"
            />

            <span class="thumbnail-change cursor-pointer mt-2">
                <Upload :size="15" />
                Change Image
            </span>
        </button>

        <button
            v-else
            type="button"
            class="upload-zone flex min-h-44 w-full flex-col items-center justify-center gap-3 rounded-lg cursor-pointer"
            @click="thumbnailInput?.click()"
        >
            <ImageIcon :size="30" />

            <span class="font-semibold">Upload thumbnail</span>

            <span class="text-muted-foreground text-xs">
                Click to choose an image
            </span>
        </button>

        <p v-if="error" class="text-destructive text-sm">
            {{ error }}
        </p>
    </div>
</template>
