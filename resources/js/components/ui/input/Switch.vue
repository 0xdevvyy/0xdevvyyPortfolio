<script setup lang="ts">
defineProps<{
    id: string;
    name: string;
    error?: string;
}>();

const model = defineModel<boolean>({ required: true });
</script>

<template>
    <div>
        <input
            :id="id"
            v-model="model"
            type="checkbox"
            role="switch"
            :name="name"
            class="sr-only"
            :aria-checked="model"
        />

        <p v-if="error" class="field-error">
            {{ error }}
        </p>
    </div>
</template>
