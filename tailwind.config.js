/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js"
    ],
    theme: {
        extend: {
            fontSize: {
                '2xs': '8px',
            },
            colors: {
                'gray-back': '#f6f6f6',
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
}
