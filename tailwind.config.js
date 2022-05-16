const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Nunito', ...defaultTheme.fontFamily.sans],
            },
            typography: {
                DEFAULT: {
                    css: {
                        h1: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        h2: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        h3: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        h4: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        h5: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        h6: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        p: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        blockquote: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        a: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px",
                        },
                        img: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                        hr: {
                            "margin-top": "0px",
                            "margin-bottom": "0px",
                            "padding-top": "0px",
                            "padding-bottom": "0px"
                        },
                    },
                },
            },
        },
    },

    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        require('@tailwindcss/forms'),
        require('daisyui'),
        require('@tailwindcss/typography')
    ],
};
