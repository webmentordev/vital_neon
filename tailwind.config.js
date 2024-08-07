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
                "1530px": {
                    "max": "1530px"
                },
                "1340px": {
                    "max": "1340px"
                },
                "1330px": {
                    "max": "1330px"
                },
                "1320px": {
                    "max": "1320px"
                },
                "1290px": {
                    "max": "1290px"
                },
                "1220px": {
                    "max": "1220px"
                },
                "1210px": {
                    "max": "1210px"
                },
                "1170px": {
                    "max": "1170px"
                },
                "1130px": {
                    "max": "1130px"
                },
                "1090px": {
                    "max": "1090px"
                },
                "1045px": {
                    "max": "1045px"
                },
                "940px": {
                    "max": "940px"
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
                "820px": {
                    "max": "820px"
                },
                "800px": {
                    "max": "800px"
                },
                "740px": {
                    "max": "740px"
                },
                "710px": {
                    "max": "710px"
                },
                "670px": {
                    "max": "670px"
                },
                "650px": {
                    "max": "650px"
                },
                "620px": {
                    "max": "620px"
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
                "dark": "#101113",
                "light": "#141517",
                "main-light": "rgba(0,128,128, 0.4)"
            }
            // colors: {
            //     "main": "#12CAFF",
            //     "parrot": "#10FF10",
            //     "dark": "#121212",
            //     "light": "#161616",
            //     "main-light": "rgba(0,128,128, 0.4)"
            // }
        },
    },
    plugins: [require('@tailwindcss/forms')],
};
