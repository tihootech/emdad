<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Introduce;
use App\User;

class IntroduceController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('organ');
		$this->middleware('operator')->only(['introduce','destroy']);
	}

	public function index()
	{
		if ( only_organ() ) {
			$introduces = Introduce::where('organ_id', auth()->id())->latest()->paginate(25);
		}elseif ( operator() ) {
			$introduces = Introduce::latest()->paginate(25);
		}else {
			abort(404);
		}
		return view('introduces.index', compact('introduces'));
	}

	public function introduce(Request $request)
    {
        $request->validate([
            'checked_ids'=>'required',
            'organ_id'=>'required|exists:users,id',
        ]);
        foreach ($request->checked_ids as $madadju_id) {
            $data['madadju_id'] = $madadju_id;
            $data['organ_id'] = $request->organ_id;
            $data['operator_id'] = auth()->id();
            Introduce::create($data);
        }
        $organ = User::find($request->organ_id);
        return back()->withMessage('افراد مورد نظر شما به موسسه '.$organ->name.' معرفی شدند.');
    }

	public function change_status(Introduce $introduce, Request $request)
	{
		$request->validate(['status'=>'required|integer']);
		$introduce->status = $request->status;
		$introduce->information = $request->information;
		$introduce->save();
		return back()->withMessage('تغییر وضعیت انجام شد.');
	}

	public function destroy(Introduce $introduce)
	{
		$introduce->delete();
		return back()->withMessage('عملیات با موفقیت انجام شد.');
	}
}
