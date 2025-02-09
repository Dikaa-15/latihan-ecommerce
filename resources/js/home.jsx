import React from "react";
import { BrowserRouter as Router, Routes, Route } from "react-router-dom";
import Products from "./components/Products";
import ProductDetail from "./components/ProductDetail";

export default function App() {
    return (
        <Router>
            <main className="py-8">
                <Routes>
                    <Route path="/" element={<Products />} />
                    <Route path="/products/:id" element={<ProductDetail />} />
                </Routes>
            </main>
        </Router>
    );
}
