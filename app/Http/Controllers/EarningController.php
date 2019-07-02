<?php

namespace App\Http\Controllers;

use App\Earning;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EarningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $earnings = Auth::user()->earnings()->paginate();
        $wallets = Auth::user()->wallets;
        return view('earning.index', compact('earnings', 'wallets'));
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
            'date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric'
        ]);

        $earning = Auth::user()->earnings()->create($request->only(['date', 'amount', 'remarks']));

        if (!$earning) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Earning Listed Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Earning $earning
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Earning $earning)
    {
        $this->authorize('update', $earning);

        $rules = [
            'date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric',
            'status' => 'required|in:0,1,2'
        ];

        if ($request->status == 1) {
            $rules['wallet_id'] = 'required|exists:wallets,id';
        }

        $request->validate($rules);

        $res = $earning->update($request->only(['date', 'amount', 'wallet_id', 'status', 'remarks']));

        if (!$res) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Earning updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Earning $earning
     * @return \Illuminate\Http\Response
     */
    public function destroy(Earning $earning)
    {
        $res = $earning->delete();

        if (!$res) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Earning deleted Successfully');
    }
}
