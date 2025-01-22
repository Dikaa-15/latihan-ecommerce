    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
        <script src="https://cdn.tailwindcss.com"></script>

    </head>

    <body>
        <div class="min-h-screen flex item-center justify-center">
            <div class="grid grid-cols-1 md:grid-cols-2 bg-white shadow-lg max-w-5xl rounded-lg overflow-hidden">
                <!-- Left Section (Form) -->
                <div class="p-8 md:p-12">
                    <div class="mb-6">
                        <h1 class="text-2xl font-bold text-gray-900">Register your <span
                                class="text-blue-600">FoodIn</span> account</h1>
                        <p class="text-gray-600">Register with your personal data and happy shopping!</p>
                    </div>
                    <form action="{{ route('register') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">Full Name</label>
                            <input id="name" name="name" type="text" placeholder="cth: johndoe"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('name')
                                <span class="text-danger-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                            <input id="email" name="email" type="email" placeholder="cth: example@gmail.com"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('email')
                                <span class="text-danger-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="phone_number" class="block text-sm font-medium text-gray-700">Phone
                                Number</label>
                            <input id="phone_number" name="phone_number" type="text"
                                placeholder="cth: 08XX-XXXX-XXXX"
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('phone_number')
                                <span class="text-danger-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                            <input id="password" name="password" type="password" placeholder=""
                                class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm">
                            @error('password')
                                <span class="text-danger-500">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-blue-600 text-white py-2 px-4 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                            Register Account
                        </button>
                    </form>
                    <p class="mt-4 text-center text-sm text-gray-600">
                        Already have an account? <a href="#" class="text-blue-600 hover:underline">Login</a>
                    </p>
                </div>
                <!-- Right Section (Image and Quote) -->
                <div class="relative hidden md:block">
                    <img src="{{ asset('auth/register.png') }}" alt="Supermarket" class="h-full w-full object-cover">
                    <div class="absolute inset-0 bg-black bg-opacity-50 flex items-center justify-center">
                        <div class="text-center text-white px-8">
                            <p class="text-lg font-semibold italic">"You can get everything you want in FoodIn"</p>
                            <p class="mt-2 text-sm">- Lautaro Martinez</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>

    </html>
