module.exports = {
    purge:['./src/index.html','./src/**/*.{svelte,js,ts}'],
    content: ["./src/**/*.{html,js}"],
    theme: {
      extend: {},
    },
    plugins: [require("daisyui")],
  }
