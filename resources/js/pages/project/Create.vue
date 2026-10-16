<script setup lang="ts">
import ProjectTag from '@/components/project/ProjectTag.vue';
import Image from '@/components/ui/input/Image.vue';
import ImageThumbnail from '@/components/ui/input/ImageThumbnail.vue';
import Features from '@/components/ui/input/Features.vue';
import Switch from '@/components/ui/input/Switch.vue';
import Text from '@/components/ui/input/Text.vue';
import TextArea from '@/components/ui/input/TextArea.vue';
import auth from '@/routes/auth';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
    ArrowLeft,
    CalendarDays,
    Check,
    Eye,
    FileText,
    Image as ImageIcon,
    Star,
} from '@lucide/vue';
import { computed, ref } from 'vue';

interface Tag {
    id: number;
    name: string;
}

const props = defineProps<{
    tags: Tag[];
}>();

const newScreenshots = ref<File[]>([]);
const thumbnailPreview = ref<string | null>(null);

const form = useForm({
    title: '',
    slug: '',
    description: '',
    excerpt: '',
    features: [] as string[],
    tags: [] as number[],
    thumbnail_path: null as File | null,
    screenshots: [] as File[],
    is_published: false,
});

const previewTags = computed(() =>
    props.tags.filter((tag) => form.tags.includes(tag.id)),
);

function updateThumbnail(file: File | null) {
    form.thumbnail_path = file;

    if (thumbnailPreview.value) {
        URL.revokeObjectURL(thumbnailPreview.value);
        thumbnailPreview.value = null;
    }

    if (file) {
        thumbnailPreview.value = URL.createObjectURL(file);
    }
}

function submit() {
    form.screenshots = [...newScreenshots.value];

    form.post(auth.project.store().url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head title="Create Project" />

    <div
        class="project-editor-page mx-auto w-full max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8"
    >
        <header
            class="flex flex-col justify-between gap-5 sm:flex-row sm:items-center"
        >
            <div class="space-y-3">
                <Link
                    :href="auth.project.index()"
                    class="text-muted-foreground hover:text-primary inline-flex items-center gap-2 text-sm transition-colors"
                >
                    <ArrowLeft :size="16" />
                    Back to Projects
                </Link>

                <div>
                    <h1 class="font-display text-primary text-3xl sm:text-4xl">
                        Create Project
                    </h1>

                    <p class="text-muted-foreground mt-2 text-sm leading-6">
                        Add a new project to your portfolio, including its
                        details, features, screenshots, and tags.
                    </p>
                </div>
            </div>
        </header>

        <form @submit.prevent="submit">
            <div class="grid grid-cols-1 items-start gap-6 lg:grid-cols-3">
                <div class="min-w-0 space-y-6 lg:col-span-2">
                    <section class="editor-panel">
                        <div class="panel-heading">
                            <div class="panel-icon">
                                <FileText :size="19" />
                            </div>

                            <div>
                                <h2 class="panel-title">Project Information</h2>

                                <p class="panel-description">
                                    Basic details about your project.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                                <Text
                                    id="title"
                                    name="title"
                                    label="Project Title"
                                    placeholder="Enter project title..."
                                    v-model="form.title"
                                    hint="Title of the project"
                                    :error="form.errors.title"
                                    required
                                />

                                <Text
                                    id="slug"
                                    name="slug"
                                    label="Project Slug"
                                    placeholder="enter-project-slug"
                                    v-model="form.slug"
                                    hint="URL-friendly project identifier"
                                    :error="form.errors.slug"
                                    required
                                />
                            </div>

                            <TextArea
                                id="description"
                                name="description"
                                label="Description"
                                placeholder="Write a description of the project..."
                                :rows="3"
                                :maxlength="200"
                                v-model="form.description"
                                :error="form.errors.description"
                                hint="A short description of the project"
                                required
                            />

                            <TextArea
                                id="excerpt"
                                name="excerpt"
                                label="Excerpt"
                                placeholder="Write an excerpt of the project..."
                                :rows="3"
                                :maxlength="200"
                                v-model="form.excerpt"
                                :error="form.errors.excerpt"
                                hint="A brief summary displayed in your portfolio"
                                required
                            />
                        </div>
                    </section>

                    <section class="editor-panel">
                        <div class="panel-heading">
                            <div class="panel-icon">
                                <Star :size="19" />
                            </div>

                            <div>
                                <h2 class="panel-title">Features</h2>

                                <p class="panel-description">
                                    Highlight what makes your project special.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <Features v-model="form.features" />

                            <p
                                v-if="form.errors.features"
                                class="text-destructive text-sm"
                            >
                                {{ form.errors.features }}
                            </p>
                        </div>
                    </section>

                    <ProjectTag v-model="form.tags" :tags="props.tags" />

                    <section class="editor-panel">
                        <div class="panel-heading">
                            <div class="panel-icon">
                                <ImageIcon :size="19" />
                            </div>

                            <div>
                                <h2 class="panel-title">Project Screenshots</h2>

                                <p class="panel-description">
                                    Upload screenshots showcasing your project.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-4">
                            <div
                                class="flex items-center justify-between gap-3"
                            >
                                <p class="text-sm font-medium">
                                    Screenshot gallery
                                </p>

                                <span class="field-hint">
                                    {{ newScreenshots.length }} selected
                                </span>
                            </div>

                            <Image
                                title="Upload Project Screenshots"
                                v-model="newScreenshots"
                                :error="
                                    Object.entries(form.errors)
                                        .filter(([key]) =>
                                            /^screenshots\.\d+$/.test(key),
                                        )
                                        .map(([, message]) => message)
                                "
                            />
                        </div>
                    </section>
                </div>

                <aside class="min-w-0 space-y-6 lg:sticky lg:top-6">
                    <section class="editor-panel">
                        <div class="panel-heading">
                            <div class="panel-icon">
                                <ImageIcon :size="19" />
                            </div>

                            <div>
                                <h2 class="panel-title">Project Thumbnail</h2>

                                <p class="panel-description">
                                    Choose the main image for your project.
                                </p>
                            </div>
                        </div>

                        <ImageThumbnail
                            v-model="form.thumbnail_path"
                            :error="form.errors.thumbnail_path"
                        />
                    </section>

                    <section class="editor-panel">
                        <div class="panel-heading">
                            <div class="panel-icon">
                                <CalendarDays :size="19" />
                            </div>

                            <div>
                                <h2 class="panel-title">Project Settings</h2>

                                <p class="panel-description">
                                    Configure your project's visibility.
                                </p>
                            </div>
                        </div>

                        <div class="space-y-5">
                            <div
                                class="flex items-center justify-between gap-3"
                            >
                                <div>
                                    <p class="text-sm font-semibold">
                                        Publish Project
                                    </p>

                                    <p class="field-hint">
                                        Make this project visible to visitors.
                                    </p>
                                </div>

                                <label
                                    class="publish-toggle cursor-pointer"
                                    :class="{
                                        'is-published': form.is_published,
                                    }"
                                >
                                    <Switch
                                        id="is-published"
                                        name="is_published"
                                        v-model="form.is_published"
                                        :error="form.errors.is_published"
                                    />

                                    <span
                                        class="publish-toggle-knob"
                                        :class="{
                                            'is-published': form.is_published,
                                        }"
                                    />
                                </label>
                            </div>
                        </div>
                    </section>

                    <section class="editor-panel">
                        <div class="panel-heading">
                            <div class="panel-icon">
                                <Eye :size="19" />
                            </div>

                            <div>
                                <h2 class="panel-title">Quick Preview</h2>

                                <p class="panel-description">
                                    Preview your project before creating it.
                                </p>
                            </div>
                        </div>

                        <div class="quick-preview">
                            <img
                                v-if="thumbnailPreview"
                                :src="thumbnailPreview"
                                :alt="`${form.title || 'Project'} preview`"
                                class="border-border aspect-video w-full rounded-md border object-cover"
                            />

                            <div
                                v-else
                                class="border-border bg-muted flex aspect-video items-center justify-center rounded-md border border-dashed"
                            >
                                <ImageIcon
                                    :size="30"
                                    class="text-muted-foreground"
                                />
                            </div>

                            <h3 class="font-heading text-primary mt-4 text-lg">
                                {{ form.title || 'Your Project Title' }}
                            </h3>

                            <div class="mt-3 flex flex-wrap gap-2">
                                <span
                                    v-for="tag in previewTags"
                                    :key="tag.id"
                                    class="tag-chip"
                                >
                                    {{ tag.name }}
                                </span>
                            </div>

                            <p
                                class="text-muted-foreground mt-3 text-xs leading-6"
                            >
                                {{
                                    form.excerpt ||
                                    'Your project excerpt will appear here.'
                                }}
                            </p>

                            <div
                                class="border-border mt-4 border-t border-dashed pt-3"
                            >
                                <span
                                    class="inline-flex items-center gap-2 text-xs font-semibold"
                                    :class="
                                        form.is_published
                                            ? 'text-secondary'
                                            : 'text-muted-foreground'
                                    "
                                >
                                    <span
                                        class="size-2 rounded-full"
                                        :class="
                                            form.is_published
                                                ? 'bg-secondary'
                                                : 'bg-pencil'
                                        "
                                    />

                                    {{
                                        form.is_published
                                            ? 'Ready to publish'
                                            : 'Saved as draft'
                                    }}
                                </span>
                            </div>
                        </div>
                    </section>
                </aside>
            </div>

            <footer class="editor-footer">
                <p class="text-muted-foreground text-xs leading-5">
                    Review your project details before creating it.
                </p>

                <div class="flex flex-wrap gap-3">
                    <Link :href="auth.project.index()" class="editor-button">
                        Cancel
                    </Link>

                    <button
                        type="submit"
                        class="editor-button editor-button-primary"
                        :disabled="form.processing"
                    >
                        <Check v-if="!form.processing" :size="16" />

                        {{ form.processing ? 'Creating...' : 'Create Project' }}
                    </button>
                </div>
            </footer>
        </form>
    </div>
</template>
