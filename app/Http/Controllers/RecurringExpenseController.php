<?php

namespace App\Http\Controllers;

use App\RecurringExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecurringExpenseController extends Controller
{
    public function __construct()

    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Auth::user()->recurrings()->paginate();
        $heads = Auth::user()->ExpenseHeads;

        return view('expense.recurring', compact('expenses', 'heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'expense_head_id' => 'required|exists:expense_heads,id',
            'days_count' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        $head = Auth::user()->ExpenseHeads()->where('id', $request->expense_head_id)->first();

        if (!$head) return abort(404);

        $expense = $head->recurrings()->create($request->only(['days_count', 'amount', 'remarks']));

        if (!$expense) return redirect()->back()->withErrors('Unexpected error! Please try again');

        return redirect()->back()->withSuccess('Expense created successfully');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\RecurringExpense $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $expense_recurring)
    {

        $recurringExpense = RecurringExpense::findOrFail($expense_recurring);

        $this->authorize('update', $recurringExpense);

        $request->validate([
            'expense_head_id' => 'required|exists:expense_heads,id',
            'days_count' => 'required|numeric',
            'amount' => 'required|numeric'
        ]);

        $head = Auth::user()->ExpenseHeads()->where('id', $request->expense_head_id)->first();

        if (!$head) return abort(404);

        $res = $recurringExpense->update($request->only(['expense_head_id', 'days_count', 'amount', 'remarks']));

        if (!$res) return redirect()->back()->withErrors('Unexpected error! Please try again');

        return redirect()->back()->withSuccess('Expense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\RecurringExpense $recurringExpense
     * @return \Illuminate\Http\Response
     */
    public function destroy($expense_recurring)
    {

        $recurringExpense = RecurringExpense::findOrFail($expense_recurring);

        $this->authorize('delete', $recurringExpense);

        $res = $recurringExpense->delete();
        if (!$res) return redirect()->back()->withErrors('Unexpected error! Please try again');

        return redirect()->back()->withSuccess('Expense deleted successfully');
    }
}
