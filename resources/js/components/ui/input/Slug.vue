```vue
<script setup lang="ts">
interface Props {
    id: string;
    modelValue: string;
    error?: string;
}

withDefaults(defineProps<Props>(), {
    error: "",
});

const emit = defineEmits<{
    "update:modelValue": [value: string];
}>();
</script>

<template>
    <div>
        <label
            :for="id"
            class="mb-2 block font-mono text-xs font-bold uppercase tracking-widest text-foreground"
        >
            Slug
        </label>

        <div class="flex items-center border-b-2 border-border">
            <span class="font-mono text-sm text-muted-foreground">
                /project/
            </span>

            <input
                :id="id"
                type="text"
                :value="modelValue"
                class="w-full bg-transparent px-1 py-3 font-mono text-sm text-foreground outline-none"
                @input="
                    emit(
                        'update:modelValue',
                        ($event.target as HTMLInputElement).value,
                    )
                "
            />
        </div>

        <p v-if="error" class="mt-2 font-mono text-xs text-error">
            {{ error }}
        </p>
    </div>
</template>
```
