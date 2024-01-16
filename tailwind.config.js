const defaultTheme = require('tailwindcss/defaultTheme');

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

        'bg_partial': "#CCF381",
        'LemonGreen': '#CCF381',
        'Electric_Blue': '#4831D4',
      },
    


    listStyleType: {
      none: 'none',
      disc: 'disc',
      decimal: 'decimal',
      square: 'square',
      roman: 'upper-roman',
    },
    extend: {
      colors: {
      bg_partial: "#CCF381",
      text_color: "#4831D4",
    },
      
},

  },

},
  plugins: [],
}
