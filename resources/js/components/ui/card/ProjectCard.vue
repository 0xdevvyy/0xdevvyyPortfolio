<script setup lang="ts">
import { Link } from "@inertiajs/vue3";
import { Pin } from "@lucide/vue";

import LineComponent from "@/components/ui/svg/Line.vue";

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
    thumbnailPath: string;
    slug: string;
    excerpt: string;
    description: string;
    features: string[];
    tags: Tag[];
    screenshots: Screenshot[];
}

const props = defineProps<{
    project: Project;
    index: number;
}>();

const rotations = [
    "-rotate-[1deg]",
    "rotate-[1deg]",
    "rotate-[1.5deg]",
    "-rotate-[1.5deg]",
];

const rotation = rotations[props.index % rotations.length];
</script>

<template>
    <article class="group relative" :class="rotation">
        <!-- Tape -->
        <div
            class="absolute -top-5 left-1/2 z-20 h-10 w-28 -translate-x-1/2 rotate-[-3deg] bg-gold/65 shadow-sm"
        />

        <!-- Paper shadow -->
        <div
            class="absolute inset-0 translate-x-2 translate-y-2 border-[3px] border-ink/15 bg-paper-dark"
        />

        <!-- Main card -->
        <div
            class="relative overflow-hidden border-[3px] border-ink bg-paper-light shadow-[7px_8px_0_0_var(--ink)] transition-all duration-300 group-hover:-translate-y-2 group-hover:shadow-[11px_13px_0_0_var(--ink)]"
        >
            <!-- Push Pin -->
            <div
                class="absolute top-3 left-5 z-30 flex h-10 w-10 -rotate-12 items-center justify-center rounded-full border-2 border-ink bg-red text-paper-light shadow-[2px_3px_0_0_var(--ink)] transition-transform duration-300 group-hover:-translate-y-1 group-hover:rotate-[-18deg]"
            >
                <Pin :size="19" :stroke-width="2" />
            </div>

            <!-- Project number -->
            <div
                class="m-2 absolute top-4 right-4 z-20 flex h-11 w-11 rotate-6 items-center justify-center rounded-full border-2 border-ink bg-gold-light font-mono text-xs font-bold text-ink"
            >
                {{ String(index + 1).padStart(2, "0") }}
            </div>

            <!-- Screenshot -->
            <div class="p-4 pb-0">
                <div
                    class="relative aspect-[16/10] overflow-hidden border-2 border-ink bg-paper-dark"
                >
                    <img
                        v-if="project.thumbnailPath"
                        :src="project.thumbnailPath"
                        :alt="`${project.title} screenshot`"
                        class="h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.04]"
                    />

                    <div v-else class="flex h-full items-center justify-center">
                        <span class="font-hand text-xl text-ink/45">
                            no preview yet
                        </span>
                    </div>

                    <div
                        class="pointer-events-none absolute inset-0 bg-gradient-to-t from-ink/20 via-transparent to-transparent opacity-0 transition-opacity duration-300 group-hover:opacity-100"
                    />
                </div>
            </div>

            <!-- Content -->
            <div class="p-5 sm:p-6">
                <!-- Project label -->
                <div class="mb-2 flex items-center gap-2">
                    <span class="h-2 w-2 rounded-full bg-sage" />

                    <span
                        class="font-mono text-[10px] font-bold uppercase tracking-[0.2em] text-sage"
                    >
                        project {{ String(index + 1).padStart(2, "0") }}
                    </span>
                </div>

                <!-- Title -->
                <div>
                    <h2
                        class="font-display text-3xl leading-none text-ink sm:text-4xl"
                    >
                        {{ project.title }}
                    </h2>
                </div>

                <!-- Divider -->
                <div
                    class="my-4 h-[2px] w-full border-t-2 border-dashed border-ink/20"
                />

                <!-- Description -->
                <p class="font-mono text-sm leading-6 text-ink/75">
                    {{ project.description }}
                </p>

                <!-- Tags -->
                <div
                    v-if="project.tags.length"
                    class="mt-5 flex flex-wrap gap-2"
                >
                    <span
                        v-for="tag in project.tags"
                        :key="tag.id"
                        class="border border-ink/35 bg-paper-dark/55 px-2.5 py-1 font-mono text-[10px] font-bold uppercase tracking-wide text-ink"
                    >
                        {{ tag.name }}
                    </span>
                </div>

                <!-- View project -->
                <div class="mt-6 flex items-end justify-end">
                    <Link
                        :href="`/projects/${project.slug}`"
                        class="group/link relative inline-block px-1 pb-1 font-mono text-[10px] font-bold uppercase tracking-[0.12em] text-ink transition-colors hover:text-sage"
                    >
                        View project

                        <LineComponent
                            class="origin-left scale-x-0 transition-transform duration-300 ease-out group-hover/link:scale-x-100"
                        />
                    </Link>
                </div>
            </div>
        </div>
    </article>
</template>
