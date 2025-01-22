<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body>
    <div class="flex h-screen">

        <x-sidebar-user></x-sidebar-user>

            <!-- Menampilkan Error Validasi -->
    @if ($errors->any())
    <div class="bg-red-100 text-red-700 border border-red-400 px-4 py-3 rounded mb-6">
        <ul class="list-disc ml-6">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('profil-update') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded px-8 pt-6 pb-8">
        @csrf

        <!-- Foto Profil -->
        <div class="mb-4">
            <label for="profil" class="block text-gray-700 text-sm font-bold mb-2">Foto Profil:</label>
            @if ($user->profil)
            <div class="mb-2">
                <img src="{{ Storage::url('users/' . $user->profil) }}" alt="Foto Profil"
                    class="w-32 h-32 rounded-full object-cover">
            </div>
            @endif
            <input type="file" id="profil" name="profil"    
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

         <!-- Nama -->
         <div class="mb-4">
            <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>

        <!-- Nomor Telepon -->
        <div class="mb-4">
            <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon:</label>
            <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                required>
        </div>
        

        <!-- Tombol Submit -->
        <div class="flex items-center justify-between">
            <button type="submit"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Simpan Perubahan
            </button>
        </div>
    </form>

    </div>

    




    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>