<nav class="flex items-center justify-between px-6 py-4 bg-white shadow">
        <!-- Logo -->
        <div class="flex items-center space-x-2">
            <span class="text-2xl font-bold text-black">
                Food<span class="text-blue-500">In</span>
            </span>
        </div>

        <!-- Navigation Links -->
        <ul class="flex space-x-6 text-gray-700">
            <li>
                <a href="{{ route('home') }}" class="hover:text-blue-500">Home</a>
            </li>
            <li>
                <a href="#" class="hover:text-blue-500">Categories</a>
            </li>
            <li>
                <a href="#" class="hover:text-blue-500">Pricing</a>
            </li>
            <li>
                <a href="#" class="hover:text-blue-500">Brands</a>
            </li>
        </ul>

        <!-- Action Buttons -->
        @auth
            <!-- Tampilan Profil Jika User Sudah Login -->
            <div class="flex items-center gap-2">
                
                <div class="w-8 h-8 rounded-full overflow-hidden">
                    <img src="{{ asset('storage/users/' . auth()->user()->profil ) }}" alt="Profile Image" class="w-full h-full object-cover" />
                </div>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('profil-admin') }}">
                    <p class="font-normal text-sm">hi, {{ auth()->user()->name }}</p>
                </a>
                @elseif(auth()->user()->role === 'user')
                <a href="{{ route('profil-user') }}">
                    <p class="font-normal text-sm">hi, {{ auth()->user()->name }}</p>
                </a>
                @endif
            </div>
        @else
            <div class="flex space-x-4">
                <a href="{{ route('login') }}" class="px-4 py-2 border border-blue-500 text-blue-500 rounded hover:bg-blue-50">
                    Login
                </a>
                <a href="{{ route('register') }}" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                    Register
                </a>
            </div>
        @endauth

    </nav>