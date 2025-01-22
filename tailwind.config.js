/** @type {import('tailwindcss').Config} */
export default {
  content: [
    './resources/views/components/app.blade.php',
    './resources/views/admin/home.blade.php',
    './resources/views/admin/customers.blade.php',
    './resources/views/products/index.blade.php',
    './resources/views/products/show.blade.php'
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}

