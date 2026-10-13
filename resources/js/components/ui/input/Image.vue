<script setup lang="ts">
import { ref, onBeforeUnmount } from "vue";
import { Upload, X } from "@lucide/vue";

defineProps<{
    title: string;
    error: string[];
}>();

const emit = defineEmits<{
    "update:modelValue": [files: File[]];
}>();

const selectedFiles = ref<File[]>([]);
const previews = ref<string[]>([]);

function handleFiles(event: Event) {
    const input = event.target as HTMLInputElement;
    const files = Array.from(input.files ?? []);

    selectedFiles.value = [...selectedFiles.value, ...files];

    previews.value.forEach((url) => URL.revokeObjectURL(url));

    previews.value = selectedFiles.value.map((file) =>
        URL.createObjectURL(file),
    );

    emit("update:modelValue", selectedFiles.value);

    input.value = "";
}

function removeImage(index: number) {
    selectedFiles.value.splice(index, 1);

    URL.revokeObjectURL(previews.value[index]);
    previews.value.splice(index, 1);

    emit("update:modelValue", selectedFiles.value);
}

onBeforeUnmount(() => {
    previews.value.forEach((url) => URL.revokeObjectURL(url));
});
</script>

<template>
    <div class="space-y-4">
        <label class="upload-zone cursor-pointer">
            <Upload :size="25" />

            <span class="font-semibold">
                {{ title }}
            </span>

            <span class="text-muted-foreground text-xs">
                PNG, JPG or WEBP
            </span>

            <input
                type="file"
                accept="image/png,image/jpeg,image/webp"
                multiple
                class="hidden"
                @change="handleFiles"
            />
        </label>

        <div
            v-if="selectedFiles.length"
            class="flex gap-4 overflow-x-auto pb-3"
        >
            <div
                v-for="(preview, index) in previews"
                :key="`${selectedFiles[index].name}-${index}`"
                class="group relative w-56 shrink-0 overflow-hidden rounded-lg border"
            >
                <img
                    :src="preview"
                    :alt="selectedFiles[index].name"
                    class="aspect-video w-full object-cover"
                />

                <button
                    type="button"
                    class="absolute right-2 top-2 rounded-full bg-black/70 p-1.5 text-white cursor-pointer transition hover:bg-red-600 sm:opacity-0 sm:group-hover:opacity-100"
                    aria-label="Remove screenshot"
                    @click="removeImage(index)"
                >
                    <X :size="16" />
                </button>

                <p class="truncate px-2 py-2 text-xs text-muted-foreground">
                    {{ selectedFiles[index].name }}
                </p>
            </div>
        </div>
        <div v-if="error.length" class="space-y-1">
            <p
                v-for="(message, index) in error"
                :key="index"
                class="text-error text-sm font-medium"
            >
                {{ message }}
            </p>
        </div>
    </div>
</template>
