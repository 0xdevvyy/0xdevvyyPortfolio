```vue
<script setup lang="ts">
interface Props {
    id: string;
    label?: string;
    modelValue: string;
    placeholder?: string;
    type?: string;
    error?: string;
}

withDefaults(defineProps<Props>(), {
    label: "",
    placeholder: "",
    type: "text",
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

        <input
            :id="id"
            :type="type"
            :value="modelValue"
            :placeholder="placeholder"
            class="w-full border-b-2 border-border bg-transparent px-1 py-3 font-serif text-2xl text-foreground outline-none transition placeholder:text-muted-foreground/40 focus:border-accent"
            @input="
                emit(
                    'update:modelValue',
                    ($event.target as HTMLInputElement).value,
                )
            "
        />

        <p v-if="error" class="mt-2 font-mono text-xs text-error">
            {{ error }}
        </p>
    </div>
</template>
```
