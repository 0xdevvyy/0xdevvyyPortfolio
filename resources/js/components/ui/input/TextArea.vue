```vue
<script setup lang="ts">
interface Props {
    id: string;
    label?: string;
    modelValue: string;
    placeholder?: string;
    rows?: number;
    resize?: "none" | "y" | "both";
    error?: string;
}

withDefaults(defineProps<Props>(), {
    label: "",
    placeholder: "",
    rows: 4,
    resize: "none",
    error: "",
});

const emit = defineEmits<{
    "update:modelValue": [value: string];
}>();
</script>

<template>
    <div>
        <label
            v-if="label"
            :for="id"
            class="mb-2 block font-mono text-xs font-bold uppercase tracking-widest text-foreground"
        >
            {{ label }}
        </label>

        <textarea
            :id="id"
            :value="modelValue"
            :rows="rows"
            :placeholder="placeholder"
            :class="[
                'w-full border-2 border-border bg-card p-4 font-mono text-sm leading-6 text-foreground outline-none transition placeholder:text-muted-foreground/50 focus:border-accent',
                resize === 'none' && 'resize-none',
                resize === 'y' && 'resize-y',
                resize === 'both' && 'resize',
            ]"
            @input="
                emit(
                    'update:modelValue',
                    ($event.target as HTMLTextAreaElement).value,
                )
            "
        />

        <p v-if="error" class="mt-2 font-mono text-xs text-error">
            {{ error }}
        </p>
    </div>
</template>
```
