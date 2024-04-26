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
  plugins: [],
};
