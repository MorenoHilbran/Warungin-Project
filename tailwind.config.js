// /** @type {import('tailwindcss').Config} */
// module.exports = {
//   content: ["./src/**/*.{html,js}"],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }

/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
       extend: {
      backgroundImage: {
        'hero-gradient': 'radial-gradient(circle at top left, #ff9a8b, #ff6a88, #ff99ac)',
      },
    },
  },
  plugins: [],
}
