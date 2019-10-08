<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
	}

    public function edit()
    {
    	$user = auth()->user();
		return view('users.edit', compact('user'));
    }
}
