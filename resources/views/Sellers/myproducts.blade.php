@extends('layouts.mylayout')

@section('content')
<main class="products-wrapper">
    <h2 class="title">My Products</h2>
    
    @if(session('status') || session('alert'))
    <div class="status-message {{ session('status') ? 'status-success' : 'status-error' }}">
        {{ session('status') ?? session('alert') }}
    </div>
    @endif

    @if($products->isEmpty())
        <div class="no-products-message">You have not added any products yet.</div>
    @else
        <ul class="products-list">
            @foreach($products as $product)
                <li class="product-item">
                    <div class="product-details">
                        <strong class="product-name">{{ $product->productName }}</strong><br>
                        <span class="product-amount">Amount Available: <span class="amount-value">{{ $product->amountAvailable }}</span></span><br>
                        <span class="product-cost">Cost: <span class="cost-value">{{ $product->cost }} cents</span></span>
                    </div>
                    <div class="product-actions">
                        <a href="{{ route('Sellers.editproducts', $product->id) }}" class="edit-link">Edit</a>
                        <form action="{{ route('Sellers.deleteProduct', $product->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-button">Delete</button>
                        </form>
                    </div>
                </li>
            @endforeach
        </ul>
    @endif
</main>
@endsection

<style>
    .products-wrapper {
        display: flex;
        flex-grow: 1;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        max-width: 100%;
        padding: 40px 20px;
    }

    .title {
        text-align: center;
        font-size: 2rem;
        font-weight: bold;
        color: #1f2937;
        margin-bottom: 24px;
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

    .no-products-message {
        margin-top: 16px;
        font-size: 1.125rem;
        color: #4b5563; 
    }

    .products-list {
        margin-top: 24px;
        width: 100%;
    }

    .product-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #d1d5db;
        padding: 16px 0;
    }

    .product-details {
        color: #374151;
    }

    .product-name {
        font-size: 1.125rem;
        font-weight: bold;
        color: #1f2937;
    }

    .product-amount,
    .product-cost {
        font-size: 0.875rem;
        color: #6b7280;
    }

    .amount-value,
    .cost-value {
        font-weight: bold;
    }

    .product-actions {
        display: flex;
        gap: 16px;
    }

    .edit-link {
        color: #2563eb;
        text-decoration: none;
    }

    .edit-link:hover {
        text-decoration: underline;
    }

    .delete-form {
        display: inline-block;
    }

    .delete-button {
        color: #dc2626;
        background: none;
        border: none;
        cursor: pointer;
        text-decoration: none;
    }

    .delete-button:hover {
        text-decoration: underline;
    }
</style>
