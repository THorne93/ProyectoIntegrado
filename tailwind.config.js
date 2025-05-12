import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            textColor: {
                'override-black': '#000',
            },
            keyframes: {
                customPulse: {
                    '0%, 100%': {
                        boxShadow: '0 0 0 0 rgba(250, 204, 21, 0.4)',
                        transform: 'scale(1)',
                        borderColor: 'rgba(250, 204, 21, 1)',
                    },
                    '50%': {
                        boxShadow: '0 0 10px 5px rgba(250, 204, 21, 0.4)',
                        transform: 'scale(1.03)',
                        borderColor: 'rgba(250, 204, 21, 1)',
                    },
                },
                customPulseNav: {
                    '0%, 100%': {
                        boxShadow: '0 0 0 0 rgba(250, 204, 21, 0.4)',
                        borderWidth: '2px',
                        borderColor: 'rgb(255, 217, 67)',
                    },
                    '50%': {
                        boxShadow: '0 0 10px 5px rgba(250, 204, 21, 0.4)',
                        borderWidth: '2px',
                        borderColor: 'rgba(255, 217, 67, 1)',
                    },
                }
            },
            animation: {
                customPulse: 'customPulse 1.2s ease-in-out infinite',
                customPulseNav: 'customPulseNav 1.2s ease-in-out infinite',
            }
        }
    },
    plugins: [forms]
}
