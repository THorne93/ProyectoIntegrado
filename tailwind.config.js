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
            screens: {
                '3xl': '1920px',
                '4xl': '2560px',
                '5xl': '3840px'
            },
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            textColor: {
                'override-black': '#000',
            },
            keyframes: {
                customPulse: {
                    '0%, 100%': {
                        boxShadow: '0 0 0 0 rgba(68,0,204, 0.4)',
                        transform: 'scale(1)',
                        borderColor: 'rgba(68,0,204, 1)',
                    },
                    '50%': {
                        boxShadow: '0 0 10px 5px rgba(68,0,204, 0.4)',
                        transform: 'scale(1.03)',
                        borderColor: 'rgba(68,0,204, 1)',
                    },
                },
                customPulseNav: {
                    '0%, 100%': {
                        boxShadow: '0 0 0 0 rgba(68,0,204, 0.4)',
                        borderWidth: '2px',
                    },
                    '50%': {
                        boxShadow: '0 0 10px 5px rgba(68,0,204, 0.4)',
                        borderWidth: '2px',
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
