import './bootstrap';
import '../css/app.css'
import 'primeicons/primeicons.css'

import { createApp, h } from 'vue'
import { createInertiaApp } from '@inertiajs/vue3'
import PrimeVue from 'primevue/config'
import ToastService from 'primevue/toastservice';

import { preset } from './themePreset'

createInertiaApp({
    resolve: name => {
        const pages = import.meta.glob('./Pages/**/*.vue', { eager: true })
        return pages[`./Pages/${name}.vue`]
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(PrimeVue, {
                theme: {
                    preset,
                    options: {
                        darkModeSelector: 'none',
                    }

                }
            })
            .use(ToastService)
            .mount(el)
    },
})
