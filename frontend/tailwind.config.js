/** @type {import('tailwindcss').Config} */
const defaultTheme = require('tailwindcss/defaultTheme')
const colors = require("tailwindcss/colors")

export default {
  content: ["./src/**/*.{js,ts,jsx,tsx,vue}"],
  theme: {
    extend: {
      fontFamily: {
          sans: ["Inter var", ...defaultTheme.fontFamily.sans],
      },
      zIndex: {
          '2': '2',
          '3': '3',
      },
      colors: {
        exportBtnBg: "#c8e6c9",
        exportBtnTxt: "#256029",
        themegreen: "#64a970",
        themered: "#d37e7e",
      }
    },
    screens: {
      xs: "320px",
      sm: "640px",
      md: "768px",
      lg: "1024px",
      xl: "1280px",
      "2xl": "1536px",
    },
  },
  plugins: [],
}

