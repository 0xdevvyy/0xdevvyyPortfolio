<script setup lang="ts">
import { X } from '@lucide/vue';
import { onBeforeUnmount, onMounted, ref, watch } from 'vue';

interface Screenshot {
    id: number;
    screenshotPath: string;
}

const props = defineProps<{
    screenshots: Screenshot[];
    projectTitle: string;
}>();

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
    <button
        v-if="screenshots[0]"
        type="button"
        class="group block h-full w-full cursor-zoom-in text-left"
        :aria-label="`Open ${projectTitle} screenshot`"
        @click="openScreenshot(screenshots[0])"
    >
        <img
            :src="screenshots[0].screenshotPath"
            :alt="`${projectTitle} screenshot`"
            class="block h-full w-full object-cover object-top transition-transform duration-500 group-hover:scale-[1.02]"
            loading="lazy"
        />
    </button>

    <Teleport to="body">
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
                class="bg-ink/20 fixed inset-0 z-50 flex items-center justify-center p-4 backdrop-blur-md sm:p-8"
                @click.self="closeScreenshot"
            >
                <!-- Glass layer -->
                <div
                    class="pointer-events-none absolute inset-0 bg-white/10"
                ></div>

                <!-- Close -->
                <button
                    type="button"
                    aria-label="Close screenshot"
                    class="text-ink absolute top-4 right-4 z-20 flex h-10 w-10 cursor-pointer items-center justify-center rounded-full border border-white/50 bg-white/30 shadow-lg backdrop-blur-md transition-all hover:rotate-3 hover:bg-white/50 sm:top-8 sm:right-8"
                    @click="closeScreenshot"
                >
                    <X :size="19" />
                </button>

                <!-- Image -->
                <div
                    class="relative z-10 max-h-[90vh] max-w-[95vw] sm:max-w-[90vw]"
                >
                    <!-- Offset glass border -->
                    <div
                        class="absolute inset-0 translate-x-2 translate-y-2 rotate-[-1deg] rounded-sm border border-white/40"
                    ></div>

                    <!-- Screenshot frame -->
                    <div
                        class="relative max-h-[90vh] overflow-hidden rounded-sm border border-white/60 bg-white/20 p-2 shadow-[0_20px_60px_rgba(0,0,0,0.18)] backdrop-blur-xl sm:p-3"
                    >
                        <img
                            :src="selectedScreenshot.screenshotPath"
                            :alt="`${projectTitle} screenshot`"
                            class="max-h-[84vh] max-w-[90vw] object-contain"
                        />
                    </div>
                </div>

                <!-- Hint -->
                <p
                    class="text-ink/50 absolute bottom-4 left-1/2 z-10 -translate-x-1/2 font-mono text-[8px] tracking-[0.15em] whitespace-nowrap uppercase sm:bottom-7"
                >
                    Click outside · press ESC · or click X
                </p>
            </div>
        </Transition>
    </Teleport>
</template>
