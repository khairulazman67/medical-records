const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
      extend: {
          fontFamily: {
              sans: ['Nunito', ...defaultTheme.fontFamily.sans],
          },
      },
      extend: {
          fontFamily: {
              sans: ['Nunito', ...defaultTheme.fontFamily.sans],
          },
          colors: {
              primary:{
                  100 : '#B4CFFA',
                  600 : '#58C1D7',
                  700 : '#189EB4',
                  800 : '#234353',
                  900 : '#1A364C'
              },
              secondary:{
                  700 : '#F3ADB6',
                  800 : '#D99DA2',
                  900 : '#C5888D'
              }
          }
      },
  },
  plugins: [require('@tailwindcss/forms')],
};
