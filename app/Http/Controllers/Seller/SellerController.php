<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Ticket;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class SellerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!auth()->user()->is_seller) {
                return redirect('/');
            }
            return $next($request);
        });
    }

    public function dashboard()
    {
        $seller = Auth::user();
        $totalRevenue = Order::where('seller_id', $seller->id)->sum('total_price');
        $totalProducts = Product::where('seller_id', $seller->id)->count();
        $totalOrders = Order::where('seller_id', $seller->id)->count();
        $pendingOrders = Order::where('seller_id', $seller->id)->where('status', 'pending')->count();
        
        $recentOrders = Order::with(['user', 'product'])
            ->where('seller_id', $seller->id)
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();
            
        $tickets = Ticket::where('seller_id', $seller->id)
            ->where('status', 'open')
            ->count();

        return view('seller.dashboard', compact(
            'totalRevenue', 
            'totalProducts', 
            'totalOrders', 
            'pendingOrders', 
            'recentOrders',
            'tickets'
        ));
    }

    public function products()
    {
        $products = Product::where('seller_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('seller.products.index', compact('products'));
    }

    public function createProduct()
    {
        return view('seller.products.create');
    }

    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_photo' => 'required|image|max:2048',
        ]);

        $imagePath = $request->file('address_photo')->store('address_photos', 'public');

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'weight' => $request->weight,
            'city' => $request->city,
            'district' => $request->district,
            'address' => $request->address,
            'address_photo' => $imagePath,
            'seller_id' => Auth::id(),
            'available' => true,
        ]);

        return redirect()->route('seller.products')->with('success', 'პროდუქტი წარმატებით დაემატა');
    }

    public function editProduct($id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        return view('seller.products.edit', compact('product'));
    }

    public function updateProduct(Request $request, $id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'weight' => 'required|numeric|min:0',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'address_photo' => 'nullable|image|max:2048',
        ]);

        $data = $request->except('address_photo');
        
        if ($request->hasFile('address_photo')) {
            // წაშალე ძველი ფოტო
            if ($product->address_photo) {
                Storage::disk('public')->delete($product->address_photo);
            }
            
            $data['address_photo'] = $request->file('address_photo')->store('address_photos', 'public');
        }

        $product->update($data);

        return redirect()->route('seller.products')->with('success', 'პროდუქტი წარმატებით განახლდა');
    }

    public function deleteProduct($id)
    {
        $product = Product::where('seller_id', Auth::id())->findOrFail($id);
        
        // წაშალე ფოტო
        if ($product->address_photo) {
            Storage::disk('public')->delete($product->address_photo);
        }
        
        $product->delete();

        return redirect()->route('seller.products')->with('success', 'პროდუქტი წარმატებით წაიშალა');
    }

    public function tickets()
    {
        $tickets = Ticket::where('seller_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(20);
            
        return view('seller.tickets.index', compact('tickets'));
    }

    public function viewTicket($id)
    {
        $ticket = Ticket::with(['user', 'responses'])
            ->where('seller_id', Auth::id())
            ->findOrFail($id);
            
        return view('seller.tickets.view', compact('ticket'));
    }

    public function respondTicket(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $ticket = Ticket::where('seller_id', Auth::id())->findOrFail($id);
        
        $ticket->responses()->create([
            'user_id' => Auth::id(),
            'message' => $request->message,
            'is_admin' => false
        ]);

        $ticket->status = 'answered';
        $ticket->save();

        return back()->with('success', 'პასუხი წარმატებით გაიგზავნა');
    }

    public function closeTicket($id)
    {
        $ticket = Ticket::where('seller_id', Auth::id())->findOrFail($id);
        $ticket->status = 'closed';
        $ticket->save();

        return back()->with('success', 'ტიკეტი დაიხურა');
    }
}
