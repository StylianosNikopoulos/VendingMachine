<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Jetstream\Jetstream;

class UserController extends Controller
{
    //Show users
    public function index(){
        $users = User::all();
        return response()->json($users);
    }

    public function show($id){
        $user = User::find($id);
        return response()->json($user);
    }

    //Create users
    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
            'role' => 'required|in:buyer,seller',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'role' => $validated['role'],
        ]);

        return response()->json($user, 201);
    }

    //Update users
    public function update(Request $request, $id){
        $user = User::findOrFail($id);
        $user->update($request->only('name', 'email', 'role'));
        return response()->json($user);
    }

    //Delete users
    public function destroy($id){
        User::find($id)->delete();
        return response()->json(['message' => 'User deleted'], 204);
    }

    // ----------------------------------------------------------------

    //Deposit amount of user
    public function deposit(Request $request){
        /** @var User $user */
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthenticated'], 401);
        }

        if ($user->role !== 'buyer') {
            return response()->json(['message' => 'Forbidden'], 403);
        }

        $request->validate([
            'amount' => 'required|numeric|in:5,10,20,50,100',
        ]);

        $user->deposit += $request->amount;
        $user->save();  

        return redirect()->back()->with('status', 'Cents added successfully!');
    }

    public function showDepositForm(){
        $user = Auth::user(); 

        if ($user->role !== 'buyer') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $user = Auth::user(); 
        return view('Buyers.deposit',compact('user')); 
    }

    //Users buy products from sellers
    public function buy(Request $request){
        /** @var User $user */
        $user = Auth::user();
        
        if ($user->role !== 'buyer') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'amount' => 'required|numeric|min:1',
        ]);

        $product = Product::findOrFail($request->product_id); 

        $totalCost = $product->cost * $request->amount;

        if ($user->deposit < $totalCost) {
            return redirect()->back()->with('alert', 'Not enough cents!');
        }

        if ($product->amountAvailable < $request->amount) {
            return redirect()->back()->with('alert', 'Not enough product available');
        }

        $user->deposit -= $totalCost;
        $user->save(); 

        $product->amountAvailable -= $request->amount; 
        $product->save(); 

        $change = $this->calculateChange($user->deposit);

        return redirect()->back()->with('status', 'Purchase successful!'); 
    }

    public function buyProducts() {
        $user = Auth::user();

        if ($user->role !== 'buyer') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
    
        $products = Product::with('seller')->get(); //Get the sellerId to see who owns the product
        return view('Buyers.buyproducts', compact('products'));
    }

    //Calculates the change
    public function calculateChange($amount){
        $coins = [100, 50, 20, 10, 5];
        $change = [];

        foreach ($coins as $coin) {
            while ($amount >= $coin) {
                $change[] = $coin;
                $amount -= $coin;
            }
        }
        return $change;
    }

    //Reset deposit amount
    public function resetDeposit(Request $request){
        /** @var User $user */
        $user = Auth::user();

        if ($user->role !== 'buyer') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        
        $user->deposit = 0; 
        $user->save();
    
        return redirect()->back()->with('status', 'Deposit reset successful');
    }

    //Show other products from sellers
    public function otherProducts(){
        $user = Auth::user();

        if ($user->role !== 'seller') {
            return response()->json(['message' => 'Forbidden'], 403);
        }
        $products = Product::all();

        return view('Sellers.otherproducts', compact('products'));
    }

}
