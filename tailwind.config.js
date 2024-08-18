import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
        'node_modules/preline/dist/*.js',
        './node_modules/preline/preline.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Roboto', ...defaultTheme.fontFamily.sans],
            },
        },

        container: {
            center: true,
            screens: {
                sm: '540px',
                md: '720px',
                lg: '960px',
                xl: '1140px',
            },
        },
    },

    plugins: [
        forms, 
        require('preline/plugin')
    ],
};
