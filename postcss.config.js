module.exports = {
  plugins: [
    require('postcss-import'),
    require('tailwindcss'),
    require('autoprefixer'), // v10.0 broken use ^9.8.6 instead
    require('@tailwindcss/typography'),
    //require('@tailwindcss/ui'),
  ],
};
