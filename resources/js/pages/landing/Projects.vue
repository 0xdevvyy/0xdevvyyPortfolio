<script setup lang="ts">
import { computed, ref } from 'vue';

import { Coffee, Plane, Star, TrendingUp } from '@lucide/vue';

import ProjectCard from '@/components/ui/card/ProjectCard.vue';
import Line from '@/components/ui/svg/Line.vue';

interface Project {
    id: number;
    title: string;
    year: string;
    description: string;
    technologies: string[];
    image: string;
    accent: string;
}
</script>

<template>
    <section
        class="projects-paper relative isolate overflow-hidden px-5 py-8 sm:px-10 lg:px-16"
    >
        <div
            class="pointer-events-none absolute top-16 right-[8%] hidden rotate-12 text-[#173B5C]/80 lg:block"
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

        <div
            class="pointer-events-none absolute top-[48%] left-[4%] hidden -rotate-6 text-[#173B5C]/80 xl:block"
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
                    stroke="#D8AE4F"
                    stroke-width="3"
                    stroke-linecap="round"
                />
            </svg>

            <Star class="mt-3 ml-16" :size="22" />
        </div>

        <div
            class="pointer-events-none absolute top-[60%] right-[5%] hidden rotate-6 text-[#173B5C]/80 xl:block"
            aria-hidden="true"
        >
            <Coffee :size="44" :stroke-width="1.5" />
        </div>

        <div class="relative mx-auto max-w-5xl">
            <header class="relative max-w-2xl">
                <div class="relative inline-block">
                    <h1
                        class="font-display mt-1 -rotate-1 text-6xl leading-[0.95] text-[#173B5C] sm:text-7xl lg:text-8xl"
                    >
                        my projects
                    </h1>

                    <Line />
                </div>

                <p
                    class="font-hand mt-5 max-w-xl text-lg leading-relaxed text-[#173B5C]/85 sm:text-xl"
                >
                    My projects throughout my Journey, Entry/Junior to ........
                </p>

                <p class="font-hand text-accent mt-3 text-base sm:text-lg">
                    Always learning new things,
                </p>
            </header>

            <div
                class="mt-16 grid grid-cols-1 gap-x-8 gap-y-20 sm:grid-cols-2 sm:gap-x-7 lg:gap-x-10"
            >
                <!-- <ProjectCard
                    v-for="(project, index) in filteredProjects"
                    :key="project.id"
                    :project="project"
                    :index="index"
                /> -->
            </div>

            <div
                class="font-hand mt-16 border-2 border-dashed border-[#173B5C]/30 px-6 py-12 text-center text-xl text-[#173B5C]/70"
            >
                <p class="mt-3">Nothing in this section just yet.</p>

                <p class="mt-1 text-base">
                    Check back when I've built something new!
                </p>
            </div>
        </div>
    </section>
</template>

<style scoped>
.projects-paper {
    background-color: #f4efdf;
    background-image:
        linear-gradient(rgba(34, 87, 122, 0.055) 1px, transparent 1px),
        linear-gradient(90deg, rgba(34, 87, 122, 0.055) 1px, transparent 1px);
    background-size: 28px 28px;
}

@media (prefers-reduced-motion: reduce) {
    .projects-paper *,
    .projects-paper *::before,
    .projects-paper *::after {
        scroll-behavior: auto !important;
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
}
</style>
