import React, { useState, useEffect } from 'react';
import axios from 'axios';
import { useParams } from 'react-router-dom';

const ProductDetail = () => {
    const { id } = useParams();
    const [product, setProduct] = useState(null);

    useEffect(() => {
        const fetchProduct = async () => {
            try {
                const { data } = await axios.get(`http://localhost:8000/api/products/${id}`);
                setProduct(data);
            } catch (error) {
                console.log('Error fetching product', error);
            }
        };
        fetchProduct();
    }, [id]);

    if (!product) {
        return <div>Loading...</div>;
    }

    return (
        <div className="container mx-auto p-4">
            <h1 className="text-3xl font-semibold text-center mb-6">Product Details</h1>
            <div className="bg-white p-6 rounded-lg shadow-md max-w-lg mx-auto mb-6">
                <img src={`http://localhost/storage/${product.picture}`} alt={product.name} className="w-full h-64 object-cover rounded-md mb-4" />
                <h2 className="text-2xl font-bold">{product.name}</h2>
                <p className="text-lg text-gray-700">Price: ${product.price}</p>
                <p className="text-gray-600 mt-2">{product.description}</p>
                <p className="mt-2"><strong>Quantity:</strong> {product.quantity}</p>
            </div>
        </div>
    );
};

export default ProductDetail;
