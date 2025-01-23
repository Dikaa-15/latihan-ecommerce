<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-100 h-screen">
    <div class="flex">

        <x-sidebar></x-sidebar>

        <section class="mt-8 flex-1 p-6">
            <h2 class="text-xl font-bold mb-4">Data Customer</h2>
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow rounded-lg">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Profil</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Username</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Email</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Phone Number</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600"></th>

                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($users as $data)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 flex items-center">
                            <img src="{{ asset('storage/users/' . $data->profil ) }}" alt="{{ $data->name }}" class="w-10 h-10 rounded-full object-cover" />
                            <span class="text-gray-800"></span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->name }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->email }}</td>
                            <td class="py-3 px-4 text-gray-600">{{ $data->phone_number }}</td>
                            <td>
                                <form onsubmit="return confirm('Yakin ingin hapus data?')" action="{{ route('deleteCustomers', $data->id) }}" method="POST">
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



        <!-- Google Material Icons -->
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>

</html>

</div>