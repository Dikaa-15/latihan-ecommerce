import React, { useEffect, useState } from "react";
import axios from "axios";
import { useNavigate, useParams } from "react-router-dom";

const CustomerUpdate = () => {
    const { id } = useParams();
    const navigate = useNavigate();
    const [form, setForm] = useState({ name: '', email: '', password: '', phone_number: '', profil: null });

    const fetchCustomer = async () => {
        try {
            const token = localStorage.getItem("token");
            const response = await axios.get(`http://localhost:8000/api/customers/${id}`, {
                headers: {
                    Authorization: `bearer ${token}`,
                },
            });
            // const data = await axios.get(`http://localhost:8000/api/customers/${id}`);
            setForm({
                name: response.data.name,
                email: response.data.email,
                password: "",
                phone_number: response.data.phone_number,
                profil: response.data.profil,
            });

        } catch (error) {
            console.log("Error fetching data customer", error);
        }
    };
    useEffect ( ()  => {
        fetchCustomer();
    },[id]);

    const handleChange = (e) => {
        const {name, value, type, files} = e.target;
        if(type === "file") {
            setForm({ ...form, [name]: files[0] });
        } else {
            setForm({ ...form, [name]: value });
        }
    };
    const handleSubmit = async (e) => {
        e.preventDefault();
        const formData = new FormData();
        formData.append('_method', 'PUT');
        formData.append('name', form.name);
        formData.append('email', form.email);
        formData.append('password', form.password);
        formData.append('phone_number', form.phone_number);
        if(form.profil) formData.append('profil', form.profil);
        try {
            const token = localStorage.getItem("token")
            await axios.post(`http://localhost:8000/api/customers/${id}`, formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    Authorization: `Bearer ${token}`,
                },
            });
            navigate('/customers');
        } catch (error) {
            console.log('Error updating customers', error);
        }
    };

    return (
        <section>
            <h1 className="text-3xl font-semibold text-center mb-6">Edit Customer</h1>
            <form key={id} onSubmit={handleSubmit} className="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto mb-6">
                <div className="mb-4">
                    <input type="text"
                    name="name"
                    placeholder="Your name"
                    value={form.name}
                    onChange={handleChange}
                    required
                    className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <div className="mb-4">
                    <input type="text"
                    name="email"
                    placeholder="Your email"
                    value={form.email}
                    onChange={handleChange}
                    required
                    className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <div className="mb-text">
                    <input type="text"
                    name="password"
                    placeholder="Your password"
                    value={form.password}
                    onChange={handleChange}
                    required
                    className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <div className="mb-text">
                    <input type="text"
                    name="phone_number"
                    placeholder="Your phone_number"
                    value={form.phone_number}
                    onChange={handleChange}
                    required
                    className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <div className="mb-text">
                    <input type="file"
                    name="profil"
                    placeholder="Your Profile"
                    onChange={handleChange}
                    required
                    className="w-full p-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"/>
                </div>
                <button type="submit">Update Customer</button>
            </form>
        </section>
    )
};
export default CustomerUpdate;