<script setup lang="ts">
import Features from '@/components/ui/input/Features.vue';
import Text from '@/components/ui/input/Text.vue';
import TextArea from '@/components/ui/input/TextArea.vue';
import auth from '@/routes/auth';
import { Form, Head, Link, useForm } from '@inertiajs/vue3';
import {
    ArrowLeft,
    CalendarDays,
    Check,
    Eye,
    FileText,
    Image as ImageIcon,
    Save,
    Star,
    Tag as TagIcon,
    Upload,
    X,
} from '@lucide/vue';

interface Screenshot {
    id: number;
    screenshotPath: string;
}

interface Tag {
    id: number;
    name: string;
}

interface Project {
    id: number;
    title: string;
    slug: string;
    excerpt: string;
    description: string;
    thumbnailPath: string | null;
    features: string[];
    isPublished: boolean;
    publishedAt: string | null;
    screenshots: Screenshot[];
    tags: Tag[];
    projectUrl?: string | null;
}

const props = defineProps<{
    project: Project;
    tags: Tag[];
}>();

const form = useForm({
    title: props.project.title,
    slug: props.project.slug,
    description: props.project.description,
    excerpt: props.project.excerpt,
    features: [...props.project.features],
    tags: props.project.tags.map((tag) => tag.id),
    thumbnail_path: null as File | null,
    screenshots: [] as File[],
    is_published: props.project.isPublished,
    published_at: props.project.publishedAt?.slice(0, 10) ?? '',
});

function submit() {
    form.put(auth.project.update(props.project.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head :title="`Edit ${project.title}`" />
    
    <div
        class="project-editor-page mx-auto w-full max-w-7xl space-y-8 px-4 py-8 sm:px-6 lg:px-8"
    >
        <div class="space-y-8">
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
                        <h1
                            class="font-display text-primary text-3xl sm:text-4xl"
                        >
                            Edit Project
                        </h1>

                        <p class="text-muted-foreground mt-2 text-sm leading-6">
                            Update your project details, features, screenshots
                            and tags.
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
                                    <h2 class="panel-title">
                                        Project Information
                                    </h2>

                                    <p class="panel-description">
                                        Basic details about your project.
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-5">
                                <div
                                    class="grid grid-cols-1 gap-5 sm:grid-cols-2"
                                >
                                    <Text
                                        id="title"
                                        name="title"
                                        label="Project Title"
                                        placeholder="Enter project title..."
                                        v-model="form.title"
                                        hint="Title of the project"
                                        :error="form.errors.title"
                                    />

                                    <Text
                                        id="slug"
                                        name="slug"
                                        label="Project slug"
                                        placeholder="Enter project slug..."
                                        v-model="form.slug"
                                        hint="Slug of the project"
                                        :error="form.errors.slug"
                                    />
                                </div>

                                <TextArea
                                    id="description"
                                    name="description"
                                    label="description"
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
                                    placeholder="Write a exerpt of the project..."
                                    :rows="3"
                                    :maxlength="200"
                                    v-model="form.excerpt"
                                    :error="form.errors.excerpt"
                                    hint="The excerpt of the project"
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
                                        Highlight what makes your project
                                        special.
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-3">
                                <Features v-model="form.features" />
                            </div>
                        </section>

                        <!-- A placeholder or now  -->
                        <section class="editor-panel">
                            <div class="panel-heading">
                                <div class="panel-icon">
                                    <TagIcon :size="19" />
                                </div>

                                <div>
                                    <h2 class="panel-title">Project Tags</h2>

                                    <p class="panel-description">
                                        Select the technologies and topics used
                                        in your project.
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div
                                    class="flex items-center justify-between gap-3"
                                >
                                    <p class="text-sm font-medium">
                                        Available tags
                                    </p>

                                    <span class="field-hint">
                                        {{ project.tags.length }} selected
                                    </span>
                                </div>

                                <div class="flex flex-wrap gap-2">
                                    <span
                                        v-for="tag in tags"
                                        :key="tag.id"
                                        class="tag-choice"
                                        :class="{
                                            'tag-choice-selected':
                                                project.tags.some(
                                                    (selectedTag) =>
                                                        selectedTag.id ===
                                                        tag.id,
                                                ),
                                        }"
                                    >
                                        {{ tag.name }}

                                        <Check
                                            v-if="
                                                project.tags.some(
                                                    (selectedTag) =>
                                                        selectedTag.id ===
                                                        tag.id,
                                                )
                                            "
                                            :size="14"
                                        />
                                    </span>
                                </div>

                                <div class="tag-preview">
                                    <span
                                        class="text-muted-foreground text-xs font-semibold"
                                    >
                                        SELECTED
                                    </span>

                                    <div
                                        v-if="project.tags.length"
                                        class="flex flex-wrap gap-2"
                                    >
                                        <span
                                            v-for="tag in project.tags"
                                            :key="tag.id"
                                            class="tag-chip"
                                        >
                                            {{ tag.name }}
                                        </span>
                                    </div>

                                    <p
                                        v-else
                                        class="text-muted-foreground text-sm"
                                    >
                                        No tags selected.
                                    </p>
                                </div>
                            </div>
                        </section>

                        <!-- this screenshot will also be a placeholder for now -->
                        <section class="editor-panel">
                            <div class="panel-heading">
                                <div class="panel-icon">
                                    <ImageIcon :size="19" />
                                </div>

                                <div>
                                    <h2 class="panel-title">
                                        Project Screenshots
                                    </h2>

                                    <p class="panel-description">
                                        Manage the screenshots included in your
                                        project.
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
                                        {{ project.screenshots.length }} images
                                    </span>
                                </div>

                                <div
                                    v-if="project.screenshots.length"
                                    class="grid grid-cols-2 gap-3 sm:grid-cols-3"
                                >
                                    <div
                                        v-for="screenshot in project.screenshots"
                                        :key="screenshot.id"
                                        class="screenshot-item"
                                    >
                                        <img
                                            :src="
                                                screenshot.screenshotPath.startsWith(
                                                    '/',
                                                ) ||
                                                screenshot.screenshotPath.startsWith(
                                                    'http',
                                                )
                                                    ? screenshot.screenshotPath
                                                    : `/storage/${screenshot.screenshotPath}`
                                            "
                                            :alt="`Project screenshot ${screenshot.id}`"
                                            class="screenshot-image"
                                        />

                                        <span class="screenshot-caption">
                                            Existing image
                                        </span>
                                    </div>
                                </div>

                                <div v-else class="empty-note">
                                    No screenshots added yet. Add screenshots to
                                    showcase your project.
                                </div>

                                <div class="upload-zone">
                                    <Upload :size="25" />

                                    <span class="font-semibold">
                                        Add project screenshots
                                    </span>

                                    <span class="text-muted-foreground text-xs">
                                        PNG, JPG or WEBP
                                    </span>
                                </div>
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
                                    <h2 class="panel-title">
                                        Project Thumbnail
                                    </h2>

                                    <p class="panel-description">
                                        The main image for your project.
                                    </p>
                                </div>
                            </div>

                            <div class="space-y-4">
                                <div
                                    v-if="project.thumbnailPath"
                                    class="thumbnail-preview"
                                >
                                    <img
                                        :src="
                                            project.thumbnailPath.startsWith(
                                                '/',
                                            ) ||
                                            project.thumbnailPath.startsWith(
                                                'http',
                                            )
                                                ? project.thumbnailPath
                                                : `/storage/${project.thumbnailPath}`
                                        "
                                        :alt="`${project.title} thumbnail`"
                                        class="aspect-video w-full rounded-lg object-cover"
                                    />

                                    <div class="thumbnail-change">
                                        <Upload :size="15" />
                                        Change Image
                                    </div>
                                </div>

                                <div v-else class="upload-zone min-h-44">
                                    <ImageIcon :size="30" />

                                    <span class="font-semibold">
                                        Upload thumbnail
                                    </span>

                                    <span class="text-muted-foreground text-xs">
                                        Click to choose an image
                                    </span>
                                </div>
                            </div>
                        </section>

                        <section class="editor-panel">
                            <div class="panel-heading">
                                <div class="panel-icon">
                                    <CalendarDays :size="19" />
                                </div>

                                <div>
                                    <h2 class="panel-title">
                                        Project Settings
                                    </h2>

                                    <p class="panel-description">
                                        Manage publishing details.
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
                                            Make this project visible to
                                            visitors.
                                        </p>
                                    </div>

                                    <span
                                        class="publish-toggle"
                                        :class="{
                                            'is-published': project.isPublished,
                                        }"
                                    >
                                        <span
                                            class="publish-toggle-knob"
                                            :class="{
                                                'is-published':
                                                    project.isPublished,
                                            }"
                                        />
                                    </span>
                                </div>

                                <div>
                                    <p class="form-label">Publication Date</p>

                                    <div class="input-wrapper">
                                        <CalendarDays
                                            :size="17"
                                            class="input-icon"
                                        />

                                        <div class="form-input">
                                            {{
                                                project.publishedAt?.slice(
                                                    0,
                                                    10,
                                                ) || 'Not set'
                                            }}
                                        </div>
                                    </div>
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
                                        A snapshot of your project.
                                    </p>
                                </div>
                            </div>

                            <div class="quick-preview">
                                <img
                                    v-if="project.thumbnailPath"
                                    :src="
                                        project.thumbnailPath.startsWith('/') ||
                                        project.thumbnailPath.startsWith('http')
                                            ? project.thumbnailPath
                                            : `/storage/${project.thumbnailPath}`
                                    "
                                    :alt="`${project.title} preview`"
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

                                <h3
                                    class="font-heading text-primary mt-4 text-lg"
                                >
                                    {{ project.title }}
                                </h3>

                                <div class="mt-3 flex flex-wrap gap-2">
                                    <span
                                        v-for="tag in project.tags"
                                        :key="tag.id"
                                        class="tag-chip"
                                    >
                                        {{ tag.name }}
                                    </span>
                                </div>

                                <p
                                    class="text-muted-foreground mt-3 text-xs leading-6"
                                >
                                    {{ project.excerpt }}
                                </p>

                                <div
                                    class="border-border mt-4 border-t border-dashed pt-3"
                                >
                                    <span
                                        class="inline-flex items-center gap-2 text-xs font-semibold"
                                        :class="
                                            project.isPublished
                                                ? 'text-secondary'
                                                : 'text-muted-foreground'
                                        "
                                    >
                                        <span
                                            class="size-2 rounded-full"
                                            :class="
                                                project.isPublished
                                                    ? 'bg-secondary'
                                                    : 'bg-pencil'
                                            "
                                        />

                                        {{
                                            project.isPublished
                                                ? 'Currently published'
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
                        Your project changes will be submitted when you save.
                    </p>

                    <div class="flex flex-wrap gap-3">
                        <button
                            type="submit"
                            class="editor-button editor-button-primary"
                            :disabled="form.processing"
                        >
                            <Check v-if="!form.processing" :size="16" />
                            {{ form.processing ? 'Saving...' : 'Save Changes' }}
                        </button>
                    </div>
                </footer>
            </form>
        </div>
    </div>
</template>
