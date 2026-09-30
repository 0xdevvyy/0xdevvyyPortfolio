<script setup lang="ts">
import { Coffee, Plane, Star } from '@lucide/vue';
import ProjectCard from '@/components/ui/card/ProjectCard.vue';
import Line from '@/components/ui/svg/Line.vue';

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
    thumbnailPath: string;
    excerpt: string;
    description: string;
    features: string[];
    tags: Tag[];
    screenshots: Screenshot[];
}

defineProps<{
    projects: Project[];
}>();
</script>

<template>
    <section
        class="relative isolate min-h-screen overflow-hidden px-5 py-8 sm:px-10 lg:px-16"
    >
        <!-- Plane doodle -->
        <div
            class="text-ink/80 pointer-events-none absolute top-16 right-[8%] hidden rotate-12 lg:block"
            aria-hidden="true"
        >
            <Plane :size="54" :stroke-width="1.4" />

            <svg
                class="mt-1 ml-[-55px]"
                width="105"
                height="55"
                viewBox="0 0 105 55"
                fill="none"
            >
                <path
                    d="M100 5 C75 45, 55 10, 42 32 S15 49 4 35"
                    stroke="currentColor"
                    stroke-width="1.7"
                    stroke-linecap="round"
                    stroke-dasharray="5 6"
                />
            </svg>
        </div>

        <!-- Good things doodle -->
        <div
            class="text-ink/80 pointer-events-none absolute top-[48%] left-[4%] hidden -rotate-6 xl:block"
            aria-hidden="true"
        >
            <p class="font-hand text-2xl leading-tight">
                Good<br />
                things<br />
                take time
            </p>

            <svg
                class="mt-2 ml-2"
                width="90"
                height="18"
                viewBox="0 0 90 18"
                fill="none"
            >
                <path
                    d="M2 13 Q40 -3 86 5"
                    stroke="var(--gold)"
                    stroke-width="3"
                    stroke-linecap="round"
                />
            </svg>

            <Star class="mt-3 ml-16" :size="22" :stroke-width="1.5" />
        </div>

        <!-- Coffee doodle -->
        <div
            class="text-ink/80 pointer-events-none absolute top-[60%] right-[5%] hidden rotate-6 xl:block"
            aria-hidden="true"
        >
            <Coffee :size="44" :stroke-width="1.5" />
        </div>

        <div class="relative mx-auto max-w-6xl">
            <!-- Header -->
            <header class="relative max-w-3xl">
                <div class="relative inline-block">
                    <h1
                        class="font-display text-ink mt-1 -rotate-1 text-6xl leading-[0.95] sm:text-7xl lg:text-8xl"
                    >
                        my projects
                    </h1>

                    <Line />
                </div>

                <p
                    class="font-hand text-ink/85 mt-5 max-w-xl text-lg leading-relaxed sm:text-xl"
                >
                    My projects throughout my journey, from learning the basics
                    to building scalable system for not it is just mostly basics stuff.
                </p>

                <p class="font-hand text-sage mt-3 text-base sm:text-lg">
                    Always learning new things, Always making myself better.
                </p>
            </header>

            <!-- Projects -->
            <div
                v-if="projects.length"
                class="mt-16 grid grid-cols-1 gap-x-10 gap-y-24 sm:grid-cols-2"
            >
                <ProjectCard
                    v-for="(project, index) in projects"
                    :key="project.id"
                    :project="project"
                    :index="index"
                />
            </div>

            <!-- Empty state -->
            <div
                v-else
                class="border-ink/30 bg-paper-light/60 mt-16 border-2 border-dashed px-6 py-14 text-center"
            >
                <p class="font-hand text-ink/70 text-2xl">
                    Nothing in this section just yet.
                </p>

                <p class="text-ink/50 mt-2 font-mono text-sm">
                    Check back when I've built something new!
                </p>
            </div>
        </div>
    </section>
</template>
