<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import { ArrowLeft } from '@lucide/vue';

interface BlogPost {
    id: number;
    title: string;
    slug: string;
    description: string;
    excerpt: string;
    publishedAt: string | null;
}

const { blog } = defineProps<{
    blog: BlogPost;
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
    <main class="min-h-screen px-5 py-12 sm:px-10 sm:py-16 lg:px-16">
        <article class="mx-auto max-w-3xl">
            <Link
                href="/blogs"
                class="text-ink/60 hover:text-sage group mb-10 inline-flex items-center gap-2 font-mono text-sm transition-colors"
            >
                <ArrowLeft
                    :size="16"
                    class="transition-transform group-hover:-translate-x-1"
                />
                Back to blogs
            </Link>

            <header class="border-ink/20 border-b pb-8">
                <p
                    class="text-sage font-mono text-xs font-bold tracking-[0.18em] uppercase"
                >
                    {{ formatPublishedDate(blog.publishedAt) }}
                </p>

                <h1
                    class="font-display text-ink mt-4 text-4xl leading-tight sm:text-6xl"
                >
                    {{ blog.title }}
                </h1>

                <p
                    v-if="blog.excerpt"
                    class="font-hand text-ink/75 mt-6 text-xl leading-relaxed sm:text-2xl"
                >
                    {{ blog.excerpt }}
                </p>
            </header>

            <div
                class="font-body text-ink/80 mt-8 text-base leading-8 sm:text-lg sm:leading-9"
            >
                <p class="whitespace-pre-line">{{ blog.description }}</p>
            </div>
        </article>
    </main>
</template>
