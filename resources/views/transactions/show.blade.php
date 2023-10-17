@extends('layouts.template')

@section('title', $transaction->id)

@section('content')
    <article class="blog-post my-4">
        <h1 class="display-5 fw-bold">{{ $transaction->id }}</h1>
        <p class="display-6">Amount : {{ $transaction->amount }}</p>
        <p class="display-6">Type : {{ $transaction->type }}</p>
        <p class="display-6">Category : {{ $transaction->category }}</p>
        <p class="display-6">Notes : {{ $transaction->notes }}</p>
        <p class="blog-post-meta">{{ $transaction->updated_at }}</p>
        <p>{{ $book->body }}</p>
    </article>
@endsection
