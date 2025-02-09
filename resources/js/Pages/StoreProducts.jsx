import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

const StoreProducts = () => {
    const [form, setForm] = useState({ name: '', picture: null, price: '', description: '', quantity: '' });

    const navigate = useNavigate();

    const handleChange = (e) => {
        const {name, value, type, files} = e.target;
        if(type === "file") {
            setForm({ ...form, [name]: files[0] });
        } else {
            setForm( { ...form, [name]: value });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('picture', form.picture);
        formData.append('description', form.description);
        formData.append('price', form.price);
        formData.append('quantity', form.quantity);

        try {
            const token = localStorage.getItem("token")
            await axios.post('http://localhost:8000/api/products', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    Authorization : `Bearer ${token}` 
                },
            });
            alert("Successfully create data products");
            setForm({ name: '', price: '', description: '', quantity: '', picture: null });
            navigate('/products');
        } catch(error) {
            console.log("Failed to create data", error);
        }
    };

    return (
        <section>
        <form onSubmit={handleSubmit} className="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto mb-6">
            <div className="mb-4">
                <input type="text" name="name" value={form.name} onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>
            <div className="mb-4">
                <input type="text" name="description" value={form.description} onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>
            <div className="mb-4">
                <input type="text" name="price" value={form.price} onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>
            <div className="mb-4">
                <input type="text" name="quantity" value={form.quantity} onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>
            <div className="mb-4">
                <input type="file" name="picture" onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
            </div>
            <button type="submit" className="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none transition">New Products</button>
        </form>
        
        </section>
    )


};
export default StoreProducts;