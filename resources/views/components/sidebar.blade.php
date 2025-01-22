

<div id="sidebar" class="w-64 bg-white h-screen shadow-lg">
      <div class="p-4 text-2xl font-bold text-blue-600">
        Food<span class="text-black">In</span>
      </div>
      <nav class="mt-4">
        <ul class="space-y-4">
          <li>
            <a href="{{ route('admin') }}" class="flex items-center text-blue-500 font-medium px-4 py-2 hover:bg-blue-50">
              <span class="material-icons">dashboard</span>
              <span class="ml-2">Dashboard</span>
            </a>
          </li>
          <li>
            <a href="{{ route('customers') }}" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
              <span class="material-icons">person</span>
              <span class="ml-2 flex">Customers</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
              <span class="material-icons">category</span>
              <span class="ml-2">Data Categories</span>
            </a>
          </li>
          <li>
            <a href="{{ route('products.index') }}" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
              <span class="material-icons">shopping_cart</span>
              <span class="ml-2">Data Product</span>
            </a>
          </li>
          <li>
            <a href="#" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
              <span class="material-icons">attach_money</span>
              <span class="ml-2">Data Transaction</span>
            </a>
          </li>
        </ul>
        <div class="mt-8 border-t">
          <ul class="mt-4 space-y-4">
            <li>
              <a href="{{ route('profil-admin') }}" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
                <span class="material-icons">settings</span>
                <span class="ml-2">Setting</span>
              </a>
            </li>
            <li>
              <a href="#" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
                <span class="material-icons">logout</span>
                <span class="ml-2">Logout</span>
              </a>
            </li>
          </ul>
        </div>
      </nav>
    </div>