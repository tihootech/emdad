<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Madadju;

class ToolsController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master');
	}

    public function tools($tool=null, Request $request)
    {
		if ($tool == 'duplicate-madadjus') {

			// find duplicate national codes
			$duplicates = DB::table('madadjus')->select('national_code', DB::raw('COUNT(*) as `count`'))
							->where('national_code', '!=', 0)->groupBy('national_code')->having('count', '>', 1)->get();

			// create a list of madadjus with duplicate national codes
			$list = [];
			foreach ($duplicates as $item) {
				$list [$item->national_code]= Madadju::whereNationalCode($item->national_code)->get();
			}

			// return view
			return view('tools.tools', compact('tool', 'list'));

		}elseif ($tool == 'incomplete-madadjus') {

			// find madadju columns and remove first and last two items from columns
			$columns = \Schema::getColumnListing('madadjus');
			array_shift($columns); array_shift($columns); array_splice($columns, -2);

			// find madadjus with incomplete information
			if ($request->filters) {
				$madadjus = Madadju::query();
				$empties = [null, 0, '', '0'];
				foreach ($request->filters as $col) {
					$madadjus = $madadjus->orWhereIn($col, $empties);
				}
				$total_count = $madadjus->count();
				$madadjus = $madadjus->paginate(25);
			}else {
				$madadjus = null;
				$total_count = 0;
			}

			return view('tools.tools', compact('tool', 'madadjus', 'total_count', 'columns'));
		}else {

			return view('tools.tools', compact('tool'));

		}
    }
}
