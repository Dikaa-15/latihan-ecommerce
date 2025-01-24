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
          <p class="text-2xl font-bold mt-2">Rp. {{ number_format($transactions) }}</p>
        </div>
      </section>

      <!-- Latest Transactions -->
      <section class="mt-8 scroll-y">
        <h2 class="text-xl font-bold">Latest Transactions</h2>
        <div class="bg-white shadow mt-4 p-4 rounded-lg">
          <section class="mt-8 flex-1 p-6">
            <h2 class="text-xl font-bold mb-4">Data Transactions</h2>
            @if (session('success'))
            <div class="mb-4 p-4 text-green-700 bg-green-100 rounded-md">
              {{ session('success') }}
            </div>
            @endif
            <div class="overflow-x-auto">
              <table class="w-full bg-white shadow rounded-lg">
                <thead class="bg-gray-100 border-b">
                  <tr>
                    <th class="text-left py-3 px-4 font-medium text-gray-600">Products</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-600">Qty</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-600">Total Price</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-600">Payment Method</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-600">user </th>
                    <th class="text-left py-3 px-4 font-medium text-gray-600">Status</th>
                    <th class="text-left py-3 px-4 font-medium text-gray-600"></th>
                  </tr>
                </thead>
                <tbody>
                  @forelse ($latestTransaction as $data)
                  <tr class="border-b hover:bg-gray-50">
                    <td class="py-5 mx-5 px-4 flex items-center gap-5">
                      <img src="{{ asset('storage/products/' . $data->product->picture) }}"
                        alt="Profile Image" width="50"
                        class="w-10 h-10 rounded-full object-cover mr-3" />
                      <span class="text-gray-800">{{ $data->product->name }}</span>
                    </td>
                    <td class="py-3 px-4 text-gray-600">{{ $data->jumlah }}</td>
                    <td class="py-3 px-4 text-gray-600">Rp. {{ number_format($data->total_harga) }}</td>
                    <td class="py-3 px-4 text-gray-600">{{ $data->payment }}</td>

                    <td class="py-3 px-4 text-gray-600">{{ $data->user->name }}</td>
                    <!-- Dropdown untuk Update Status -->
                    <td class="py-3 px-4 text-gray-600">
                      <form action="{{ route('transactions.updateStatus', $data->id) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()"
                          class="border border-gray-300 rounded px-2 py-1 text-gray-600">
                          <option value="pending" {{ $data->status === 'pending' ? 'selected' : '' }}>
                            Pending</option>
                          <option value="complete"
                            {{ $data->status === 'complete' ? 'selected' : '' }}>
                            complete</option>
                          <option value="failed" {{ $data->status === 'failed' ? 'selected' : '' }}>
                            Failed</option>
                        </select>
                      </form>
                    </td>
                    <td>
                      <form onsubmit="return confirm('Yakin ingin hapus data?')" action="{{ route('transactions.destroy', $data->id) }}"
                        method="POST">
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
      </section>
    </main>
  </div>

  <!-- Google Material Icons -->
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
</body>

</html>