<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketMessage;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class TicketController extends Controller
{

    public function __construct()
	{
		$this->middleware('auth');
	}

    public function index()
    {
        $tickets = Ticket::query();
        $status = request('status') ?? 'open';
        if (master()) {
            if ($status != 'all') {
                $tickets = $tickets->whereStatus($status);
            }
        }else {
            $tickets = $tickets->where('user_id', auth()->id());
        }
        $tickets = $tickets->latest()->paginate(25);
        return view('tickets.index', compact('tickets', 'status'));
    }


    public function create()
    {
        $ticket = new Ticket;
        return view('tickets.create', compact('ticket'));
    }

    public function store(Request $request)
    {
        // prepare data
        $ticket_data = self::validate_ticket();
        $ticket_message_data = self::validate_ticket_message();

        // complete data
        $ticket_data['user_id'] = auth()->id();
        $ticket_data['uid'] = rs();

        // store ticket and ticket message in database
        $ticket = Ticket::create($ticket_data);
        $ticket_message_data['ticket_id'] = $ticket->id;
        TicketMessage::create($ticket_message_data);

        //redirection
        return redirect('ticket')->withMessage('نامه شما با موفقیت ایجاد شد.');
    }

    public function show($uid)
    {
        $ticket = Ticket::where('uid', $uid)->firstOrFail();
        return view('tickets.show', compact('ticket'));
    }

    public function message_form($uid)
    {
        $ticket = Ticket::where('uid', $uid)->firstOrFail();
        return view('tickets.message', compact('ticket'));
    }

    public function new_message($uid, Request $request)
    {
        // find ticket in database
        $ticket = Ticket::where('uid', $uid)->firstOrFail();

        // prepare data
        $data = self::validate_ticket_message();
        $data['ticket_id'] = $ticket->id;

        // store new ticket message
        TicketMessage::create($data);

        // update ticket status
        $ticket->status = master() ? 'answered' : 'open';
        $ticket->save();

        // redirection
        return redirect("ticket/$uid");
    }

    public function close($uid)
    {
        $ticket = Ticket::where('uid', $uid)->firstOrFail();
        $ticket->status = 'closed';
        $ticket->save();
        return redirect("ticket")->withMessage('نامه مورد نظر بسته شد.');
    }

    public static function validate_ticket()
    {
        return request()->validate([
            'notification_history_uid' => 'nullable:exists:notification_histories,uid',
            'title' => 'required|string|max:100',
            'priority' => [
				'required',
				Rule::in([1,2,3])
			],
            'type' => [
				'required',
				Rule::in(['official','complaint'])
			],
        ]);
    }

    public static function validate_ticket_message()
    {
        $data = request()->validate([
            'body' => 'required',
            'file' => 'nullable|file|mimes:jpg,gif,jpeg,png,pdf,pbk,bmp,txt,xlsx,xls,doc,docx|max:10000',
        ]);
        if (isset($data['file']) && $data['file']) {
            $data['file'] = upload($data['file']);
        }
        $data['author_id'] = auth()->id();
        return $data;
    }
}
