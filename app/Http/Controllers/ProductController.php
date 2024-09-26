<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class ProductController extends Controller
{
    //Show all Products 
    public function index(){
        $product = Product::all();
        return response()->json($product);
    }

    //Show specific Products 
    public function show($id){
        $product = Product::findOrFail();
        return response()->json($product);
    }


    //Create Products
    public function create(){
        $user = Auth::user();
    
        if (!$user || $user->role !== 'seller') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        return view('Sellers.addproducts');
    }
    
    public function store(Request $request){
        $user = Auth::user(); 

        if (!$user || $user->role !== 'seller') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validated = $request->validate([
            'productName' => 'required|string|max:255',
            'amountAvailable' => 'required|integer',
            'cost' => 'required|numeric',
            
        ]);

        $existingProduct = Product::where('productName',$validated['productName'])
        ->where('sellerId',$user->id)
        ->first();

        if ($existingProduct) {
            return redirect()->back()->with('alert', 'A product with this name already exists.');
        }
    
        $product = Product::create([
            'productName' => $validated['productName'],
            'amountAvailable' => $validated['amountAvailable'],
            'cost' => $validated['cost'],
            'sellerId' => $user->id, 
        ]);
    
        return redirect()->back()->with('status', 'Product added successfully!');
    }
    

    //Edit Products
    public function edit($id){
        $user = Auth::user();
        
        if (!$user || $user->role !== 'seller') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $product = Product::findOrFail($id);
        
        if ($product->sellerId !== $user->id) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return view('Sellers.editproducts', compact('product'));
    }

    public function update(Request $request, $id){
        $user = Auth::user(); 


        if (!$user || $user->role !== 'seller') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $validated = $request->validate([
            'productName' => 'required|string|max:255',
            'amountAvailable' => 'required|integer',
            'cost' => 'required|numeric',
        ]);

        $product = Product::findOrFail($id);

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        $product->update($validated);
    
        return redirect()->route('Sellers.editproducts', $product->id)->with('status', 'Product updated successfully!');
    }

    //Seller see their products
    public function myProducts(){
        $user = Auth::user();
    
        if (!$user || $user->role !== 'seller') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $products = Product::where('sellerId', $user->id)->get();
        return view('Sellers.myproducts', compact('products'));
    }


    //Delete Products
    public function destroy($id){
        $user = Auth::user();


        if (!$user || $user->role !== 'seller') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $product = Product::findOrFail($id);

        if ($product->sellerId !== Auth::user()->id) {
            return response()->json(['error' => 'Unauthorized'], 401);  
        }

        $product->delete();
        return redirect()->back()->with('status', 'Product deleted successful!');
    }
}
