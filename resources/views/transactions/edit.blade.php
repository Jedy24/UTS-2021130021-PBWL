@extends('layouts.template')

@section('title', 'Update Transaction')

@section('content')
    <div class="mt-4 p-5 bg-black text-white rounded">
        <h1>Update Data Transaction</h1>
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
            <form action="{{ route('transactions.update', $transaction) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="amount" class="form-label">Amount (IDR)</label>
                    <input type="number" class="form-control" id="amount" name="amount" step="1" value="{{ old('amount', $transaction->amount) }}" required>
                </div>

                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="type" class="form-label">Type</label>
                    <select class="form-control" id="type" name="type" required>
                        <option disabled selected="selected">Choose Option</option>
                        <option value="income" {{ $transaction->type === 'income' ? 'selected' : ''}}>Income</option>
                        <option value="expense" {{ $transaction->type === 'expense' ? 'selected' : ''}}>Expense</option>
                    </select>
                </div>

                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-control" required>
                        @foreach($categoryOptions[$transaction->type] as $category)
                            <option value="{{ $category }}" {{ $category == $transaction->category ? 'selected' : '' }}>{{ $category }}</option>
                        @endforeach

                        @foreach($categories as $category)
                            @php
                                $capitalizedCategory = ucwords($category);
                            @endphp
                            <option class="hidden-option" disabled value="{{ $category }}" {{ $category == $transaction->category ? 'selected' : '' }}>{{ $capitalizedCategory }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="notes" class="form-label">Notes</label>
                    <textarea id="notes" class="form-control" name="notes" value="{{ old('notes') }}">{{ $transaction->notes }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </form>
        </div>
    </div>

    <script>
        var categoryDropdown = document.getElementById('category');
        var hiddenOptions = categoryDropdown.querySelectorAll('.hidden-option');

        // Hide disabled option
        function hideDisabledOptions() {
            hiddenOptions.forEach(function(option) {
                option.style.display = 'none';
            });
        }

        hideDisabledOptions();

        categoryDropdown.addEventListener('change', function() {
            hideDisabledOptions();
        });
    </script>
@endsection
