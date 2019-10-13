<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Introduce;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if (operator()) {
            $rejects = Introduce::whereConfirmed(0)->paginate(50);
            return view('home', compact('rejects'));
        }else {
            return view('home', compact('user'));
        }
    }
}
