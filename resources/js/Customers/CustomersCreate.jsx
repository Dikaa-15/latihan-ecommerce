import React, { useState } from "react";
import axios from "axios";
import { useNavigate } from "react-router-dom";

const StoreCustomer = () => {
    const [form, setForm] = useState({name: '', email: '', password: '', phone_number: '', profil: null});

    const navigate = useNavigate();

    const handleChange = (e) => {
        const {name, value, type, files} = e.target;
        if(type === "file") {
            setForm({ ...form, [name]:  [0] });
        } else {
            setForm({ ...form, [name]: value });
        }
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('name', form.name);
        formData.append('email', form.email);
        formData.append('password', form.password);
        formData.append('phone_number', form.phone_number);
        formData.append('profil', form.profil);
        try {
            const token = localStorage.getItem("token")
            await axios.post("http://localhost:8000/api/customers", formData, {
                headers: {
                    'Content-Type' : 'multipart/form-data',
                     Authorization: `Bearer ${token}`
                },
            });
            alert("Successfully create data customers");
            setForm({ name: '', email: '', password: '', phone_number: '', profil: null });
            navigate('/customers');
        } catch (error) {
            alert("Failed to create data customers");
        }
    };

    return (
        <section>
            <form onSubmit={handleSubmit} className="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto mb-6">
                <div className="mb-4">
                    <input type="text" name="name" value={form.name} onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <div className="mb-4">
                    <input type="text" name="email" value={form.email} onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <div className="mb-4">
                    <input type="password" name="password" value={form.password} onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <div className="mb-4">
                    <input type="text" name="phone_number" value={form.phone_number} onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <div className="mb-4">
                    <input type="file" name="profil" onChange={handleChange} required className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <button type="submit" className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                    New Customers
                </button>
            </form>
        </section>
    )

};
export default StoreCustomer;