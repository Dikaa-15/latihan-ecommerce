import React, { useState, useEffect } from "react";
import axios from "axios";

import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

const Carts = () => {
    const [cartItems, setCarts] = useState([]); // Inisialisasi sebagai array
    const [loading, setLoading] = useState(true);
    const [message, setMessage] = useState(null);

    // Fungsi untuk mengambil data keranjang pengguna
    const getUserCarts = async () => {
        try {
            const token = localStorage.getItem("token");
            if (!token) {
                setMessage({ type: "error", text: "Token tidak ditemukan, silakan login kembali!" });
                return;
            }

            const response = await axios.get(`http://localhost:8000/api/cart`, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });

            // Cek respons dari API
            console.log("Response from API:", response.data);

            // Pastikan data yang diterima adalah array
            setCarts(Array.isArray(response.data.cart_items) ? response.data.cart_items : []);
        } catch (error) {
            console.log("Error Fetching carts items: ", error.response?.data || error.message);
            setMessage({ type: "error", text: "Gagal mengambil data keranjang" });
        } finally {
            setLoading(false);
        }
    };

    // Fungsi untuk menghapus item dari keranjang
    const handleRemoveFromCart = async (id) => {
        try {
            const token = localStorage.getItem("token");
            await axios.delete(`http://localhost:8000/api/cart/${id}`, {
                headers: { Authorization: `Bearer ${token}` },
            });

            // Menghapus item yang dihapus dari state cartItems
            setCarts(cartItems.filter((item) => item.id !== id));

            setMessage({ type: "success", text: "Produk berhasil dihapus dari keranjang" });
        } catch (error) {
            console.error("Error removing item from cart:", error.response?.data || error.message);
            setMessage({ type: "error", text: "Gagal menghapus produk dari keranjang" });
        }
    };

    // Mengambil data keranjang saat pertama kali render
    useEffect(() => {
        getUserCarts();
    }, []); // Empty dependency array untuk hanya memanggil sekali

    return (
        <section>
            <Navbar/>
            <div className="container mx-auto mt-10 p-6">
            <h2 className="text-3xl font-bold mb-4">Shopping Cart</h2>

            {cartItems.length === 0 ? (
                <p className="text-center text-gray-500 mt-5">Keranjang belanja kosong</p>
            ) : (
                <div className="overflow-x-auto">
                    <table className="w-full border-collapse border border-gray-300">
                        <thead>
                            <tr className="bg-gray-100 text-left">
                                <th className="p-3 border border-gray-300">Photo</th>
                                <th className="p-3 border border-gray-300">Product</th>
                                <th className="p-3 border border-gray-300">Price</th>
                                <th className="p-3 border border-gray-300">Qty</th>
                                <th className="p-3 border border-gray-300">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            {cartItems.map((item) => (
                                <tr key={item.id} className="border border-gray-300">
                                    <td className="p-3 text-center">
                                        <img
                                            src={`http://localhost:8000/storage/${item.product.picture}`}
                                            alt={item.product.name}
                                            className="w-24 h-24 object-cover rounded-lg"
                                        />
                                    </td>
                                    <td className="p-3">{item.product.name}</td>
                                    <td className="p-3">Rp {item.product.price.toLocaleString()}</td>
                                    <td className="p-3 flex items-center">
                                        <button
                                            className="px-2 py-1 bg-gray-300 rounded-l"
                                            onClick={() => handleUpdateQty(item.id, item.jumlah - 1)}
                                            disabled={item.jumlah <= 1}
                                        >
                                            -
                                        </button>
                                        <span className="px-3">{item.jumlah}</span>
                                        <button
                                            className="px-2 py-1 bg-gray-300 rounded-r"
                                            onClick={() => handleUpdateQty(item.id, item.jumlah + 1)}
                                        >
                                            +
                                        </button>
                                    </td>
                                    <td className="p-3 text-center">
                                        <button
                                            onClick={() => handleRemoveFromCart(item.id)}
                                            className="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-700"
                                        >
                                            Remove
                                        </button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>

                    {/* Total Price */}
                    <div className="mt-5 text-right text-xl font-bold">
                        Total Price: Rp{" "}
                        {cartItems.reduce((total, item) => total + item.product.price * item.jumlah, 0).toLocaleString()}
                    </div>
                </div>
            )}
        </div>
        <Footer/>
        </section>
        
    );
};

export default Carts;
