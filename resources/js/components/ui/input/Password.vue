<script setup lang="ts">
import { Eye, EyeOff, LockKeyhole } from "@lucide/vue";
import { ref } from "vue";

interface Props {
    modelValue: string;
    id?: string;
    name?: string;
    label?: string;
    placeholder?: string;
    error?: string;
    autocomplete?: string;
    required?: boolean;
    hint?: string;
}

withDefaults(defineProps<Props>(), {
    label: "Password",
    placeholder: "Enter your password",
    error: "",
    autocomplete: "current-password",
    required: true,
});

const emit = defineEmits<{
    "update:modelValue": [value: string];
}>();

const showPassword = ref(false);
</script>

<template>
    <div>
        <label :for="id" class="font-heading mb-2 block text-lg text-ink">
            {{ label }}

            <span v-if="required" class="text-error"> * </span>
        </label>

        <div
            class="flex items-center gap-3 border-2 border-ink/40 bg-paper px-4 py-3 transition focus-within:border-primary"
            :class="{ 'border-error': error }"
        >
            <LockKeyhole
                class="h-5 w-5 shrink-0 text-ink"
                :stroke-width="1.8"
            />

            <input
                :id="id"
                :name="name"
                :value="modelValue"
                :type="showPassword ? 'text' : 'password'"
                :placeholder="placeholder"
                :required="required"
                :autocomplete="autocomplete"
                class="font-body w-full border-0 bg-transparent p-0 text-sm text-ink outline-none placeholder:text-pencil focus:ring-0"
                @input="
                    emit(
                        'update:modelValue',
                        ($event.target as HTMLInputElement).value,
                    )
                "
            />

            <button
                type="button"
                class="shrink-0 text-ink transition hover:text-primary cursor-pointer"
                @click="showPassword = !showPassword"
            >
                <EyeOff
                    v-if="showPassword"
                    class="h-5 w-5"
                    :stroke-width="1.8"
                />

                <Eye v-else class="h-5 w-5" :stroke-width="1.8" />
            </button>
        </div>

        <p v-if="hint" class="font-body mt-2 text-xs text-pencil">
            {{ hint }}
        </p>

        <p v-if="error" class="font-body mt-2 text-xs text-error">
            {{ error }}
        </p>
    </div>
</template>
