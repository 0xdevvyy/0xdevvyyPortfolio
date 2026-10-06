<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { Eye, Pencil, Plus, Trash2 } from '@lucide/vue';

interface Tag {
    id: number;
    name: string;
}

interface Project {
    id: number;
    title: string;
    slug: string;
    thumbnailPath: string;
    excerpt: string;
    tags: Tag[];
    isPublished: boolean;
    publishedAt: string | null;
}

defineProps<{
    projects: Project[];
}>();
</script>

<template>
    <section
        class="relative isolate min-h-screen overflow-hidden px-5 py-8 sm:px-10 lg:px-16 lg:py-12"
    >
        <div class="relative mx-auto max-w-7xl">
            <header
                class="mb-12 flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between"
            >
                <div>
                    <div class="mb-2 flex items-center gap-3">
                        <span class="bg-gold h-0.5 w-8 rotate-[-3deg]"></span>

                        <span
                            class="text-sage font-mono text-xs tracking-[0.2em] uppercase"
                        >
                            Manage
                        </span>
                    </div>

                    <h1
                        class="font-display text-ink text-5xl leading-none sm:text-6xl lg:text-7xl"
                    >
                        my projects
                    </h1>

                    <p
                        class="font-hand text-ink/70 mt-4 max-w-xl text-lg leading-relaxed sm:text-xl"
                    >
                        The things I've built, worked on, and decided to keep
                        around.
                    </p>
                </div>

                <Link
                    href="/projects/create"
                    class="bg-ink text-paper inline-flex w-fit items-center gap-2 rounded-lg px-5 py-3 font-mono text-sm transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[4px_4px_0_var(--gold)]"
                >
                    <Plus :size="17" />
                    New Project
                </Link>
            </header>

            <div class="mb-7 flex items-center gap-3">
                <span class="font-display text-ink text-3xl">
                    {{ projects.length }}
                </span>

                <span
                    class="text-ink/50 font-mono text-xs tracking-[0.18em] uppercase"
                >
                    total projects
                </span>
            </div>

            <div v-if="projects.length" class="space-y-5">
                <article
                    v-for="(project, index) in projects"
                    :key="project.id"
                    class="group border-ink/15 bg-paper-light relative overflow-hidden rounded-xl border-2 p-5 transition-all duration-200 hover:-translate-y-1 hover:shadow-[5px_5px_0_var(--ink)] sm:p-6"
                >
                    <div
                        class="grid gap-6 lg:grid-cols-[90px_1fr_auto] lg:items-center"
                    >
                        <div>
                            <div
                                class="border-ink/10 bg-paper-dark aspect-square overflow-hidden rounded-lg border"
                            >
                                <img
                                    v-if="project.thumbnailPath"
                                    :src="project.thumbnailPath"
                                    :alt="`${project.title} thumbnail`"
                                    class="h-full w-full object-cover transition-transform duration-300 group-hover:scale-105"
                                />

                                <div
                                    v-else
                                    class="flex h-full w-full items-center justify-center"
                                >
                                    <span
                                        class="font-display text-ink/30 text-3xl"
                                    >
                                        {{ project.title.charAt(0) }}
                                    </span>
                                </div>
                                <pre>{{ project.thumbnailPath }}</pre>
                            </div>
                        </div>

                        <div class="min-w-0">
                            <div class="mb-2 flex flex-wrap items-center gap-3">
                                <span
                                    class="font-mono text-[10px] tracking-[0.18em] uppercase"
                                    :class="
                                        project.isPublished
                                            ? 'text-sage'
                                            : 'text-ink/40'
                                    "
                                >
                                    <span
                                        class="mr-1.5 inline-block size-1.5 rounded-full align-middle"
                                        :class="
                                            project.isPublished
                                                ? 'bg-sage'
                                                : 'bg-ink/30'
                                        "
                                    ></span>

                                    {{
                                        project.isPublished
                                            ? 'Published'
                                            : 'Draft'
                                    }}
                                </span>

                                <span class="text-ink/30 font-mono text-[10px]">
                                    #{{ String(index + 1).padStart(2, '0') }}
                                </span>

                                <span
                                    v-if="project.publishedAt"
                                    class="text-ink/35 font-mono text-[10px]"
                                >
                                    {{ project.publishedAt }}
                                </span>
                            </div>

                            <h2
                                class="font-heading text-ink text-2xl leading-tight sm:text-3xl"
                            >
                                {{ project.title }}
                            </h2>

                            <p
                                class="text-ink/55 mt-2 line-clamp-2 max-w-2xl font-mono text-xs leading-5 sm:text-sm"
                            >
                                {{ project.excerpt }}
                            </p>

                            <div
                                v-if="project.tags.length"
                                class="mt-4 flex flex-wrap gap-2"
                            >
                                <span
                                    v-for="tag in project.tags"
                                    :key="tag.id"
                                    class="bg-sage/5 border-sage/20 text-sage rounded-full border px-2.5 py-1 font-mono text-[9px]"
                                >
                                    #{{ tag.name }}
                                </span>
                            </div>
                        </div>

                        <div
                            class="border-border flex items-center gap-2 border-t pt-5 lg:border-0 lg:pt-0"
                        >
                            <Link
                                :href="`/projects/${project.slug}`"
                                class="border-ink/15 text-ink/60 hover:border-ink hover:text-ink flex size-10 items-center justify-center rounded-full border transition"
                                title="View project"
                            >
                                <Eye :size="17" />
                            </Link>

                            <Link
                                :href="`/projects/${project.id}/edit`"
                                class="border-ink/15 text-ink/60 hover:bg-primary hover:text-muted flex size-10 items-center justify-center rounded-full border transition"
                                title="Edit project"
                            >
                                <Pencil :size="16" />
                            </Link>

                            <button
                                type="button"
                                class="border-red/20 text-red/60 hover:bg-red hover:text-paper flex size-10 cursor-pointer items-center justify-center rounded-full border transition"
                                title="Delete project"
                            >
                                <Trash2 :size="16" />
                            </button>
                        </div>
                    </div>
                </article>
            </div>

            <div
                v-else
                class="border-ink/25 bg-paper-light/50 rounded-xl border-2 border-dashed px-6 py-20 text-center"
            >
                <div
                    class="border-ink/20 bg-paper-dark mx-auto flex size-16 items-center justify-center rounded-xl border"
                >
                    <span class="font-display text-ink/30 text-3xl"> + </span>
                </div>

                <p class="font-hand text-ink/70 mt-5 text-3xl">
                    No projects yet.
                </p>

                <p class="text-ink/45 mx-auto mt-2 max-w-md font-mono text-sm">
                    Nothing has been added to the collection. Time to build
                    something.
                </p>

                <Link
                    href="/projects/create"
                    class="text-ink decoration-gold mt-6 inline-flex items-center gap-2 font-mono text-sm underline decoration-2 underline-offset-4"
                >
                    <Plus :size="16" />
                    Post your first project
                </Link>
            </div>
        </div>
    </section>
</template>
