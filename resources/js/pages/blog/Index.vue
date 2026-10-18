<script setup lang="ts">
import DeleteDialog from '@/components/ui/dialog/Delete.vue';
import auth from '@/routes/auth';
import { Head, Link, router } from '@inertiajs/vue3';
import { BookOpen, Pencil, Plus, Trash2 } from '@lucide/vue';
import { ref } from 'vue';

interface BlogPost {
    id: number;
    title: string;
    slug: string;
    description: string;
    excerpt: string;
    isPublished: boolean;
    publishedAt: string | null;
}

defineProps<{
    blogs: BlogPost[];
}>();

const selectedBlog = ref<BlogPost | null>(null);
const isDeleting = ref(false);

function openDeleteDialog(blog: BlogPost) {
    selectedBlog.value = blog;
}

function closeDeleteDialog() {
    if (isDeleting.value) {
        return;
    }

    selectedBlog.value = null;
}

function deleteBlog() {
    const blog = selectedBlog.value;

    if (!blog || isDeleting.value) {
        return;
    }

    isDeleting.value = true;

    router.delete(auth.blog.delete(blog.id).url, {
        preserveScroll: true,
        onSuccess: () => {
            selectedBlog.value = null;
        },
        onFinish: () => {
            isDeleting.value = false;
        },
    });
}

function formatPublishedDate(publishedAt: string | null): string {
    if (!publishedAt) {
        return 'Date not set';
    }

    return new Intl.DateTimeFormat('en', {
        year: 'numeric',
        month: 'short',
        day: 'numeric',
    }).format(new Date(publishedAt));
}

function statusFor(blog: BlogPost): string {
    if (!blog.isPublished) {
        return 'Draft';
    }

    if (blog.publishedAt && new Date(blog.publishedAt) > new Date()) {
        return 'Scheduled';
    }

    return 'Published';
}
</script>

<template>
    <Head title="Manage Blogs" />

    <main
        class="mx-auto w-full max-w-7xl space-y-8 px-5 py-8 sm:px-10 lg:px-16"
    >
        <header
            class="flex flex-col gap-6 sm:flex-row sm:items-end sm:justify-between"
        >
            <div>
                <p class="font-hand text-sage text-xl">your writing desk</p>

                <h1 class="font-display text-ink mt-2 text-5xl sm:text-6xl">
                    manage blogs
                </h1>

                <p
                    class="text-ink/65 mt-4 max-w-xl font-mono text-sm leading-6"
                >
                    Create, edit, and remove posts. Drafts and scheduled posts
                    are included here.
                </p>
            </div>

            <Link
                :href="auth.blog.create()"
                class="bg-ink text-paper inline-flex w-fit items-center gap-2 rounded-lg px-5 py-3 font-mono text-sm transition-all hover:-translate-y-0.5 hover:shadow-[4px_4px_0_var(--gold)]"
            >
                <Plus :size="17" />
                New blog
            </Link>
        </header>

        <div class="flex items-center gap-3">
            <span class="font-display text-ink text-3xl">{{
                blogs.length
            }}</span>
            <span
                class="text-ink/50 font-mono text-xs tracking-[0.18em] uppercase"
            >
                total blog posts
            </span>
        </div>

        <section v-if="blogs.length" class="space-y-4">
            <article
                v-for="(blog, index) in blogs"
                :key="blog.id"
                class="border-ink/15 bg-paper-light rounded-xl border-2 p-5 transition hover:-translate-y-0.5 hover:shadow-[4px_4px_0_var(--ink)] sm:p-6"
            >
                <div class="grid gap-5 sm:grid-cols-[1fr_auto] sm:items-center">
                    <div class="min-w-0">
                        <div class="mb-3 flex flex-wrap items-center gap-3">
                            <span
                                class="font-mono text-[10px] tracking-[0.18em] uppercase"
                                :class="
                                    blog.isPublished
                                        ? 'text-sage'
                                        : 'text-ink/45'
                                "
                            >
                                <span
                                    class="mr-1.5 inline-block size-1.5 rounded-full align-middle"
                                    :class="
                                        blog.isPublished
                                            ? 'bg-sage'
                                            : 'bg-ink/30'
                                    "
                                ></span>
                                {{ statusFor(blog) }}
                            </span>

                            <span class="text-ink/35 font-mono text-[10px]">
                                #{{ String(index + 1).padStart(2, '0') }}
                            </span>

                            <span class="text-ink/40 font-mono text-[10px]">
                                {{ formatPublishedDate(blog.publishedAt) }}
                            </span>
                        </div>

                        <h2 class="font-display text-ink text-2xl sm:text-3xl">
                            {{ blog.title }}
                        </h2>

                        <p class="text-ink/50 mt-1 font-mono text-xs">
                            /blogs/{{ blog.slug }}
                        </p>

                        <p
                            class="text-ink/65 mt-3 line-clamp-2 font-mono text-sm leading-6"
                        >
                            {{ blog.excerpt }}
                        </p>
                    </div>

                    <div class="flex items-center gap-2 sm:justify-end">
                        <Link
                            :href="auth.blog.edit(blog.id)"
                            class="border-ink/15 text-ink/70 hover:bg-ink hover:text-paper inline-flex items-center gap-2 rounded-full border px-4 py-2 font-mono text-xs transition"
                        >
                            <Pencil :size="15" />
                            Edit
                        </Link>

                        <button
                            type="button"
                            class="border-red/20 text-red/70 hover:bg-red hover:text-paper inline-flex cursor-pointer items-center gap-2 rounded-full border px-4 py-2 font-mono text-xs transition disabled:cursor-not-allowed disabled:opacity-50"
                            :disabled="isDeleting"
                            :aria-label="`Delete ${blog.title}`"
                            @click="openDeleteDialog(blog)"
                        >
                            <Trash2 :size="15" />
                            Delete
                        </button>
                    </div>
                </div>
            </article>
        </section>

        <section
            v-else
            class="border-ink/25 bg-paper-light/50 rounded-xl border-2 border-dashed px-6 py-20 text-center"
        >
            <BookOpen class="text-sage mx-auto size-9" />

            <h2 class="font-display text-ink mt-4 text-3xl">
                No blog posts yet
            </h2>

            <p class="text-ink/55 mx-auto mt-2 max-w-md font-mono text-sm">
                Start with a draft or publish your first post.
            </p>

            <Link
                :href="auth.blog.create()"
                class="text-ink decoration-gold mt-6 inline-flex items-center gap-2 font-mono text-sm underline decoration-2 underline-offset-4"
            >
                <Plus :size="16" />
                Create your first blog
            </Link>
        </section>
        <DeleteDialog
            :open="selectedBlog !== null"
            :title="`Delete ${selectedBlog?.title ?? 'blog post'}?`"
            description="This will permanently delete this blog post. This action cannot be undone."
            :processing="isDeleting"
            @confirm="deleteBlog"
            @cancel="closeDeleteDialog"
        />
    </main>
</template>
