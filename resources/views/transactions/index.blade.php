@extends('layouts.template')

@section('title', 'Transaction List')

@section('content')
    <div class="mt-4 p-5 bg-black text-white rounded">
        <h1>Transaction List</h1>

        {{-- Add button --}}
        <a href="{{ route('transactions.create') }}" class="btn btn-primary btn-sm">Add New Transaction</a>
    </div>

    @if (session()->has('success'))
    <div class="alert alert-success mt-4">
        {{ session()->get('success') }}
    </div>
    @endif

    <div class="container mt-5">
    <div class="row mb-4">
        <div class="col-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Income</h5>
                    <p class="card-text">Rp. {{ number_format($totalIncome, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Expense</h5>
                    <p class="card-text">Rp. {{ number_format($totalExpense, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Balance</h5>
                    <p class="card-text">Rp. {{ number_format($balance, 0, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-4">
                <div class="card-body">
                    <h5 class="card-title">Total Transactions Income</h5>
                    <p class="card-text">{{ $incomeCount }}</p>
                </div>
            </div>
        </div>
        <div class="col-3">
            <div class="card mb-2">
                <div class="card-body">
                    <h5 class="card-title">Total Transactions Expense</h5>
                    <p class="card-text">{{ $expenseCount }}</p>
                </div>
            </div>
        </div>
    </div>

        <table class="table table-bordered mb-5">
            <thead>
                <tr class="table-success">
                    <th scope="col">Id</th>
                    <th scope="col">Amount</th>
                    <th scope="col">Type</th>
                    <th scope="col">Category</th>
                    <th scope="col">Notes</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Updated At</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($transactions as $transaction)
                    <tr>
                        <th scope="row"><a href="{{ route('transactions.show', $transaction) }}">{{ $transaction->id }}</a></th>
                        <td>Rp. {{ number_format($transaction->amount, 0, ',', '.') }}</td>
                        <td>{{ ucfirst($transaction->type) }}</td>
                        <td>{{ ucfirst($transaction->category) }}</td>
                        <td>{{ $transaction->notes }}</td>
                        <td>{{ $transaction->created_at }}</td>
                        <td>{{ $transaction->updated_at }}</td>
                        <td><a href="{{ route('transactions.edit', $transaction) }}" class="btn btn-primary btn-sm">Edit</a>
                            <form action="{{ route('transactions.destroy', $transaction) }}" method="POST" class="d-inline-block">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No Transaction found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {!! $transactions->links() !!}
        </div>

    </div>
@endsection
