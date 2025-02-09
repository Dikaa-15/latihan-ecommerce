import React, { useEffect, useState } from "react";
import axios from "axios";
import SidebarAdmin from "../components/SIdebar-Admin";

const DashboardAdmin = () => {
    const [cards, setcards] = useState(null);

    

    useEffect(() => {
        const getcardsAdmin = async () => {
            try {
                const response = await axios.get('http://localhost:8000/api/cards-admin')
                setcards(response.data);
            } catch(error) {
                console.error(error);
            }  
        };
        getcardsAdmin();
    },[])
    return (

   <div className="flex">

    <SidebarAdmin/>

    <main className="flex-1 p-6">
      <header>
        <h1 className="text-3xl font-bold">Property Dashboard</h1>
        <p className="text-gray-600 mt-2">Welcome, Admin!</p>
      </header>

      {cards ? (
                <section className="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div className="bg-white shadow p-4 rounded-lg">
                  <h2 className="text-sm text-gray-500">Users</h2>
                  <p className="text-2xl font-bold mt-2">{cards.Users}</p>
                </div>
                <div className="bg-white shadow p-4 rounded-lg">
                  <h2 className="text-sm text-gray-500">Products</h2>
                  <p className="text-2xl font-bold mt-2">{cards.Products}</p>
                </div>
                <div className="bg-white shadow p-4 rounded-lg">
                  <h2 className="text-sm text-gray-500">Transactions</h2>
                  <p className="text-2xl font-bold mt-2">Rp. {cards.Transactions_Total}</p>
                </div>
              </section>
      ) : (
        <p>Loading</p>
      )}
    </main>
  </div>
    )
};
export default DashboardAdmin;