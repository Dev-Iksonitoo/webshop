<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Chat;
use App\Models\User;

class ChatController extends Controller
{
    /**
     * კონსტრუქტორი
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * ჩატის მთავარი გვერდი
     */
    public function index()
    {
        $users = User::where('id', '!=', Auth::id())->get();
        return view('chat.index', compact('users'));
    }

    /**
     * კონკრეტული მომხმარებლის ჩატის ჩვენება
     */
    public function show($userId)
    {
        $user = User::findOrFail($userId);
        
        // ჩატის შეტყობინებების მიღება
        $messages = Chat::where(function($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                  ->where('receiver_id', $userId);
        })->orWhere(function($query) use ($userId) {
            $query->where('sender_id', $userId)
                  ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();
        
        return view('chat.show', compact('user', 'messages'));
    }

    /**
     * შეტყობინების გაგზავნა
     */
    public function send(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        $chat = new Chat();
        $chat->sender_id = Auth::id();
        $chat->receiver_id = $request->receiver_id;
        $chat->message = $request->message;
        $chat->save();

        return redirect()->back();
    }
}
