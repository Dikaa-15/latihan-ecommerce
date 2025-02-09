import React from "react";
import { Routes, Route } from "react-router-dom";
import Products from "./Products";
import ProductDetail from "./ProductDetail";
import Login from "./Login";
import Register from "./Register";

export default function App() {
    return (
        <Routes>
            <Route path="/" element={<Products />} />
            <Route path="/products/:id" element={<ProductDetail />} />
            <Route path="/login" element={<Login/>} />
            <Route path="/regiser" element={<Register/>} />
        </Routes>
    );
}
