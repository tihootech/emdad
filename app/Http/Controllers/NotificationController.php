<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\NotificationHistory;
use App\Notification;
use App\User;
use App\Organ;
use App\Operator;

class NotificationController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master')->except(['index']);
	}

	public function index()
	{
		if (master()) {
			$list = NotificationHistory::latest()->paginate(10);
		}else {
			$list = Notification::where('user_id', auth()->id())->latest()->orderBy('read')->paginate(10);
			foreach ($list as $notification) {
				$notification->mark_as_read();
			}
		}
		return view('notifications.index', compact('list'));
	}

    public function create()
    {
		$operators = Operator::all();
		$organs = Organ::all();
		return view('notifications.create', compact('operators', 'organs'));
    }

	public function store(Request $request)
	{
		$request->validate([
			'body'=>'required',
			'target' => [
				'required',
				Rule::in([Operator::class, Organ::class])
			],
		]);
		$list = User::whereOwnerType($request->target)->get();
		if($count = $list->count()){
			$history = NotificationHistory::make($request->target, $request->body);
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
			return back()->withError('Database Error');
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
			return back()->withError('Database Error');
		}
	}
}
