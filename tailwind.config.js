import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],
    darkMode: 'class', // Enable dark mode using class attribute

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                light: {
                    primary: '#FFFFFF', // Define your light mode colors here
                    // Add more light mode colors as needed
                },
                dark: {
                    primary: '#111111', // Define your dark mode colors here
                    // Add more dark mode colors as needed
                },
            },
        },
    },
    plugins: [forms],
}
