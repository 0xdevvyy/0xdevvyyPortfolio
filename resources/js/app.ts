import { createInertiaApp } from '@inertiajs/vue3';
import AppLayout from './components/layouts/AppLayout.vue';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

void createInertiaApp({
    title: (title) => (title ? `${title} - ${appName}` : appName),
    layout(name) {
        switch (true) {
            case name.startsWith('landing/'):
                return AppLayout;
            // case name.startsWith('project/'):
            //     return AppLayout;
            default:
                return AppLayout;

        }
    },
    progress: {
        color: '#4B5563',
    },
});
