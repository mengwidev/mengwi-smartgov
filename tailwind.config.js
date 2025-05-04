/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        extend: {
            fontFamily: {
                figtree: ['Figtree', 'sans-serif'],
                lexend: ['Lexend Deca', 'sans-serif'],
            },
        },
        screens: {
            // Mobile breakpoints
            'mobile-sm': '300px',
            'mobile-md': '375px',
            'mobile-lg': '425px',

            // Tablet breakpoints
            'tablet-sm': '640px',
            'tablet-md': '768px',
            'tablet-lg': '1024px',
        },
    },
    darkMode: 'media',
    plugins: [require('flowbite/plugin')],
};
