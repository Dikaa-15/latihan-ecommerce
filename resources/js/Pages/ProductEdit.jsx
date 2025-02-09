import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useNavigate, useParams } from 'react-router-dom';

const ProductEdit = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [form, setForm] = useState({ name: '', price: '', description: '', quantity: '', picture: null });

    useEffect(() => {
        const fetchProduct = async () => {
            try {
                const { data } = await axios.get(`http://localhost:8000/api/products/${id}`);
                setForm({
                    name: data.name,
                    price: data.price,
                    description: data.description,
                    quantity: data.quantity,
                    picture: null // Don't keep the picture in form state
                });
            } catch (error) {
                console.log('Error fetching product', error);
            }
        };
        fetchProduct();
    }, [id]);

    const handleChange = (e) => {
        const { name, value, type, files } = e.target;
        if (type === "file") {
            setForm({ ...form, [name]: files[0] });
        } else {
            setForm({ ...form, [name]: value });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('_method', 'PUT');  // Menambahkan _method PUT
        formData.append('name', form.name);
        formData.append('price', form.price);
        formData.append('description', form.description);
        formData.append('quantity', form.quantity);
        if (form.picture) formData.append('picture', form.picture); // Only append if picture is selected

        try {
            await axios.post(`http://localhost:8000/api/products/${id}`, formData, {
                headers: { 'Content-Type': 'multipart/form-data' }
            });
            navigate('/products'); // Redirect to products list
        } catch (error) {
            console.log('Error updating product:', error);
        }
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-3xl font-semibold text-center mb-6">Edit Product</h1>
            <form onSubmit={handleSubmit} className="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto mb-6">
                <div className="mb-4">
                    <input 
                        type="text" 
                        name="name" 
                        placeholder="Product Name" 
                        value={form.name} 
                        onChange={handleChange} 
                        required 
                        className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>
                <div className="mb-4">
                    <input 
                        type="number" 
                        name="price" 
                        placeholder="Price" 
                        value={form.price} 
                        onChange={handleChange} 
                        required 
                        className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>
                <div className="mb-4">
                    <textarea 
                        name="description" 
                        placeholder="Description" 
                        value={form.description} 
                        onChange={handleChange} 
                        required 
                        className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>
                <div className="mb-4">
                    <input 
                        type="number" 
                        name="quantity" 
                        placeholder="Quantity" 
                        value={form.quantity} 
                        onChange={handleChange} 
                        required 
                        className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>
                <div className="mb-4">
                    <input 
                        type="file" 
                        name="picture" 
                        onChange={handleChange} 
                        className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>
                <button type="submit" className="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none transition">
                    Update Product
                </button>
            </form>
        </div>
    );
};

export default ProductEdit;
