<script setup lang="ts">
import { Mail } from "@lucide/vue";

interface Props {
    modelValue: string;
    label?: string;
    placeholder?: string;
    error?: string;
}

withDefaults(defineProps<Props>(), {
    label: "Email",
    placeholder: "you@example.com",
    error: "",
});

const emit = defineEmits<{
    "update:modelValue": [value: string];
}>();
</script>

<template>
    <div>
        <label class="font-heading mb-2 block text-lg text-ink">
            {{ label }}

            <span class="text-error"> * </span>
        </label>

        <div
            class="flex items-center gap-3 border-2 border-ink/40 bg-paper px-4 py-3 transition focus-within:border-primary"
            :class="{ 'border-error': error }"
        >
            <Mail class="h-5 w-5 shrink-0 text-ink" :stroke-width="1.8" />

            <input
                :value="modelValue"
                type="email"
                :placeholder="placeholder"
                required
                autocomplete="email"
                class="font-body w-full border-0 bg-transparent p-0 text-sm text-ink outline-none placeholder:text-pencil focus:ring-0"
                @input="
                    emit(
                        'update:modelValue',
                        ($event.target as HTMLInputElement).value,
                    )
                "
            />
        </div>

        <p v-if="error" class="font-body mt-2 text-xs text-error">
            {{ error }}
        </p>
    </div>
</template>
