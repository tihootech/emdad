<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Introduce;
use App\Ticket;
use App\Operator;

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
        }elseif (root()) {
            $operators = Operator::all();
            return view('home', compact('operators'));
        }else {
            return view('home', compact('user'));
        }
    }
}
