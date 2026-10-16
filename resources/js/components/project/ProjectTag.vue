<script setup lang="ts">
import { computed } from 'vue';
import { Tag as TagIcon } from '@lucide/vue';

import TagChoice from '../ui/pill/TagChoice.vue';
import Tag from '../ui/pill/Tag.vue';

interface TagItem {
    id: number;
    name: string;
}

const props = defineProps<{
    tags: TagItem[];
    modelValue: number[];
}>();

const emit = defineEmits<{
    'update:modelValue': [value: number[]];
}>();

const selectedTags = computed(() =>
    props.tags.filter((tag) => props.modelValue.includes(tag.id)),
);

function toggleTag(tagId: number) {
    const updatedIds = props.modelValue.includes(tagId)
        ? props.modelValue.filter((id) => id !== tagId)
        : [...props.modelValue, tagId];

    emit('update:modelValue', updatedIds);
}
</script>

<template>
    <section class="editor-panel">
        <div class="panel-heading">
            <div class="panel-icon">
                <TagIcon :size="19" />
            </div>

            <div>
                <h2 class="panel-title">Project Tags</h2>
                <p class="panel-description">
                    Select the technologies and topics used in your project.
                </p>
            </div>
        </div>

        <div class="space-y-4">
            <div class="flex items-center justify-between gap-3">
                <p class="text-sm font-medium">Available tags</p>

                <span class="field-hint">
                    {{ selectedTags.length }} selected
                </span>
            </div>

            <div class="flex flex-wrap gap-2">
                <TagChoice
                    v-for="tag in tags"
                    :key="tag.id"
                    :name="tag.name"
                    :selected="modelValue.includes(tag.id)"
                    @click="toggleTag(tag.id)"
                />
            </div>

            <div class="tag-preview">
                <span class="text-muted-foreground text-xs font-semibold">
                    SELECTED
                </span>

                <div v-if="selectedTags.length" class="flex flex-wrap gap-2">
                    <Tag
                        v-for="tag in selectedTags"
                        :key="tag.id"
                        :name="tag.name"
                    />
                </div>

                <p v-else class="text-muted-foreground text-sm">
                    No tags selected.
                </p>
            </div>
        </div>
    </section>
</template>
