<?php

namespace App\Http\Controllers;

use App\ImapMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $me = ImapMessage::first();
        $file = Storage::disk('dropbox')->mimeType($me->attachments[0]);

        dd($file);
    }
}
