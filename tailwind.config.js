/** @type {import('tailwindcss').Config} */
module.exports = {
  purge: {
    content: [
      './vendor/wire-elements/modal/resources/views/*.blade.php',
      './storage/framework/views/*.php',
      './resources/views/**/*.blade.php',
    ],
    options: {
      safelist: [
        'sm:max-w-2xl'
      ]
    }
  },
  theme: {
    extend: {},
  },
  plugins: [],
}

