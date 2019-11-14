<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Rules\NationalCode;
use App\User;
use App\Operator;
use App\Organ;

class OwnerController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master');
	}

	public function index($type)
	{
		$class_name = class_name($type);
		$owners = $class_name::latest()->paginate(20);
		$persian_type = $type == 'operator' ? 'مددکار' : 'موسسه';
		return view('owners.index', compact('owners', 'type', 'persian_type'));
	}

	public function create($type)
	{
		$class_name = class_name($type);
		$owner = new $class_name;
		return view('owners.form', compact('owner','type'));
	}

	public function store(Request $request)
	{

		// first validation
		$acc_data = $request->validate([
			'owner_type' => [
				'required',
				Rule::in([Operator::class, Organ::class])
			],
			'type' => 'required',
			'username' => 'required|string|min:4|unique:users,username',
			'password' => 'required|string|min:4',
		]);

		// create owner
		$type = $request->type;
		$validator = "validate_{$type}";
		$owner_data = self::$validator();
		$owner = $request->owner_type::create($owner_data);

		// create account for owner
		$user = User::acc_for_owners($acc_data, $owner->id);

		// set user id for owner
		$owner->user_id = $user->id;
		$owner->save();

		// redirection
		return redirect("owners/$type")->withMessage($owner->persian_type().' جدید در سیستم ثبت شد.');
	}

	public function edit($type, $owner_id)
    {
		$class_name = class_name($type);
		$owner = $class_name::find($owner_id);
		if ($owner) {
			return view('owners.form', compact('owner','type'));
		}else {
			abort(404);
		}
    }

	public function update(Request $request, $owner_id)
	{
		$owner = $request->owner_type::find($owner_id);
		if ($owner && $owner->user) {

			$request->validate([
				'owner_type' => [
					'required',
					Rule::in([Operator::class, Organ::class])
				],
				'username' => 'required|string|min:4|unique:users,username,'.$owner->user->id,
			]);

			// update owner itself
			$type = $owner->type();
			$validator = "validate_{$type}";
			$data = self::$validator($owner->id);
			$owner->update($data);

			// update owner acc
			$acc = $owner->user;
			if ($acc) {
				$acc->username = $request->username;
				if ($request->new_password) {
					$acc->password = bcrypt($request->new_password);
				}
				$acc->update();
			}

			// redirection
			return redirect("owners/$type")->withMessage('عملیات با موفقیت انجام شد.');

		}else {
			return back()->withError('Database Error');
		}
	}

	public function destroy($type, $owner_id)
	{
		$class_name = class_name($type);
		$owner = $class_name::find($owner_id);
		if ($owner) {
			$user = $owner->user;
			if ($user) {
				$user->delete();
			}
			$owner->delete();
		}
		return back()->withMessage($owner->persian_type().' مورد نظر از سیستم حذف شد');
	}

	public static function validate_organ($id=0)
	{
		return request()->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'national_code' => [
                "nullable",
                "unique:organs,national_code,$id",
                new NationalCode,
            ],
			'telephone' => 'nullable',
			'education' => 'nullable',
			'agency_name' => 'required',
			'product_type' => 'nullable',
			'address' => 'nullable',
		]);
	}

	public static function validate_operator($id=0)
	{
		return request()->validate([
			'first_name' => 'required',
			'last_name' => 'required',
			'region' => 'required|integer|gt:0',
		]);
	}
}
