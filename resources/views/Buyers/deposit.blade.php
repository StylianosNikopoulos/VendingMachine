@extends('layouts.mylayout')

@section('content')
<main class="content-wrapper">
    <h2 class="page-title">Deposit Coins</h2>
    
    @if(session('status') || session('alert'))
    <div class="status-message {{ session('status') ? 'status-success' : 'status-error' }}">
        {{ session('status') ?? session('alert') }}
    </div>
    @endif
    
    <form action="{{ route('deposit') }}" method="POST" class="form-container">
        @csrf
        
        <label for="amount" class="form-label">Select Amount</label>
        <select name="amount" id="amount" required class="form-select">
            <option value="" disabled selected>Select a coin</option>
            <option value="5">5 cents</option>
            <option value="10">10 cents</option>
            <option value="20">20 cents</option>
            <option value="50">50 cents</option>
            <option value="100">100 cents</option>
        </select>

        <p class="total-amount">Your Total Amount: {{ $user->deposit }} cents</p>

        <div class="form-group">
            <button type="submit" class="form-button">Deposit</button>
        </div>
    </form>
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

    .form-container {
        width: 100%;
        max-width: 400px;
    }

    .form-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 500;
        color: #374151;
        margin-bottom: 8px;
    }

    .form-select {
        width: 100%;
        padding: 8px;
        border: 1px solid #d1d5db;
        border-radius: 6px;
        margin-top: 4px;
        outline: none;
        font-size: 1rem;
        appearance: none;
        background-color: #fff;
        transition: border-color 0.3s ease;
    }

    .form-select:focus {
        border-color: #6366f1; 
        box-shadow: 0 0 0 2px rgba(99, 102, 241, 0.2);
    }

    .total-amount {
        margin-top: 16px;
        font-size: 1rem;
        font-weight: bold;
        color: #4b5563; 
    }

    .form-group {
        margin-top: 24px;
    }

    .form-button {
        width: 100%;
        padding: 12px;
        background-color: #16a34a; 
        color: white;
        border-radius: 6px;
        cursor: pointer;
        font-weight: bold;
        text-align: center;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .form-button:hover {
        background-color: #15803d; 
    }
</style>
