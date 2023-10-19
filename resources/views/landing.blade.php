@extends('layouts.template')

@section('title', 'Landing Page')

@section('content')
 <div class="container">
    <div class="row">
        <div class="col-lg">
            <div class="row">
        @forelse ($transactions as $transaction)
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-body">
                        <strong class="d-inline-block mb-2 text-primary">Transaction</strong>
                        <h2 class="card-title h4">{{ $transaction->id }}</h2>
                        <p class="card-text">Amount: {{ $transaction->amount }}, Type: {{ ucfirst($transaction->type) }}, ....</p>
                        <a class="btn btn-primary" href="{{ route('transactions.show', $transaction) }}">Read more →</a>
                    </div>
                </div>
            </div>
        @empty
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-body">
                    <h2 class="card-text mb-auto">No transaction found.</h2>
                </div>
            </div>
        </div>
        @endforelse
        {{ $transactions->links() }}
    </div>
 </div>
@endsection
