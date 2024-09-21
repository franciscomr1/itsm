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
                    'background':'#f5f5f5',
                    'container':'#ffffff',
                    'container-variant':'#ebebeb',
                    'accent':'#3584e4',
                    'primary':'#191919',
                    'secondary':'#404040',
                    'tertiary':'#666666',

                },
                dark:{
                    'background':'#292929',
                    'container':'#333333',
                    'container-variant':'#212121',
                    'accent':'#3584e4',
                    'primary':'#e6e6e6',
                    'secondary':'#bfbfbf',
                    'tertiary':'#999999',

                },
            },
        },
    },

    plugins: [forms, typography],
};
