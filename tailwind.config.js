module.exports = {
  important: '.sp-block',
  future: {
    purgeLayersByDefault: true,
    removeDeprecatedGapUtilities: true
  },
  purge: {
    content: [
      '**/*.php',
      '**/*.blade.php'
    ],
    options: {
      safelist: ['sp-block']
    }
  },
  theme: {
    extend: {
      colors: {
        primary: 'var(--sp-color-primary)',
        secondary: 'var(--sp-color-secondary)'
      }
    }
  }
}
