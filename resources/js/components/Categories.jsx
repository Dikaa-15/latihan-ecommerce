import React from "react";

const Categories = () => {

    return (
        <section className="px-10 py-10">
            <h2 className="text-2xl font-bold mb-6">Categories</h2>
            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">

                <div className="flex flex-col items-center p-4 bg-gray-100 rounded-lg shadow">
                    <div className="w-16 h-16 flex items-center justify-center rounded-full bg-gray-200">
                        <img src="{{ asset('categorys/bread 1.png') }}" alt="Snack" className="w-10 h-10"/>
                    </div>
                    <span className="mt-4 text-gray-700 font-medium">Snack</span>
                </div>

                <div className="flex flex-col items-center p-4 bg-gray-100 rounded-lg shadow">
                    <div className="w-16 h-16 flex items-center justify-center rounded-full bg-gray-200">
                        <img src="{{ asset('categorys/bread 1.png') }}" alt="Bread" className="w-10 h-10"/>
                    </div>
                    <span className="mt-4 text-gray-700 font-medium">Bread</span>
                </div>
                <div className="flex flex-col items-center p-4 bg-gray-100 rounded-lg shadow">
                    <div className="w-16 h-16 flex items-center justify-center rounded-full bg-gray-200">
                        <img src="{{ asset('categorys/bread 1.png') }}" alt="Junk Food" className="w-10 h-10"/>
                    </div>
                    <span className="mt-4 text-gray-700 font-medium">Junk Food</span>
                </div>
                <div className="flex flex-col items-center p-4 bg-gray-100 rounded-lg shadow">
                    <div className="w-16 h-16 flex items-center justify-center rounded-full bg-gray-200">
                        <img src="{{ asset('categorys/bread 1.png') }}" alt="Milk" className="w-10 h-10"/>
                    </div>
                    <span className="mt-4 text-gray-700 font-medium">Milk</span>
                </div>
                <div className="flex flex-col items-center p-4 bg-gray-100 rounded-lg shadow">
                    <div className="w-16 h-16 flex items-center justify-center rounded-full bg-gray-200">
                        <img src="{{ asset('categorys/bread 1.png') }}" alt="Drink Water" className="w-10 h-10"/>
                    </div>
                    <span className="mt-4 text-gray-700 font-medium">Drink Water</span>
                </div>
            </div>
        </section>

    )
}

export default Categories;