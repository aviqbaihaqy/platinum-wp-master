// import { createApp, h } from "vue";
// import { createInertiaApp, Link, Head } from "@inertiajs/inertia-vue";
import Vue from 'vue';
import { Inertia } from '@inertiajs/inertia';
import { App as InertiaApp, plugin as InertiaPlugin } from '@inertiajs/inertia-vue';
import NProgress from 'nprogress';

import { ZiggyVue } from "ziggy";
import { Ziggy } from "./ziggy";

// InertiaProgress.init();

// createInertiaApp({
//     resolve: async (name) => {
//         return (await import(`./Pages/${name}`)).default;
//     },
//     setup({ el, App, props, plugin }) {
//         createApp({ render: () => h(App, props) })
//             .use(plugin)
//             .use(ZiggyVue, Ziggy)
//             .component("Link", Link)
//             .component("Head", Head)
//             .mixin({ methods: { route } })
//             .mount(el);
//     },
// });

const app = document.getElementById('app');

Inertia.on('start', () => {
    timeout = setTimeout(() => NProgress.start(), 250)
});

Inertia.on('progress', (event) => {
    if (NProgress.isStarted() && event.detail.progress.percentage) {
        NProgress.set((event.detail.progress.percentage / 100) * 0.9)
    }
});

Inertia.on('finish', (event) => {
    clearTimeout(timeout)
    if (!NProgress.isStarted()) {
        return
    } else if (event.detail.visit.completed) {
        NProgress.done()
    } else if (event.detail.visit.interrupted) {
        NProgress.set(0)
    } else if (event.detail.visit.cancelled) {
        NProgress.done()
        NProgress.remove()
    }
});

window.App = new Vue({
    store,
    metaInfo: {
        title: '',
        titleTemplate: '%s'
    },
    render: (h) =>
        h(InertiaApp, {
            props: {
                initialPage: JSON.parse(app.dataset.page),
                resolveComponent: async (name) => (await import(`./Pages/${name}`)).default,
            },
        }),
}).$mount(app);
