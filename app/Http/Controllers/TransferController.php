<?php

namespace App\Http\Controllers;

use App\Transfer;
use App\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TransferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transfers = Auth::user()->transfers()->paginate();
        $wallets = Auth::user()->wallets;

        return view('transfer.index', compact('transfers', 'wallets'));
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
            'from_wallet' => 'required|exists:wallets,id',
            'to_wallet' => 'required|exists:wallets,id|different:from_wallet',
            'date' => 'required|date_format:Y-m-d',
            'amount' => 'required|numeric',
        ]);

        $from = Auth::user()->wallets()->where('id', $request->from_wallet)->first();

        if (!$from || $from->balance < $request->amount) return redirect()->back()->withErrors('Not enough balance');

        $transfer = Auth::user()->transfers()->create($request->only(['from_wallet', 'to_wallet', 'date', 'amount', 'remarks']));

        if (! $transfer) return redirect()->back()->withErrors('Unexpected error! Please try again');

        return redirect()->back()->withSuccess('Transferred successful');

    }
}
