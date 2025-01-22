<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body>
    <div class="flex">
        <x-sidebar></x-sidebar>
        <section class="max-w-4xl mx-auto bg-white p-6 rounded-lg shadow mt-8">
            <h2 class="text-2xl font-bold mb-6 text-gray-800">Tambah product</h2>
            <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                    <input
                        type="text"
                        id="name"
                        name="name"
                        class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter product name"
                        required 
                        value="{{ $product->name }}"/>
                        @error('name')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                </div>


                <!-- Picture -->
                <div class="mb-4">
                    <label for="picture" class="block text-gray-700 font-medium mb-2">Picture</label>
                    <input
                        type="file"
                        id="picture"
                        name="picture"
                        accept="image/*"
                        class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        >
                        @error('picture')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                        
                        
                </div>

                <!-- Price -->
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 font-medium mb-2">Price</label>
                    <input
                        type="number"
                        id="price"
                        name="price"
                        class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter price"
                        required 
                        value="{{ $product->price }}">
                        @error('price')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 font-medium mb-2">Description</label>
                    <textarea
                        id="description"
                        name="description"
                        rows="4"
                        class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter product description"
                        required
                        value="">{{ $product->description }}</textarea>
                        @error('description')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                </div>

                <!-- Quantity -->
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 font-medium mb-2">Quantity</label>
                    <input
                        type="number"
                        id="quantity"
                        name="quantity"
                        class="w-full px-4 py-2 border rounded-lg text-gray-700 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Enter quantity"
                        required 
                        value="{{ $product->quantity }}">
                        @error('quantity')
                        <span class="text-red-500">{{ $message }}</span>
                        @enderror
                </div>

                <!-- Submit Button -->
                <div class="text-right">
                    <button
                        type="submit"
                        class="bg-blue-500 hover:bg-blue-600 text-white font-medium px-6 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-400">
                        Submit
                    </button>
                </div>
            </form>
        </section>
    </div>




    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>

</html>