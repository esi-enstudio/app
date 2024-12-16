import { createApp, h } from 'vue';
import {createInertiaApp, Head, Link} from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import { createVuetify } from 'vuetify';
import * as components from 'vuetify/components';
import * as directives from 'vuetify/directives';
import '@mdi/font/css/materialdesignicons.css';
import '../css/app.css';
import './bootstrap';
import 'preline';
import 'vuetify/styles';

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

// const customIcons = {
//     email: '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 17.93c-4.26-.47-7.66-3.87-8.13-8.13H3v-1h1.02c.47-4.26 3.87-7.66 8.13-8.13V3h1v1.02c4.26.47 7.66 3.87 8.13 8.13H21v1h-1.02c-.47 4.26-3.87 7.66-8.13 8.13V21h-1v-1.07z"></path></svg>',
// };

const vuetify = createVuetify({
    icons: {
        defaultSet: 'mdi', // Use Material Design Icons
        // sets: {
        //     custom: customIcons,
        // },
    },
    components,
    directives,
});

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob('./Pages/**/*.vue'),
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(vuetify)
            .use(ZiggyVue)
            .component('Head', Head)
            .component('Link', Link)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
