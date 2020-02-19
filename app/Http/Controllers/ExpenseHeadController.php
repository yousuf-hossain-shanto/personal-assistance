<?php

namespace App\Http\Controllers;

use App\ExpenseHead;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseHeadController extends Controller
{

    public function __construct()

    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $heads = Auth::user()->ExpenseHeads()->orderBy('id', 'DESC')->paginate();

        return view('expense.head', compact('heads'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $head = Auth::user()->ExpenseHeads()->create($request->only(['title', 'description']));

        if (! $head) return redirect()->back()->withErrors('Unexpected Error! Please Try Again');

        return redirect()->back()->withSuccess('Head Created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ExpenseHead $expenseHead)
    {
        $this->authorize('update', $expenseHead);

        $request->validate([
            'title' => 'required'
        ]);

        $res = $expenseHead->update($request->only(['title', 'description']));

        if (! $res) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Head Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ExpenseHead  $expenseHead
     * @return \Illuminate\Http\Response
     */
    public function destroy(ExpenseHead $expenseHead)
    {
        $this->authorize('delete', $expenseHead);

        $res = $expenseHead->delete();

        if (! $res) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Head deleted successfully');
    }
}
