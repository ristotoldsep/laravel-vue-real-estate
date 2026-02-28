import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.{vue,js}',
    ],

    theme: {
        extend: {
            screens: {
                'custom': '872px',
            },
            fontFamily: {
                sans: ["Displace2", ...defaultTheme.fontFamily.sans],
                quicksand: ['Quicksand', 'sans-serif'],
                piazolla: ['Piazolla', 'serif'],
            },
            colors: {
                primary: {
                    50: "#EFEDEB",
                    100: "#DDD8D5",
                    200: "#BBB1AA",
                    300: "#998B80",
                    400: "#71655B",
                    500: "#473F39",
                    600: "#39322D",
                    700: "#2A2622",
                    800: "#1C1917",
                    900: "#0E0D0B",
                    950: "#080807",
                },
                surface: {
                    0: "#FFFFFF",
                    50: "#F9FAFB",
                    100: "#F3F4F6",
                    200: "#E5E7EB",
                    300: "#D1D5DB",
                    400: "#9CA3AF",
                    500: "#6B7280",
                    600: "#4B5563",
                    700: "#374151",
                    800: "#1F2937",
                    900: "#111827",
                }
            },
        },
    },

    plugins: [forms],
};
