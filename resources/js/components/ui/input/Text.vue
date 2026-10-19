<script setup lang="ts">
withDefaults(
    defineProps<{
        id: string;
        name: string;
        label?: string;
        placeholder: string;
        type?: string;
        autocomplete?: string;
        hint?: string;
        error?: string;
        maxlength?: number;
        required?: boolean;
        modelValue: string;
    }>(),
    {
        type: "text",
        required: true,
    },
);

defineEmits<{
    "update:modelValue": [value: string];
}>();
</script>

<template>
    <div class="min-w-0">
        <label :for="id" class="form-label">
            {{ label }}
            <span v-if="required" class="text-red">*</span>
        </label>

        <input
            :id="id"
            :type="type"
            :autocomplete="autocomplete"
            :placeholder="placeholder"
            :name="name"
            :required="required"
            :maxlength="maxlength"
            class="form-input standalone"
            @input="
                $emit(
                    'update:modelValue',
                    ($event.target as HTMLInputElement).value,
                )
            "
            :value="modelValue"
        />

        <p v-if="hint" class="field-hint">{{ hint }}</p>

        <p v-if="error" class="field-error">{{ error }}</p>
    </div>
</template>
