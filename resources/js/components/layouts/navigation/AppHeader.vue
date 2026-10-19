<script setup lang="ts">
import { computed, onMounted, onUnmounted, ref } from 'vue';
import { Link, useForm, usePage } from '@inertiajs/vue3';
import { LogOut } from '@lucide/vue';

import NavigationLogo from '@/components/ui/navigations/NavigationLogo.vue';
import NavigationLink from '@/components/ui/navigations/NavigationLink.vue';

import { aboutMe, contact, dashboard, home } from '@/routes';
import { index } from '@/routes/project';
import project from '@/routes/auth/project';
import tag from '@/routes/auth/tag';
import settings from '@/routes/auth/settings';

const isMenuOpen = ref(false);
const isVisible = ref(true);

let lastScrollY = 0;

const page = usePage();
const logoutForm = useForm({});

const isAuthenticated = computed(() => !!page.props.auth?.user);

function logout() {
    logoutForm.post('/auth/logout', {
        preserveScroll: true,
        onFinish: () => {
            isMenuOpen.value = false;
        },
    });
}

const items = computed(() => {
    const guestItems = [
        { name: 'Me', href: home() },
        { name: 'Projects', href: index() },
        { name: 'Blogs', href: '/blogs' },
        { name: 'About Me', href: aboutMe() },
        { name: 'Contact', href: contact() },
    ];

    const authenticatedItems = [
        { name: 'Dashboard', href: dashboard() },
        { name: 'Projects', href: project.index() },
        { name: 'Blogs', href: '/auth/blogs' },
        { name: 'Tags', href: tag.index() },
        { name: 'Settings', href: settings.index() },
    ];

    return isAuthenticated.value ? authenticatedItems : guestItems;
});

const handleScroll = () => {
    const currentScrollY = window.scrollY;

    if (currentScrollY <= 10 || currentScrollY < lastScrollY) {
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
                    v-if="isAuthenticated"
                    type="button"
                    class="group font-doodle hidden cursor-pointer items-center gap-2 rounded-full border border-red-300/60 px-4 py-2 text-sm text-red-700 transition-all duration-200 hover:border-red-500 hover:bg-red-50 hover:text-red-800 disabled:cursor-not-allowed disabled:opacity-50 md:flex"
                    :disabled="logoutForm.processing"
                    @click="logout"
                >
                    <LogOut
                        class="size-4 transition-transform duration-200 group-hover:translate-x-0.5"
                    />
                    <span>
                        {{
                            logoutForm.processing
                                ? 'Signing out...'
                                : 'Sign out'
                        }}
                    </span>
                </button>

                <button
                    type="button"
                    class="font-doodle text-ink hover:text-primary text-lg transition-colors md:hidden"
                    :aria-expanded="isMenuOpen"
                    aria-label="Toggle navigation menu"
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
                    class="font-doodle text-ink hover:text-primary text-2xl transition-colors"
                    @click="isMenuOpen = false"
                >
                    {{ item.name }}
                </Link>

                <button
                    v-if="isAuthenticated"
                    type="button"
                    class="group border-ink/15 font-doodle flex items-center gap-3 border-t pt-5 text-left text-xl text-red-700 transition-colors hover:text-red-900 disabled:cursor-not-allowed disabled:opacity-50"
                    :disabled="logoutForm.processing"
                    @click="logout"
                >
                    <LogOut
                        class="size-5 transition-transform duration-200 group-hover:translate-x-0.5"
                    />
                    <span>
                        {{
                            logoutForm.processing
                                ? 'Signing out...'
                                : 'Sign out'
                        }}
                    </span>
                </button>
            </nav>
        </div>
    </header>
</template>
