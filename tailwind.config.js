const Color = require('color');

function darken(color, amount) {
  return Color(color).darken(amount).hex().toString();
}

function lighten(color, amount) {
  return Color(color).lighten(amount).hex().toString();
}

module.exports = {
  purge: {
    content: [
      'resources/views/**/*.php',
      'resources/js/**/*.vue'
    ],
    options: {
      whitelist: ['text-primary','text-success','text-warning','text-accent'],
    }
  },
  theme: {
    colors: {
      primary: {
        light: lighten('#1988F9',.25),
        default: '#1988F9',
        dark: darken('#1988F9',.25)
      },
      success: {
        light: lighten('#3EBD73',.25),
        default: '#3EBD73',
        dark: darken('#3EBD73',.25)
      },
      warning: {
        light: lighten('#F2994A',.25),
        default: '#F2994A',
        dark: darken('#F2994A',.25)
      },
      error: {
        light: lighten('#DC2626',.25),
        default: '#DC2626',
        dark: darken('#DC2626',.25)
      },
      accent: {
        light: lighten('#9B51E0',.25),
        default: '#9B51E0',
        dark: darken('#9B51E0',.25)
      },
      gray: {
        100: '#ECECEC',
        200: '#E8E8E8',
        300: '#C2C2C2',
        400: '#716F6F',
        500: '#424242'
      },
      white: '#FFFFFF',
      bitcoin: '#F7931A'
    },
    fontFamily: {
      primary: ['Rubik','sans-serif']
    },
    extend: {
      boxShadow: {
        normal: '0px 6px 12px rgba(172, 172, 172, 0.15)'
      }
    },
  },
  variants: {},
  plugins: [],
}
