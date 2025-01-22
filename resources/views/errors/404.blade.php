<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>404 Page Not Found</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
  <div class="text-center">
    <!-- Logo -->
    <div class="mb-4">
      <span class="bg-blue-500 text-white px-4 py-2 rounded-full text-lg font-bold">weberror</span>
    </div>

    <!-- Sad Emoji -->
    <div class="text-6xl mb-4">😔</div>

    <!-- Title -->
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Oops, page not found</h1>

    <!-- Subtitle -->
    <p class="text-gray-600 mb-6">
      We are very sorry for the inconvenience. It looks like you're trying to access a page that has been deleted or never even existed.
    </p>

    <!-- Button -->
    <a href="{{ route('home') }}" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
      Back to Homepage
    </a>

    <!-- Footer Links -->
    <div class="mt-8 text-gray-500">
      <a href="#" class="hover:underline">Help Center</a> · 
      <a href="#" class="hover:underline">FAQ Section</a>
    </div>
  </div>
</body>
</html>
