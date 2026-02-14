/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './application/views/**/*.php',
    './src/**/*.{js,ts}',
  ],
  darkMode: 'class',
  theme: {
    extend: {
      colors: {
        accent: {
          DEFAULT: 'var(--accent, #6366f1)',
          50: 'var(--accent-50, #eef2ff)',
          100: 'var(--accent-100, #e0e7ff)',
          500: 'var(--accent, #6366f1)',
          600: 'var(--accent-600, #4f46e5)',
          700: 'var(--accent-700, #4338ca)',
        },
      },
      fontFamily: {
        sans: ['Inter', 'system-ui', '-apple-system', 'sans-serif'],
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
  ],
}
