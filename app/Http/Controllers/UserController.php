<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;
use App\Organ;
use App\Operator;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master')->except(['edit', 'update']);
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
			"username" => "required|min:4|unique:users,username,$user->id",
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

	public function store(Request $request)
	{
		// validation
		$user_data = $request->validate([
			'owner_type' => [
				'required',
				Rule::in([Operator::class, Organ::class])
			],
			'username' => 'required|min:4|unique:users',
			'password' => 'required|min:4',
		]);
		$owner_data = $request->validate([
			'first_name' => 'required',
			'last_name' => 'required',
		]);

		// create owner instance
		$owner = $request->owner_type::create($owner_data);

		// more data for user
		$user_data['password'] = bcrypt($user_data['password']);
		$user_data['owner_id'] = $owner->id;

		// create user
		User::create($user_data);

		// redirection
		return back()->withMessage('کاربر جدید در سیستم اضافه شد.');
	}

	public function update_password(User $user,Request $request)
	{
		$request->validate([
			'username' => 'required|min:4',
			'password' => 'required|min:4',
		]);
		$user->username = $request->username;
		$user->password = bcrypt($request->password);
		$user->save();
		return back()->withMessage("رمزعبور $user->username تغییر پیدا کرد.");
	}

	public function destroy(User $user)
	{
		$user->delete();
		$user->owner->delete();
		return back()->withMessage("کاربر $user->username با موفقیت از سیستم حذف شد.");
	}
}
