import React, { useEffect, useState } from "react";
import axios from "axios";
import SideBarUser from "../components/SideBarUser";


const ProfilUser = () => {
    const [user, setUser] = useState({
        name: '',
        email: '',
        profil: null,
        phone_number: ''
    });

    const [priviewImage, setPreviewImage] = useState(null);

    const getProfil = async () => {
        try {
            const token = localStorage.getItem("token");
            if (!token) {
                console.error("Token not found");
                return;
            }
            const response = await axios.get("http://localhost:8000/api/profile", {
                headers: {
                    Authorization: `Bearer ${token}`
                },
            });
            setUser(response.data.user);
        } catch (error) {
            console.error("failed to get profil", error)
            alert("Failed to get profil");
        }
    };
    useEffect(() => {
        getProfil();
    }, []);

    const handleChange = (e) => {
        setUser({ ...user, [e.target.name]: e.target.value });
    };

    const handleFileChange = (e) => {
        const file = e.target.files[0];
        setUser({ ...user, profil: file });

        // preview image
        const reader = new FileReader();
        reader.onloadend = () => {
            setPreviewImage(reader.result);
        };
        reader.readAsDataURL(file);
    };

    const handleSubmit = async (e) => {
        e.preventDefault();
        const token = localStorage.getItem("token");

        const formData = new FormData();
        formData.append("name", user.name);
        formData.append("email", user.email);
        formData.append("phone_number", user.phone_number);
        if (user.profil) {
            formData.append("profil", user.profil);
        }

        try {
            await axios.post("http://localhost:8000/api/profile-update", formData, {
                headers: {
                    Authorization: `Bearer ${token}`,
                    "Content-Type": "multipart/form-data",
                },
            });
            alert("Profile Updated Successfully");
            getProfil();
        } catch (error) {
            console.error("Failed to update profile", error);
            alert("Failed to update profile");
        }
    };

    return (
        <section className="flex h-min-screen">
            <SideBarUser />
            <div className="p-8 w-full">
                <h1 className="text-2xl font-bold mb-4">Update Profile</h1>

                <form onSubmit={handleSubmit} className="bg-white shadow-md rounded px-8 pt-6 pb-8">
                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2">Foto Profil:</label>
                        <div className="mb-2">
                            <img src={priviewImage || (user.profil ? `http://localhost:8000/storage/users/${user.profil}` : 'default.jpg')} alt="Foto Profil"
                                className="w-32 h-32 rounded-full object-cover" />
                        </div>
                        <input type="file" onChange={handleFileChange} className="border p-2 w-full" />
                    </div>
                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                        <input
                            type="text"
                            name="name"
                            value={user.name}
                            onChange={handleChange}
                            className="border p-2 w-full"
                            required
                        />
                    </div>

                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                        <input
                            type="email"
                            name="email"
                            value={user.email}
                            onChange={handleChange}
                            className="border p-2 w-full"
                            required
                        />
                    </div>

                    <div className="mb-4">
                        <label className="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon:</label>
                        <input
                            type="text"
                            name="phone_number"
                            value={user.phone_number}
                            onChange={handleChange}
                            className="border p-2 w-full"
                            required
                        />
                    </div>

                    <button type="submit" className="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                        Simpan Perubahan
                    </button>
                </form>
            </div>
            {/* <form action="" method="POST" enctype="multipart/form-data" class="bg-white rounded px-8 pt-6 pb-8">

                <div class="mb-4">
                    <label for="profil" class="block text-gray-700 text-sm font-bold mb-2">Foto Profil : </label>
                    <div class="mb-2">
                        <img src="{{ Storage::url('users/' . $user->profil) }}" alt="Foto Profil"
                            class="w-32 h-32 rounded-full object-cover"/>
                    </div>

                    <input type="file" id="profil" name="profil"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"/>
                </div>

                <div class="mb-4">
                    <label for="name" class="block text-gray-700 text-sm font-bold mb-2">Nama:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required/>
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-gray-700 text-sm font-bold mb-2">Email:</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required/>
                </div>

                <div class="mb-4">
                    <label for="phone_number" class="block text-gray-700 text-sm font-bold mb-2">Nomor Telepon:</label>
                    <input type="text" id="phone_number" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}"
                        class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                        required/>
                </div>


                <div class="flex items-center justify-between">
                    <button type="submit"
                        class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                        Simpan Perubahan
                    </button>
                </div>
            </form> */}
            <div>
            </div>
        </section>
    )
};
export default ProfilUser;