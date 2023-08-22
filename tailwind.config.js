/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        extend: {
            colors: {
                'primary': {
                    default: '#7CB342',
                    50: '#EBF4E1',
                    100: '#E1EFD2',
                    200: '#CDE4B5',
                    300: '#B9D997',
                    400: '#A4CE79',
                    500: '#90C35B',
                    600: '#7CB342',
                    700: '#608A33',
                    800: '#436124',
                    900: '#273815',
                    950: '#19240D'
                },
                'info': {
                    default: '#00BCD4',
                    50: '#DEFBFF',
                    100: '#CAF9FF',
                    200: '#A1F4FF',
                    300: '#78F0FF',
                    400: '#4FEBFF',
                    500: '#27E7FF',
                    600: '#00E0FD',
                    700: '#00BCD4',
                    800: '#008A9C',
                    900: '#005964',
                    950: '#004048'
                },
            }
        },
    },
    plugins: [],
}

