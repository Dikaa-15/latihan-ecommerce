import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';
import { Spin } from 'antd';
import Navbar from "../components/Navbar";
import Footer from "../components/Footer";

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
                    <div className="grid lg:grid-cols-2 gap-12 items-center">
                        <div className="flex justify-center">
                            <div className="w-full max-w-sm md:max-w-md lg:max-w-lg xl:max-w-xl">
                                <img src={`http://localhost:8000/storage/${product.picture}`} alt={product.name}
                                    className="w-full h-96 object-cover rounded-lg shadow-lg" />
                            </div>
                        </div>
                        <div>
                            <h2 className="text-3xl font-bold text-gray-900">{product.name}</h2>
                            <p className="text-xl font-semibold text-gray-700 mt-2">Rp {product.price}</p>

                            <input
                                type="number"
                                value={quantity}
                                onChange={(e) => setQuantity(Number(e.target.value))}
                                min="1"
                                max={product.quantity}
                            />
                            <button
                                onClick={handleAddToCart}
                                className={`ml-4 px-4 py-2 text-white rounded ${buttonLoading ? "bg-gray-400" : "bg-blue-500 hover:bg-blue-700"}`}
                                disabled={buttonLoading}
                            >
                                {buttonLoading ? <Spin size="small" /> : "Add to Cart"}
                            </button>

                            {message && (
                                <div className={`mt-4 ${message.type === "success" ? "text-green-500" : "text-red-500"}`}>
                                    {message.text}
                                </div>
                            )}

                            <div className="mt-10">
                                <h2 className="text-xl font-bold text-gray-900">About Product</h2>
                                <p className="text-gray-600 mt-4 leading-relaxed">
                                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                    Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <Footer />
        </span>
    );
};

export default ProductDetail;
