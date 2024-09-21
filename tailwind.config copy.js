import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                light:{
                    'primary':'#4b5c92',
                    'on.primary':'#ffffff',
                    'surface': '#faf8ff',
                    'surf.container':'#eeedf4',
                    'on.surface':'#1a1b21',
                    'on.surface.var':'#45464f',
                    'secondary.container':'#dde1f9',
                    'on.secondary.container':'#161b2c',
                    'outline':'#757680',
                    'error':'#ba1a1a',
                },
                dark:{
                    'primary':'#b4c5ff',
                    'on.primary':'#1b2d60',
                    'surface': '#121318',
                    'surf.container':'#1e1f25',
                    'on.surface':'#e3e2e9',
                    'on.surface.var':'#c5c6d0',
                    'secondary.container':'#414659',
                    'on.secondary.container':'#dde1f9',
                    'outline':'#8f909a',
                    'error':'#ffb4ab',
                },
            },
        },
    },

    plugins: [forms, typography],
};
