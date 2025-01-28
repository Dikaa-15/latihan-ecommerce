import React, { useState, useEffect } from "react";
import { Link } from "react-router-dom";

const Navbar = () => {
    const [user, setUser] = useState(null);

    // Simulasi Cek Login (Bisa diubah sesuai API)
    useEffect(() => {
        const storedUser = JSON.parse(localStorage.getItem("user"));
        if (storedUser) {
            setUser(storedUser); // Set user dari localStorage jika ada
        }
    }, []);

    return (
        <nav className="flex items-center justify-between px-6 py-4 bg-white shadow">
            {/* Logo */}
            <div className="flex items-center space-x-2">
                <span className="text-2xl font-bold text-black">
                    Food<span className="text-blue-500">In</span>
                </span>
            </div>

            {/* Navigation Links */}
            <ul className="flex space-x-6 text-gray-700">
                <li><Link to="/" className="hover:text-blue-500">Home</Link></li>
                <li><Link to="/categories" className="hover:text-blue-500">Categories</Link></li>
                <li><Link to="/pricing" className="hover:text-blue-500">Pricing</Link></li>
                <li><Link to="/brands" className="hover:text-blue-500">Brands</Link></li>
            </ul>

            {/* Action Buttons */}
            {user ? (
                // Jika User Sudah Login
                <div className="flex items-center gap-2">
                    <div className="w-8 h-8 rounded-full overflow-hidden">
                        <img src={user.profile} alt="Profile" className="w-full h-full object-cover" />
                    </div>
                    <Link to={user.role === "admin" ? "/profil-admin" : "/profil-user"}>
                        <p className="font-normal text-sm">Hi, {user.name}</p>
                    </Link>
                    <button
                        className="ml-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                        onClick={() => {
                            localStorage.removeItem("user");
                            setUser(null);
                        }}
                    >
                        Logout
                    </button>
                </div>
            ) : (
                // Jika Belum Login
                <div className="flex space-x-4">
                    <Link to="/login" className="px-4 py-2 border border-blue-500 text-blue-500 rounded hover:bg-blue-50">
                        Login
                    </Link>
                    <Link to="/register" className="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                        Register
                    </Link>
                </div>
            )}
        </nav>
    );
};

export default Navbar;
