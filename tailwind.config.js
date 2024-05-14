/** @type {import('tailwindcss').Config} */

const plugin = require('tailwindcss/plugin');

module.exports = {
  important: true,
  // content: ["./**/*.php"],
  // content: ["./single-photo.php"],
  content: [
    "./views/**/*.twig", // Where are the templates (views)
    "./assets/css/*.css", // Using the @apply directive (maybe)
  ],
  theme: {
    screens: {
      // There is only 1 responsive breakpoint in the project
      md: "376px",
    },
    extend: {
      fontSize: {
        'hero': 'clamp(1.72rem, 0.216216216216216rem + 6.426426426426428vw, 6rem)',
            },
      fontFamily: {
        spacemono: ["Space Mono", "sans-serif"],
        poppins: ["Poppins", "serif"],
      },

      fontWeight: {
        light: 300,
        regular: 400,
        medium: 500,
        bold: 700,
      },
      colors: {
        "mota-red": "#E00000",
        "mota-mid-red": "#FE5858",
        "mota-light-red": "#FFD6D6",
        "mota-dark-blue": "#313144",
        "mota-grey": "#C4C4C4",
        "mota-mid-grey": "#D8D8D8",
        "mota-light-grey": "#E5E5E5",
      },
      boxShadow: {
        mota: "0px 4px 14px 10px rgba(0, 0, 0, 0.03)",
      },
    },
  },
  plugins: [
        plugin(function({ addUtilities, theme }) {
            addUtilities({
                '.text-outline': {
                    color: 'transparent',
                    '-webkit-text-stroke-color': theme('colors.white'),
                    '-webkit-text-stroke-width': 'clamp(0.05375rem, 0.006654929577464788rem + 0.20093896713615023vw, 0.1875rem)',
                }
            })
        })
    ],
};
