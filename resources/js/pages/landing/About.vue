<script setup lang="ts">
import Hobbies from '@/components/about/Hobbies.vue';
import Currently from '@/components/about/Currently.vue';
import Like from '@/components/about/Like.vue';
import Me from '@/components/about/Me.vue';
import TechStack from '@/components/about/TechStack.vue';
import Quote from '@/components/about/Quote.vue';

const aboutImage = '/images/coding.png'; //note: will change this
</script>

<template>
    <section id="about" class="px-6 py-24 sm:px-10 lg:px-16 lg:py-18">
        <div
            class="mx-auto grid max-w-6xl grid-cols-1 items-start gap-16 lg:grid-cols-[0.8fr_1.2fr] lg:gap-24"
        >
            <div class="lg:sticky lg:top-28 lg:self-start">
                <div class="relative mx-auto max-w-md lg:mx-0">
                    <div
                        class="border-secondary/30 absolute -right-4 -bottom-4 h-full w-full border"
                    ></div>

                    <div
                        class="relative rotate-[-2deg] overflow-hidden bg-[#E8DFC9] p-3"
                    >
                        <img
                            :src="aboutImage"
                            alt="A photo of 0xdevvyy"
                            class="aspect-[4/5] w-full object-cover grayscale transition duration-700 hover:grayscale-0"
                        />
                    </div>

                    <p
                        class="font-hand text-secondary absolute right-0 -bottom-12 rotate-[-5deg] text-2xl"
                    >
                        Hello :)
                    </p>
                </div>
            </div>

            <div>
                <Me>
                    <template #title> A little about me </template>
                </Me>

                <Like>
                    <template #title> What i lIke </template>
                </Like>

                <Hobbies>
                    <template #title> Hobbies </template>
                </Hobbies>

                <Currently>
                    <template #title> Currently Doing </template>
                </Currently>

                <TechStack>
                    <template #title> My Tech Stack </template>
                </TechStack>

                <Quote />
            </div>
        </div>
    </section>
</template>
