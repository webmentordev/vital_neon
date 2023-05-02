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
                "1090px": {
                    "max": "1090px"
                },
                "1045px": {
                    "max": "1045px"
                },
                "920px": {
                    "max": "920px"
                },
                "890px": {
                    "max": "890px"
                },
                "870px": {
                    "max": "870px"
                },
                "850px": {
                    "max": "850px"
                },
                "800px": {
                    "max": "800px"
                },
                "600px": {
                    "max": "600px"
                },
                "575px": {
                    "max": "575px"
                },
                "530px": {
                    "max": "530px"
                },
                "490px": {
                    "max": "490px"
                },
                "475px": {
                    "max": "475px"
                },
                "400px": {
                    "max": "400px"
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
