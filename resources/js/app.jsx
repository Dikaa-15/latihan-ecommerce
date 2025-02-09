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
import ProtectedRoute from './ProtectedRoute';
import Profile from './Pages/Profile';
import LogoutButton from './Pages/Logout';
import Carts from './Pages/Carts';
import SuccessPage from './components/SuccessPage';
import StoreProducts from './Pages/StoreProducts';
import ProfilUser from './Pages/ProfilUser';
import GetCustomers from './Customers/Customers';
import Customers from './Customers/Customers';
import StoreCustomer from './Customers/CustomersCreate';
import CustomerUpdate from './Customers/CustomerUpdate';

const App = () => (
    <Router>
        <Routes>
            <Route path="/" element={<Home />} />
            <Route path="/login" element={<Login />} />
            <Route path="/register" element={<Register />} />
            <Route path="/logout" element={<LogoutButton />} />
            <Route path="/success-page" element={<SuccessPage />} />

            {/* Halaman profil hanya bisa diakses oleh pengguna yang sudah login */}
            <Route element={<ProtectedRoute />}>

                <Route path="/cart" element={<Carts />} />
                <Route path='/detail-products/:id' element={<ProductDetail />} />
                <Route path='/profile-user' element={<ProfilUser/>}></Route>
            </Route>

            {/* Hanya bisa diakses oleh admin */}
            <Route element={<ProtectedRoute role="admin" />}>
                <Route path="/profile" element={<Profile />} />
                <Route path="/products" element={<Products />} />
                <Route path="/products/create" element={<StoreProducts />} />
                <Route path="/products/:id" element={<ProductDetail />} />
                <Route path="/products/edit/:id" element={<ProductEdit />} />
                <Route path="/customers" element={<Customers />} />
                <Route path="/customers/create" element={<StoreCustomer />} />
                <Route path="/customers/edit/:id" element={<CustomerUpdate />} />
            </Route>

            {/* <coba/> */}
        </Routes>
    </Router>
);

ReactDOM.createRoot(document.getElementById('app')).render(<App />);
console.log('React Mounted to DOM'); // Log Debug