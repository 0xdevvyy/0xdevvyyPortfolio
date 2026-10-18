<script setup lang="ts">
import Text from '@/components/ui/input/Text.vue';
import TextArea from '@/components/ui/input/TextArea.vue';
import auth from '@/routes/auth';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { ArrowLeft, FileText } from '@lucide/vue';

interface BlogPost {
    id: number;
    title: string;
    slug: string;
    description: string;
    excerpt: string;
    isPublished: boolean;
    publishedAt: string | null;
}

const props = defineProps<{
    blog: BlogPost;
}>();

const form = useForm({
    title: props.blog.title,
    slug: props.blog.slug,
    description: props.blog.description,
    excerpt: props.blog.excerpt,
    is_published: props.blog.isPublished,
    published_at: props.blog.publishedAt?.slice(0, 10) ?? '',
});

function submit() {
    form.put(auth.blog.update(props.blog.id).url, {
        preserveScroll: true,
    });
}
</script>

<template>
    <Head :title="`Edit ${blog.title}`" />

    <main class="mx-auto w-full max-w-4xl space-y-8 px-4 py-8 sm:px-6">
        <header class="space-y-4">
            <Link
                :href="auth.blog.index()"
                class="text-ink/60 hover:text-ink inline-flex items-center gap-2 font-mono text-sm transition-colors"
            >
                <ArrowLeft :size="16" />
                Back to blogs
            </Link>

            <div>
                <p class="font-hand text-sage text-xl">revise your entry</p>
                <h1 class="font-display text-ink mt-2 text-4xl sm:text-5xl">
                    Edit blog
                </h1>
                <p class="text-ink/60 mt-3 font-mono text-sm leading-6">
                    Update the post details and publication settings.
                </p>
            </div>
        </header>

        <form
            class="border-ink/15 bg-paper-light space-y-6 rounded-xl border-2 p-5 sm:p-8"
            @submit.prevent="submit"
        >
            <div class="border-ink/10 flex items-center gap-3 border-b pb-4">
                <FileText class="text-sage size-5" />
                <h2 class="font-display text-ink text-2xl">Post details</h2>
            </div>

            <div class="grid gap-5 sm:grid-cols-2">
                <Text
                    id="title"
                    v-model="form.title"
                    name="title"
                    label="Title"
                    placeholder="Enter a title"
                    hint="The heading readers will see."
                    :error="form.errors.title"
                    :maxlength="255"
                />

                <Text
                    id="slug"
                    v-model="form.slug"
                    name="slug"
                    label="Slug"
                    placeholder="a-url-friendly-slug"
                    hint="Used in the public blog URL."
                    :error="form.errors.slug"
                    :maxlength="255"
                />
            </div>

            <TextArea
                id="excerpt"
                v-model="form.excerpt"
                name="excerpt"
                label="Excerpt"
                placeholder="A short introduction to your post"
                hint="A short summary shown in the blog listing."
                :maxlength="255"
                :error="form.errors.excerpt"
                required
                :rows="3"
            />

            <TextArea
                id="description"
                v-model="form.description"
                name="description"
                label="Content"
                placeholder="Write your blog post"
                hint="Main content of the post."
                :maxlength="255"
                :error="form.errors.description"
                required
                :rows="8"
            />

            <div class="grid gap-5 sm:grid-cols-2">
                <Text
                    id="published_at"
                    v-model="form.published_at"
                    name="published_at"
                    label="Publication date"
                    type="date"
                    placeholder=""
                    hint="Optional. Defaults to today when left blank."
                    :error="form.errors.published_at"
                    :required="false"
                />

                <div class="space-y-2">
                    <span class="form-label">Visibility</span>
                    <label
                        for="is_published"
                        class="border-ink/15 flex min-h-12 cursor-pointer items-center gap-3 rounded-md border px-3"
                    >
                        <input
                            id="is_published"
                            v-model="form.is_published"
                            name="is_published"
                            type="checkbox"
                            class="accent-sage size-4"
                        />
                        <span class="text-ink/75 font-mono text-sm">
                            Publish this post
                        </span>
                    </label>
                    <p v-if="form.errors.is_published" class="field-error">
                        {{ form.errors.is_published }}
                    </p>
                </div>
            </div>

            <footer
                class="border-ink/10 flex flex-col-reverse justify-end gap-3 border-t pt-5 sm:flex-row"
            >
                <Link
                    :href="auth.blog.index()"
                    class="border-ink/20 text-ink/70 hover:bg-paper inline-flex items-center justify-center rounded-md border px-5 py-3 font-mono text-sm transition"
                >
                    Cancel
                </Link>
                <button
                    type="submit"
                    class="bg-ink text-paper inline-flex cursor-pointer items-center justify-center rounded-md px-5 py-3 font-mono text-sm transition hover:-translate-y-0.5 disabled:cursor-not-allowed disabled:opacity-60"
                    :disabled="form.processing"
                >
                    {{ form.processing ? 'Saving…' : 'Save changes' }}
                </button>
            </footer>
        </form>
    </main>
</template>
