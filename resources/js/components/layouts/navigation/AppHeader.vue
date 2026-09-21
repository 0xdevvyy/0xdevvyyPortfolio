<script setup lang="ts">
import { ref } from 'vue'
import NavigationLogo from '@/components/ui/navigations/NavigationLogo.vue';
import NavigationLink from '@/components/ui/navigations/NavigationLink.vue';

const isMenuOpen = ref(false)

const items = [
    { name: 'Me', href: '#home' },
    { name: 'Projects', href: '#work' }, //will add the wayfinder routes
    { name: 'About Me', href: '#about' },
    { name: 'Contact', href: '#contact' },
]
</script>

<template>
    <header class="w-full px-6 py-6 md:px-10 border-b border-ink">
        <div class="mx-auto flex max-w-7xl items-center justify-between">
            <!-- Logo -->
            <NavigationLogo />

            <!-- Desktop Navigation -->
            <nav class="hidden items-center gap-8 md:flex">
                <NavigationLink 
                    v-for="item in items"
                    :key="item.name"
                    :label="item.name"
                    :url="item.href"
                />
            </nav>

            <!-- Menu Button -->
            <button
                type="button"
                class="font-doodle text-lg text-ink md:hidden"
                @click="isMenuOpen = !isMenuOpen"
            >
                {{ isMenuOpen ? 'CLOSE' : 'MENU' }}
            </button>
        </div>

        <!-- Mobile Navigation -->
        <nav
            v-if="isMenuOpen"
            class="mx-auto mt-8 flex max-w-7xl flex-col gap-5 border-t border-ink/20 pt-6 md:hidden"
        >
            <a
                v-for="item in items"
                :key="item.name"
                :href="item.href"
                class="font-doodle text-2xl text-ink"
                @click="isMenuOpen = false"
            >
                {{ item.name }}
            </a>
        </nav>
    </header>
</template>