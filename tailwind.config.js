/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            fontSize: {
                '2xs': '10px',
            },
            colors: {
                'gray-back': '#f6f6f6',
            },
        },
    },
    plugins: [
    ],
}
