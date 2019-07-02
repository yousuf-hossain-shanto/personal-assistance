<?php

namespace App\Http\Controllers;

use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wallets = Auth::user()->wallets()->paginate();

        return view('wallet.index', compact('wallets'));
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
            'name' => 'required'
        ]);

        $wallet = Auth::user()->wallets()->create($request->only(['name']));

        if (!$wallet) return redirect()->back()->withErrors('Unexpected Error, Please try again');

        return redirect()->back()->withSuccess('Wallet Added Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Wallet $wallet)
    {
        $this->authorize('update', $wallet);

        $request->validate([
            'name' => 'required'
        ]);

        $res = $wallet->update($request->only(['name']));

        if (!$res) return redirect()->back()->withErrors('Unexpected Error, Please try again');

        return redirect()->back()->withSuccess('Wallet Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Wallet $wallet
     * @return \Illuminate\Http\Response
     */
    public function destroy(Wallet $wallet)
    {
        $this->authorize('delete', $wallet);

        $res = $wallet->delete();

        if (!$res) return redirect()->back()->withErrors('Unexpected Error, Please try again');

        return redirect()->back()->withSuccess('Wallet Deleted Successfully');
    }
}
