<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';

import EmailInput from '@/components/ui/input/Email.vue';
import PasswordInput from '@/components/ui/input/Password.vue';
import PrimaryButton from '@/components/ui/button/PrimaryButton.vue';
import HeadingRays from '@/components/ui/svg/HeadingRays.vue';
import Highlight from '@/components/ui/svg/Highlight.vue';
import Line from '@/components/ui/svg/Line.vue';
import login from '@/routes/login';

const form = useForm({
    email: '',
    password: '',
});

const submit = () => {
    form.post('/login', {
        onFinish: () => {
            form.reset('password');
        },
    });
};
</script>

<template>
    <Head title="Login" />

    <section class="overflow-hidden px-10 py-16 sm:px-12 lg:px-16">
        <div
            class="mx-auto grid max-w-7xl grid-cols-1 items-center gap-14 lg:grid-cols-2 lg:gap-20"
        >
            <!-- Left -->
            <div>
                <p class="font-hand text-2xl">welcome back,</p>

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

                <p class="mt-3">
                    <span class="relative inline-block">
                        <Highlight />

                        <span
                            class="font-hand relative z-10 text-3xl sm:text-4xl"
                        >
                            nice to see you again
                        </span>
                    </span>
                </p>

                <!-- <p
                    class="font-hand mt-6 max-w-xl text-xl leading-relaxed sm:text-2xl"
                >
                    Log in 
                </p> -->

                <div class="mt-12">
                    <p class="font-doodle text-pencil text-lg">
                        small steps,
                        <span class="text-primary"> big dreams. </span>
                    </p>
                </div>
            </div>

            <!-- Login -->
            <div class="flex justify-center">
                <div class="relative w-full max-w-[520px]">
                    <!-- Decorative paper layers -->
                    <div
                        class="border-primary/20 absolute -top-2 -right-2 h-full w-full rotate-2 border-2"
                    />

                    <div
                        class="border-sage/30 absolute -bottom-2 -left-2 h-full w-full -rotate-2 border-2"
                    />

                    <!-- Form -->
                    <div
                        class="border-ink/80 bg-paper-light relative border-2 px-7 py-9 sm:px-10 sm:py-11"
                    >
                        <!-- Header -->
                        <div class="mb-8">
                            <p class="font-hand text-pencil text-xl">
                                let's get started
                            </p>

                            <h2
                                class="font-heading text-ink mt-1 text-4xl sm:text-5xl"
                            >
                                Log In
                            </h2>

                            <div class="relative mt-2 w-fit">
                                <Highlight />

                                <p
                                    class="font-doodle text-ink relative z-10 text-lg"
                                >
                                    one more line of code
                                </p>
                            </div>
                        </div>

                        <!-- Form -->
                        <form class="space-y-6" @submit.prevent="submit">
                            <EmailInput
                                v-model="form.email"
                                label="Email"
                                placeholder="you@example.com"
                                :error="form.errors.email"
                            />

                            <PasswordInput
                                v-model="form.password"
                                label="Password"
                                placeholder="your password"
                                :error="form.errors.password"
                            />
                            <!-- Submit -->
                            <button
                                type="submit"
                                class="rounde-lg bg-primary text-primary-foreground inline-flex h-12 cursor-pointer items-center justify-center px-6 font-sans text-sm font-bold tracking-wide shadow-[3px_3px_0_0_var(--color-ink-dark)] transition-all duration-200 hover:-translate-y-0.5 hover:shadow-[5px_5px_0_0_var(--color-ink-dark)] active:translate-y-0 active:shadow-[2px_2px_0_0_var(--color-ink-dark)]"
                                :disabled="form.processing"
                            >
                                {{
                                    form.processing ? 'Logging in...' : 'Log In'
                                }}
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>
