import React, { useState, useEffect } from "react";
import axios from "axios";
import { useParams } from "react-router-dom";
import { Spin } from "antd";
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";
import { motion } from "framer-motion"; // Import animasi Framer Motion

const ProductDetail = () => {
    const { id } = useParams();
    const [product, setProduct] = useState(null);
    const [quantity, setQuantity] = useState(1);
    const [loading, setLoading] = useState(true);
    const [buttonLoading, setButtonLoading] = useState(false);
    const [message, setMessage] = useState(null);

    const getProductDetail = async (id) => {
        const token = localStorage.getItem("token");

        try {
            const response = await axios.get(`http://localhost:8000/api/detail-products/${id}`, {
                headers: {
                    Authorization: `Bearer ${token}`,
                }
            });
            setProduct(response.data);
        } catch (error) {
            console.error("Error fetching product detail:", error.response?.data || error.message);
        } finally {
            setLoading(false);
        }
    };

    useEffect(() => {
        if (id) {
            getProductDetail(id);
        }
    }, [id]);

    const handleAddToCart = async () => {
        if (!product) return;

        setButtonLoading(true);

        try {
            const token = localStorage.getItem("token");
            const response = await axios.post(
                `http://localhost:8000/api/products/${id}/cart`,
                { product_id: product.id, quantity },
                { headers: { Authorization: `Bearer ${token}` } }
            );

            setMessage({ type: "success", text: response.data.message });
        } catch (error) {
            setMessage({ type: "error", text: error.response?.data.message || "Gagal menambahkan ke keranjang" });
        } finally {
            setButtonLoading(false);
        }
    };

    if (loading) {
        return (
            <div className="flex justify-center items-center h-screen">
                <Spin size="large" />
            </div>
        );
    }

    return (
        <span>
            <Navbar />
            <section className="pt-28 pb-36">
                <div className="container mx-auto px-4">
                    <motion.div
                        initial={{ opacity: 0, y: 20 }}
                        animate={{ opacity: 1, y: 0 }}
                        transition={{ duration: 0.5 }}
                        className="grid lg:grid-cols-2 gap-12 items-center"
                    >
                        <div className="flex justify-center">
                            <div className="w-full max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl">
                                {/* Tambahkan animasi fade-in untuk gambar */}
                                <motion.img
                                    src={product.picture ? `http://localhost:8000/storage/${product.picture}` : ""}
                                    alt={product.name}
                                    className="w-full h-96 object-cover rounded-lg shadow-lg"
                                    initial={{ opacity: 0 }}
                                    animate={{ opacity: 1 }}
                                    transition={{ duration: 0.8 }}
                                />
                            </div>
                        </div>
                        <div>
                            <motion.h2
                                className="text-3xl font-bold text-gray-900"
                                initial={{ opacity: 0, x: -20 }}
                                animate={{ opacity: 1, x: 0 }}
                                transition={{ duration: 0.5 }}
                            >
                                {product.name}
                            </motion.h2>
                            <motion.p
                                className="text-xl font-semibold text-gray-700 mt-2"
                                initial={{ opacity: 0, x: -20 }}
                                animate={{ opacity: 1, x: 0 }}
                                transition={{ duration: 0.6 }}
                            >
                                Rp {product.price}
                            </motion.p>

                            <input
                                type="number"
                                value={quantity}
                                onChange={(e) => setQuantity(Number(e.target.value))}
                                min="1"
                                max={product.quantity}
                                className="border p-2 rounded-md mt-4"
                            />
                            <motion.button
                                onClick={handleAddToCart}
                                className={`ml-4 px-4 py-2 text-white rounded ${buttonLoading ? "bg-gray-400" : "bg-blue-500 hover:bg-blue-700"}`}
                                disabled={buttonLoading}
                                initial={{ scale: 0.8 }}
                                animate={{ scale: 1 }}
                                transition={{ duration: 0.3 }}
                            >
                                {buttonLoading ? <Spin size="small" /> : "Add to Cart"}
                            </motion.button>

                            {message && (
                                <motion.div
                                    className={`mt-4 ${message.type === "success" ? "text-green-500" : "text-red-500"}`}
                                    initial={{ opacity: 0 }}
                                    animate={{ opacity: 1 }}
                                    transition={{ duration: 0.5 }}
                                >
                                    {message.text}
                                </motion.div>
                            )}

                            <div className="mt-10">
                                <motion.h2
                                    className="text-xl font-bold text-gray-900"
                                    initial={{ opacity: 0, x: -20 }}
                                    animate={{ opacity: 1, x: 0 }}
                                    transition={{ duration: 0.6 }}
                                >
                                    About Product
                                </motion.h2>
                                <motion.p
                                    className="text-gray-600 mt-4 leading-relaxed"
                                    initial={{ opacity: 0, x: -20 }}
                                    animate={{ opacity: 1, x: 0 }}
                                    transition={{ duration: 0.7 }}
                                >
                                    {product.description || "Tidak ada deskripsi untuk produk ini."}
                                </motion.p>
                            </div>
                        </div>
                    </motion.div>
                </div>
            </section>
            <Footer />
        </span>
    );
};

export default ProductDetail;
