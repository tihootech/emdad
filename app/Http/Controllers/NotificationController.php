<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\NotificationHistory;
use App\Notification;
use App\User;
use App\Organ;
use App\Operator;
use App\Madadju;

class NotificationController extends Controller
{

	public function __construct()
	{
		$this->middleware('auth');
		$this->middleware('master')->except(['index']);
	}

	public function history()
	{
		$list = NotificationHistory::latest()->paginate(25);
		return view('notifications.history', compact('list'));
	}

	public function manage($id)
	{
		$history = NotificationHistory::findOrFail($id);
		$notifications = $history->list()->paginate(25);
		return view('notifications.manage', compact('history', 'notifications'));
	}

	public function index()
	{
		$list = Notification::where('user_id', auth()->id())->latest()->orderBy('read')->paginate(10);
		foreach ($list as $notification) {
			$notification->mark_as_read();
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
		// validate request
		$request->validate([
			'body'=>'required',
			'target' => [
				'required',
				Rule::in([Operator::class, Organ::class])
			],
			'region'=>'nullable|integer',
			'owner_id'=>'nullable|integer',
		]);

		// create list of owners which notification is for
		$list = $request->target::query();
		if ($request->region) {
			$list = $list->where('region', $request->region);
		}
		if ($request->owner_ids && count($request->owner_ids)) {
			$list = $list->whereIn('id', $request->owner_ids);
		}
		$list = $list->get();

		// create notification and notification history in database
		if($count = $list->count()){
			$history = NotificationHistory::make($request->target, $request->body);
			Notification::notify($history->id, $list);
			return redirect('notifications/history')->withMessage("اطلاع رسانی به $count کاربر با موفقیت انجام شد");
		}else {
			return back()->withError('با اطلاعات وارد شده، کاربری برای اطلاع رسانی یافت نشد.');
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
			return back()->withMessage('اطلاع رسانی با موفقیت لغو شد و اعلامیه مورد نظر از داشبورد کاربران حذف شد.');
		}else {
			return back()->withError('Database Error');
		}
	}

	public function single_delete(Notification $notification)
	{
		$notification->delete();
		return back()->withMessage('اطلاع رسانی برای کاربر مورد نظر با موفقیت لغو شد.');
	}
}
