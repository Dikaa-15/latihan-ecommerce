<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    @viteReactRefresh
    @vite(['resources/js/app.jsx'])
</head>

<body>

</body>
<x-navbar></x-navbar>

<x-carousel></x-carousel>

<x-categorys></x-categorys>

<div id="app"></div>

<!-- Products Section -->
<section class="container mx-auto py-8">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-semibold">Populer Product</h2>
        <a href="#" class="text-blue-500 hover:underline">See All Product</a>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse ($products as $data)
            <!-- Item 1 -->
            <a href="{{ route('detail-produk', ['id' => $data->id]) }}">
                <div class="bg-white shadow-md rounded-lg overflow-hidden">
                    <img src="{{ asset('storage/products/' . $data->picture) }}" alt="Canitos Snack"
                        class="w-full h-40 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold">{{ $data->name }}</h3>
                        <p class="text-gray-600">Rp. {{ number_format($data->price) }}</p>
                    </div>
                </div>
            </a>

        @empty
        @endforelse



    </div>
</section> 

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button>Logout</button>
</form>

<x-sub-footer></x-sub-footer>

<x-footer></x-footer>

<script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>


</html>
