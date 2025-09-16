import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
                barcode: ['"Libre Barcode 128 Text"', 'sans-serif'],
                abril: ['"Abril Fatface"', 'cursive'],
                montserrat: ['"Montserrat"', 'sans-serif'],
                poppins: ['"Poppins"', 'sans-serif'],
            },
        },
    },

    plugins: [forms],
};
