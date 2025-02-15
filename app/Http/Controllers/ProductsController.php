<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\category;
use App\Models\products;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    //
    public function index()
    {
        $category = category::all();
        return view('products')->with('category', $category);
    }

    public function searchProducts()
    {
        $search = Request()->name;
        $products = products::with('category')
            ->where('name', 'like', '%'.$search.'%')
            ->orWhere('description', 'like', '%'.$search.'%')
            ->get();
        return response()->json(['status' => 'success', 'products' => $products], 200);
    }

    public function productById($id)
    {
        try{
            $category = category::all();
            $product = products::with('category')->find($id);
            return view('productById')->with(['product' => $product, 'category' => $category, 'id' => $id]);
        }
        catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
        
    }

    public function showproductById($id)
    {
        try{
            $product = products::with('category')->find($id);
            return view('product-details')->with(['product' => $product, 'id' => $id]);
        }
        catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function deleteproduct($id)
    {
        $product = products::find($id);
        $product->delete();

        return response()->json(['status' => 'success', 'message' => 'Product Deleted Successfully'], 200);
    }

    public function updateproduct($id)
    {
        $product = products::find($id);
        $product->name = request('name');
        $product->description = request('description');
        $product->price = request('price');
        $product->category_id = request('category');
        $product->stock = request('stock');
        $product->save();

        return response()->json(['status' => 'success', 'product' => $product], 200);
    }

    public function getProducts()
    {
        try{
            $products = products::with('category')->get();
            return response()->json(['status' => 'success', 'products' => $products], 200);
        }
        catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function getApiProducts($id)
    {
        try{
            $product = products::with('category')->find($id);
            return response()->json(['status' => 'success', 'products' => $product], 200);
        }
        catch(\Exception $e){
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }

    public function addProducts(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'category' => 'required|exists:categories,id',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $imageName = time().'.'.$request->image->extension();  
            $request->image->move(public_path('images'), $imageName);

            $product = new products();
            $product->name = $request->name;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->category_id = $request->category;
            $product->image = $imageName;
            $product->stock = $request->stock;
            $product->save();

            return response()->json(['status' => 'success', 'product' => $product], 201);
        } catch (\Exception $e) {
            return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
        }
    }
}
