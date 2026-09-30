<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowLeft, Check } from '@lucide/vue';

import ProjectScreenshots from '@/components/project/ProjectScreenshot.vue';
import { index } from '@/routes/project';

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
    thumbnailPath: string | null;
    excerpt: string | null;
    description: string;
    features: string[];
    tags: Tag[];
    screenshots: Screenshot[];
    liveUrl: string | null;
}

const { project } = defineProps<{
    project: Project;
}>();
</script>

<template>
    <section class="text-ink min-h-screen overflow-hidden">
        <div class="mx-auto max-w-6xl px-5 py-3 sm:px-10 lg:px-7">
            <!-- Back -->
            <div class="mb-5">
                <Link
                    :href="index().url"
                    class="font-body group text-ink/60 hover:text-ink inline-flex items-center gap-2 text-sm transition"
                >
                    <ArrowLeft
                        :size="16"
                        class="transition-transform duration-300 group-hover:-translate-x-1"
                    />

                    <span>Back to projects</span>
                </Link>
            </div>

            <!-- Hero -->
            <section class="relative">
                <div class="grid items-start gap-10 lg:grid-cols-[1fr_0.9fr]">
                    <!-- Project Information -->
                    <div class="relative">
                        <h1
                            class="font-display text-ink max-w-3xl -rotate-1 text-5xl leading-[0.95] sm:text-6xl lg:text-7xl"
                        >
                            {{ project.title }}
                        </h1>

                        <div class="mt-7 max-w-xl">
                            <p
                                v-if="project.excerpt"
                                class="font-hand text-ink/75 text-xl leading-relaxed sm:text-2xl"
                            >
                                {{ project.excerpt }}
                            </p>
                        </div>

                        <!-- Tags -->
                        <div
                            v-if="project.tags.length"
                            class="mt-8 flex flex-wrap gap-2"
                        >
                            <span
                                v-for="tag in project.tags"
                                :key="tag.id"
                                class="font-body border-ink/20 text-ink/65 rounded-full border px-3 py-1 text-[11px] tracking-wide uppercase"
                            >
                                {{ tag.name }}
                            </span>
                        </div>
                    </div>

                    <!-- Thumbnail -->
                    <div v-if="project.thumbnailPath" class="relative lg:pt-8">
                        <div
                            class="bg-paper-light rotate-[1.5deg] p-3 shadow-[5px_7px_0_rgba(23,59,92,0.08)] transition duration-500 hover:rotate-0 hover:shadow-[8px_11px_0_rgba(23,59,92,0.12)] sm:p-4"
                        >
                            <div class="bg-paper-dark overflow-hidden">
                                <img
                                    :src="project.thumbnailPath"
                                    :alt="project.title"
                                    class="block h-auto w-full"
                                />
                            </div>

                            <p class="font-hand text-ink/50 mt-3 px-1 text-sm">
                                the main view
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main Content -->

            <section class="mt-4 grid gap-14 lg:grid-cols-2 lg:gap-20">
                <!-- Left: About the Project -->
                <div>
                    <h2 class="font-heading text-ink text-3xl sm:text-4xl">
                        About the Project
                    </h2>

                    <div
                        class="font-body text-ink/70 mt-5 max-w-2xl text-sm leading-8 sm:text-base"
                    >
                        <p>
                            {{ project.description }}
                        </p>
                    </div>
                </div>

                <!-- Right: Features -->
                <div v-if="project.features.length">
                    <h2 class="font-heading text-ink text-3xl sm:text-4xl">
                        Features
                    </h2>

                    <ul class="mt-6 space-y-4">
                        <li
                            v-for="(feature, featureIndex) in project.features"
                            :key="featureIndex"
                            class="group flex items-start gap-4"
                        >
                            <span
                                class="bg-gold/50 mt-1 flex h-7 w-7 shrink-0 items-center justify-center rounded-full"
                            >
                                <Check :size="15" :stroke-width="2" />
                            </span>

                            <span
                                class="font-body text-ink/70 pt-1 text-sm leading-6"
                            >
                                {{ feature }}
                            </span>
                        </li>
                    </ul>
                </div>
            </section>

            <!-- Screenshots -->
            <section v-if="project.screenshots.length" class="relative mt-7">
                <!-- Header -->
                <div class="mb-5 flex items-end justify-between">
                    <div>
                        <h2
                            class="font-heading text-ink mt-3 text-4xl sm:text-5xl"
                        >
                            Screenshots
                        </h2>
                    </div>
                </div>

                <!-- Photo Book -->
                <div class="border-ink/10 relative border-y py-6 sm:py-8">
                    <!-- Bento Sheet -->
                    <div class="grid grid-cols-2 gap-3 sm:grid-cols-4 sm:gap-4">
                        <article
                            v-for="(
                                screenshot, screenshotIndex
                            ) in project.screenshots"
                            :key="screenshot.id"
                            class="group relative"
                            :class="[
                                screenshotIndex === 0
                                    ? 'col-span-2 row-span-2'
                                    : '',

                                screenshotIndex === 3 ? 'sm:col-span-2' : '',

                                screenshotIndex === 4 ? 'sm:col-span-2' : '',
                            ]"
                        >
                            <!-- Image -->
                            <div
                                class="bg-paper-light relative h-full p-1.5 transition-transform duration-500 sm:p-2"
                                :class="
                                    screenshotIndex % 3 === 0
                                        ? 'rotate-[-0.35deg] group-hover:rotate-0'
                                        : screenshotIndex % 3 === 1
                                          ? 'rotate-[0.25deg] group-hover:rotate-0'
                                          : 'rotate-[-0.15deg] group-hover:rotate-0'
                                "
                            >
                                <div
                                    class="bg-paper-dark relative h-full overflow-hidden"
                                >
                                    <ProjectScreenshots
                                        :screenshots="[screenshot]"
                                        :project-title="project.title"
                                    />

                                    <!-- Hover -->
                                    <div
                                        class="bg-paper-light/0 group-hover:bg-paper-light/10 pointer-events-none absolute inset-0 transition-all duration-500"
                                    ></div>

                                    <!-- Number -->
                                    <div
                                        class="bg-paper-light/90 absolute top-2 left-2 flex h-6 min-w-6 items-center justify-center px-1.5"
                                    >
                                        <span
                                            class="text-ink/55 font-mono text-[8px]"
                                        >
                                            {{
                                                String(
                                                    screenshotIndex + 1,
                                                ).padStart(2, '0')
                                            }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </article>
                    </div>
                </div>
            </section>
        </div>
    </section>
</template>
