import React, { useEffect, useState } from "react";
import { Skeleton } from 'antd';
import Navbar from "../components/Navbar";
import Carousel from "../components/Carousel";
import Categories from "../components/Categories";
import SubFooter from "../components/Sub-Fototer";
import Footer from "../components/Footer";
import axios from "axios";
import LogoutButton from "./Logout";

const Home = () => {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true); // Tambah state loading

  const getProducts = async () => {
    try {
      setLoading(true); // Aktifkan loading saat mulai fetch data
      const response = await axios.get('http://localhost:8000/api/cards');
      setProducts(response.data);
    } catch (error) {
      console.log('Error fetching data products', error);
    } finally {
      setLoading(false); // Matikan loading setelah selesai
    }
  }

  useEffect(() => {
    getProducts();
  }, []); // Tambahkan dependency array kosong

  return (
    <div className="font-sans">
      <Navbar />
      <Carousel />
      <Categories />

      {/* Popular Products Section */}
      <section className="container mx-auto py-8">
        <div className="flex justify-between items-center mb-6">
          <h2 className="text-2xl font-semibold">Populer Product</h2>
          <a href="#" className="text-blue-500 hover:underline">See All Product</a>
        </div>
        
        <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
          {loading ? (
            // Tampilkan skeleton loading
            Array(6).fill().map((_, index) => (
              <div key={index} className="bg-white rounded-lg overflow-hidden">
                <Skeleton.Image 
                  active 
                  style={{ 
                    width: '1000px', 
                    height: '240px',
                    borderRadius: '0.5rem' 
                  }} 
                />
                <div className="p-4 block">
                  <Skeleton.Input 
                    active 
                    size="small" 
                    style={{ width: '80%', marginBottom: '12px' }} 
                  />
                  <Skeleton.Input 
                    active 
                    size="small" 
                    style={{ width: '60%' }} 
                  />
                </div>
              </div>
            ))
          ) : (
            // Tampilkan produk asli
            products.map((product) => (
              <a key={product.id} href={`/detail-products/${product.id}`} className="block">
                <img
                  src={`http://localhost:8000/storage/${product.picture}`}
                  alt={product.name}
                  className="w-full h-60 object-cover rounded-lg"
                />
                <div className="bg-white rounded-lg overflow-hidden">
                  <div className="p-4">
                    <h3 className="text-lg font-semibold">{product.name}</h3>
                    <p className="text-gray-600">Rp. {product.price}</p>
                  </div>
                </div>
              </a>
            ))
          )}
        </div>
      </section>

      <LogoutButton />
      <SubFooter />
      <Footer />
    </div>
  );
};

export default Home;