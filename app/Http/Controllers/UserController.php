<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\User;

class UserController extends Controller
{
	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master')->except(['edit', 'update']);
	}

	public function index($type)
	{
		$users = User::where('type', $type)->get();
		$persian_type = $type == 'operator' ? 'متصدی' : 'موسسه';
		return view('users.index', compact('users', 'type', 'persian_type'));
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
		$data = $request->validate([
			'type' => [
				'required',
				Rule::in(['operator', 'organ'])
			],
			'name' => 'required',
			'username' => 'required|min:4|unique:users',
			'password' => 'required|min:4',
		]);

		// incrypt password
		$data['password'] = bcrypt($data['password']);

		// create user
		User::create($data);

		// redirection
		return back()->withMessage('کاربر جدید در سیستم اضافه شد.');
	}

	public function update_password(User $user,Request $request)
	{
		$request->validate([
			'password' => 'required|min:4'
		]);
		$user->password = bcrypt($request->password);
		$user->save();
		return back()->withMessage("رمزعبور $user->username تغییر پیدا کرد.");
	}

	public function destroy(User $user)
	{
		$user->delete();
		return back()->withMessage("کاربر $user->username با موفقیت از سیستم حذف شد.");
	}
}
