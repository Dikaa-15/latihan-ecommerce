<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carts User</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-50">
    <div class="container mx-auto p-6">
        <!-- Navbar -->
        <x-navbar></x-navbar>

        <!-- Shopping Cart Section -->
        <h1 class="text-2xl font-bold mb-6">Shopping Cart</h1>

        @if (session('success'))
            <div class="bg-green-100 text-green-800 px-4 py-2 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <table class="w-full bg-white shadow rounded-lg overflow-hidden border border-gray-200">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                <tr>
                    <th class="py-3 px-6 text-left">Photo</th>
                    <th class="py-3 px-6 text-left">Product</th>
                    <th class="py-3 px-6 text-center">Price</th>
                    <th class="py-3 px-6 text-center">Qty</th>
                    <th class="py-3 px-6 text-center">Action</th>
                </tr>
            </thead>
            <tbody class="text-gray-600 text-sm font-light">
                @forelse ($carts as $cart)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left">
                            
                                <img src="{{ asset('storage/products/' . $cart->product->picture) }}" alt="">

                        </td>
                        <td class="py-3 px-6 text-left font-medium">{{ $cart->product->name }}</td>
                        <td class="py-3 px-6 text-center font-semibold">
                            Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                        </td>
                        <td class="py-3 px-6 text-center">
                            <div class="flex justify-center items-center">
                                <form action="#" method="POST" class="flex items-center space-x-2">
                                    <button type="button"
                                        class="text-gray-600 px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">-</button>
                                    <input type="number" name="quantity" value="{{ $cart->jumlah }}" min="1"
                                        class="w-12 text-center border rounded">
                                    <button type="button"
                                        class="text-gray-600 px-2 py-1 bg-gray-200 rounded hover:bg-gray-300">+</button>
                                </form>
                            </div>
                        </td>
                        <td class="py-3 px-6 text-center">
                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">
                                    Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-6 text-gray-500">Your cart is empty</td>
                    </tr>
                @endforelse
            </tbody>
        </table>


        <!-- Total Price -->
        <div class="text-right mt-4 text-xl font-bold">
            <h3 class="text-semibold font-sans text-gray-800">Total Price</h3>
            <h5 class="text-sm font-sans text-gray-700 mr-6">{{ number_format($totalHarga, 0, ',', '.') }}</h5>
        </div>


        <!-- Shipping Details -->
        <div class="mt-10 bg-white shadow rounded-lg p-6 border border-gray-200">
            <h2 class="text-xl font-semibold mb-6">Shipping Details</h2>
            <form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-gray-600 mb-2">Full Name</label>
                    <input type="text" name="fullname"
                        class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">Email Address</label>
                    <input type="email" name="email"
                        class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">Address</label>
                    <input type="text" name="address"
                        class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">Phone Number</label>
                    <input type="text" name="phone"
                        class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">Payment Method</label>
                    <input type="text" name="payment"
                        class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-200">
                </div>
                <div>
                    <label class="block text-gray-600 mb-2">Upload Transaction</label>
                    <input type="file" name="transaction"
                        class="w-full border px-4 py-2 rounded focus:ring focus:ring-blue-200">
                </div>
                <div class="col-span-1 md:col-span-2">
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 rounded hover:bg-blue-700">
                        Checkout Now
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
