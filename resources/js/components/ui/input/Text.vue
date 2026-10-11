<script setup lang="ts">
withDefaults(
    defineProps<{
        id: string;
        name: string;
        label?: string;
        placeholder: string;
        type?: string;
        hint?: string;
        error?: string;
        required?: boolean;
        modelValue: string;
    }>(),{
        type: 'text',
        required: true,
    }
)

defineEmits<{
    'update:modelValue': [value: string];
}>();

</script>


<template>
    <div class="min-w-0 ">
        <label class="form-label">
            {{ label }}
            <span v-if="required" class="text-red">*</span>
        </label>

        <input
            :id="id"
            :placeholder="placeholder"
            :name="name"
            :required="required"
            class="form-input standalone"
            @input="$emit(
                'update:modelValue',
                ($event.target as HTMLInputElement).value
            )"
            :value="modelValue"
        >

        <p v-if="hint" class="field-hint">{{ hint }}</p>

        <p v-if="error" class="field-error">{{ error }}</p>
    </div>
</template>