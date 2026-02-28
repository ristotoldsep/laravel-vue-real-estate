import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m';
import PrimeVue from 'primevue/config';
import Lara from '@/presets/lara';      //import preset
import VueSplide from '@splidejs/vue-splide';
import VueSmoothScroll from 'vue3-smooth-scroll'
import ToastService from 'primevue/toastservice';
import ConfirmationService from 'primevue/confirmationservice';
import VueWebpImage from 'vue-webp-image';
import { createI18n } from 'vue-i18n'
import routePlugin from './Plugins/useRoute'
import components from './components';

import messages from '@intlify/unplugin-vue-i18n/messages'

const appName = import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue')),
    setup({ el, App, props, plugin }) {
        const i18n = createI18n({
            legacy: false,
            locale: props.initialPage.props.locale,
            fallbackLocale: 'et',
            messages,
            missing: (_locale, key) => key,
            missingWarn: false,
            fallbackWarn: false,
        })
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(i18n)
            .use(PrimeVue, {
                unstyled: true,
                pt: Lara
            })
            .use(VueSmoothScroll)
            .use(components)
            .use(ToastService)
            .use(ConfirmationService)
            .use(routePlugin)
            .use(ZiggyVue)
            .use(VueSplide)
            .use(VueWebpImage)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});
