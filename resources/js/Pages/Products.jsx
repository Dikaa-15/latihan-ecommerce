import React, { useState, useEffect } from 'react';
import axios from 'axios';
import ProductEdit from './ProductEdit';

const Products = () => {
    const [products, setProducts] = useState([]);
    const [form, setForm] = useState({ name: '', price: '', description: '', quantity: '', picture: null });

    const fetchProducts = async () => {
        try {
            const { data } = await axios.get('http://localhost:8000/api/products');
            setProducts(data);
        } catch (error) {
            console.log('Error fetching products', error);
        }
    };

    useEffect(() => {
        fetchProducts();
    }, []);

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
        formData.append('name', form.name);
        formData.append('price', form.price);
        formData.append('description', form.description);
        formData.append('quantity', form.quantity);
        formData.append('picture', form.picture);

        try {
            await axios.post('http://localhost:8000/api/products', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            fetchProducts();
            setForm({ name: '', price: '', description: '', quantity: '', picture: null });
        } catch (error) {
            console.log('Error creating product:', error);
        }
    };

    const handleDelete = async (id) => {
        await axios.delete(`http://localhost:8000/api/products/${id}`);
        fetchProducts();
    };

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-3xl font-semibold text-center mb-6">Product Management</h1>
            
            {/* Form Section */}
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
                        required 
                        className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                </div>
                <button type="submit" className="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 focus:outline-none transition">
                    Add Product
                </button>
            </form>

            {/* Products List */}
            <div className="overflow-x-auto">
                <table className="min-w-full table-auto bg-white shadow-md rounded-lg">
                    <thead>
                        <tr>
                            <th className="px-4 py-2 text-left border-b">Name</th>
                            <th className="px-4 py-2 text-left border-b">Price</th>
                            <th className="px-4 py-2 text-left border-b">Quantity</th>
                            <th className="px-4 py-2 text-left border-b">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        {products.map((product) => (
                            <tr key={product.id}>
                                <img src={`http://localhost:8000/storage/${product.picture}`} alt="" />
                                <td className="px-4 py-2 border-b">{product.name}</td>
                                <td className="px-4 py-2 border-b">Rp. {product.price}</td>
                                <td className="px-4 py-2 border-b">{product.quantity}</td>
                                <td className="px-4 py-2 border-b flex gap-3">
                                    <button 
                                        onClick={() => handleDelete(product.id)} 
                                        className="bg-red-500 text-white py-1 px-4 rounded-md hover:bg-red-600 focus:outline-none transition"
                                    >
                                        Delete
                                    </button>
                                    <button className='bg-sky-500 text-white py-1 px-4 rounded-md' path="/edit" element={<ProductEdit/>}>
                                    Edit
                                    </button>
                                </td>
                            </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </div>
    );
};

export default Products;
