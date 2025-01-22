<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <div class="flex">
        <x-sidebar></x-sidebar>

        <section class="mt-8 flex-1 p-6">
            <div class="flex justify-between mb-5">
            <h2 class="text-xl font-bold mb-4">Data Products</h2>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded-lg"><a href="{{ route('products.create') }}">New Product</a></button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow rounded-lg">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Picture</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Name</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Price</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Qty</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $data)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 flex items-center">
                                <img class="w-10 h-10 rounded-full mr-3" src="{{ asset('storage/products/' . $data->picture ) }}" alt="Profile">
                                <span class="text-gray-800">{{ $data->name }}</span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->name }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->price }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->quantity}}</td>
                            <td>
                                <form onsubmit="return confirm('Yakin ingin hapus data?')" action="{{ route('products.destroy',$data->id) }}" method="POST" class="flex gap-3 justify-around">
                                    <a href="{{ route('products.edit', $data->id) }}" class="text-green-500">Edit</a>
                                    @csrf
                                    @method('DELETE')
                                   <button type="submit" class="text-red-500">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                            <span class="text-green-500">Data belum ada</span>
                        @endforelse
                        <!-- Baris Data -->
                    </tbody>
                </table>
            </div>
        </section>
    </div>






    <!-- Google Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>

</html>