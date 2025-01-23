<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Transactions</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body>
    <div class="flex">
        <x-sidebar></x-sidebar>

        <section class="mt-8 flex-1 p-6">
            <h2 class="text-xl font-bold mb-4">Data Customer</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow rounded-lg">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Products</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Qty</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Total Price</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Payment Method</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Status</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">user  </th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($transactions as $data)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-5 mx-5 px-4 flex items-center gap-5">
                            <img src="{{ asset('storage/products/' . $data->product->picture) }}" alt="Profile Image" width="50" class="w-24 h-24 rounded-lg object-cover mr-3" />
                            <span class="text-gray-800">{{ $data->product->name }}</span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->jumlah }}</td>
                            <td class="py-3 px-4 text-gray-600">Rp. {{ number_format($data->total_harga) }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->payment }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->status }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->user->name }}</td>
                            <td>
                                <form onsubmit="return confirm('Yakin ingin hapus data?')" action="" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <span class="text-red-500">Delete</span>
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