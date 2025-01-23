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
        $products = Product::latest()->paginate(10);
        
    return view('products.index', compact('products'));
    return new ApiResource(true, 'List data Products', $products);    
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

        if($validator->fails()){
            return response()->json(['error' => $validator->errors()], 422);
        }

        $picture = $request->file('picture');
        $picture->storeAs('public/products', $picture->hashName());

        $post = Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'picture' => $picture->hashName()
        ]);

        return new ApiResource(true, 'Data product berhasil ditambahkan', $post);

        return redirect()->route('products.index')->with(['success' => 'Data berhasil ditambahkan']);

        return back()->withErrors([
            'name' => 'Tidak dapat menambahkan data baru'
        ])->onlyInput('name');
    }
    public function show($id)
    {
        $product = Product::find($id);

        if(is_null($product)){
            return response()->json(['error' => 'Data tidak ditemukan'], 404);
        }

        // return new ApiResource(true, 'Detail product', $product);
        
        return view('products.show', compact('product'));
    }
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }
    public function update(Request $request,$id)
    {
        $product = Product::find($id);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'picture' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'price' => 'required|numeric',
            'description' => 'required|string|max:255',
            'quantity' => 'required|integer'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(), 402);
        }

        if($request->hasFile('picture'))
        {
            // upload new image
            $picture = $request->file('picture');
            $picture->storeAs('public/products', $picture->hashName());

            // delete old image
            Storage::delete('public/products/' . basename($product->picture));

            $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            'picture' => $picture->hashName()
            ]);
        } else {
            $product->update([
            'name' => $request->name,
            'price' => $request->price,
            'description' => $request->description,
            'quantity' => $request->quantity,
            ]);
        }

        return new ApiResource(true, 'Product berhasil diupdate', $product);

        return redirect()->route('products.index');
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
