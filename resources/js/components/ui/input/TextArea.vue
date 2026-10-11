
<script setup lang="ts">
withDefaults(
    defineProps<{
        id: string;
        name: string;
        label: string;
        placeholder?: string;
        hint?: string;
        error?: string;
        rows?: number;
        maxlength?: number;
        required?: boolean;
        modelValue: string;
    }>(),
    {
        rows: 4,
        required: false,
    },
);


defineEmits<{
    'update:modelValue': [value: string]
}>()
</script>

<template>
    <div class="min-w-0">
        <label :for="id" class="form-label">
            {{ label }}
            <span v-if="required" class="text-red">*</span>
        </label>

        <textarea
            :id="id"
            :name="name"
            :placeholder="placeholder"
            :rows="rows"
            :maxlength="maxlength"
            :required="required"
            :value="modelValue"
            @input="$emit('update:modelValue', ($event.target as HTMLInputElement).value)"
            class="form-input standalone !h-auto resize-y py-3"
        />

        <p v-if="hint" class="field-hint">
            {{ hint }}
        </p>

        <p v-if="error" class="field-error">
            {{ error }}
        </p>
    </div>
</template>
