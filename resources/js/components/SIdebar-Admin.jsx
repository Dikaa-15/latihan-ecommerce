import React from 'react';

const SidebarAdmin = () => {
    return (
        <section>
            <div id="sidebar" class="w-64 bg-white h-screen shadow-lg">
                <div class="p-4 text-2xl font-bold text-blue-600">
                    Food<span class="text-black">In</span>
                </div>
                <nav class="mt-4">
                    <ul class="space-y-4">
                        <li>
                            <a href="/dashboard-admin" class="flex items-center text-blue-500 font-medium px-4 py-2 hover:bg-blue-50">
                                {/* <span class="material-icons">dashboard</span> */}
                                <span class="ml-2">Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="/customers" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
                                {/* <span class="material-icons">person</span> */}
                                <span class="ml-2 flex">Customers</span>
                            </a>
                        </li>
                        <li>
                            <a href="/carts" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
                                {/* <span class="material-icons">category</span> */}
                                <span class="ml-2">Data Cart</span>
                            </a>
                        </li>
                        <li>
                            <a href="/products" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
                                {/* <span class="material-icons">shopping_cart</span> */}
                                <span class="ml-2">Data Product</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('transactions.index') }}" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
                                {/* <span class="material-icons">attach_money</span> */}
                                <span class="ml-2">Data Transaction</span>
                            </a>
                        </li>
                    </ul>
                    <div class="mt-8 border-t">
                        <ul class="mt-4 space-y-4">
                            <li>
                                <a href="/profile" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
                                    {/* <span class="material-icons">settings</span> */}
                                    <span class="ml-2">Setting</span>
                                </a>
                            </li>
                            <li>
                                <form action="{{ route('logout') }}" method="POST" class="flex items-center text-gray-600 px-4 py-2 hover:bg-gray-100">
                                    @csrf
                                    <span class="material-icons">logout</span>
                                    <button>Logout</button>
                                </form>

                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </section>
    )
};
export default SidebarAdmin;