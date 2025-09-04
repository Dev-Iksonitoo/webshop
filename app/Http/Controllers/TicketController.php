<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\User;

class TicketController extends Controller
{
    /**
     * კონსტრუქტორი
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ტიკეტების სია
     */
    public function index()
    {
        $tickets = Ticket::where('user_id', Auth::id())->orderBy('created_at', 'desc')->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * ახალი ტიკეტის შექმნის ფორმა
     */
    public function create()
    {
        $sellers = User::where('is_seller', true)->get();
        return view('tickets.create', compact('sellers'));
    }

    /**
     * ახალი ტიკეტის შენახვა
     */
    public function store(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
            'seller_id' => 'required|exists:users,id',
        ]);

        $ticket = new Ticket();
        $ticket->subject = $request->subject;
        $ticket->message = $request->message;
        $ticket->user_id = Auth::id();
        $ticket->seller_id = $request->seller_id;
        $ticket->status = 'open';
        $ticket->save();

        return redirect()->route('tickets.show', $ticket->id)->with('success', 'ტიკეტი წარმატებით შეიქმნა');
    }

    /**
     * ტიკეტის ჩვენება
     */
    public function show($id)
    {
        $ticket = Ticket::where('id', $id)
                        ->where(function($query) {
                            $query->where('user_id', Auth::id())
                                  ->orWhere('seller_id', Auth::id());
                        })
                        ->firstOrFail();
        
        return view('tickets.show', compact('ticket'));
    }

    /**
     * ტიკეტზე პასუხის გაცემა
     */
    public function reply(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string',
        ]);

        $ticket = Ticket::where('id', $id)
                        ->where(function($query) {
                            $query->where('user_id', Auth::id())
                                  ->orWhere('seller_id', Auth::id());
                        })
                        ->firstOrFail();
        
        // პასუხის დამატება
        $ticket->replies = $ticket->replies ?? [];
        $ticket->replies[] = [
            'user_id' => Auth::id(),
            'message' => $request->reply,
            'created_at' => now()->toDateTimeString(),
        ];
        
        // სტატუსის განახლება
        if (Auth::id() == $ticket->seller_id) {
            $ticket->status = 'answered';
        } else {
            $ticket->status = 'awaiting';
        }
        
        $ticket->save();
        
        return redirect()->back()->with('success', 'პასუხი წარმატებით დაემატა');
    }

    /**
     * ტიკეტის დახურვა
     */
    public function close($id)
    {
        $ticket = Ticket::where('id', $id)
                        ->where(function($query) {
                            $query->where('user_id', Auth::id())
                                  ->orWhere('seller_id', Auth::id());
                        })
                        ->firstOrFail();
        
        $ticket->status = 'closed';
        $ticket->save();
        
        return redirect()->back()->with('success', 'ტიკეტი დაიხურა');
    }
}
