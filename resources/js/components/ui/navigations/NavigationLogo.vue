<script setup lang="ts">
import { Link } from "@inertiajs/vue3";

const imgSrc = "/images/star.png";
</script>

<template>
    <Link
        href="/"
        class="group flex items-center gap-4"
        aria-label="Oxdevyy Home"
    >
        <!-- Star -->
        <span
            class="relative flex h-10 w-10 items-center justify-center text-[38px] leading-none transition-transform duration-300 group-hover:-rotate-12"
        >
            <img :src="imgSrc" alt="logo" />
        </span>

        <!-- Logo -->
        <span
            class="relative text-[30px] font-bold leading-none tracking-tight"
        >
            Oxdevyy

            <!-- Underline -->
            <span
                class="absolute -bottom-2 left-0 h-[2px] w-full rotate-[-2deg] bg-ink"
            />
        </span>
    </Link>
</template>
