import React, { useEffect, useState } from "react";
import axios, { Axios } from "axios";
import SidebarAdmin from "../components/SIdebar-Admin";
import CustomerUpdate from "./CustomerUpdate";
import { useNavigate } from "react-router-dom";

const Customers =  () => {
    const [customers, setCustomers] = useState([]);
    const navigate = useNavigate();

    const GetCustomers = async () => {
        try {
            const token = localStorage.getItem("token");
            const response = await axios.get("http://localhost:8000/api/customers", {
                headers: {
                    Authorization: `Bearer ${token}`,
                },
            });
            setCustomers(response.data);
        } catch (error) {
            console.error("failed to fetch data customers");
        }
    }
    

    useEffect( () => {
        GetCustomers();
    },[]);

    const handleDelete = async (id) => {
        try {
            const token = localStorage.getItem("token");
        await axios.delete(`http://localhost:8000/api/customers/${id}`, {
            headers : {
                Authorization: `Bearer ${token}`,
            },
        });
        alert("Successfully deleted data")
        } catch (error) {
            alert("Gagal hapus data");
        }  
    };
    const goToUpdateCustomer = (id) => {
        navigate(`/customers/edit/${id}`);
    }

    return (
        <section className="flex">
            <SidebarAdmin/>
            {/* customers List */}
            <section class="mt-8 flex-1 p-6">
                <div class="flex justify-between mb-5">
                    <h2 class="text-xl font-bold mb-4">Data customers</h2>
                    <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-3 px-2 rounded-lg"><a href="/customers/create">New customer</a></button>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full bg-white shadow rounded-lg">
                        <thead class="bg-gray-100 border-b">
                            <tr>
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Picture</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Name</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Email</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-600">Role</th>
                                <th class="text-left py-3 px-4 font-medium text-gray-600"></th>

                            </tr>
                        </thead>
                        <tbody>
                            {customers.map((customer) => (
                                <tr key={customer.id} class="border-b hover:bg-gray-50">
                                    <td class="py-3 px-4 flex items-center">
                                        <img class="w-10 h-10 rounded-full mr-3" src={`http://localhost:8000/storage/${customer.profil}`} alt="Profile" />
                                        <span class="text-gray-800"></span>
                                    </td>
                                    <td class="py-3 px-4 text-gray-600">{customer.name}</td>
                                    <td class="py-3 px-4 text-gray-600">{customer.email}</td>
                                    <td class="py-3 px-4 text-gray-600">{customer.role}</td>
                                    <td className='flex gap-3 mt-[-20px]'>
                                        <button onClick={() => goToUpdateCustomer(customer.id)} className='hover:text-green-500 cursor-pointer'>Edit</button>
                                        <button onClick={() => handleDelete(customer.id)} className='hover:text-red-500 cursor-pointer'>Delete</button>
                                    </td>
                                </tr>
                            ))}
                        </tbody>
                    </table>
                </div>
            </section>
        </section>
    )
};
export default Customers;
