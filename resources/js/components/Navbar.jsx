import { useState, useEffect } from "react";
import { Link, useNavigate } from "react-router-dom";

const Navbar = () => {
    const [user, setUser] = useState(null);
    const navigate = useNavigate();

    useEffect(() => {
        const storedUser = localStorage.getItem("user");
        if (storedUser) {
            try {
                setUser(JSON.parse(storedUser));
            } catch (error) {
                console.error("Error parsing user data:", error);
                localStorage.removeItem("user"); // Remove corrupted data
            }
        }

        const handleStorageChange = () => {
            const updatedUser = localStorage.getItem("user");
            setUser(updatedUser ? JSON.parse(updatedUser) : null);
        };

        window.addEventListener("storage", handleStorageChange);
        return () => window.removeEventListener("storage", handleStorageChange);
    }, []);

    const handleLogout = () => {
        localStorage.removeItem("user");
        localStorage.removeItem("token");
        setUser(null);
        navigate("/");
    };

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
                <li><Link to="/profile" className="hover:text-blue-500">Profile</Link></li>
                <li><Link to="/cart" className="hover:text-blue-500">Carts</Link></li>
                <li><Link to="/brands" className="hover:text-blue-500">Brands</Link></li>
            </ul>

            {/* Action Buttons */}
            {user ? (
                <div className="flex items-center gap-2">
                    <div className="w-8 h-8 rounded-full overflow-hidden">
                        <img
                            src={user.profile || "/default-avatar.png"} 
                            alt="Profile"
                            className="w-full h-full object-cover"
                        />
                    </div>
                    <Link to="/profile" className="text-sm font-normal">
                        Hi, {user.name}
                    </Link>
                    <button
                        className="ml-4 px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600"
                        onClick={handleLogout}
                    >
                        Logout
                    </button>
                </div>
            ) : (
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
