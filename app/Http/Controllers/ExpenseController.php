<?php

namespace App\Http\Controllers;

use App\Expense;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenses = Auth::user()->expenses()->paginate();
        $heads = Auth::user()->ExpenseHeads;
        $wallets = Auth::user()->wallets;

        return view('expense.index', compact('expenses', 'heads', 'wallets'));
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
            'date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric'
        ]);

        $head = Auth::user()->ExpenseHeads()->where('id', $request->expense_head_id)->first();

        if (!$head) return abort(404);

        $expense = $head->expenses()->create($request->only(['date', 'amount', 'remarks']));

        if (!$expense) return redirect()->back()->withErrors('Unexpected error! Please try again');

        return redirect()->back()->withSuccess('Expense created successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Expense $expense)
    {
        $this->authorize('update', $expense);

        $rules = [
            'expense_head_id' => 'required|exists:expense_heads,id',
            'date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric',
            'status' => 'required|in:0,1,2'
        ];

        if ($request->status == 1) {
            $rules['wallet_id'] = 'required|exists:wallets,id';
        }

        $request->validate($rules);

        if ($request->wallet_id) {
            $wallet = Wallet::find($request->wallet_id);
            $this->authorize('update', $wallet);
            if ($wallet->balance < $expense->amount) return redirect()->back()->withErrors('Not enough balance');
        }

        $head = Auth::user()->ExpenseHeads()->where('id', $request->expense_head_id)->first();

        if (!$head) return abort(404);

        $res = $expense->update($request->only(['expense_head_id', 'date', 'amount', 'remarks', 'status', 'wallet_id']));

        if (!$res) return redirect()->back()->withErrors('Unexpected error! Please try again');

        return redirect()->back()->withSuccess('Expense updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Expense $expense
     * @return \Illuminate\Http\Response
     */
    public function destroy(Expense $expense)
    {
        $this->authorize('delete', $expense);

        $res = $expense->delete();
        if (!$res) return redirect()->back()->withErrors('Unexpected error! Please try again');

        return redirect()->back()->withSuccess('Expense deleted successfully');
    }
}
