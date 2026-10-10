<script setup lang="ts">
import { ImagePlus, Trash2, X } from "@lucide/vue";

import ProjectScreenshots from "@/components/project/ProjectScreenshot.vue";

interface Screenshot {
    id: number;
    screenshotPath: string;
}

interface Props {
    modelValue: File[];
    screenshots: Screenshot[];
    deletedScreenshots: number[];
    projectTitle: string;
    error?: string;
}

const props = withDefaults(defineProps<Props>(), {
    error: "",
});

const emit = defineEmits<{
    "update:modelValue": [value: File[]];
    "update:deletedScreenshots": [value: number[]];
}>();

const toggleDelete = (id: number) => {
    if (props.deletedScreenshots.includes(id)) {
        emit(
            "update:deletedScreenshots",
            props.deletedScreenshots.filter(
                (screenshotId) => screenshotId !== id,
            ),
        );

        return;
    }

    emit("update:deletedScreenshots", [...props.deletedScreenshots, id]);
};

const handleFiles = (event: Event) => {
    const target = event.target as HTMLInputElement;

    if (!target.files) {
        return;
    }

    emit("update:modelValue", [
        ...props.modelValue,
        ...Array.from(target.files),
    ]);

    target.value = "";
};

const removeNewScreenshot = (index: number) => {
    emit(
        "update:modelValue",
        props.modelValue.filter((_, fileIndex) => fileIndex !== index),
    );
};

const screenshotPreview = (file: File) => {
    return URL.createObjectURL(file);
};
</script>

<template>
    <div>
        <div class="grid gap-5 sm:grid-cols-2">
            <template v-for="screenshot in screenshots" :key="screenshot.id">
                <div
                    v-if="!deletedScreenshots.includes(screenshot.id)"
                    class="group relative overflow-hidden border-2 border-[#173B5C]/20 bg-[#FAF7EC]"
                >
                    <ProjectScreenshots
                        :screenshots="[screenshot]"
                        :project-title="projectTitle"
                    >
                        <img
                            :src="screenshot.screenshotPath"
                            :alt="`${projectTitle} screenshot`"
                            class="block aspect-video w-full object-cover object-top transition duration-500 group-hover:scale-[1.02]"
                            loading="lazy"
                        />
                    </ProjectScreenshots>

                    <button
                        type="button"
                        aria-label="Delete screenshot"
                        class="absolute right-3 top-3 z-10 flex size-9 items-center justify-center rounded-full bg-[#FAF7EC]/90 text-[#bd0505] shadow-sm transition hover:scale-105 cursor-pointer"
                        @click="toggleDelete(screenshot.id)"
                    >
                        <Trash2 :size="16" />
                    </button>
                </div>

                <div
                    v-else
                    class="flex aspect-video flex-col items-center justify-center border-2 border-dashed border-[#bd0505]/40 bg-[#bd0505]/5 p-5 text-center"
                >
                    <Trash2 :size="22" class="mb-2 text-[#bd0505]" />

                    <p class="font-mono text-xs">
                        Screenshot marked for deletion
                    </p>

                    <button
                        type="button"
                        class="mt-3 font-mono text-xs font-bold text-[#71866A] underline"
                        @click="toggleDelete(screenshot.id)"
                    >
                        Undo
                    </button>
                </div>
            </template>

            <label
                class="flex aspect-video cursor-pointer flex-col items-center justify-center border-2 border-dashed border-[#173B5C]/30 bg-[#FAF7EC] transition hover:border-[#71866A] hover:bg-[#71866A]/5"
            >
                <ImagePlus :size="28" class="mb-3 text-[#71866A]" />

                <span class="font-mono text-sm font-bold">
                    Add screenshots
                </span>

                <span class="mt-1 font-mono text-xs text-[#173B5C]/45">
                    PNG, JPG, WEBP
                </span>

                <input
                    type="file"
                    multiple
                    accept="image/png,image/jpeg,image/webp"
                    class="hidden"
                    @change="handleFiles"
                />
            </label>
        </div>

        <div v-if="modelValue.length" class="mt-8">
            <p
                class="mb-4 font-mono text-xs font-bold uppercase tracking-widest"
            >
                New screenshots
            </p>

            <div class="flex gap-4 overflow-x-auto pb-3">
                <div
                    v-for="(file, index) in modelValue"
                    :key="`${file.name}-${index}`"
                    class="group relative w-48 shrink-0 overflow-hidden border-2 border-[#173B5C]/20 bg-[#FAF7EC]"
                >
                    <img
                        :src="screenshotPreview(file)"
                        :alt="file.name"
                        class="aspect-video w-full object-cover"
                    />

                    <button
                        type="button"
                        aria-label="Remove new screenshot"
                        class="absolute right-2 top-2 flex size-8 items-center justify-center rounded-full bg-[#FAF7EC]/90 text-[#bd0505] cursor-pointer"
                        @click="removeNewScreenshot(index)"
                    >
                        <X :size="15" />
                    </button>

                    <div class="truncate px-3 py-2 font-mono text-[10px]">
                        {{ file.name }}
                    </div>
                </div>
            </div>
        </div>

        <p v-if="error" class="mt-3 font-mono text-xs text-[#bd0505]">
            {{ error }}
        </p>
    </div>
</template>
