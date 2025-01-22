<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail product</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">

    <x-navbar></x-navbar>

    <!-- Main Content Detail Buku Section Start -->
    <section class="pt-28 pb-36 ">
        <div class="w-full px-4">
            <div class="container mx-auto">
                <div class="grid lg:grid-cols-3 justify-center">
                    <!-- Buku Start -->
                    <div class="mb-2 md:mb-6 lg:mb-0">
                        <div class="w-full mx-auto md:w-[90%] lg:mx-0 xl:w-[380px] xl:h-[500px] rounded-md">
                            <img src="{{ asset('storage/products/' . $product->picture) }}" alt=""
                                class="w-full h-full object-cover rounded-lg" />
                        </div>
                    </div>
                    <!-- Buku End -->

                    <!-- Title Start -->
                    <div class="lg:col-span-2 lg:ml-20 xl:ml-0">
                        <!-- Judul Buku Start -->
                        <div class="pt-2">
                            <h2 class="text-2xl md:text-[28px] font-bold mb-1 md:mb-2">
                                {{ $product->name }}
                            </h2>
                            <p class="font-normal text-sm md:text-lg text-grey mb-6">
                               Rp. {{ number_format($product->price) }}
                            </p>

                            <form action="{{ route('add-cart', ['id' => '$product_id']) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <input type="hidden" name="quantity" value="1"> <!-- Default quantity -->
                                <button id="openModal" class="block w-full md:w-[30%] lg:w-[20%] xl:w-[10%] text-white bg-blue-500 p-4 rounded-lg">
                                   Add to cart
                                </button>
                            </form>
                            
                            <div class="mt-10">
                                <h2 class="text-xl text-gray-900 mb-5">About Product</h2>

                            <p class="font-normal text-sm md:text-lg text-slate-500 w-full mb-5 md:mb-8">
                                {{ $product->description }}
                            </p>
                            </div>
                            

                        </div>
                        <!-- Judul Buku End -->
                    </div>
                    <!-- Title End -->
                </div>
            </div>
        </div>
    </section>
    <!-- Main Content Detail Buku Section End -->

    <x-footer></x-footer>


    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>
</body>

</html>
