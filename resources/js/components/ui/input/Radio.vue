
<script setup lang="ts">
interface RadioOption {
    label: string;
    value: string;
    description?: string;
}

defineProps<{
    id: string;
    name: string;
    label: string;
    options: RadioOption[];
    error?: string;
}>();

const model = defineModel<string>({ required: true });
</script>

<template>
    <fieldset class="min-w-0 space-y-3">
        <legend class="form-label">
            {{ label }}
        </legend>

        <label
            v-for="option in options"
            :key="option.value"
            class="radio-option"
            :class="{ 'radio-option-selected': model === option.value }"
        >
            <input
                :id="`${id}-${option.value}`"
                v-model="model"
                type="radio"
                :name="name"
                :value="option.value"
                class="size-4 text-foreground"
            />

            <span class="min-w-0 flex-1">
                <span class="block text-sm font-semibold">
                    {{ option.label }}
                </span>

                <span
                    v-if="option.description"
                    class="mt-1 block text-xs leading-5 text-muted-foreground"
                >
                    {{ option.description }}
                </span>
            </span>
        </label>

        <p v-if="error" class="field-error">
            {{ error }}
        </p>
    </fieldset>
</template>
