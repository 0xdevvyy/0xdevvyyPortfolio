<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowUpRight, BookOpen, FolderKanban } from '@lucide/vue';

import HeadingRays from '@/components/ui/svg/HeadingRays.vue';
import Highlight from '@/components/ui/svg/Highlight.vue';

defineProps<{
    projectsCount: number;
    blogsCount: number;
}>();
</script>

<template>
    <section class="overflow-hidden px-6 py-12 sm:px-10 lg:px-8 lg:py-5">
        <div class="mx-auto max-w-7xl">
            <!-- Heading -->
            <div class="mb-12">
                <p class="font-hand text-2xl">welcome back,</p>

                <div class="relative inline-block">
                    <HeadingRays side="left" />

                    <h1
                        class="font-display text-5xl leading-none sm:text-6xl lg:text-7xl"
                    >
                        Dashboard
                    </h1>

                    <HeadingRays side="right" />
                </div>

                <p
                    class="font-hand text-muted-foreground mt-4 max-w-2xl text-xl leading-relaxed sm:text-2xl"
                >
                    A little overview of the things I've been
                    <span class="relative inline-block">
                        <Highlight />

                        <span class="relative z-10"> building </span>
                    </span>
                    and writing about.
                </p>
            </div>

            <!-- Statistics -->
            <div class="grid gap-6 md:grid-cols-2">
                <!-- Projects -->
                <Link
                    href="/projects"
                    class="group border-border bg-card hover-bounce relative overflow-hidden rounded-2xl border-2 p-7 transition-all duration-200"
                >
                    <div
                        class="font-hand text-gold absolute top-6 right-7 rotate-[-5deg] text-lg"
                    >
                        things I made
                    </div>

                    <div
                        class="border-border bg-muted mb-10 flex size-16 items-center justify-center rounded-xl border"
                    >
                        <FolderKanban
                            class="text-primary size-7"
                            stroke-width="1.8"
                        />
                    </div>

                    <p
                        class="text-muted-foreground font-mono text-xs tracking-[0.2em] uppercase"
                    >
                        Projects
                    </p>

                    <div class="mt-2 flex items-end justify-between">
                        <span
                            class="font-display text-primary text-7xl leading-none"
                        >
                            {{ projectsCount }}
                        </span>

                        <span
                            class="border-border mb-1 flex size-10 items-center justify-center rounded-full border transition-transform duration-200 group-hover:rotate-45"
                        >
                            <ArrowUpRight class="size-5" />
                        </span>
                    </div>

                    <div class="border-border mt-8 border-t pt-4">
                        <span class="text-muted-foreground font-mono text-xs">
                            View all projects
                        </span>
                    </div>
                </Link>

                <!-- Blogs -->
                <Link
                    href="/blogs"
                    class="group border-border bg-card hover-bounce relative overflow-hidden rounded-2xl border-2 p-7 transition-all duration-200"
                >
                    <div
                        class="font-hand text-secondary absolute top-6 right-7 rotate-[4deg] text-lg"
                    >
                        thoughts & ideas
                    </div>

                    <div
                        class="border-secondary/30 bg-secondary/10 mb-10 flex size-16 items-center justify-center rounded-xl border"
                    >
                        <BookOpen
                            class="text-secondary size-7"
                            stroke-width="1.8"
                        />
                    </div>

                    <p
                        class="text-muted-foreground font-mono text-xs tracking-[0.2em] uppercase"
                    >
                        Blogs
                    </p>

                    <div class="mt-2 flex items-end justify-between">
                        <span
                            class="font-display text-primary text-7xl leading-none"
                        >
                            {{ blogsCount }}
                        </span>

                        <span
                            class="border-border text-secondary mb-1 flex size-10 items-center justify-center rounded-full border transition-transform duration-200 group-hover:rotate-45"
                        >
                            <ArrowUpRight class="size-5" />
                        </span>
                    </div>

                    <div class="border-border mt-8 border-t pt-4">
                        <span class="text-muted-foreground font-mono text-xs">
                            View all blog posts
                        </span>
                    </div>
                </Link>
            </div>
        </div>
    </section>
</template>
