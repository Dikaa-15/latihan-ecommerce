import React from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

const LogoutButton = () => {
  const navigate = useNavigate();

  const handleLogout = () => {
    axios.post('http://localhost:8000/api/logout')
      .then((response) => {
        console.log(response.data.message); // Untuk debug
        // Menghapus token atau session
        localStorage.removeItem('token'); // atau sessionStorage
        // Redirect ke halaman login setelah logout
        navigate('/login');
      })
      .catch((error) => {
        console.error('Logout error', error);
      });
  };

  return (
    <button
      onClick={handleLogout}
      className="px-4 py-2 bg-red-500 text-white rounded-md"
    >
      Logout
    </button>
  );
};

export default LogoutButton;
