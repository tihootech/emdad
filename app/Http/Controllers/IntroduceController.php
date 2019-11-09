<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Introduce;
use App\User;
use App\Organ;
use App\Operator;
use App\Madadju;

class IntroduceController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('organ');
		$this->middleware('operator')->only(['introduce','destroy', 'confirm']);
	}

	public function index(Request $request)
	{

		if ( only_organ() ) {
			$introduces = Introduce::where('organ_id', current_organ_id())->latest()->paginate(25);
		}elseif ( operator() ) {

			$query = Introduce::query();

			if ( $request->madadjus && is_array($request->madadjus) ) {
				$query = $query->whereIn('madadju_id', $request->madadjus);
			}
			if ( $request->organs && is_array($request->organs) ) {
				$query = $query->whereIn('organ_id', $request->organs);
			}
			if ( $request->operators && is_array($request->operators) ) {
				$query = $query->whereIn('operator_id', $request->operators);
			}
			if ( $request->status && is_array($request->status) ) {
				$query = $query->whereIn('status', $request->status);
			}
			if ($request->from) {
				$from = persian_to_carbon($request->from);
				$query = $query->where('created_at', '>=', $from);
			}
			if ($request->till) {
				$till = persian_to_carbon($request->till);
				$query = $query->where('created_at', '<', $till);
			}

			$introduces = $query->latest()->paginate(25);

		}else {
			abort(404);
		}

		$madadjus = Madadju::all();
		$organs = Organ::all();
		$operators = Operator::all();

		return view('introduces.index', compact('introduces','madadjus', 'organs', 'operators'));
	}

	public function introduce(Request $request)
    {
        $request->validate([
            'checked_ids'=>'required',
            'organ_id'=>'required|exists:organs,id',
        ]);
        foreach ($request->checked_ids as $madadju_id) {
			$madadju = Madadju::find($madadju_id);
			if ( only_operator() && $madadju->region != auth()->user()->region() ) {
	            abort(404);
	        }else {
				$data['madadju_id'] = $madadju_id;
	            $data['organ_id'] = $request->organ_id;
	            $data['operator_id'] = current_operator_id();
	            Introduce::create($data);
	        }
        }
        $organ = Organ::find($request->organ_id);
        return back()->withMessage('افراد مورد نظر شما به موسسه "'.$organ->title().'" معرفی شدند.');
    }

	public function change_status(Introduce $introduce, Request $request)
	{
		if ($request->status == 3) {
			$request->validate(['status'=>'required|integer','information' => 'required|string']);
			$introduce->confirmed = 0;
			$introduce->information = $request->information;
			$message = 'درخواست شمادر دست بررسی قرار گرفت.';
		}else {
			$request->validate(['status'=>'required|integer']);
			$message = 'تغییر وضعیت انجام شد.';
			$introduce->information = null;
		}
		$introduce->status = $request->status;
		$introduce->save();
		return back()->withMessage($message);
	}

	public function confirm(Introduce $introduce, Request $request)
	{
		$request->validate(['confirmed'=>'required']);
		$introduce->status = $request->confirmed ? 3 : 2;
		$introduce->confirmed = 1;
		$introduce->save();
		return back()->withMessage('عملیات با موفقیت انجام شد.');
	}

	public function destroy(Introduce $introduce)
	{
		$introduce->delete();
		return back()->withMessage('عملیات با موفقیت انجام شد.');
	}
}
