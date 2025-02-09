import { Navigate, Outlet } from "react-router-dom";

const ProtectedRoute = ({ role }) => {
    const token = localStorage.getItem('token');
    const userRole = localStorage.getItem('role');

    // Jika token tidak ada atau peran tidak sesuai, arahkan ke halaman login
    if (!token) {
        return <Navigate to="/login" replace />;
    }

    if (role && userRole !== role) {
        // Jika peran tidak sesuai, arahkan ke halaman yang sesuai
        return <Navigate to="/" replace />;
    }

    return <Outlet />;
};

export default ProtectedRoute;
