/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./src/**/*.{html,js}",
  "./**/*.php",
  'node_modules/preline/dist/*.js',
],
darkMode: 'class',
  theme: {
    extend: {},
  },
  plugins: [
    require('preline/plugin'),
  ],
}

