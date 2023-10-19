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
                        <option disabled selected="selected">Choose Option</option>
                        <option value="income" {{ old('type') === 'income' ? 'selected' : ''}}>Income</option>
                        <option value="expense" {{ old('type') === 'expense' ? 'selected' : ''}}>Expense</option>
                    </select>
                </div>

                <div class="mb-3 col-md-12 col-sm-12">
                    <label for="category" class="form-label">Category</label>
                    <select id="category" name="category" class="form-control" required>
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

    <script>
    // Klasifikasi dropdown type dan kategori
    var typeDropdown = document.getElementById('type');
    var categoryDropdown = document.getElementById('category');

    // Pilihan untuk dropdown kategori
    var categoryOptions = {
        income: ['Uncategorized', 'Wage', 'Bonus', 'Gift'],
        expense: ['Uncategorized', 'Food & Drinks', 'Shopping', 'Charity', 'Housing', 'Insurance', 'Taxes', 'Transportation']
    };

    // Event listener untuk update kategori sesuai type
    typeDropdown.addEventListener('change', function() {
        categoryDropdown.innerHTML = '';

        // Membuat opsi baru sesuai dengan type
        var selectedType = typeDropdown.value;
        categoryOptions[selectedType].forEach(function(category) {
            addCategoryOption(category);
        });
    });

    // Fungsi untuk menambah opsi kedalam kategori
    function addCategoryOption(value) {
        var option = document.createElement('option');
        option.value = value;
        option.textContent = value;
        categoryDropdown.appendChild(option);
    }
    </script>
@endsection
