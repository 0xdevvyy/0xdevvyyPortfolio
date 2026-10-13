<script setup lang="ts">
import { AlertTriangle } from "@lucide/vue";

withDefaults(
    defineProps<{
        open: boolean;
        title?: string;
        description?: string;
        processing?: boolean;
    }>(),
    {
        title: "Are you sure?",
        description: "This action cannot be undone.",
        processing: false,
    },
);

const emit = defineEmits<{
    confirm: [];
    cancel: [];
}>();
</script>

<template>
    <Teleport to="body">
        <div v-if="open" class="dialog-overlay" @click.self="emit('cancel')">
            <section
                class="delete-dialog"
                role="alertdialog"
                aria-modal="true"
                aria-labelledby="delete-dialog-title"
                aria-describedby="delete-dialog-description"
            >
                <div class="dialog-icon">
                    <AlertTriangle :size="24" />
                </div>

                <h2 id="delete-dialog-title" class="font-heading text-xl">
                    {{ title }}
                </h2>

                <p
                    id="delete-dialog-description"
                    class="my-4 text-sm text-muted-foreground"
                >
                    {{ description }}
                </p>

                <div class="flex justify-end gap-3">
                    <button
                        type="button"
                        class="editor-button editor-button-secondary cursor-pointer"
                        :disabled="processing"
                        @click="emit('cancel')"
                    >
                        Cancel
                    </button>

                    <button
                        type="button"
                        class="editor-button editor-button-danger cursor-pointer"
                        :disabled="processing"
                        @click="emit('confirm')"
                    >
                        {{ processing ? "Deleting..." : "Delete" }}
                    </button>
                </div>
            </section>
        </div>
    </Teleport>
</template>
