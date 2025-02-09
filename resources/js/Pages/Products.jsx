import React, { useState, useEffect } from 'react';
import axios from 'axios';
import ProductEdit from './ProductEdit';
import { useNavigate } from 'react-router-dom';
import SidebarAdmin from '../components/SIdebar-Admin';

const Products = () => {
    const [products, setProducts] = useState([]);
    const [form, setForm] = useState({ name: '', price: '', description: '', quantity: '', picture: null });

    const navigate = useNavigate();
    // const fetchProducts = async () => {
    //     try {
    //         const { data } = await axios.get('http://localhost:8000/api/products');
    //         setProducts(data);
    //     } catch (error) {
    //         console.log('Error fetching products', error);
    //     }
    // };

    // const getProducts = async () => {
    //     const token = localStorage.getItem('token');
    //     if (!token) return;

    //     try {
    //         const response = await axios.get('http://localhost:8000/api/products', {
    //             headers: { Authorization: `Bearer ${token}` }
    //         });
    //         setProducts(response.data);
    //     } catch (error) {
    //         console.error('Error fetching products:', error.response?.data || error.message);
    //     }
    // };

    const getProducts = async () => {
        try {
            const response = await axios.get('http://localhost:8000/api/cards');
            setProducts(response.data);
        }catch (error) {
            console.log('Error fetching data products', error);
        }
    }
    
    useEffect( () => {
        getProducts();
    },[]);


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
            const token = localStorage.getItem("token");
            await axios.post('http://localhost:8000/api/products', formData, {
                headers: {
                    'Content-Type': 'multipart/form-data'
                }
            });
            setForm({ name: '', price: '', description: '', quantity: '', picture: null });
        } catch (error) {
            console.log('Error creating product:', error);
        }
    };

    const handleDelete = async (id) => {
        try {
            const token = localStorage.getItem("token");
            await axios.delete(`http://localhost:8000/api/products/${id}`, {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });
            getProducts();
        } catch (error) {
            alert("Gagal hapus data", error);
        }
        
    };
    const gotoEditProducts = (id) => {
        navigate(`/products/edit/${id}`);
    }
    const goToCreateProduct = () => {
        navigate('/products/create');
    }

    return (
        <section className='flex'>
            <SidebarAdmin/>
            <div className="container mx-auto p-4">
            {/* <h1 className="text-3xl font-semibold text-center mb-6">Product Management</h1> */}

            {/* Form Section */}
            


            {/* Products List */}
            <section class="mt-8 flex-1 p-6">
            <div class="flex justify-between mb-5">
            <h2 class="text-xl font-bold mb-4">Data Products</h2>
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded-lg"><a href="products/create">New Product</a></button>
            </div>
            
            <div class="overflow-x-auto">
                <table class="w-full bg-white shadow rounded-lg">
                    <thead class="bg-gray-100 border-b">
                        <tr>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Picture</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Name</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Price</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600">Qty</th>
                            <th class="text-left py-3 px-4 font-medium text-gray-600"></th>

                        </tr>
                    </thead>
                    <tbody>
                        {products.map( (product) => (
                            <tr class="border-b hover:bg-gray-50">
                            <td class="py-3 px-4 flex items-center">
                                <img class="w-14 h-14 rounded-full mr-3" src={`http://localhost:8000/storage/${product.picture}`} alt="Profile" />
                                <span class="text-gray-800"></span>
                            </td>
                            <td class="py-3 px-4 text-gray-600">{product.name}</td>
                            <td class="py-3 px-4 text-gray-600">{product.price}</td>
                            <td class="py-3 px-4 text-gray-600">{product.quantity}</td>
                            <td className='flex gap-3 mt-[-20px]'>
                                <button onClick={ () => gotoEditProducts(product.id) } className='hover:text-green-500 cursor-pointer'>Edit</button>
                                <button onClick={ () => handleDelete(product.id) } className='hover:text-red-500 cursor-pointer'>Delete</button>
                            </td>
                        </tr>
                        ))}
                    </tbody>
                </table>
            </div>
        </section>
        </div>
        </section>
        
    );
};

export default Products;
