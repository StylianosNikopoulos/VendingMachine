@extends('layouts.mylayout')

@section('content')
<main class="flex-grow flex flex-col items-center justify-center container mx-auto px-4 lg:px-8 py-10">
    <h2 class="welcome-message text-center">Welcome to Vending Machine!</h2>
    @if (!Auth::user())
        <h2 class="welcome-message text-center">Login and enjoy !</h2>
    @endif
    @if (Auth::user() && Auth::user()->role == 'seller')
    <h2 class="welcome-message">As a {{ Auth::user()->role }}, you can add your Products</h2>
    @endif

    @if (Auth::user() && Auth::user()->role == 'buyer')
    <h2 class="welcome-message">As a {{ Auth::user()->role }}, you can buy Products</h2>
    @endif

    <br>

    <div class="mt-6 space-x-4">
        @if (Auth::user() && Auth::user()->role == 'buyer')
        <a href="{{ route('Buyers.deposit') }}" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Deposit</a>
        <a href="{{ route('Buyers.buyproducts') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Buy Products</a>


        <form action="{{ route('resetDeposit') }}" method="POST" class="inline">
            @csrf
            <button type="submit" class="inline-block px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Reset Deposit</button>
        </form>
        @endif
        @if (Auth::user() && Auth::user()->role == 'seller')
        <a href="{{ route('Sellers.otherProducts') }}" class="inline-block px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">See Other Products</a>
        @endif 
    </div>

    @if(session('status'))
        <div class="mt-4 text-green-600">{{ session('status') }}</div>
    @endif
</main>
@endsection
