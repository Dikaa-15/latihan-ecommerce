<aside class="w-64 bg-white shadow-md flex flex-col">
    <!-- Profile Section -->
    <div class="flex flex-col items-center py-8 border-b">
        <img src="{{ asset('storage/users/' . auth()->user()->profil  ) }}" alt="User Avatar" class="w-20 h-20 rounded-full object-cover shadow-md mb-4">
        <h1 class="text-lg font-bold">{{ auth()->user()->name }}</h1>
        <p class="text-sm text-gray-500">{{ auth()->user()->email }}</p>
    </div>

    <!-- Navigation Links -->
    <nav class="flex flex-col px-4 mt-6 space-y-2">
        <!-- Back to Store -->
        <a href="{{ route('home') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded">
            <span class="material-icons">store</span>
            <span class="ml-3">Back to Store</span>
        </a>
        <!-- Transaction -->
        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded">
            <span class="material-icons">receipt</span>
            <span class="ml-3">Transaction</span>
        </a>
        <!-- Card -->
        <a href="{{ route('cart.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded">
            <span class="material-icons">credit_card</span>
            <span class="ml-3">Card</span>
        </a>
        <!-- Messages -->
        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded">
            <span class="material-icons">message</span>
            <span class="ml-3">Messages</span>
        </a>
        <!-- Settings -->
        <a href="#" class="flex items-center px-4 py-2 text-gray-700 hover:bg-blue-100 hover:text-blue-700 rounded">
            <span class="material-icons">settings</span>
            <span class="ml-3">Settings</span>
        </a>
        <!-- Logout -->
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            
            <button  class="ml-3"> 
                <span class="material-icons">logout</span>
                Logout
            </button>
                
        </form>
        
    </nav>
</aside>