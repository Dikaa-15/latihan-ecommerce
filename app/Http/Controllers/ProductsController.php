<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Resources\ApiResource;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Validation\ValidatesRequests;

class ProductsController extends Controller
{
    use ValidatesRequests;

    public function index()
    {
        $products = Product::all();

        // return view('products.index', compact('products'));
        return response()->json($products, 200);
    }
    public function cards()
    {
        $products = Product::latest()->paginate(6);
        return view('home', compact('products'));
    }
    public function create()
    {
        return view('products.create');
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Proses upload gambar
        $imagePath = $request->file('picture')->store('products', 'public');

        // Menyimpan data produk ke database
        $product = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'picture' => $imagePath
        ]);

        return response()->json($product, 201);
    }
    // Method untuk menampilkan produk
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return response()->json($product);
    }

    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    // Method untuk memperbarui produk
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;

        if ($request->hasFile('picture')) {
            // Hapus gambar lama jika ada
            if ($product->picture) {
                Storage::delete('public/' . $product->picture);
            }
            // Simpan gambar baru
            $imagePath = $request->file('picture')->store('products', 'public');
            $product->picture = $imagePath;
        }

        $product->save();

        return response()->json($product, 200);
    }
    
    public function destroy($id)
    {
        $product = Product::find($id);

        Storage::delete('public/products/' . basename($product->picture));
        $product->delete();

        return new ApiResource(true, 'data berhasil dihapus', null);
        
        return redirect()->route('products.index');
    }
}
