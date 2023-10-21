<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::orderBy('created_at', 'desc')->paginate(20);
        $totalIncome = Transaction::where('type', 'income')->sum('amount');
        $totalExpense = Transaction::where('type', 'expense')->sum('amount');
        $balance = $totalIncome-$totalExpense;
        $incomeCount = Transaction::where('type', 'income')->count();
        $expenseCount = Transaction::where('type', 'expense')->count();

        return view('transactions.index', compact('transactions', 'totalIncome', 'totalExpense', 'balance', 'incomeCount', 'expenseCount'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string',
            'category' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $transaction = Transaction::create([
            'amount' => $validated['amount'],
            'type' => $validated['type'],
            'category' => $validated['category'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction added successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        $categoryOptions = [
            'income' => ['Wage', 'Bonus', 'Gift'],
            'expense' => ['Food & Drinks', 'Shopping', 'Charity', 'Housing', 'Insurance', 'Taxes', 'Transportation']
        ];

        return view('transactions.edit', compact('transaction', 'categoryOptions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0',
            'type' => 'required|string',
            'category' => 'required|string',
            'notes' => 'nullable|string',
        ]);

        $transaction->update([
            'amount' => $validated['amount'],
            'type' => $validated['type'],
            'category' => $validated['category'],
            'notes' => $validated['notes'],
        ]);

        return redirect()->route('transactions.index')->with('success', 'Transaction updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction)
    {
        $transaction->delete();
        return redirect()->route('transactions.index')->with('success', 'Transaction deleted successfully');
    }
}
