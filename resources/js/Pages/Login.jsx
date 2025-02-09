import React, { useState } from "react";
import { useNavigate } from 'react-router-dom';
import axios from 'axios';

const Login = () => {
    const [formData, setFormData] = useState({ email: '', password: ''});
    const navigate = useNavigate();

    const handleChange = (e) => {
        setFormData({ ...formData, [e.target.name]: e.target.value });
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        try {
            // Kirim request login ke backend Laravel
            const response = await axios.post('/api/login', formData, { withCredentials: true });
            alert('Login successful');
        } catch (error) {
            console.error('Login failed:', error.response?.data || error.message);
            alert('Login failed');
        }
    };
    

    // Fungsi untuk navigasi ke halaman register
    const goToRegister = () => {
        navigate('/register');
    };

    return (
        <div className="flex justify-center items-center min-h-screen bg-gray-100">
            <div className="bg-white p-6 rounded-lg shadow-md w-full max-w-md">
                <h1 className="text-2xl font-semibold text-gray-700 mb-4 text-center">Login</h1>
                <form onSubmit={handleSubmit} className="space-y-4">
                    <input
                        type="email"
                        name="email"
                        placeholder="Email"
                        value={formData.email}
                        onChange={handleChange}
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <input
                        type="password"
                        name="password"
                        placeholder="Password"
                        value={formData.password}
                        onChange={handleChange}
                        className="w-full p-2 border border-gray-300 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"
                    />
                    <button
                        type="submit"
                        className="w-full bg-blue-500 text-white py-2 rounded hover:bg-blue-600 transition"
                    >
                        Login
                    </button>
                </form>
                <button
                    onClick={goToRegister}
                    className="mt-4 w-full bg-gray-500 text-white py-2 rounded hover:bg-gray-600 transition"
                >
                    Go to Register
                </button>
            </div>
        </div>
    );
    
}

export default Login;