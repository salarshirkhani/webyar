<?php


namespace App\Http\Controllers\Dashboard\Customer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Customer\TicketCreateRequest;
use App\Http\Requests\Dashboard\Customer\TicketUpdateRequest;
use App\Models\Ticket;
use App\Http\Requests;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->orderBy('created_at', 'desc')->with('user')->get();
        return view('dashboard.customer.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('dashboard.customer.ticket.show', compact('ticket'));
    }

    public function create()
    {
        return view('dashboard.customer.ticket.create');
    }

    public function store(TicketCreateRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('file'))
            $data['file'] = $request->file('file')->store('ticket', 'public');
        $data['user_id'] = Auth::id();

        $ticket = Ticket::create($data);

        $data['ticket_id'] = $ticket->id;
        TicketMessage::create($data);

        return redirect()->route('dashboard.customer.ticket.show', compact('ticket'))
            ->with('info', 'درخواست شما ارسال شد. لطفا منتظر باشید تا تیم پشتیبانی به شما پاسخ دهند.');
    }

    public function edit(Ticket $ticket)
    {
        return view('dashboard.customer.ticket.edit', compact('ticket'));
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $data = $request->validated();
        if ($request->hasFile('file'))
            $data['file'] = $request->file('file')->store('ticket', 'public');
        $data['user_id'] = Auth::id();
        $data['ticket_id'] = $ticket->id;
        TicketMessage::create($data);

        return redirect()->route('dashboard.customer.ticket.show', compact('ticket'))
            ->with('info', 'پاسخ شما ارسال شد. لطفا منتظر باشید تا تیم پشتیبانی به شما پاسخ دهند.');
    }

}
