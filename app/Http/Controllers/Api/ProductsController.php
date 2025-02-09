<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);

        return response()->json(['message' => 'List Data Products', 'Data' => $products], 201);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:255',
            'picture' => 'required|image|mimes:png,jpg,jpeg',
            'price' => 'required|'
        ]);
    }
    
}
