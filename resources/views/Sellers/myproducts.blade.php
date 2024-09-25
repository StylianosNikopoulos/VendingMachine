@extends('layouts.mylayout')

@section('content')
<main class="flex-grow flex flex-col items-center justify-center container mx-auto px-4 lg:px-8 py-10">
    <h2 class="text-center text-3xl font-bold text-gray-800">My Products</h2>
    
    @if(session('status') || session('alert'))
    <div class="mt-4 {{ session('status') ? 'text-green-600' : 'text-red-600' }} transition-all duration-300">
        {{ session('status') ?? session('alert') }}
    </div>
    @endif

    @if($products->isEmpty())
        <div class="mt-4 text-gray-600 text-lg">You have not added any products yet.</div>
    @else
        <ul class="mt-6 w-full">
            @foreach($products as $product)
                <li class="flex justify-between items-center border-b border-gray-300 py-4">
                    <div>
                        <strong class="text-lg text-gray-800">{{ $product->productName }}</strong><br>
                        <span class="text-gray-600">Amount Available: <span class="font-semibold">{{ $product->amountAvailable }}</span></span><br>
                        <span class="text-gray-600">Cost: <span class="font-semibold">{{ $product->cost }} cents</span></span>
                    </div>
                    <div class="flex space-x-4">
                        <a href="{{ route('Sellers.editproducts', $product->id) }}" class="text-blue-600 hover:underline">Edit</a>
                        <form action="{{ route('Sellers.deleteProduct', $product->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</main>
@endsection
