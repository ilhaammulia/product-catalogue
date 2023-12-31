import "./bootstrap";
import "../css/app.css";
import "flowbite/dist/flowbite.js";

import "@fancyapps/ui/dist/carousel/carousel.css";
import "@fancyapps/ui/dist/carousel/carousel.thumbs.css";

import PrimeVue from "primevue/config";
import ConfirmationService from "primevue/confirmationservice";

import { createApp, h } from "vue";
import { createInertiaApp } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { ZiggyVue } from "../../vendor/tightenco/ziggy/dist/vue.m";

import store from "./store/index.js";

import { OhVueIcon, addIcons } from "oh-vue-icons";
import * as CiIcons from "oh-vue-icons/icons/ci";

addIcons(...Object.values({ ...CiIcons }));

const appName = import.meta.env.VITE_APP_NAME || "Laravel";

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .use(ZiggyVue)
            .use(store)
            .use(PrimeVue)
            .use(ConfirmationService)
            .component("v-icon", OhVueIcon)
            .mount(el);
    },
    progress: {
        color: "#4B5563",
    },
});
