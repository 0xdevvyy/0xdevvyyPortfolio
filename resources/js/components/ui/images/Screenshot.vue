<script setup lang="ts">
import { X } from "@lucide/vue";
import ProjectScreenshot from "@/components/project/ProjectScreenshot.vue";
import Delete from "../dialog/Delete.vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
import auth from "@/routes/auth/index.js";
interface Screenshot {
    id: number;
    screenshotPath: string;
}

defineProps<{
    screenshots: Screenshot[];
}>();

const isDeleteDialogOpen = ref(false);
const selectedScreenshotId = ref<number | null>(null);
const isDeleting = ref(false);

function openDeleteDialog(id: number) {
    selectedScreenshotId.value = id;
    isDeleteDialogOpen.value = true;
}

function closeDeleteDialog() {
    if (isDeleting.value) return;

    isDeleteDialogOpen.value = false;
    selectedScreenshotId.value = null;
}

function deleteScreenshot() {
    if (selectedScreenshotId.value === null) return;

    isDeleting.value = true;

    router.delete(auth.screenshot.delete(selectedScreenshotId.value).url, {
        preserveScroll: true,
        onSuccess: () => {
            isDeleteDialogOpen.value = false;
            selectedScreenshotId.value = null;
        },
        onFinish: () => {
            isDeleting.value = false;
        },
    });
}
</script>

<template>
    <div
        v-if="screenshots.length"
        class="grid grid-cols-2 gap-3 sm:grid-cols-3"
    >
        <div
            v-for="screenshot in screenshots"
            :key="screenshot.id"
            class="screenshot-item group relative"
        >
            <ProjectScreenshot :screenshots="[screenshot]" />

            <button
                type="button"
                class="absolute right-2 top-2 z-10 flex size-8 items-center justify-center rounded-full bg-red-600 text-white opacity-100 shadow-md transition hover:bg-red-700 sm:opacity-0 sm:group-hover:opacity-100 cursor-pointer"
                aria-label="Remove screenshot"
                title="Remove screenshot"
                @click="openDeleteDialog(screenshot.id)"
            >
                <X :size="18" />
            </button>

            <span class="screenshot-caption"> Existing image </span>
        </div>
    </div>

    <div v-else class="empty-note">
        No screenshots added yet. Add screenshots to showcase your project.
    </div>

    <Delete
        :open="isDeleteDialogOpen"
        title="Delete screenshot?"
        description="Are you sure you want to delete this screenshot? This action cannot be undone."
        :processing="isDeleting"
        @confirm="deleteScreenshot"
        @cancel="closeDeleteDialog"
    />
</template>
