<?php

namespace App\Http\Controllers;

use App\ExpenseSector;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpenseSectorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        /* @var User $user */
        $user = Auth::user();
        $sectors = $user->expense_sectors()->orderBy('id', 'DESC')->paginate();

        return view('expense.sector', compact('sectors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $sector = Auth::user()->expense_sectors()->create($request->only(['title', 'description']));

        if (!$sector) return redirect()->back()->withErrors('Unexpected Error! Please Try Again');

        return redirect()->back()->withSuccess('Expense Sector Created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ExpenseSector $expenseSector
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, ExpenseSector $expenseSector)
    {
        $this->authorize('update', $expenseSector);

        $request->validate([
            'title' => 'required'
        ]);

        $res = $expenseSector->update($request->only(['title', 'description']));

        if (!$res) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Expense Sector Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ExpenseSector $expenseSector
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(ExpenseSector $expenseSector)
    {
        $this->authorize('delete', $expenseSector);

        $res = $expenseSector->delete();

        if (!$res) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Expense Sector deleted successfully');
    }
}
