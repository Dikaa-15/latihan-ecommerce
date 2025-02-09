import React from "react";

import { useNavigate } from "react-router-dom";
import Navbar from "./Navbar";
import Footer from "./Footer";

const SuccessPage = () => {
    const navigate = useNavigate();

    const goToCart = () => {
        navigate('/cart');
    }

    return (
        <section>
            <Navbar />
            <div className="container w-[50%] text-center mx-auto">
                <div className="image mb-3">
                    <img src="../../../public/success.jpg" alt="" />
                </div>
                <div className="text mb-3">
                    <h2 className="font-bold font-serif text-gray-950 text-xl">Yes, Payment Complete!</h2>
                    <h5 className="text-gray-600 text-md ">Belaanjaanmu terverifikasi, silahkan tunggu pesananmu sampai diruma</h5>
                </div>
                <button className="w-96 py-3 bg-blue-700 text-white rounded-md" onClick={goToCart}>Tracking Order</button>
            </div>
            <Footer/>
        </section>
    )
};
export default SuccessPage;