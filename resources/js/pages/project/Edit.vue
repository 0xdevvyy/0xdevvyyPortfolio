<script setup lang="ts">
import { computed, ref } from 'vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import {
    ArrowLeft,
    Check,
    ChevronDown,
    Eye,
    ImagePlus,
    Plus,
    Save,
    X,
} from '@lucide/vue';
import GhostButton from '@/components/ui/button/GhostButton.vue';
import PrimaryButton from '@/components/ui/button/PrimaryButton.vue';
import ScreenshotInput from '@/components/ui/input/Screenshot.vue';
import SlugInput from '@/components/ui/input/Slug.vue';
import TextInput from '@/components/ui/input/Text.vue';
import TextareaInput from '@/components/ui/input/TextArea.vue';
import Line from '@/components/ui/svg/Line.vue';
import auth from '@/routes/auth';

interface Tag {
    id: number;
    name: string;
}

interface Screenshot {
    id: number;
    screenshotPath: string;
}

interface Project {
    id: number;
    title: string;
    slug: string;
    description: string;
    excerpt: string | null;
    features: string[];
    isPublished: boolean;
    screenshots: Screenshot[];
    tags: Tag[];
}

interface Props {
    project: Project;
    tags: Tag[];
}

const props = defineProps<Props>();

const form = useForm({
    title: props.project.title,
    slug: props.project.slug,
    excerpt: props.project.excerpt ?? '',
    description: props.project.description,
    features: [...props.project.features],
    isPublished: props.project.isPublished,
    tags: props.project.tags.map((tag) => tag.id),
    screenshots: [] as File[],
    deletedScreenshots: [] as number[],
});

const newFeature = ref('');

const availableTags = computed(() =>
    props.tags.filter((tag) => !form.tags.includes(tag.id)),
);

const selectedTags = computed(() =>
    form.tags
        .map((id) => props.tags.find((tag) => tag.id === id))
        .filter((tag): tag is Tag => Boolean(tag)),
);

const remainingScreenshots = computed(() =>
    props.project.screenshots.filter(
        (screenshot) => !form.deletedScreenshots.includes(screenshot.id),
    ),
);

const totalScreenshots = computed(
    () => remainingScreenshots.value.length + form.screenshots.length,
);

const addFeature = () => {
    const feature = newFeature.value.trim();

    if (!feature) {
        return;
    }

    form.features.push(feature);
    newFeature.value = '';
};

const removeFeature = (index: number) => {
    form.features.splice(index, 1);
};

const toggleTag = (id: number) => {
    if (form.tags.includes(id)) {
        form.tags = form.tags.filter((tagId) => tagId !== id);
        return;
    }

    form.tags.push(id);
};

const submit = () => {
    form.put(auth.project.update.url(props.project.slug), {
        preserveScroll: true,
        forceFormData: true,
    });
};
</script>

<template>
    <Head :title="`Edit ${project.title}`" />

    <div class="text-ink min-h-screen px-6 py-10 md:px-10 lg:px-14">
        <div class="mx-auto max-w-7xl">
            <div class="mb-10">
                <Link
                    :href="auth.project.index()"
                    class="text-ink-soft hover:text-ink mb-8 inline-flex items-center gap-2 font-mono text-sm transition hover:-translate-x-1"
                >
                    <ArrowLeft :size="17" />
                    Back to projects
                </Link>

                <div
                    class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between"
                >
                    <div>
                        <div class="relative inline-block">
                            <h1
                                class="font-heading text-5xl font-bold tracking-tight md:text-6xl"
                            >
                                Edit Project
                            </h1>

                            <Line class="absolute -bottom-4 left-0 w-full" />
                        </div>

                        <p
                            class="font-body text-ink-soft mt-7 max-w-xl text-sm leading-6"
                        >
                            Fix the details, polish the presentation, and keep
                            your project looking sharp.
                        </p>
                    </div>

                    <div class="flex items-center gap-3">
                        <PrimaryButton
                            type="button"
                            :disabled="form.processing"
                            @click="submit"
                        >
                            <Save :size="17" />
                            {{ form.processing ? 'Saving...' : 'Save Changes' }}
                        </PrimaryButton>
                    </div>
                </div>
            </div>

            <div class="grid gap-10 lg:grid-cols-[1fr_330px]">
                <main class="space-y-10">
                    <section
                        class="border-border border-y-2 border-dashed py-8"
                    >
                        <div class="mb-7 flex items-center gap-4">
                            <span class="font-body text-sage text-sm font-bold">
                                01
                            </span>

                            <h2
                                class="font-heading text-ink text-3xl font-bold"
                            >
                                Project details
                            </h2>
                        </div>

                        <div class="space-y-7">
                            <TextInput
                                id="title"
                                v-model="form.title"
                                label="Project title"
                                placeholder="My awesome project"
                                :error="form.errors.title"
                            />

                            <SlugInput
                                id="slug"
                                v-model="form.slug"
                                :error="form.errors.slug"
                            />

                            <TextareaInput
                                id="excerpt"
                                v-model="form.excerpt"
                                label="Short description"
                                placeholder="A short description of this project..."
                                :rows="3"
                                resize="none"
                                :error="form.errors.excerpt"
                            />

                            <TextareaInput
                                id="description"
                                v-model="form.description"
                                label="Full description"
                                placeholder="Tell the story behind this project..."
                                :rows="9"
                                resize="y"
                                :error="form.errors.description"
                            />
                        </div>
                    </section>

                    <section
                        class="border-border border-y-2 border-dashed py-8"
                    >
                        <div class="mb-7 flex items-center gap-4">
                            <span class="font-body text-sage text-sm font-bold">
                                02
                            </span>

                            <h2
                                class="font-heading text-ink text-3xl font-bold"
                            >
                                Features
                            </h2>
                        </div>

                        <div class="space-y-3">
                            <div
                                v-for="(feature, index) in form.features"
                                :key="index"
                                class="group border-border flex items-center gap-3 border-b py-3"
                            >
                                <Check :size="18" class="text-sage shrink-0" />

                                <input
                                    v-model="form.features[index]"
                                    type="text"
                                    class="font-body text-ink min-w-0 flex-1 bg-transparent text-sm outline-none"
                                />

                                <button
                                    type="button"
                                    class="text-ink-soft/50 hover:text-red opacity-0 transition group-hover:opacity-100"
                                    @click="removeFeature(index)"
                                >
                                    <X :size="17" />
                                </button>
                            </div>

                            <div
                                class="border-border flex gap-3 border-b-2 py-3"
                            >
                                <Plus
                                    :size="18"
                                    class="text-sage mt-0.5 shrink-0"
                                />

                                <input
                                    v-model="newFeature"
                                    type="text"
                                    class="font-body text-ink placeholder:text-ink-soft/40 min-w-0 flex-1 bg-transparent text-sm outline-none"
                                    placeholder="Add another feature..."
                                    @keyup.enter="addFeature"
                                />

                                <button
                                    type="button"
                                    class="font-body text-sage hover:text-sage-dark cursor-pointer text-xs font-bold tracking-wider uppercase hover:underline"
                                    @click="addFeature"
                                >
                                    Add
                                </button>
                            </div>
                        </div>

                        <p
                            v-if="form.errors.features"
                            class="font-body text-red mt-3 text-xs"
                        >
                            {{ form.errors.features }}
                        </p>
                    </section>

                    <section
                        class="border-border border-y-2 border-dashed py-8"
                    >
                        <div
                            class="mb-7 flex items-center justify-between gap-4"
                        >
                            <div class="flex items-center gap-4">
                                <span
                                    class="font-body text-sage text-sm font-bold"
                                >
                                    03
                                </span>

                                <div>
                                    <h2
                                        class="font-heading text-ink text-3xl font-bold"
                                    >
                                        Screenshots
                                    </h2>

                                    <p
                                        class="font-body text-ink-soft mt-1 text-xs"
                                    >
                                        Add, remove, or preview your project
                                        screenshots.
                                    </p>
                                </div>
                            </div>

                            <span class="font-body text-ink-soft text-xs">
                                {{ totalScreenshots }}
                                {{
                                    totalScreenshots === 1 ? 'image' : 'images'
                                }}
                            </span>
                        </div>

                        <ScreenshotInput
                            v-model="form.screenshots"
                            v-model:deleted-screenshots="
                                form.deletedScreenshots
                            "
                            :screenshots="project.screenshots"
                            :project-title="form.title"
                            :error="form.errors.screenshots"
                        />

                        <p
                            v-if="form.errors.screenshots"
                            class="font-body text-red mt-3 text-xs"
                        >
                            {{ form.errors.screenshots }}
                        </p>
                    </section>

                    <section
                        class="border-border border-y-2 border-dashed py-8"
                    >
                        <div class="mb-7 flex items-center gap-4">
                            <span class="font-body text-sage text-sm font-bold">
                                04
                            </span>

                            <h2
                                class="font-heading text-ink text-3xl font-bold"
                            >
                                Tags
                            </h2>
                        </div>

                        <div
                            v-if="selectedTags.length"
                            class="flex flex-wrap gap-3"
                        >
                            <button
                                v-for="tag in selectedTags"
                                :key="tag.id"
                                type="button"
                                class="group border-ink bg-paper-dark font-body text-ink hover:border-sage flex items-center gap-2 border-2 px-4 py-2 text-xs font-bold transition hover:-translate-y-0.5"
                                @click="toggleTag(tag.id)"
                            >
                                #{{ tag.name }}

                                <X
                                    :size="13"
                                    class="text-ink-soft group-hover:text-red transition"
                                />
                            </button>
                        </div>

                        <div
                            v-else
                            class="border-border font-body text-ink-soft border border-dashed p-5 text-xs"
                        >
                            No tags selected.
                        </div>

                        <div v-if="availableTags.length" class="mt-5">
                            <p
                                class="font-body text-ink-soft mb-3 text-[10px] font-bold tracking-widest uppercase"
                            >
                                Available tags
                            </p>

                            <div class="flex flex-wrap gap-2">
                                <button
                                    v-for="tag in availableTags"
                                    :key="tag.id"
                                    type="button"
                                    class="border-border font-body text-ink-soft hover:border-sage hover:text-sage border border-dashed px-3 py-2 text-xs transition"
                                    @click="toggleTag(tag.id)"
                                >
                                    + #{{ tag.name }}
                                </button>
                            </div>
                        </div>

                        <p
                            v-if="form.errors.tags"
                            class="font-body text-red mt-3 text-xs"
                        >
                            {{ form.errors.tags }}
                        </p>
                    </section>
                </main>

                <aside class="space-y-7 lg:sticky lg:top-8 lg:self-start">
                    <div
                        class="border-border bg-paper-light rotate-[1deg] border-2 p-6 shadow-[5px_6px_0_color-mix(in_oklab,var(--ink)_12%,transparent)]"
                    >
                        <div class="mb-5 flex items-center justify-between">
                            <span
                                class="font-body text-ink text-xs font-bold tracking-widest uppercase"
                            >
                                Project status
                            </span>

                            <span
                                class="size-3 rounded-full"
                                :class="
                                    form.isPublished ? 'bg-sage' : 'bg-gold'
                                "
                            />
                        </div>

                        <button
                            type="button"
                            class="border-border bg-paper-dark hover:border-sage flex w-full cursor-pointer items-center justify-between border-2 px-4 py-3 text-left transition"
                            @click="form.isPublished = !form.isPublished"
                        >
                            <div>
                                <p
                                    class="font-heading text-ink text-lg font-bold"
                                >
                                    {{
                                        form.isPublished ? 'Published' : 'Draft'
                                    }}
                                </p>

                                <p
                                    class="font-body text-ink-soft mt-1 text-[11px]"
                                >
                                    {{
                                        form.isPublished
                                            ? 'Visible on your portfolio'
                                            : 'Only visible to you'
                                    }}
                                </p>
                            </div>

                            <ChevronDown :size="17" class="text-ink-soft" />
                        </button>
                    </div>

                    <div class="border-border bg-paper-dark border-2 p-6">
                        <p
                            class="font-body text-ink mb-5 text-xs font-bold tracking-widest uppercase"
                        >
                            Project summary
                        </p>

                        <div
                            class="border-border bg-paper-light overflow-hidden border-2"
                        >
                            <div
                                v-if="remainingScreenshots.length"
                                class="aspect-video overflow-hidden"
                            >
                                <img
                                    :src="
                                        remainingScreenshots[0].screenshotPath
                                    "
                                    :alt="`${form.title} screenshot`"
                                    class="h-full w-full object-cover"
                                />
                            </div>

                            <div
                                v-else
                                class="border-border flex aspect-video items-center justify-center border-b-2"
                            >
                                <div class="text-center">
                                    <ImagePlus
                                        :size="26"
                                        class="text-sage mx-auto mb-2"
                                    />

                                    <p class="font-body text-ink-soft text-xs">
                                        No screenshot yet
                                    </p>
                                </div>
                            </div>

                            <div class="p-5">
                                <p
                                    class="font-heading text-ink text-xl leading-tight font-bold"
                                >
                                    {{ form.title || 'Untitled project' }}
                                </p>

                                <p
                                    class="font-body text-ink-soft mt-2 line-clamp-3 text-xs leading-5"
                                    :class="
                                        !form.excerpt.trim()
                                            ? 'text-ink-soft/50 italic'
                                            : ''
                                    "
                                >
                                    {{
                                        form.excerpt ||
                                        'Your project summary will appear here.'
                                    }}
                                </p>

                                <div
                                    v-if="selectedTags.length"
                                    class="mt-4 flex flex-wrap gap-2"
                                >
                                    <span
                                        v-for="tag in selectedTags"
                                        :key="tag.id"
                                        class="border-border bg-paper-dark font-body text-sage border px-2 py-1 text-[10px]"
                                    >
                                        #{{ tag.name }}
                                    </span>
                                </div>

                                <div
                                    class="border-border mt-5 flex items-center justify-between border-t pt-4"
                                >
                                    <span
                                        class="font-body text-ink-soft text-[10px] tracking-widest uppercase"
                                    >
                                        {{ form.features.length }}
                                        {{
                                            form.features.length === 1
                                                ? 'feature'
                                                : 'features'
                                        }}
                                    </span>

                                    <span
                                        class="font-body text-ink-soft text-[10px] tracking-widest uppercase"
                                    >
                                        {{ totalScreenshots }}
                                        {{
                                            totalScreenshots === 1
                                                ? 'image'
                                                : 'images'
                                        }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</template>
