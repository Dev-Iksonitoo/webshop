<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Seller;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_admin) {
                return redirect('/');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $totalRevenue = Order::sum('total_price');
        $users = User::where('is_seller', false)->where('is_admin', false)->count();
        $sellers = User::where('is_seller', true)->count();
        $pendingSellers = User::where('is_seller', true)->where('is_verified', false)->count();
        $tickets = Ticket::where('status', 'open')->count();

        $recentOrders = Order::with(['user', 'seller', 'product'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalRevenue', 
            'users', 
            'sellers', 
            'pendingSellers', 
            'tickets', 
            'recentOrders'
        ));
    }

    public function sellers()
    {
        $sellers = User::where('is_seller', true)
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.sellers', compact('sellers'));
    }

    public function verifySeller($id)
    {
        $seller = User::findOrFail($id);
        
        if (!$seller->is_seller) {
            return back()->with('error', 'მომხმარებელი არ არის გამყიდველი');
        }

        $seller->is_verified = true;
        $seller->save();

        return back()->with('success', 'გამყიდველი წარმატებით დავერიფიცირდა');
    }

    public function tickets()
    {
        $tickets = Ticket::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.tickets', compact('tickets'));
    }

    public function viewTicket($id)
    {
        $ticket = Ticket::with(['user', 'responses'])->findOrFail($id);
        return view('admin.ticket-view', compact('ticket'));
    }

    public function respondTicket(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $ticket = Ticket::findOrFail($id);
        
        $ticket->responses()->create([
            'user_id' => auth()->id(),
            'message' => $request->message,
            'is_admin' => true
        ]);

        $ticket->status = 'answered';
        $ticket->save();

        return back()->with('success', 'პასუხი წარმატებით გაიგზავნა');
    }

    public function closeTicket($id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->status = 'closed';
        $ticket->save();

        return back()->with('success', 'ტიკეტი დაიხურა');
    }
}
