<script setup lang="ts">
import { onMounted, ref } from 'vue';

const emit = defineEmits<{
    complete: [];
}>();

const intro = ref(false);
const progress = ref(0);

onMounted(() => {
    const storageKey = 'portfolio-intro-played';

    if (sessionStorage.getItem(storageKey) === 'true') {
        emit('complete');
        return;
    }

    sessionStorage.setItem(storageKey, 'true');

    intro.value = true;

    const duration = 2200;
    const start = performance.now();

    const animate = (now: number) => {
        const elapsed = now - start;

        progress.value = Math.min(elapsed / duration, 1);

        if (progress.value < 1) {
            requestAnimationFrame(animate);
        } else {
            setTimeout(() => {
                intro.value = false;
                emit('complete');
            }, 700);
        }
    };

    requestAnimationFrame(animate);
});
</script>

<template>
    <Transition name="intro">
        <div
            v-if="intro"
            class="portfolio-intro"
        >
            <div class="intro-content">

                <div class="word-wrapper">

                    <!-- Outline -->
                    <svg
                        class="word-outline"
                        viewBox="0 0 1000 220"
                        preserveAspectRatio="xMidYMid meet"
                    >
                        <text
                            x="500"
                            y="160"
                            text-anchor="middle"
                        >
                            0xdevvy
                        </text>
                    </svg>

                    <!-- Animated Fill -->
                    <svg
                        class="word-fill"
                        viewBox="0 0 1000 220"
                        preserveAspectRatio="xMidYMid meet"
                    >
                        <defs>
                            <clipPath id="fillClip">
                                <rect
                                    x="0"
                                    y="0"
                                    :width="progress * 1000"
                                    height="220"
                                />
                            </clipPath>
                        </defs>

                        <text
                            x="500"
                            y="160"
                            text-anchor="middle"
                            clip-path="url(#fillClip)"
                        >
                            0xdevvy
                        </text>
                    </svg>

                </div>

            </div>
        </div>
    </Transition>
</template>

<style scoped>
.portfolio-intro {
    position: fixed;
    inset: 0;
    z-index: 9999;

    display: flex;
    align-items: center;
    justify-content: center;

    overflow: hidden;

    background: #f4efdf;
    color: #173b5c;
}

.intro-content {
    width: min(900px, 88vw);
}

.word-wrapper {
    position: relative;

    width: 100%;
    max-width: 900px;

    aspect-ratio: 1000 / 220;
}

.word-outline,
.word-fill {
    position: absolute;
    inset: 0;

    width: 100%;
    height: 100%;

    overflow: visible;
}

.word-outline text,
.word-fill text {
    font-family: 'Permanent Marker', cursive;
    font-size: 150px;
    font-weight: 400;
    letter-spacing: -8px;
}

.word-outline text {
    fill: transparent;
    stroke: #173b5c;
    stroke-width: 2;
    opacity: 0.22;
}

.word-fill text {
    fill: #173b5c;
}

/* Intro transition */

.intro-enter-active {
    transition:
        opacity 0.4s ease,
        transform 0.7s cubic-bezier(.2, .8, .2, 1);
}

.intro-leave-active {
    transition:
        opacity 0.7s ease,
        transform 0.9s cubic-bezier(.2, .8, .2, 1);
}

.intro-enter-from {
    opacity: 0;
    transform: scale(1.03);
}

.intro-leave-to {
    opacity: 0;
    transform: scale(1.08);
}

/* Mobile */

@media (max-width: 640px) {
    .word-outline text,
    .word-fill text {
        font-size: 145px;
    }

    .intro-content {
        width: 92vw;
    }
}

</style>
