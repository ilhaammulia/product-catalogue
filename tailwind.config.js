import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";
import typography from "@tailwindcss/typography";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./vendor/laravel/jetstream/**/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/js/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ["Figtree", ...defaultTheme.fontFamily.sans],
            },
            colors: {
                gold: {
                    50: "#f6f5f0",
                    100: "#e9e6d8",
                    200: "#d5ccb3",
                    300: "#bdac87",
                    400: "#a89063",
                    500: "#9a8058",
                    600: "#84684a",
                    700: "#6b513d",
                    800: "#5b4638",
                    900: "#503d33",
                    950: "#2d201b",
                },
                brown: {
                    100: "#f1ebe3",
                    200: "#e2d5c6",
                    300: "#cfbaa2",
                    400: "#ba9779",
                    500: "#ad8262",
                    600: "#a07056",
                    700: "#855b49",
                    800: "#6d4c3f",
                    900: "#593e35",
                    950: "#2f1f1b",
                },
                dark: {
                    primary: "#222222",
                    secondary: "#2B2B2B",
                },
            },
        },
    },

    plugins: [forms, typography, require("flowbite/plugin")],
};
