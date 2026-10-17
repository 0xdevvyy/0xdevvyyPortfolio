<script setup lang="ts">
import auth from '@/routes/auth';
import { edit } from '@/routes/auth/tag';
import { Head, Link } from '@inertiajs/vue3';
import { Pencil, Plus, Tag as TagIcon } from '@lucide/vue';

interface Tag {
    id: number;
    name: string;
}

defineProps<{
    tags: Tag[];
}>();
</script>

<template>
    <Head title="Tags" />

    <main class="mx-auto w-full max-w-5xl space-y-8 px-4 py-8 sm:px-6">
        <header
            class="border-primary/25 flex flex-col gap-4 border-b-2 border-dashed pb-6 sm:flex-row sm:items-end sm:justify-between"
        >
            <div>
                <p
                    class="font-hand text-xs tracking-[0.25em] text-[#71866A] uppercase"
                >
                    Project organization
                </p>

                <h1 class="font-display text-primary mt-2 text-4xl font-bold">
                    Manage tags<span class="text-warning">.</span>
                </h1>

                <p class="text-primary/70 mt-2 text-sm">
                    Keep your projects organized with reusable tags.
                </p>
            </div>

            <Link
                :href="auth.tag.create()"
                class="border-primary bg-primary text-popover inline-flex items-center justify-center gap-2 self-start border-2 px-4 py-2.5 font-mono text-sm transition hover:-translate-y-0.5 hover:bg-[#2B5273] sm:self-auto"
            >
                <Plus class="size-4" />
                New tag
            </Link>
        </header>

        <section class="border-primary bg-popover border-2">
            <div
                class="border-primary bg-popover flex items-center justify-between border-b-2 px-5 py-4"
            >
                <div class="flex items-center gap-3">
                    <TagIcon class="text-primary size-5" />

                    <h2 class="text-primary font-serif text-xl font-bold">
                        Available tags
                    </h2>
                </div>

                <span
                    class="border-primary/30 bg-popover text-primary border px-3 py-1 font-mono text-xs"
                >
                    {{ tags.length }} total
                </span>
            </div>

            <div
                v-if="tags.length"
                class="divide-primary/20 divide-y divide-dashed"
            >
                <div
                    v-for="(tag, index) in tags"
                    :key="tag.id"
                    class="hover:bg-popover/40 flex flex-col gap-4 px-5 py-4 transition sm:flex-row sm:items-center sm:justify-between"
                >
                    <div class="flex min-w-0 items-center gap-4">
                        <span
                            class="font-mono text-xs text-[#71866A] tabular-nums"
                        >
                            {{ String(index + 1).padStart(2, '0') }}
                        </span>

                        <div class="min-w-0">
                            <span
                                class="text-primary inline-flex max-w-full items-center border border-[#71866A]/50 bg-[#71866A]/10 px-3 py-1 font-mono text-sm"
                            >
                                <span class="truncate">{{ tag.name }}</span>
                            </span>
                        </div>
                    </div>

                    <div
                        class="flex shrink-0 items-center gap-2 sm:justify-end"
                    >
                        <Link
                            :href="edit(tag.id)"
                            class="border-primary/30 text-primary hover:border-primary hover:bg-popover inline-flex items-center gap-2 border px-3 py-2 font-mono text-xs transition"
                        >
                            <Pencil class="size-3.5" />
                            Edit
                        </Link>
                    </div>
                </div>
            </div>

            <div v-else class="px-6 py-16 text-center">
                <TagIcon class="mx-auto size-9 text-[#71866A]" />

                <h3 class="text-primary mt-4 font-serif text-xl font-bold">
                    No tags yet
                </h3>

                <p class="text-primary/65 mt-2 text-sm">
                    Create your first tag to organize your projects.
                </p>
            </div>

            <footer
                class="border-primary/25 text-primary/55 border-t border-dashed px-5 py-3 font-mono text-xs"
            >
                END OF TAG INDEX
            </footer>
        </section>
    </main>
</template>
