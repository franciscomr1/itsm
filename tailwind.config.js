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
                sans: ['Cantarell', 'Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                light:{
                    'background':'#f5f5f5',
                    'container':'#ffffff',
                    'container-variant':'#ebebeb',
                    'accent':'#3584e4',
                    'accent-variant':'#1c71d8',
                    'primary':'#0a0a0a',
                    'secondary':'#333333',
                    'tertiary':'#5c5c5c',

                },
                dark:{
                    'background':'#1e1e1e',
                    'container':'#333333',
                    'container-variant':'#292929',
                    'accent':'#3584e4',
                    'accent-variant':'#1c71d8',
                    'primary':'#f5f5f5',
                    'secondary':'#cccccc',
                    'tertiary':'#a3a3a3',

                },
            },
        },
    },

    plugins: [forms, typography],
};
