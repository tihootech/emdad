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
	public function edit(User $user)
    {
    	return view('owners.edit', compact('user'));
    }

	public function update(Request $request, $owner_id)
	{
		$request->validate([
			'owner_type' => [
				'required',
				Rule::in([Operator::class, Organ::class])
			]
		]);
		$owner = $request->owner_type::find($owner_id);
		if ($owner) {
			$type = $owner->type();
			$validator = "validate_{$type}";
			$data = self::$validator($owner->id);
			$owner->update($data);
			return redirect("users/$type");
		}else {
			return back()->withError('Database Error');
		}
	}

	public static function validate_organ($id=null)
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

	public static function validate_operator($id=null)
	{
		return request()->validate([
			'first_name' => 'required',
			'last_name' => 'required',
		]);
	}
}
