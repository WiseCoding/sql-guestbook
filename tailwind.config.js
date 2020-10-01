module.exports = {
  future: {
    removeDeprecatedGapUtilities: true,
    purgeLayersByDefault: true,
  },
  purge: {
    enabled: true, //toggle
    content: ['./*.php', './model/*.php', './view/*.php', './controller/*.php'],
  },
  theme: {
    extend: {},
  },
  variants: {},
  plugins: [],
};
