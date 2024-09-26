@extends('layouts.mylayout')

@section('content')
<main class="content-wrapper">
    <h2 class="page-title">Available Products</h2>
    
    @if(session('status') || session('alert'))
        <div class="status-message {{ session('status') ? 'status-success' : 'status-error' }}">
            {{ session('status') ?? session('alert') }}
        </div>
    @endif

    <div class="products-container">
        @foreach($products as $product)
            <div class="product-card">
                <h3 class="product-name">{{ $product->productName }}</h3>
                <p>Amount Available: {{ $product->amountAvailable }}</p>
                <p>Cost: {{ $product->cost }} cents</p>
                <p>(From User: {{ $product->seller->name }})</p>
            </div>
        @endforeach
    </div>
</main>
@endsection

<style>
    .content-wrapper {
        display: flex;
        flex-grow: 1;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        max-width: 100%;
        padding: 40px 20px;
    }

    .page-title {
        text-align: center;
        font-size: 1.75rem;
        font-weight: bold;
        margin-bottom: 24px;
        color: #1a202c;
    }

    .status-message {
        margin-top: 16px;
        padding: 10px;
        text-align: center;
        transition: all 0.3s ease;
    }

    .status-success {
        color: #16a34a; 
    }

    .status-error {
        color: #dc2626; 
    }

    .products-container {
        width: 100%;
        max-width: 40rem; 
    }

    .product-card {
        border: 1px solid #e5e7eb; 
        padding: 1rem;
        margin-bottom: 16px;
        border-radius: 8px;
        background-color: #fff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
    }

    .product-name {
        font-size: 1.25rem;
        font-weight: bold;
        margin-bottom: 8px;
        color: #1a202c; 
    }

    .purchase-form {
        margin-top: 16px;
    }

    .quantity-group {
        display: flex;
        align-items: center;
    }

    .quantity-label {
        margin-right: 8px;
        font-size: 0.875rem;
        color: #4b5563; 
    }

    .quantity-input {
        padding: 0.5rem;
        border: 1px solid #d1d5db; 
        border-radius: 4px;
        width: 60px;
        font-size: 1rem;
    }

    .buy-button {
        margin-top: 8px;
        padding: 0.5rem 1rem;
        background-color: #2563eb; 
        color: white;
        border-radius: 0.375rem;
        cursor: pointer;
        font-weight: bold;
        text-align: center;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .buy-button:hover {
        background-color: #1d4ed8; 
    }
</style>
