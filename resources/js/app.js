// import '../css/app.css';
import './bootstrap';

import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { createApp, h } from 'vue';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import Toast, { POSITION } from 'vue-toastification'; // Import Toast and POSITION
import 'vue-toastification/dist/index.css'; // Import Toastification styles

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        // Create the Vue app
        const app = createApp({ render: () => h(App, props) });

        // Use Inertia plugin
        app.use(plugin);

        // Use Ziggy for route management
        app.use(ZiggyVue);

        // Use Vue Toastification plugin and set options
        app.use(Toast, {
            position: POSITION.TOP_RIGHT,  // Set toast position
            timeout: 3000,                // Set default timeout for toasts
        });

        // Mount the Vue app
        app.mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
