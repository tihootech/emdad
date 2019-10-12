<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\NotificationHistory;
use App\Notification;
use App\User;

class NotificationController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master');
	}

	public function index()
	{
		$list = NotificationHistory::latest()->paginate(10);
		return view('notifications.index', compact('list'));
	}

    public function create()
    {
		$operators = User::whereType('operator')->get();
		$organs = User::whereType('organ')->get();
		return view('notifications.create', compact('operators', 'organs'));
    }

	public function store($target, Request $request)
	{
		$request->validate(['body'=>'required']);
		$list = User::whereType($target)->get();
		if($count = $list->count()){
			$history = NotificationHistory::make($target, $request->body);
			Notification::notify($history->id, $list);
			return redirect('notifications')->withMessage("اطلاع رسانی به $count کاربر با موفقیت انجام شد");
		}else {
			return back()->withError('کاربری برای اطلاع رسانی یافت نشد.');
		}
	}

	public function update($id, Request $request)
	{
		$history = NotificationHistory::find($id);
		if ($history) {
			$history->body = $request->body;
			$history->save();
			return back()->withMessage('اطلاعیه مورد نظر شما به روز رسانی شد.');
		}else {
			return back()->withError('Nothing Found');
		}
	}

	public function destroy($id)
	{
		$history = NotificationHistory::find($id);
		if ($history) {
			Notification::where('notification_history_id', $history->id)->delete();
			$history->delete();
			return back()->withMessage('اطلاع رسانی با موفقیت لغو شد و پیغام مورد نظر از داشبورد کاربران حذف شد.');
		}else {
			return back()->withError('Nothing Found');
		}
	}
}
