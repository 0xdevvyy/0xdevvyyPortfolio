<script setup lang="ts">
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ArrowLeft, Check, Tag as TagIcon } from '@lucide/vue';
import { index, update } from '@/routes/auth/tag';
import Input from '@/components/ui/input/Text.vue';

interface Tag {
    id: number;
    name: string;
}

const props = defineProps<{
    tag: Tag;
}>();

const form = useForm({
    name: props.tag.name,
});

function submit() {
    form.put(update(props.tag.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Edit Tag" />

    <main
        class="project-editor-page mx-auto w-full max-w-3xl space-y-8 px-4 py-8 sm:px-6"
    >
        <header class="border-border border-b border-dashed pb-6">
            <Link
                :href="index().url"
                class="text-muted-foreground hover:text-primary mb-6 inline-flex items-center gap-2 text-sm transition-colors"
            >
                <ArrowLeft class="size-4" />
                Back to tags
            </Link>

            <p
                class="text-secondary font-mono text-xs tracking-[0.2em] uppercase"
            >
                Project organization
            </p>

            <h1
                class="font-display text-primary mt-2 text-3xl font-bold sm:text-4xl"
            >
                Edit a tag<span class="text-destructive">.</span>
            </h1>

            <p class="text-muted-foreground mt-2 text-sm">
                Update the name of this reusable project label.
            </p>
        </header>

        <form class="editor-panel" @submit.prevent="submit">
            <div class="panel-heading">
                <div class="panel-icon">
                    <TagIcon class="size-5" />
                </div>

                <div>
                    <h2 class="panel-title">Tag details</h2>
                    <p class="panel-description">
                        Change the name used to organize your projects.
                    </p>
                </div>
            </div>

            <div class="space-y-6">
                <Input
                    id="name"
                    name="name"
                    label="Tag name"
                    placeholder="e.g. Laravel, Vue.js, Open Source"
                    hint="Use a short, descriptive name that can be reused across multiple projects."
                    :required="true"
                    v-model="form.name"
                    :error="form.errors.name"
                />

                <div class="tag-preview">
                    <div>
                        <p class="text-muted-foreground text-xs font-semibold">
                            LIVE PREVIEW
                        </p>
                        <p class="text-muted-foreground mt-1 text-xs">
                            This is how your tag will appear on projects.
                        </p>
                    </div>

                    <div>
                        <span class="tag-chip">
                            <TagIcon class="size-3.5" />
                            {{ form.name.trim() || 'Your tag name' }}
                        </span>
                    </div>
                </div>
            </div>

            <footer class="editor-footer mt-6">
                <p class="text-muted-foreground text-xs">
                    <span class="text-destructive">*</span>
                    Required field
                </p>

                <div class="flex flex-col-reverse gap-3 sm:flex-row">
                    <Link
                        :href="index().url"
                        class="editor-button editor-button-secondary"
                    >
                        Cancel
                    </Link>

                    <button
                        type="submit"
                        :disabled="form.processing || !form.name.trim()"
                        class="editor-button editor-button-primary"
                    >
                        <Check class="size-4" />
                        {{ form.processing ? 'Saving...' : 'Save changes' }}
                    </button>
                </div>
            </footer>
        </form>
    </main>
</template>
