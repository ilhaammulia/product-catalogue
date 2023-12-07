<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestTicketRequest;
use App\Models\RequestTicket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Exception;

class RequestTicketController extends Controller
{
    public function index()
    {
        $tickets = RequestTicket::orderBy('created_at', 'desc')
            ->get()
            ->map(function ($ticket) {
                return [
                    'id' => $ticket->id,
                    'name' => $ticket->name,
                    'email' => $ticket->email,
                    'message' => $ticket->message,
                    'product' => $ticket->product ? [
                        'link' => url(route('landing.product.detail', ['slug' => $ticket->product->slug])),
                        'name' => $ticket->product->name,
                    ] : null,
                    'created_at' => $ticket->created_at->format('d-m-Y')
                ];
            });
        return Inertia::render('Admin/Ticket', [
            'tickets' => $tickets
        ]);
    }

    public function store(StoreRequestTicketRequest $request)
    {
        try {
            $ticket = RequestTicket::create($request->toArray());
            return [
                'status' => 'success',
                'ticket' => $ticket,
            ];
        } catch (Exception $error) {
            return [
                'status' => 'error',
            ];
        }
    }

    public function destroy(RequestTicket $ticket)
    {
        if ($ticket) {
            $ticket->delete();
        }
        return redirect()->to(route('admin.ticket'));
    }
}
