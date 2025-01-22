<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <title>Admin Dashboard</title>
</head>
<body class="bg-gray-100 font-sans">
  <!-- Wrapper -->
  <div class="flex">
    <!-- Sidebar Component -->
    <x-sidebar></x-sidebar>

    <!-- Main Content -->
    <main class="flex-1 p-6">
      <header>
        <h1 class="text-3xl font-bold">Property Dashboard</h1>
        <p class="text-gray-600 mt-2">Welcome, Admin!</p>
      </header>

      <!-- Statistics -->
      <section class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white shadow p-4 rounded-lg">
          <h2 class="text-sm text-gray-500">Users</h2>
          <p class="text-2xl font-bold mt-2">{{ $users }}</p>
        </div>
        <div class="bg-white shadow p-4 rounded-lg">
          <h2 class="text-sm text-gray-500">Products</h2>
          <p class="text-2xl font-bold mt-2">{{ $products }}</p>
        </div>
        <div class="bg-white shadow p-4 rounded-lg">
          <h2 class="text-sm text-gray-500">Transactions</h2>
          <p class="text-2xl font-bold mt-2">Rp 75.000.000</p>
        </div>
      </section>

      <!-- Latest Transactions -->
      <section class="mt-8">
        <h2 class="text-xl font-bold">Latest Transactions</h2>
        <div class="bg-white shadow mt-4 p-4 rounded-lg">
          <p class="text-gray-500">Product Image</p>
        </div>
      </section>
    </main>
  </div>

  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>
</html>
