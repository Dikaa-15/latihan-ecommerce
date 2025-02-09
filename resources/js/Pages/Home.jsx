import React, { useEffect, useState } from "react";

import Navbar from "../components/Navbar";
import Carousel from "../components/Carousel";
import Categories from "../components/Categories";
import SubFooter from "../components/Sub-Fototer";
import Footer from "../components/Footer";
import axios from "axios";

const Home = () => {
  const [products, setProducts] = useState([]);

  useEffect(() => {
    axios.get('http://localhost:8000/api/products')
      .then(response => setProducts(response.data))
      .catch(error => console.log("Error fetching products", error));
  }, []);

  return (
    <div classNameName="font-sans">
      {/* Navbar */}
      {/* <nav classNameName="flex justify-between items-center p-4 shadow-md">
        <h1 classNameName="text-lg font-bold">FoodIn</h1>
        <ul classNameName="flex space-x-6">
          <li>Home</li>
          <li>Categories</li>
          <li>Pricing</li>
          <li>Brands</li>
        </ul>
        <div>
          <button classNameName="px-4 py-2 border rounded-md">Login</button>
          <button classNameName="px-4 py-2 bg-blue-500 text-white rounded-md ml-2">Register</button>
        </div>
      </nav> */}
      <Navbar />

      {/* Hero Section */}
      {/* <section classNameName="relative w-full h-64 bg-red-500 flex justify-center items-center text-white">
        <h2 classNameName="text-3xl font-bold">Always LAYS POTATO CHIP - Enak dan Bergizi</h2>
      </section> */}
      <Carousel />

      <Categories />

      {/* Popular Products */}
      <section className="container mx-auto py-8">
        <div className="flex justify-between items-center mb-6">
          <h2 className="text-2xl font-semibold">Populer Product</h2>
          <a href="#" className="text-blue-500 hover:underline">See All Product</a>
        </div>
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {products.map((product) => (
            <a key={product.id} href={`/product/${product.id}`} className="block">
              <div className="bg-white shadow-md rounded-lg overflow-hidden">
                <img
                  src={`http://localhost:8000/storage/${product.picture}`}
                  alt={product.name}
                  className="w-full h-40 object-cover"
                />
                <div className="p-4">
                  <h3 className="text-lg font-semibold">{product.name}</h3>
                  <p className="text-gray-600">Rp. {product.price}</p>
                </div>
              </div>
            </a>
          ))}
        </div>
      </section>

      <SubFooter/>

      <Footer/>

    </div>
  );
};

export default Home