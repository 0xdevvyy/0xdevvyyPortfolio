<script setup lang="ts">
import { onMounted, onUnmounted, ref } from 'vue';
import NavigationLogo from '@/components/ui/navigations/NavigationLogo.vue';
import NavigationLink from '@/components/ui/navigations/NavigationLink.vue';
import { aboutMe, home } from '@/routes';
import { Link } from '@inertiajs/vue3';

const isMenuOpen = ref(false);
const isVisible = ref(true);

let lastScrollY = 0;

const items = [
    { name: 'Me', href: home() },
    { name: 'Projects', href: '#work' },
    { name: 'About Me', href: aboutMe() },
    { name: 'Contact', href: '#contact' },
];

const handleScroll = () => {
    const currentScrollY = window.scrollY;

    if (currentScrollY <= 10) {
        isVisible.value = true;
    } else if (currentScrollY < lastScrollY) {
        isVisible.value = true;
    } else if (currentScrollY > lastScrollY) {
        isVisible.value = false;
        isMenuOpen.value = false;
    }

    lastScrollY = currentScrollY;
};

onMounted(() => {
    lastScrollY = window.scrollY;
    window.addEventListener('scroll', handleScroll, { passive: true });
});

onUnmounted(() => {
    window.removeEventListener('scroll', handleScroll);
});
</script>

<template>
    <header
        class="sticky top-0 z-50 w-full transition-transform duration-500 ease-out"
        :class="isVisible ? 'translate-y-0' : '-translate-y-full'"
    >
        <div class="px-6 py-5 md:px-10">
            <div
                class="border-ink/20 mx-auto flex max-w-7xl items-center justify-between border-b pb-5"
            >
                <NavigationLogo />

                <nav class="hidden items-center gap-8 md:flex">
                    <NavigationLink
                        v-for="item in items"
                        :key="item.name"
                        :label="item.name"
                        :url="item.href"
                    />
                </nav>

                <button
                    type="button"
                    class="font-doodle text-ink text-lg md:hidden"
                    @click="isMenuOpen = !isMenuOpen"
                >
                    {{ isMenuOpen ? 'CLOSE' : 'MENU' }}
                </button>
            </div>

            <nav
                v-if="isMenuOpen"
                class="border-ink/20 mx-auto flex max-w-7xl flex-col gap-5 border-b pt-5 pb-6 md:hidden"
            >
                <Link
                    v-for="item in items"
                    :key="item.name"
                    :href="item.href"
                    class="font-doodle text-ink text-2xl"
                    @click="isMenuOpen = false"
                >
                    <p>{{ item.name }}</p>
                </Link>
            </nav>
        </div>
    </header>
</template>
