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
    },
    darkMode: 'media',
    plugins: [require('flowbite/plugin')],
};
