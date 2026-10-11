<script setup lang="ts">
import { computed, ref } from 'vue';
import { Check, Plus, Trash2 } from '@lucide/vue';

const features = defineModel<string[]>({
    required: true,
});

const props = defineProps<{
    errors?: Record<string, string>;
}>();

const newFeature = ref('');

const featuresError = computed(() => props.errors?.features);

function addFeature() {
    const value = newFeature.value.trim();

    if (!value) return;

    features.value = [...features.value, value];
    newFeature.value = '';
}

function removeFeature(index: number) {
    features.value = features.value.filter((_, i) => i !== index);
}
</script>

<template>
    <div class="space-y-3">
        <div
            v-for="(feature, index) in features"
            :key="index"
            class="space-y-1"
        >
            <div class="feature-row">
                <Check
                    :size="17"
                    class="shrink-0 text-muted-foreground"
                />

                <input
                    v-model="features[index]"
                    :name="`features[${index}]`"
                    type="text"
                    maxlength="255"
                    class="min-w-0 flex-1 bg-transparent text-sm outline-none"
                    :class="{
                        'text-destructive': props.errors?.[`features.${index}`],
                    }"
                    :aria-label="`Feature ${index + 1}`"
                    :aria-invalid="!!props.errors?.[`features.${index}`]"
                    :aria-describedby="
                        props.errors?.[`features.${index}`]
                            ? `feature-error-${index}`
                            : undefined
                    "
                    placeholder="Enter a project feature..."
                />

                <button
                    type="button"
                    class="icon-action icon-action-danger cursor-pointer"
                    :aria-label="`Remove feature ${index + 1}`"
                    @click="removeFeature(index)"
                >
                    <Trash2 :size="16" />
                </button>
            </div>

            <p
                v-if="props.errors?.[`features.${index}`]"
                :id="`feature-error-${index}`"
                class="pl-2 text-sm text-destructive"
                role="alert"
            >
                {{ props.errors[`features.${index}`] }}
            </p>
        </div>

        <p
            v-if="featuresError"
            class="text-sm text-destructive"
            role="alert"
        >
            {{ featuresError }}
        </p>

        <p
            v-if="features.length === 0"
            class="empty-note"
        >
            No features yet. Add your first project feature below.
        </p>

        <div class="flex flex-col gap-2 sm:flex-row">
            <input
                v-model="newFeature"
                type="text"
                maxlength="255"
                class="form-input standalone"
                placeholder="Add a new feature..."
                @keydown.enter.prevent="addFeature"
            />

            <button
                type="button"
                class="editor-button editor-button-secondary shrink-0 cursor-pointer"
                @click="addFeature"
            >
                <Plus :size="16" />
                Add Feature
            </button>
        </div>

        <input
            type="hidden"
            name="features_present"
            value="1"
        />
    </div>
</template>
