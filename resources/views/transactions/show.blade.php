@extends('layouts.template')

@section('title', $transaction->id)

@section('content')
    <div class="d-flex justify-content-center align-items-center">
        <section class="blog-post">
            <h1 class="display-5 fw-bold">Id : {{ $transaction->id }}</h1>
            <p class="display-6">Amount : Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</p>
            <p class="display-6">Type : {{ ucfirst($transaction->type) }}</p>
            <p class="display-6">Category : {{ ucfirst($transaction->category) }}</p>
            <p class="display-6">Notes : {{ $transaction->notes }}</p>
            <p class="blog-post-meta">Updated : {{ $transaction->updated_at }}</p>
        </section>
    </div>
@endsection
