<script setup lang="ts">
import Line from '@/components/ui/svg/Line.vue';
import { Link } from '@inertiajs/vue3';

interface BlogPost {
    id: number;
    title: string;
    slug: string;
    description: string;
    excerpt: string;
    publishedAt: string | null;
}

const props = defineProps<{
    blogs: BlogPost[];
}>();

const formatPublishedDate = (publishedAt: string | null): string => {
    if (!publishedAt) {
        return 'Date to be announced';
    }

    return new Intl.DateTimeFormat('en', {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
    }).format(new Date(publishedAt));
};
</script>

<template>
    <section
        class="min-h-screen overflow-hidden px-5 py-12 sm:px-10 sm:py-16 lg:px-16"
    >
        <div class="mx-auto max-w-6xl">
            <header class="relative max-w-3xl">
                <p class="font-hand text-sage text-2xl">
                    a little corner of the internet
                </p>

                <div class="relative mt-2 inline-block">
                    <h1
                        class="font-display text-ink text-5xl leading-[0.95] sm:text-7xl"
                    >
                        notes &amp; thoughts
                    </h1>
                    <Line />
                </div>

                <p
                    class="font-hand text-ink/75 mt-6 max-w-2xl text-lg leading-relaxed sm:text-xl"
                >
                    Small lessons, things I'm figuring out, and ideas from my
                    journey building for the web.
                </p>
            </header>

            <div
                class="border-ink/20 mt-12 flex flex-col gap-5 border-y py-5 sm:flex-row sm:items-center sm:justify-between"
            >
                <div>
                    <p
                        class="text-ink/60 font-mono text-xs font-bold tracking-[0.2em] uppercase"
                    >
                        My journal
                    </p>
                </div>
            </div>
            <div
                v-for="blog in blogs"
                :key="blog.id"
                class="border-ink/20 border-b py-6"
            >
                <p
                    class="text-sage font-mono text-xs font-bold tracking-[0.18em] uppercase"
                >
                    {{ formatPublishedDate(blog.publishedAt) }}
                </p>

                <h2 class="font-display mt-2 text-2xl sm:text-3xl">
                    <Link
                        :href="`/blogs/${blog.slug}`"
                        class="text-ink hover:text-sage focus-visible:text-sage transition-colors hover:underline hover:underline-offset-4 focus-visible:underline focus-visible:underline-offset-4"
                    >
                        {{ blog.title }}
                    </Link>
                </h2>

                <p class="text-ink/75 mt-2 font-mono text-sm leading-7">
                    {{ blog.description }}
                </p>
            </div>
        </div>
    </section>
</template>
