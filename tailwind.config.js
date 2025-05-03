/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
        './node_modules/flowbite/**/*.js',
    ],
    theme: {
        fontFamily: {
            inter: ['Inter', 'sans-serif'],
            figtree: ['Figtree', 'sans-serif'],
        },
        extend: {
            backgroundImage: {
                'mengwi-jadoel0': "url('/assets/bg-mengwi-jadoel-1.jpg')",
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
    darkMode: false,
    plugins: [require('flowbite/plugin')],
};
