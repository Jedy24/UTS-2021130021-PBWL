@extends('layouts.template')

@section('title', 'Add New Transactions')

@section('content')
    <div class="mt-4 p-5 bg-black text-white rounded">
        <h1>Add New Transactions</h1>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger mt-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row my-5">
        <div class="col-12 px-5">
            <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="amount" class="form-label">Amount (IDR)</label>
                    <input type="number" class="form-control" id="amount" name="amount" step="1" value="{{ old('amount') }}" required>
                </div>

                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="income" {{ old('type') === 'income' ? 'selected' : ''}}>Income</option>
                        <option value="expense" {{ old('type') === 'expense' ? 'selected' : ''}}>Expense</option>
                    </select>
                </div>

                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-control" required>
                        @if(old('type') === 'income')
                            <option value="uncategorized">Uncategorized</option>
                        @elseif(old('type') === 'expense')
                            <option value="uncategorized">Uncategorized</option>
                            <option value="food & drinks">Food & Drinks</option>
                            <option value="shopping">Shopping</option>
                            <option value="charity">Charity</option>
                            <option value="housing">Housing</option>
                            <option value="insurance">Insurance</option>
                            <option value="taxes">Taxes</option>
                            <option value="transportation">Transportation</option>
                        @endif
                    </select>
                </div>


                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea id="notes" class="form-control"  name="notes" value="{{ old('notes') }}"></textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </form>
        </div>
    </div>
@endsection
