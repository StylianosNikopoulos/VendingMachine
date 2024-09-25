@extends('layouts.mylayout')

@section('content')
<main class="flex-grow flex flex-col items-center justify-center container mx-auto px-4 lg:px-8 py-10">
    <h2 class="text-center text-2xl font-bold">Deposit Coins</h2>
    
    @if(session('status') || session('alert'))
    <div class="mt-4 {{ session('status') ? 'text-green-600' : 'text-red-600' }} transition-all duration-300">
        {{ session('status') ?? session('alert') }}
    </div>
    @endif
    
    <form action="{{ route('deposit') }}" method="POST" class="mt-6 w-full max-w-md">
        @csrf
        
        <label for="amount" class="block text-sm font-medium text-gray-700">Select Amount</label>
        <select name="amount" id="amount" required class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
            <option value="" disabled selected>Select a coin</option>
            <option value="5">5 cents</option>
            <option value="10">10 cents</option>
            <option value="20">20 cents</option>
            <option value="50">50 cents</option>
            <option value="100">100 cents</option>
        </select>

        <p class="mt-4">Your Total Amount: {{ $user->deposit }} cents</p>

        <div class="mt-6">
            <button type="submit" class="inline-block px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">
                Deposit
            </button>
        </div>
    </form>
</main>
@endsection
