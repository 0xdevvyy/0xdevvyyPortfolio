```vue
<script setup lang="ts">
import { Link } from '@inertiajs/vue3';
import {
    ArrowLeft,
    ArrowUpRight,
    Check,
    ExternalLink,
    X,
} from '@lucide/vue';
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';
import { index } from '@/routes/project';

interface Screenshot {
    id: number;
    path: string;
}

const screenshots: Screenshot[] = [
    {
        id: 1,
        path: '/images/projects/placeholder-1.png',
    },
    {
        id: 2,
        path: '/images/projects/placeholder-2.png',
    },
    {
        id: 3,
        path: '/images/projects/placeholder-3.png',
    },
];

const tags = [
    'Laravel',
    'Vue',
    'Inertia',
    'Tailwind CSS',
];

const features = [
    'User authentication and account management',
    'Responsive and accessible interface',
    'CRUD operations and data management',
    'Role-based functionality',
    'Clean and reusable component structure',
];

const selectedScreenshot = ref<Screenshot | null>(null);

const openScreenshot = (screenshot: Screenshot) => {
    selectedScreenshot.value = screenshot;
};

const closeScreenshot = () => {
    selectedScreenshot.value = null;
};

const handleKeydown = (event: KeyboardEvent) => {
    if (event.key === 'Escape') {
        closeScreenshot();
    }
};

watch(selectedScreenshot, (screenshot) => {
    document.body.style.overflow = screenshot ? 'hidden' : '';
});

onMounted(() => {
    window.addEventListener('keydown', handleKeydown);
});

onBeforeUnmount(() => {
    window.removeEventListener('keydown', handleKeydown);
    document.body.style.overflow = '';
});
</script>

<template>
    <main
        class="relative min-h-screen overflow-hidden bg-paper px-5 py-8 text-ink sm:px-8 lg:px-12"
    >
        <div class="pointer-events-none absolute inset-0 opacity-30">
            <div
                class="absolute inset-0 bg-[linear-gradient(90deg,transparent_98%,rgba(23,59,92,0.06)_100%),linear-gradient(0deg,transparent_98%,rgba(23,59,92,0.06)_100%)] bg-[size:24px_24px]"
            />
        </div>

        <div class="relative mx-auto max-w-6xl">
            <!-- Back -->
            <Link
                :href="index().url"
                class="group mb-8 inline-flex items-center gap-2 font-mono text-[10px] text-ink/65 transition-colors hover:text-sage sm:mb-10"
            >
                <ArrowLeft
                    :size="14"
                    class="transition-transform group-hover:-translate-x-1"
                />

                Back to Projects
            </Link>

            <article>
                <!-- Project Preview -->
                <section class="relative">
                    <div
                        class="absolute inset-2 rotate-[-1deg] border border-ink/20 sm:inset-4"
                    />

                    <div
                        class="relative rotate-[0.4deg] border-2 border-ink bg-paper-light p-2 shadow-[6px_7px_0_0_var(--ink)] sm:p-3"
                    >
                        <div
                            class="aspect-[16/9] overflow-hidden border border-ink/30 bg-paper-dark"
                        >
                            <div
                                class="flex h-full items-center justify-center"
                            >
                                <span
                                    class="font-hand text-2xl text-ink/40 sm:text-4xl"
                                >
                                    project preview
                                </span>
                            </div>
                        </div>
                    </div>

                    <div
                        class="absolute -bottom-3 -right-1 hidden rotate-[-4deg] font-hand text-sm text-ink/60 sm:block lg:-right-4"
                    >
                        project preview
                    </div>
                </section>

                <!-- Project Heading -->
                <section class="relative py-12 sm:py-16">
                    <div
                        class="grid gap-8 md:grid-cols-[1fr_auto] md:items-end"
                    >
                        <div>
                            <p
                                class="mb-3 font-mono text-[9px] uppercase tracking-[0.2em] text-sage"
                            >
                                Project
                            </p>

                            <h1
                                class="max-w-4xl font-display text-4xl leading-[1.05] sm:text-5xl lg:text-6xl"
                            >
                                Sample Project
                            </h1>

                            <p
                                class="mt-5 max-w-2xl font-mono text-xs leading-6 text-ink/70 sm:text-sm"
                            >
                                A short placeholder description for the project.
                                This will eventually come from the database.
                            </p>

                            <div class="mt-6 flex flex-wrap gap-2">
                                <span
                                    v-for="tag in tags"
                                    :key="tag"
                                    class="rounded-full border border-ink/45 bg-paper-light px-3 py-1.5 font-mono text-[9px] text-ink sm:text-[10px]"
                                >
                                    {{ tag }}
                                </span>
                            </div>
                        </div>

                        <a
                            href="#"
                            class="group relative inline-flex w-fit items-center gap-3 border-2 border-ink bg-paper-light px-5 py-3 font-hand text-base shadow-[4px_4px_0_0_var(--ink)] transition-all hover:-translate-y-1 hover:shadow-[6px_6px_0_0_var(--ink)] md:mb-1"
                        >
                            View Live Site

                            <ArrowUpRight
                                :size="17"
                                class="transition-transform group-hover:-translate-y-0.5 group-hover:translate-x-0.5"
                            />

                            <ExternalLink
                                :size="11"
                                class="absolute -right-2 -top-2 rotate-12"
                            />
                        </a>
                    </div>
                </section>

                <!-- About + Features -->
                <section
                    class="grid gap-10 border-y border-ink/15 py-10 md:grid-cols-[1.2fr_0.8fr] md:gap-14 md:py-12"
                >
                    <!-- About -->
                    <div>
                        <div class="mb-4 inline-block">
                            <h2
                                class="font-hand text-2xl leading-tight sm:text-3xl"
                            >
                                About the project
                            </h2>

                            <div
                                class="mt-1 h-[2px] w-full rotate-[-1deg] bg-ink/65"
                            />
                        </div>

                        <p
                            class="max-w-2xl font-mono text-[11px] leading-7 text-ink/75 sm:text-xs sm:leading-8"
                        >
                            This is placeholder project content. The actual
                            project description will be added later once the
                            database integration is connected.
                        </p>
                    </div>

                    <!-- Features -->
                    <div>
                        <div class="mb-4 inline-block">
                            <h2
                                class="font-hand text-2xl leading-tight sm:text-3xl"
                            >
                                Key features
                            </h2>

                            <div
                                class="mt-1 h-[2px] w-full rotate-[1deg] bg-ink/65"
                            />
                        </div>

                        <ul class="space-y-3">
                            <li
                                v-for="(feature, featureIndex) in features"
                                :key="`${featureIndex}-${feature}`"
                                class="flex items-start gap-3 font-mono text-[10px] leading-5 text-ink/75 sm:text-[11px]"
                            >
                                <span
                                    class="mt-1 flex h-4 w-4 shrink-0 items-center justify-center border border-ink/50"
                                >
                                    <Check
                                        :size="9"
                                        :stroke-width="2"
                                    />
                                </span>

                                <span>{{ feature }}</span>
                            </li>
                        </ul>
                    </div>
                </section>

                <!-- Built With -->
                <section class="py-10 sm:py-12">
                    <div
                        class="flex flex-col gap-5 sm:flex-row sm:items-center sm:justify-between"
                    >
                        <div>
                            <div class="inline-block">
                                <h2
                                    class="font-hand text-2xl leading-tight sm:text-3xl"
                                >
                                    Built with
                                </h2>

                                <div
                                    class="mt-1 h-[2px] w-full rotate-[1deg] bg-ink/65"
                                />
                            </div>
                        </div>

                        <div
                            class="flex flex-wrap gap-2 sm:justify-end"
                        >
                            <span
                                v-for="tag in tags"
                                :key="tag"
                                class="border border-ink/45 bg-paper-light px-3 py-1.5 font-mono text-[9px] text-ink sm:text-[10px]"
                            >
                                {{ tag }}
                            </span>
                        </div>
                    </div>
                </section>

                <!-- Screenshots -->
                <section class="pb-12 sm:pb-16">
                    <div
                        class="mb-7 flex items-end justify-between gap-5"
                    >
                        <div>
                            <div class="inline-block">
                                <h2
                                    class="font-hand text-2xl leading-tight sm:text-3xl"
                                >
                                    Screenshots
                                </h2>

                                <div
                                    class="mt-1 h-[2px] w-full rotate-[-1deg] bg-ink/65"
                                />
                            </div>

                            <p
                                v-if="screenshots.length > 1"
                                class="mt-3 font-mono text-[8px] text-ink/40 sm:text-[9px]"
                            >
                                Scroll sideways to see more
                            </p>
                        </div>

                        <span
                            class="hidden font-mono text-[8px] uppercase tracking-wider text-ink/40 sm:block"
                        >
                            {{ screenshots.length }}
                            {{ screenshots.length === 1 ? 'image' : 'images' }}
                        </span>
                    </div>

                    <!-- Horizontal Gallery -->
                    <div
                        class="-mx-5 overflow-x-auto px-5 pb-6 sm:-mx-8 sm:px-8 lg:-mx-12 lg:px-12"
                    >
                        <div
                            class="flex w-max gap-6 pr-5 sm:gap-8"
                        >
                            <button
                                v-for="(screenshot, screenshotIndex) in screenshots"
                                :key="screenshot.id"
                                type="button"
                                class="group relative w-[82vw] max-w-[700px] shrink-0 cursor-zoom-in text-left sm:w-[65vw] lg:w-[600px]"
                                :aria-label="`Open screenshot ${screenshotIndex + 1}`"
                                @click="openScreenshot(screenshot)"
                            >
                                <div
                                    class="absolute inset-0 border border-ink/20"
                                    :class="
                                        screenshotIndex % 2 === 0
                                            ? 'translate-x-2 translate-y-2 rotate-[1deg]'
                                            : '-translate-x-1 translate-y-2 rotate-[-1deg]'
                                    "
                                />

                                <div
                                    class="relative border-2 border-ink bg-paper-light p-2 transition-transform duration-300 group-hover:-translate-y-1 sm:p-3"
                                    :class="
                                        screenshotIndex % 2 === 0
                                            ? 'rotate-[-0.5deg]'
                                            : 'rotate-[0.5deg]'
                                    "
                                >
                                    <div
                                        class="aspect-[16/10] overflow-hidden border border-ink/30 bg-paper-dark"
                                    >
                                        <img
                                            :src="screenshot.path"
                                            :alt="`Sample Project screenshot ${screenshotIndex + 1}`"
                                            class="h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.02]"
                                            loading="lazy"
                                        />
                                    </div>

                                    <div
                                        class="flex items-center justify-between pt-2 font-mono text-[8px] uppercase tracking-wider text-ink/40"
                                    >
                                        <span>
                                            Screenshot
                                        </span>

                                        <span>
                                            {{
                                                String(
                                                    screenshotIndex + 1,
                                                ).padStart(2, '0')
                                            }}
                                        </span>
                                    </div>
                                </div>
                            </button>
                        </div>
                    </div>
                </section>

                <!-- Bottom -->
                <section
                    class="flex flex-col items-start justify-between gap-5 border-t border-ink/15 py-8 sm:flex-row sm:items-center"
                >
                    <p
                        class="rotate-[-2deg] font-hand text-lg text-ink/60"
                    >
                        That's it for this project.
                    </p>

                    <Link
                        :href="index().url"
                        class="group inline-flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.15em] text-ink/65 transition-colors hover:text-sage"
                    >
                        <ArrowLeft
                            :size="13"
                            class="transition-transform group-hover:-translate-x-1"
                        />

                        All Projects
                    </Link>
                </section>
            </article>
        </div>

        <!-- Screenshot Lightbox -->
        <Transition
            enter-active-class="duration-200 ease-out"
            enter-from-class="opacity-0"
            enter-to-class="opacity-100"
            leave-active-class="duration-150 ease-in"
            leave-from-class="opacity-100"
            leave-to-class="opacity-0"
        >
            <div
                v-if="selectedScreenshot"
                class="fixed inset-0 z-50 flex items-center justify-center bg-[#102D47]/90 p-4 backdrop-blur-sm sm:p-8"
                @click.self="closeScreenshot"
            >
                <!-- Close -->
                <button
                    type="button"
                    aria-label="Close screenshot"
                    class="absolute right-4 top-4 z-10 flex h-10 w-10 items-center justify-center border-2 border-paper bg-paper-light text-ink shadow-[3px_3px_0_0_var(--paper)] transition-transform hover:rotate-3 sm:right-8 sm:top-8"
                    @click="closeScreenshot"
                >
                    <X :size="19" />
                </button>

                <!-- Image -->
                <div
                    class="relative max-h-[90vh] max-w-[95vw] sm:max-w-[90vw]"
                >
                    <div
                        class="absolute inset-0 translate-x-2 translate-y-2 rotate-[-1deg] border-2 border-paper/40"
                    />

                    <div
                        class="relative max-h-[90vh] overflow-hidden border-2 border-ink bg-paper-light p-2 shadow-[6px_7px_0_0_rgba(0,0,0,0.25)] sm:p-3"
                    >
                        <img
                            :src="selectedScreenshot.path"
                            alt="Sample Project screenshot"
                            class="max-h-[84vh] max-w-[90vw] object-contain"
                        />
                    </div>
                </div>

                <!-- Hint -->
                <p
                    class="absolute bottom-4 left-1/2 -translate-x-1/2 font-mono text-[8px] uppercase tracking-[0.15em] text-paper/60 sm:bottom-7"
                >
                    Click outside or press ESC to close
                </p>
            </div>
        </Transition>
    </main>
</template>
```
