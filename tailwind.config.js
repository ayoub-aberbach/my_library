/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    ],
    theme: {
        extend: {
            keyframes: {
                slidebottom: {
                    "0%": {
                        transform: "translateY(-50px)",
                        opacity: 0
                    },

                    "100%": {
                        transform: "translateY(0)",
                        opacity: 1
                    }
                },
                slideLeft: {
                    "0%": {
                        transform: "translateX(-50px)",
                        opacity: 0
                    },

                    "100%": {
                        transform: "translateX(0)",
                        opacity: 1,
                    }
                },
                slideRight: {
                    "0%": {
                        transform: "translateX(0)",
                        opacity: 1
                    },

                    "100%": {
                        transform: "translateX(-50px)",
                        opacity: 0,
                    }
                },
                slideRight2: {
                    "0%": {
                        transform: "translateX(50px)",
                        opacity: 0
                    },

                    "100%": {
                        transform: "translateX(0)",
                        opacity: 1,
                    }
                },
            }
        },
    },
    plugins: [],
}
