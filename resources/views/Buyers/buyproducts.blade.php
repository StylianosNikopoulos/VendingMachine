@extends('layouts.mylayout')

@section('content')
<main class="flex-grow flex flex-col items-center justify-center container mx-auto px-4 lg:px-8 py-10">
    <h2 class="text-center text-2xl font-bold">Available Products</h2>
    
    @if(session('status') || session('alert'))
    <div class="mt-4 {{ session('status') ? 'text-green-600' : 'text-red-600' }} transition-all duration-300">
        {{ session('status') ?? session('alert') }}
    </div>
    @endif


    <div class="mt-6 w-full max-w-2xl">
        @foreach($products as $product)
            <div class="border p-4 mb-4 rounded shadow">
                <h3 class="text-lg font-semibold">{{ $product->productName }}</h3>
                <p>Amount Available: {{ $product->amountAvailable }}</p>
                <p>Cost: {{ $product->cost }} cents</p>
                <p>(From User: {{ $product->seller->name }})</p>
                <form action="{{ route('buy', ['product_id' => $product->id]) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="flex items-center">
                        <label for="amount_{{ $product->id }}" class="mr-2">Quantity:</label>
                        <input type="number" name="amount" id="amount_{{ $product->id }}" min="1" required class="border rounded-md p-2" placeholder="1">
                    </div>
                    <button type="submit" class="mt-2 inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">
                        Buy
                    </button>
                </form>
            </div>
        @endforeach
    </div>
</main>
@endsection
