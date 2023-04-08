const defaultTheme = require('tailwindcss/defaultTheme');

/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            screens: {
                "890px": {
                    "max": "890px"
                }
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                "main": "#12CAFF",
                "parrot": "#10FF10",
                "dark": "#121212",
                "light": "#161616",
                "main-light": "rgba(0,128,128, 0.4)"
            }
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
