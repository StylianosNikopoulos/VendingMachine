@extends('layouts.mylayout')

@section('content')
<main class="content-wrapper">
    <div class="form-container">
        <h2 class="form-title">Add New Product</h2>

        @if(session('status') || session('alert'))
        <div class="status-message {{ session('status') ? 'status-success' : 'status-error' }}">
            {{ session('status') ?? session('alert') }}
        </div>
        @endif

        <form action="{{ route('Sellers.addproducts') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="productName" class="form-label">Product Name</label>
                <input type="text" name="productName" id="productName" required class="form-input" placeholder="Enter product name">
            </div>

            <div class="form-group">
                <label for="amountAvailable" class="form-label">Amount Available</label>
                <input type="number" name="amountAvailable" id="amountAvailable" required class="form-input" placeholder="Enter amount available">
            </div>

            <div class="form-group">
                <label for="cost" class="form-label">Cost (in cents)</label>
                <input type="number" name="cost" id="cost" required class="form-input" placeholder="Enter product cost">
            </div>

            <div class="form-group">
                <button type="submit" class="form-button">Add Product</button>
            </div>
        </form>
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

.form-container {
    background-color: white;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    border: 1px solid #d1d5db;
    border-radius: 8px;
    padding: 32px;
    max-width: 400px;
    width: 100%;
}

.form-title {
    text-align: center;
    font-size: 1.5rem;
    font-weight: bold;
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

.form-group {
    margin-bottom: 16px;
}

.form-label {
    display: block;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151;
}

.form-input {
    width: 100%;
    padding: 8px;
    border: 1px solid #d1d5db;
    border-radius: 6px;
    margin-top: 4px;
    outline: none;
    font-size: 1rem;
}

.form-input:focus {
    border-color: #6366f1; 
    box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
}

.form-button {
    width: 100%;
    padding: 12px;
    background-color: #2563eb;
    color: white;
    border-radius: 6px;
    cursor: pointer;
    font-weight: bold;
}

.form-button:hover {
    background-color: #1d4ed8;
}

</style>