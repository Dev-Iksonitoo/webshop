@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card bg-dark text-white">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>ტიკეტი #{{ $ticket->id }} - {{ $ticket->subject }}</span>
                    <div>
                        @if($ticket->status != 'closed')
                            <form method="POST" action="{{ route('tickets.close', $ticket->id) }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('დარწმუნებული ხართ, რომ გსურთ ტიკეტის დახურვა?')">დახურვა</button>
                            </form>
                        @endif
                        <a href="{{ route('tickets.index') }}" class="btn btn-outline-primary btn-sm ml-2">უკან დაბრუნება</a>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="ticket-status mb-4">
                        <span class="badge 
                            @if($ticket->status == 'open') badge-info
                            @elseif($ticket->status == 'awaiting') badge-warning
                            @elseif($ticket->status == 'answered') badge-success
                            @elseif($ticket->status == 'closed') badge-secondary
                            @endif">
                            @if($ticket->status == 'open') ღია
                            @elseif($ticket->status == 'awaiting') პასუხის მოლოდინში
                            @elseif($ticket->status == 'answered') პასუხგაცემული
                            @elseif($ticket->status == 'closed') დახურული
                            @endif
                        </span>
                        <span class="text-muted ml-2">შეიქმნა: {{ $ticket->created_at->format('d.m.Y H:i') }}</span>
                    </div>

                    <div class="ticket-message p-3 mb-4 border border-secondary rounded">
                        <div class="d-flex justify-content-between mb-2">
                            <div>
                                <strong>{{ $ticket->user->username }}</strong>
                                <span class="badge badge-primary ml-1">მომხმარებელი</span>
                            </div>
                            <small class="text-muted">{{ $ticket->created_at->format('d.m.Y H:i') }}</small>
                        </div>
                        <div class="ticket-content">
                            {{ $ticket->message }}
                        </div>
                    </div>

                    @if(isset($ticket->replies) && count($ticket->replies) > 0)
                        <h5 class="mb-3">პასუხები</h5>
                        @foreach($ticket->replies as $reply)
                            <div class="ticket-reply p-3 mb-3 border border-secondary rounded">
                                <div class="d-flex justify-content-between mb-2">
                                    <div>
                                        @php
                                            $replyUser = App\Models\User::find($reply['user_id']);
                                        @endphp
                                        <strong>{{ $replyUser ? $replyUser->username : 'წაშლილი მომხმარებელი' }}</strong>
                                        @if($replyUser && $replyUser->id == $ticket->seller_id)
                                            <span class="badge badge-success ml-1">სელერი</span>
                                        @elseif($replyUser && $replyUser->is_admin)
                                            <span class="badge badge-danger ml-1">ადმინი</span>
                                        @else
                                            <span class="badge badge-primary ml-1">მომხმარებელი</span>
                                        @endif
                                    </div>
                                    <small class="text-muted">{{ \Carbon\Carbon::parse($reply['created_at'])->format('d.m.Y H:i') }}</small>
                                </div>
                                <div class="reply-content">
                                    {{ $reply['message'] }}
                                </div>
                            </div>
                        @endforeach
                    @endif

                    @if($ticket->status != 'closed')
                        <div class="reply-form mt-4">
                            <h5 class="mb-3">პასუხის გაცემა</h5>
                            <form method="POST" action="{{ route('tickets.reply', $ticket->id) }}">
                                @csrf
                                <div class="form-group">
                                    <textarea name="reply" class="form-control bg-dark text-white @error('reply') is-invalid @enderror" rows="3" required></textarea>
                                    @error('reply')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <button type="submit" class="btn btn-primary">პასუხის გაგზავნა</button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-secondary mt-4">
                            ეს ტიკეტი დახურულია და აღარ შეიძლება პასუხის გაცემა.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .ticket-message, .ticket-reply {
        background-color: #2a2a2a;
    }
    .ticket-content, .reply-content {
        white-space: pre-line;
    }
</style>
@endsection