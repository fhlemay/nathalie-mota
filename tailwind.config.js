/** @type {import('tailwindcss').Config} */
module.exports = {
  important: true,
  // content: ["./**/*.php"],
  // content: ["./single-photo.php"],
  content: ["./views/*.twig", "./views/components/*.twig"], // Where are the templates
  theme: {
    extend: {
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
    },
  },
  plugins: [],
};
