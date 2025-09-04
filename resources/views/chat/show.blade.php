@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark text-white">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        @if($user->avatar)
                            <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->username }}" class="rounded-circle mr-2" width="40">
                        @else
                            <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center mr-2" style="width: 40px; height: 40px;">
                                {{ strtoupper(substr($user->username, 0, 1)) }}
                            </div>
                        @endif
                        <span>{{ $user->username }}</span>
                        @if($user->is_seller)
                            <span class="badge badge-success ml-2">სელერი</span>
                        @endif
                    </div>
                    <a href="{{ route('chat.index') }}" class="btn btn-outline-primary btn-sm">უკან დაბრუნება</a>
                </div>

                <div class="card-body">
                    <div class="chat-messages p-3" id="chat-messages">
                        @foreach($messages as $message)
                            <div class="message mb-3 {{ $message->sender_id == Auth::id() ? 'text-right' : 'text-left' }}">
                                <div class="message-content d-inline-block p-2 rounded {{ $message->sender_id == Auth::id() ? 'bg-primary' : 'bg-secondary' }}" style="max-width: 80%;">
                                    <p class="mb-0">{{ $message->message }}</p>
                                    <small class="text-white-50">{{ $message->created_at->format('H:i') }}</small>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="card-footer">
                    <form action="{{ route('chat.send') }}" method="POST">
                        @csrf
                        <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                        <div class="input-group">
                            <input type="text" name="message" class="form-control bg-dark text-white" placeholder="დაწერეთ შეტყობინება..." required>
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="submit">
                                    <i class="fas fa-paper-plane"></i> გაგზავნა
                                </button>
                            </div>
                        </div>
                        <div class="emoji-picker mt-2">
                            <button type="button" class="btn btn-sm btn-outline-secondary emoji" data-emoji="😊">😊</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary emoji" data-emoji="😂">😂</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary emoji" data-emoji="❤️">❤️</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary emoji" data-emoji="👍">👍</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary emoji" data-emoji="🙏">🙏</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary emoji" data-emoji="🔥">🔥</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary emoji" data-emoji="😎">😎</button>
                            <button type="button" class="btn btn-sm btn-outline-secondary emoji" data-emoji="😍">😍</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .chat-messages {
        height: 400px;
        overflow-y: auto;
    }
    .message-content {
        word-break: break-word;
    }
    .emoji-picker {
        display: flex;
        flex-wrap: wrap;
    }
    .emoji {
        margin-right: 5px;
        margin-bottom: 5px;
        font-size: 1.2rem;
        padding: 0.1rem 0.3rem;
    }
</style>
@endsection

@section('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // ჩატის ბოლოში ჩასვლა
        const chatMessages = document.getElementById('chat-messages');
        chatMessages.scrollTop = chatMessages.scrollHeight;
        
        // ემოჯის ღილაკების ფუნქციონალი
        const emojiButtons = document.querySelectorAll('.emoji');
        const messageInput = document.querySelector('input[name="message"]');
        
        emojiButtons.forEach(button => {
            button.addEventListener('click', function() {
                const emoji = this.getAttribute('data-emoji');
                messageInput.value += emoji;
                messageInput.focus();
            });
        });
    });
</script>
@endsection