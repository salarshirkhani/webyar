<?php

namespace App\Http\Controllers\Dashboard\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\Customer\TicketUpdateRequest;
use App\Models\Ticket;
use App\Http\Requests;
use App\Models\TicketMessage;
use Illuminate\Support\Facades\Auth;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('agent_id', Auth::id())->orWhereNull('agent_id')->orderBy('created_at', 'desc')->get();
        return view('dashboard.admin.ticket.index', compact('tickets'));
    }

    public function show(Ticket $ticket)
    {
        return view('dashboard.admin.ticket.show', compact('ticket'));
    }

    public function edit(Ticket $ticket)
    {
        return view('dashboard.admin.ticket.edit', compact('ticket'));
    }

    public function update(TicketUpdateRequest $request, Ticket $ticket)
    {
        $data = $request->validated();
        if ($request->hasFile('file'))
            $data['file'] = $request->file('file')->store('ticket', 'public');
        $data['user_id'] = Auth::id();
        $data['ticket_id'] = $ticket->id;
        TicketMessage::create($data);

        if (empty($ticket->agent_id))
            $ticket->agent()->associate(Auth::user());

        return redirect()->route('dashboard.admin.ticket.show', compact('ticket'))
            ->with('info', 'پاسخ شما ارسال شد.');
    }

}
