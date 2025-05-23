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
            // colors: {
            //     success: '#28a745', // custom green
            //     danger: '#dc3545', // custom red
            //     warning: '#ffc107', // custom yellow
            //     info: '#17a2b8', // custom light blue
            //     primary: '#007bff', // custom blue
            //     secondary: '#6c757d', // custom gray
            //     // add or override other colors as needed
            // },
        },
    },
    darkMode: 'media',
    plugins: [require('flowbite/plugin')],
    safelist: [
        {
            pattern:
                /^(bg|text)-(slate|gray|zinc|neutral|stone|red|orange|amber|yellow|lime|green|emerald|teal|cyan|sky|blue|indigo|violet|purple|fuchsia|pink|rose)-(50|100|200|300|400|500|600|700|800|900|950)$/,
        },
    ],
};
