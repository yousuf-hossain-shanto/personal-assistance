<?php

namespace App\Http\Controllers;

use App\EarningSource;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EarningSourceController extends Controller
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
        $sources = $user->earning_sources()->orderBy('id', 'DESC')->paginate();

        return view('earning.source', compact('sources'));
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

        $source = Auth::user()->earning_sources()->create($request->only(['title', 'description']));

        if (!$source) return redirect()->back()->withErrors('Unexpected Error! Please Try Again');

        return redirect()->back()->withSuccess('Earning Source Created Successfully');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\EarningSource $earningSource
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EarningSource $earningSource)
    {
        $this->authorize('update', $earningSource);

        $request->validate([
            'title' => 'required'
        ]);

        $res = $earningSource->update($request->only(['title', 'description']));

        if (!$res) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Earning Source Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\EarningSource $earningSource
     * @return \Illuminate\Http\Response
     */
    public function destroy(EarningSource $earningSource)
    {
        $this->authorize('delete', $earningSource);

        $res = $earningSource->delete();

        if (!$res) return redirect()->back()->withErrors('Unexpected Error! Please try again');

        return redirect()->back()->withSuccess('Earning source deleted successfully');
    }
}
