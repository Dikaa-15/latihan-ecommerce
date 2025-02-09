import React from 'react';
import ReactDOM from 'react-dom/client';
import { BrowserRouter as Router, Routes, Route } from 'react-router-dom';
// import coba from './Pages/coba';

// Pages
// const Login = () => <h1 className='text-lg'>Login Page</h1>;
// const Register = () => <h1>Register Page</h1>;

import Home from './Pages/Home';
import Login from './Pages/Login';
import Register from './Pages/Register';
import Products from './Pages/Products';
import ProductDetail from './Pages/ProductDetail';
import ProductEdit from './Pages/ProductEdit';

const App = () => (
    <Router>
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/products" element={<Products />} />
            <Route path="/products/:id" element={<ProductDetail />} />
            <Route path="/products/edit/:id" element={<ProductEdit />} />

            {/* <coba/> */}
        </Routes>
    </Router>
);

ReactDOM.createRoot(document.getElementById('app')).render(<App />);
console.log('React Mounted to DOM'); // Log Debug