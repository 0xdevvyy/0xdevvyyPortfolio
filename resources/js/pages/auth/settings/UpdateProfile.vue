<script setup lang="ts">
import { Head, useForm } from '@inertiajs/vue3';
import Input from '@/components/ui/input/Text.vue';
import PasswordInput from '@/components/ui/input/Password.vue';
import Email from '@/components/ui/input/Email.vue';

const props = defineProps<{
    email: string;
}>();

const form = useForm({
    email: props.email,
    current_password: '',
    password: '',
    password_confirmation: '',
});

function updateSettings() {
    form.put('/settings/profile', {
        preserveScroll: true,
        onSuccess: () =>
            form.reset('current_password', 'password', 'password_confirmation'),
    });
}
</script>

<template>
    <Head title="Account settings" />

    <main class="mx-auto w-full max-w-3xl space-y-8 px-4 py-8 sm:px-6">
        <header class="border-border border-b border-dashed pb-6">
            <p
                class="text-secondary font-mono text-xs tracking-[0.2em] uppercase"
            >
                Account
            </p>
            <h1
                class="font-display text-primary mt-2 text-3xl font-bold sm:text-4xl"
            >
                Account settings<span class="text-destructive">.</span>
            </h1>
            <p class="text-muted-foreground mt-2 text-sm">
                Update the email address and password you use to sign in.
            </p>
        </header>

        <form class="editor-panel space-y-6" @submit.prevent="updateSettings">
            <div>
                <h2 class="panel-title">Email address</h2>
                <p class="panel-description">
                    Use a valid email address for your account.
                </p>
            </div>

            <Email
                v-model="form.email"
                label="Email"
                placeholder="you@example.com"
                :error="form.errors.email"
            />

            <div>
                <h2 class="panel-title">Change password</h2>
                <p class="panel-description">
                    Leave these fields blank to keep your current password.
                </p>
            </div>

            <PasswordInput
                id="current_password"
                name="current_password"
                autocomplete="current-password"
                label="Current password"
                placeholder="Enter your current password"
                v-model="form.current_password"
                :required="Boolean(form.password)"
                :error="form.errors.current_password"
            />

            <PasswordInput
                id="password"
                name="password"
                autocomplete="new-password"
                label="New password"
                placeholder="Enter a new password"
                hint="Use at least 8 characters."
                v-model="form.password"
                :required="Boolean(form.password)"
                :error="form.errors.password"
            />

            <PasswordInput
                id="password_confirmation"
                name="password_confirmation"
                autocomplete="new-password"
                label="Confirm new password"
                placeholder="Enter the new password again"
                v-model="form.password_confirmation"
                :required="Boolean(form.password)"
                :error="form.errors.password_confirmation"
            />

            <footer class="editor-footer">
                <button
                    type="submit"
                    :disabled="form.processing"
                    class="editor-button editor-button-primary"
                >
                    {{ form.processing ? 'Saving...' : 'Save changes' }}
                </button>
            </footer>
        </form>
    </main>
</template>
