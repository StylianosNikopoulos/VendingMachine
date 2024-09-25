@extends('layouts.mylayout')

@section('content')
<main class="flex-grow flex flex-col items-center justify-center container mx-auto px-4 lg:px-8 py-10">
    <h2 class="text-center text-2xl font-bold">Add New Product</h2>
    
    @if(session('status') || session('alert'))
    <div class="mt-4 {{ session('status') ? 'text-green-600' : 'text-red-600' }} transition-all duration-300">
        {{ session('status') ?? session('alert') }}
    </div>
    @endif
    
    <form action="{{ route('Sellers.addproducts') }}" method="POST" class="mt-6 w-full max-w-md">
        @csrf
        
        <div class="mb-4">
            <label for="productName" class="block text-sm font-medium text-gray-700">Product Name</label>
            <input type="text" name="productName" id="productName" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter product name">
        </div>

        <div class="mb-4">
            <label for="amountAvailable" class="block text-sm font-medium text-gray-700">Amount Available</label>
            <input type="number" name="amountAvailable" id="amountAvailable" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter amount available">
        </div>

        <div class="mb-4">
            <label for="cost" class="block text-sm font-medium text-gray-700">Cost (in cents)</label>
            <input type="number" name="cost" id="cost" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Enter product cost">
        </div>

        <div class="mt-6">
            <button type="submit" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                Add Product
            </button>
        </div>
        
    </form>
</main>
@endsection
