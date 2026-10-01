<script setup lang="ts">
import HeadingRays from '@/components/ui/svg/HeadingRays.vue';
import Highlight from '@/components/ui/svg/Highlight.vue';
import Line from '@/components/ui/svg/Line.vue';

import {
    Mail,
    MapPin,
} from '@lucide/vue';

const socials = [
    {
        name: 'Gmail',
        href: 'mailto:supanrenieljohn.com',
        type: 'gmail',
        note: 'say hello',
    },
    {
        name: 'LinkedIn',
        href: '',
        type: 'linkedin',
        note: "let's connect",
    },
    {
        name: 'JobStreet',
        href: 'https://ph.jobstreet.com/profiles/renieljohn-supan-2wV3h68NDF',
        type: 'jobstreet',
        note: 'hire me maybe?',
    },
    {
        name: 'GitHub',
        href: 'https://github.com/0xdevvyy',
        type: 'github',
        note: 'look at my code',
    },
];
</script>

<template>
    <section class="overflow-hidden px-10 py-16 sm:px-12 lg:px-16">
        <div
            class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-16 lg:grid-cols-[0.9fr_1.1fr] lg:gap-12"
        >
            <!-- LEFT -->
            <div class="relative">
                <div class="relative mt-8 inline-block">
                    <HeadingRays side="left" />

                    <div class="relative inline-block">
                        <h1
                            class="font-display text-6xl uppercase leading-[0.85] text-primary sm:text-7xl lg:text-8xl"
                        >
                            Get in
                            <br />
                            touch
                        </h1>

                        <Line class="text-primary" />
                    </div>

                    <HeadingRays side="right" />
                </div>

                <p class="mt-6">
                    <span class="relative inline-block">
                        <Highlight />

                        <span
                            class="font-hand relative z-10 text-2xl text-primary sm:text-3xl"
                        >
                            I'm just a message away
                        </span>
                    </span>
                </p>

                <p
                    class="font-hand mt-7 max-w-xl text-xl leading-relaxed text-primary/90 sm:text-2xl"
                >
                    Got a project idea, a job opportunity, want to
                    collaborate, or just want to say hi?

                    <br />
                    <br />

                    Feel free to reach out!
                </p>

                <div
                    class="mt-8 flex items-center gap-3 font-hand text-lg text-primary"
                >
                    <MapPin
                        :size="24"
                        :stroke-width="1.8"
                    />

                    <span>
                        Philippines
                        <span class="ml-1 opacity-60">
                            (open to remote work)
                        </span>
                    </span>
                </div>
            </div>

            <!-- RIGHT -->
            <section
                class="relative min-h-[520px] sm:min-h-[580px]"
            >
                <!-- Handwritten heading -->
                <div
                    class="absolute left-1/2 top-0 z-20 -translate-x-1/2 -rotate-2 whitespace-nowrap"
                >
                    <span
                        class="font-doodle text-3xl text-primary"
                    >
                        Find me here
                    </span>
                </div>

                <!-- Large doodle circle -->
                <div
                    class="absolute left-1/2 top-1/2 h-[370px] w-[370px] -translate-x-1/2 -translate-y-1/2 rounded-full border border-dashed border-primary/20 sm:h-[460px] sm:w-[460px]"
                ></div>

                <div
                    class="absolute left-1/2 top-1/2 h-[300px] w-[300px] -translate-x-1/2 -translate-y-1/2 rounded-full border border-gold/30 sm:h-[380px] sm:w-[380px]"
                ></div>

                <!-- GMAIL -->
                <a
                    :href="socials[0].href"
                    :aria-label="socials[0].name"
                    class="group absolute left-[8%] top-[23%] z-10"
                >
                    <div
                        class="relative h-24 w-24 overflow-hidden rounded-[38%] border border-primary/20 bg-white shadow-[5px_7px_0_0_rgba(23,59,92,0.12)] transition duration-300 group-hover:-translate-y-3 group-hover:rotate-3 group-hover:scale-110 sm:h-28 sm:w-28"
                        style="clip-path: url(#squircleClip)"
                    >
                        <div
                            class="absolute inset-0 flex items-center justify-center"
                        >
                            <Mail
                                class="h-12 w-12 text-[#C86B52] sm:h-14 sm:w-14"
                                stroke-width="1.7"
                            />
                        </div>
                    </div>

                    <span
                        class="absolute -bottom-9 left-1/2 -translate-x-1/2 rotate-[-7deg] whitespace-nowrap font-doodle text-xl text-primary"
                    >
                        say hello
                    </span>
                </a>

                <!-- LINKEDIN -->
                <a
                    :href="socials[1].href"
                    target="_blank"
                    rel="noopener noreferrer"
                    :aria-label="socials[1].name"
                    class="group absolute right-[10%] top-[17%] z-10"
                >
                    <div
                        class="relative h-28 w-28 overflow-hidden rounded-[38%] border border-dark/35 bg-primary shadow-[-5px_7px_0_0_rgba(23,59,92,0.12)] transition duration-300 group-hover:-translate-y-3 group-hover:-rotate-3 group-hover:scale-110 sm:h-32 sm:w-32"
                        style="clip-path: url(#squircleClip)"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            class="absolute inset-0 m-auto h-14 w-14 fill-paper-light sm:h-16 sm:w-16"
                            aria-hidden="true"
                        >
                            <path
                                d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433a2.062 2.062 0 1 1 0-4.125 2.062 2.062 0 0 1 0 4.125zM7.114 20.452H3.56V9h3.554v11.452z"
                            />
                        </svg>
                    </div>

                    <span
                        class="absolute -bottom-9 left-1/2 -translate-x-1/2 rotate-[5deg] whitespace-nowrap font-doodle text-xl text-primary"
                    >
                        let's connect
                    </span>
                </a>

                <!-- JOBSTREET -->
                <a
                    :href="socials[2].href"
                    target="_blank"
                    rel="noopener noreferrer"
                    :aria-label="socials[2].name"
                    class="group absolute bottom-[18%] left-[12%] z-10"
                >
                    <div
                        class="relative h-28 w-28 overflow-hidden rounded-[38%] border border-primary/20 bg-[#599AD7] shadow-[5px_6px_0_0_rgba(23,59,92,0.12)] transition duration-300 group-hover:-translate-y-3 group-hover:rotate-3 group-hover:scale-110 sm:h-32 sm:w-32"
                        style="clip-path: url(#squircleClip)"
                    >
                        <div
                            class="absolute inset-0 flex items-center justify-center"
                        >
                            <span
                                class="font-heading text-[1.65rem] tracking-[-0.05em] text-white sm:text-[1.9rem]"
                            >
                                jobstreet
                            </span>
                        </div>
                    </div>

                    <span
                        class="absolute -bottom-10 left-1/2 -translate-x-1/2 rotate-[-4deg] whitespace-nowrap font-doodle text-xl text-primary"
                    >
                        hire me maybe?
                    </span>
                </a>

                <!-- GITHUB -->
                <a
                    :href="socials[3].href"
                    target="_blank"
                    rel="noopener noreferrer"
                    :aria-label="socials[3].name"
                    class="group absolute bottom-[15%] right-[9%] z-10"
                >
                    <div
                        class="relative h-28 w-28 overflow-hidden rounded-[38%] border border-dark/35 bg-primary shadow-[-5px_7px_0_0_rgba(23,59,92,0.12)] transition duration-300 group-hover:-translate-y-3 group-hover:-rotate-3 group-hover:scale-110 sm:h-32 sm:w-32"
                        style="clip-path: url(#squircleClip)"
                    >
                        <svg
                            viewBox="0 0 24 24"
                            class="absolute inset-0 m-auto h-14 w-14 fill-paper-light sm:h-16 sm:w-16"
                            aria-hidden="true"
                        >
                            <path
                                d="M12 .297a12 12 0 0 0-3.79 23.385c.6.113.82-.26.82-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.84 1.237 1.84 1.237 1.07 1.834 2.807 1.304 3.492.997.108-.775.418-1.305.762-1.605-2.665-.304-5.466-1.332-5.466-5.93 0-1.31.465-2.38 1.235-3.22-.124-.303-.535-1.523.117-3.176 0 0 1.008-.322 3.3 1.23a11.5 11.5 0 0 1 6.003 0c2.29-1.552 3.296-1.23 3.296-1.23.653 1.653.242 2.873.118 3.176.77.84 1.233 1.91 1.233 3.22 0 4.61-2.804 5.624-5.475 5.922.43.372.823 1.102.823 2.222v3.293c0 .32.216.694.825.576A12 12 0 0 0 12 .297"
                            />
                        </svg>
                    </div>

                    <span
                        class="absolute -bottom-10 left-1/2 -translate-x-1/2 rotate-[6deg] whitespace-nowrap font-doodle text-xl text-primary"
                    >
                        look at my code
                    </span>
                </a>
            </section>
        </div>
    </section>
</template>