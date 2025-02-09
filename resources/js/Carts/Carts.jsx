import React, { useEffect, useState } from "react";
import axios from "axios";
import SidebarAdmin from "../components/SIdebar-Admin";

const CartsAdmin = () => {
    const [carts, setCarts] = useState(null); // Awalnya null biar bisa cek dulu

    useEffect(() => {
        const getCarts = async () => {
            try {
                const response = await axios.get('http://localhost:8000/api/carts');
                console.log("API Response:", response.data); // Cek hasil API di console
                
                // Jika API mengembalikan { data: [...] }, gunakan response.data.data
                setCarts(Array.isArray(response.data) ? response.data : response.data.data || []);
            } catch (error) {
                console.error("Error fetching carts:", error);
                setCarts([]); // Jika error, jangan biarkan null agar .map tidak error
            }
        };

        getCarts();
    }, []);

    return (
        <section className='flex'>
            <SidebarAdmin />
            <div className="container mx-auto p-4">
                <section className="mt-8 flex-1 p-6">
                    <div className="flex justify-between mb-5">
                        <h2 className="text-xl font-bold mb-4">Data Carts</h2>
                        <button className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded-lg">
                            <a href="carts/create">New cart</a>
                        </button>
                    </div>

                    <div className="overflow-x-auto">
                        {carts === null ? (
                            <p>Loading...</p>
                        ) : carts.length === 0 ? (
                            <p>No carts available.</p>
                        ) : (
                            <table className="w-full bg-white shadow rounded-lg">
                                <thead className="bg-gray-100 border-b">
                                    <tr>
                                        <th className="text-left py-3 px-4 font-medium text-gray-600">User name</th>
                                        <th className="text-left py-3 px-4 font-medium text-gray-600">Product name</th>
                                        <th className="text-left py-3 px-4 font-medium text-gray-600">Qty</th>
                                        <th className="text-left py-3 px-4 font-medium text-gray-600">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    {carts.map((cart) => (
                                        <tr key={cart.id} className="border-b hover:bg-gray-50">
                                            <td className="py-3 px-4 text-gray-600">{cart.user?.name}</td>
                                            <td className="py-3 px-4 text-gray-600">{cart.product?.name}</td>
                                            {/* <td className="py-3 px-4 text-gray-600">{cart.user?.name}</td> */}
                                            <td className="py-3 px-4 text-gray-600">{cart.jumlah}</td>
                                            <td className="flex gap-3 mt-5">
                                                <button onClick={() => gotoEditcarts(cart.id)} className="hover:text-green-500 cursor-pointer">Edit</button>
                                                <button onClick={() => handleDelete(cart.id)} className="hover:text-red-500 cursor-pointer">Delete</button>
                                            </td>
                                        </tr>
                                    ))}
                                </tbody>
                            </table>
                        )}
                    </div>
                </section>
            </div>
        </section>
    );
};

export default CartsAdmin;
