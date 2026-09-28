<script setup lang="ts">
import { ArrowUpRight, Star } from "@lucide/vue";

interface Project {
    id: number;
    title: string;
    year: string;
    category: string;
    description: string;
    technologies: string[];
    image: string;
    accent: string;
}

defineProps<{
    project: Project;
}>();
</script>

<template>
    <article
        class="group relative flex min-w-0 flex-col transition-transform duration-300"
        :class="
            project.id % 2 === 0
                ? 'sm:rotate-[-0.7deg] sm:hover:rotate-0'
                : 'sm:rotate-[0.7deg] sm:hover:rotate-0'
        "
    >
        <div
            class="absolute -top-5 left-1/2 z-30 h-10 w-24 -translate-x-1/2 rotate-[-3deg] bg-[#D8AE4F]/80 shadow-sm"
            aria-hidden="true"
        >
            <div
                class="h-full w-full opacity-30"
                style="
                    background-image: repeating-linear-gradient(
                        90deg,
                        transparent 0,
                        transparent 8px,
                        rgba(255, 255, 255, 0.5) 9px,
                        transparent 10px
                    );
                "
            />
        </div>

        <div
            class="relative flex min-h-[590px] flex-col overflow-hidden border border-[#d6cfbd] bg-[#F4EFDF] text-[#173B5C] shadow-[4px_7px_0_rgba(23,59,92,0.07),0_12px_22px_rgba(23,59,92,0.12)] transition-all duration-300 hover:-translate-y-2 hover:shadow-[7px_12px_22px_rgba(23,59,92,0.15)]"
            style="
                clip-path: polygon(
                    0.5% 1%,
                    3% 0.4%,
                    7% 1%,
                    12% 0.4%,
                    17% 0.9%,
                    22% 0.3%,
                    28% 0.8%,
                    34% 0.3%,
                    41% 0.8%,
                    48% 0.3%,
                    55% 0.8%,
                    62% 0.3%,
                    69% 0.8%,
                    76% 0.3%,
                    83% 0.8%,
                    90% 0.3%,
                    97% 0.8%,
                    99.5% 1%,
                    99% 97%,
                    95% 99%,
                    88% 98.4%,
                    81% 99%,
                    74% 98.5%,
                    67% 99%,
                    60% 98.4%,
                    53% 99%,
                    46% 98.5%,
                    39% 99%,
                    32% 98.4%,
                    25% 99%,
                    18% 98.5%,
                    11% 99%,
                    4% 98.4%,
                    0.5% 99%
                );
            "
        >
            <div
                class="pointer-events-none absolute inset-0 opacity-30"
                style="
                    background-image:
                        radial-gradient(
                            rgba(23, 59, 92, 0.12) 0.7px,
                            transparent 0.7px
                        ),
                        radial-gradient(
                            rgba(139, 138, 130, 0.08) 0.6px,
                            transparent 0.6px
                        );
                    background-position:
                        0 0,
                        8px 8px;
                    background-size:
                        16px 16px,
                        16px 16px;
                "
            />

            <div
                class="pointer-events-none absolute right-4 top-4 h-8 w-8 rotate-12 bg-[#FAF7EC]/60 shadow-[-1px_1px_2px_rgba(23,59,92,0.05)]"
            />

            <div
                class="relative z-10 mx-4 mt-5 h-40 overflow-hidden border-2 border-[#71866A]/50 shadow-inner sm:mx-5 sm:h-44"
                :style="{ backgroundColor: project.accent }"
            >
                <img
                    :src="project.image"
                    :alt="`${project.title} project preview`"
                    class="h-full w-full object-cover transition-transform duration-500 group-hover:scale-105"
                />

                <div
                    class="pointer-events-none absolute inset-0 bg-gradient-to-t from-[#173B5C]/25 via-transparent to-white/10"
                />

                <span
                    class="font-hand absolute left-2 top-2 -rotate-3 border border-[#173B5C]/10 bg-[#FAF7EC] px-3 py-1 text-base text-[#173B5C] shadow-[1px_2px_3px_rgba(23,59,92,0.15)]"
                >
                    {{ String(project.id).padStart(2, "0") }}
                </span>

                <span
                    class="font-hand absolute right-2 top-2 rotate-2 border border-[#173B5C]/10 bg-[#FAF7EC] px-3 py-1 text-base text-[#173B5C] shadow-[1px_2px_3px_rgba(23,59,92,0.15)]"
                >
                    {{ project.year }}
                </span>

                <span
                    class="font-hand absolute bottom-2 right-2 rotate-[-2deg] border border-white/20 bg-[#22577A] px-3 py-1 text-sm text-white shadow-[2px_3px_4px_rgba(23,59,92,0.15)]"
                >
                    {{ project.category }}

                    <span aria-hidden="true">↗</span>
                </span>
            </div>

            <div
                class="relative z-10 flex flex-1 flex-col px-5 pb-6 pt-5 sm:px-6"
            >
                <div class="flex items-start justify-between gap-3">
                    <h2
                        class="font-display text-3xl leading-tight text-[#173B5C] sm:text-4xl"
                    >
                        {{ project.title }}
                    </h2>

                    <span
                        class="font-hand mt-1 shrink-0 text-sm text-[#71866A]"
                    >
                        #project
                    </span>
                </div>

                <svg
                    class="mt-1 h-2 w-24"
                    viewBox="0 0 100 8"
                    fill="none"
                    aria-hidden="true"
                >
                    <path
                        d="M2 5 Q25 1 50 5 T98 3"
                        stroke="#D8AE4F"
                        stroke-width="2.5"
                        stroke-linecap="round"
                    />
                </svg>

                <p
                    class="font-hand mt-3 flex-1 text-lg leading-relaxed text-[#173B5C]/85"
                >
                    {{ project.description }}
                </p>

                <p class="font-hand mt-5 text-sm text-[#71866A]">
                    things i used:
                </p>

                <div class="mt-2 flex flex-wrap gap-2">
                    <span
                        v-for="(technology, techIndex) in project.technologies"
                        :key="technology"
                        class="font-hand rounded-full border border-[#71866A]/30 bg-[#E8DFC9]/60 px-3 py-1 text-sm text-[#173B5C] shadow-[1px_2px_0_rgba(23,59,92,0.05)]"
                        :class="techIndex % 2 === 0 ? '-rotate-1' : 'rotate-1'"
                    >
                        {{ technology }}
                    </span>
                </div>

                <div class="mt-7 flex justify-center">
                    <a
                        href="#"
                        class="font-hand inline-flex items-center justify-center gap-2 rounded-full border-2 border-[#22577A] bg-[#22577A] px-7 py-2.5 text-lg text-[#FAF7EC] shadow-[3px_4px_0_rgba(23,59,92,0.14)] transition-all duration-200 hover:-translate-y-1 hover:rotate-[-1deg] hover:bg-[#173B5C] hover:shadow-[4px_6px_0_rgba(23,59,92,0.15)] focus-visible:outline-none focus-visible:ring-2 focus-visible:ring-[#38A3A5] focus-visible:ring-offset-2"
                    >
                        View Project

                        <ArrowUpRight
                            :size="19"
                            :stroke-width="2"
                            class="transition-transform duration-200 group-hover:translate-x-0.5 group-hover:-translate-y-0.5"
                        />
                    </a>
                </div>
            </div>

            <Star
                v-if="project.id % 2 === 0"
                class="pointer-events-none absolute -bottom-4 -right-3 rotate-12 text-[#D8AE4F]"
                :size="24"
                :stroke-width="1.7"
                aria-hidden="true"
            />
        </div>
    </article>
</template>
