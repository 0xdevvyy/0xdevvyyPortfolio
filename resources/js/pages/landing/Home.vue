<script setup lang="ts">
import GhostButton from '@/components/ui/button/GhostButton.vue';
import PrimaryButton from '@/components/ui/button/PrimaryButton.vue';
import HeadingRays from '@/components/ui/svg/HeadingRays.vue';
import Highlight from '@/components/ui/svg/Highlight.vue';
import Line from '@/components/ui/svg/Line.vue';
import { home } from '@/routes';

const logo = '/images/coding.png';
</script>

<template>
    <section class="overflow-hidden px-10 py-16 sm:px-12 lg:px-16">
        <div
            class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-12 lg:grid-cols-2 lg:gap-20"
        >
            <div>
                <p class="font-hand text-2xl">hi, i'm</p>

                <div class="relative inline-block">
                    <HeadingRays side="left" />

                    <div class="relative inline-block">
                        <h1
                            class="font-display text-6xl leading-none sm:text-7xl lg:text-8xl"
                        >
                            0xdevvy
                        </h1>

                        <Line class="text-primary" />
                    </div>

                    <HeadingRays side="right" />
                </div>

                <p class="mt-2">
                    <span class="relative inline-block">
                        <Highlight />

                        <span
                            class="font-hand relative z-10 text-3xl sm:text-4xl"
                        >
                            Software Developer
                        </span>
                    </span>
                </p>

                <p
                    class="font-hand mt-6 max-w-xl text-xl leading-relaxed sm:text-2xl"
                >
                    I'm a BSIT graduate still looking for a job, trying to
                    figure out if this is actually the right path for me. I
                    don't always know where I'm going, but I do know that I
                    really enjoy building web applications that other people can
                    use. My main tech stack is Vue, Laravel, Inertia.js, and
                    Tailwind CSS.
                </p>

                <div class="mt-8 flex flex-wrap items-center gap-3">
                    <PrimaryButton :href="home()"> My Projects </PrimaryButton>

                    <GhostButton :href="home()"> About Me </GhostButton>

                    <GhostButton :href="home()"> Blogs </GhostButton>
                </div>
            </div>

            <div
                class="hidden min-h-[400px] items-center justify-center lg:flex"
            >
                <img
                    :src="logo"
                    alt="0xdevvy logo"
                    class="h-auto w-full max-w-[520px] object-contain"
                />
            </div>
        </div>
    </section>
</template>
