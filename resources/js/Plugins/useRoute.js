import { usePage } from '@inertiajs/vue3';
import { route } from 'ziggy-js';
import { computed } from 'vue';

export function useRoute() {
    const page = usePage();
    const locale = computed(() => page.props.locale);

    return (name, params, absolute, config) => {
        return route(
            `${locale.value}.${name}`,
            params,
            absolute,
            config
        );
    };
}

export function useRouteCurrent() {
    const page = usePage();
    const locale = computed(() => page.props.locale);

    return (name) => {
        return route().current(`${locale.value}.${name}`);
    };
}

export default {
    install(app) {
        const page = usePage();
        const locale = computed(() => page.props.locale);

        app.config.globalProperties.$route = (name, params, absolute, config) => {
            return route(
                `${locale.value}.${name}`,
                params,
                absolute,
                config
            );
        };

        app.config.globalProperties.$routeCurrent = (name) => {
            return route().current(`${locale.value}.${name}`);
        };
    }
};
