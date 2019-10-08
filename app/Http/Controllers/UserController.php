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

	public function update(Request $request)
	{
		$user = auth()->user();

		$request->validate([
			"username" => "required|unique:users,username,$user->id",
			"current_password" => "required",
			"new_password" => "nullable|confirmed|string|min:4",
		]);

		$change = false;
		if (\Hash::check($request->current_password, $user->password)) {
			if ($user->username != $request->username) {
				$user->username = $request->username;
				$change =true;
			}
			if ($request->new_password) {
				$user->password = bcrypt($request->new_password);
				$change =true;
			}
			if ($change) {
				$user->save();
				return redirect('login')->with(\Auth::logout())->withMessage('تغییرات با موفقیت انجام شد. اکنون دوباره وارد شوید.');
			}else {
				return back()->withError('تغییری داده نشده است.');
			}
		}else {
			return back()->withError('رمزعبور فعلی اشتباه است.');
		}
	}
}
