module.exports = {
  purge: [
    'src/Templates/404.html',
    'src/Templates/form.html',
    'src/Templates/index.html',
    'src/Templates/kontakt.html',
    'src/Templates/reference.html',
    'src/Templates/layouts/layout.html',

  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    extend: {
      transitionProperty: {
        'max-height': 'max-height'
      }
    },
  },
  variants: {
    extend: {},
  },
  plugins: [
    require('@tailwindcss/forms')
  ],
}
