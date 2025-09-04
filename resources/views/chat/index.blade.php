@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark text-white">
                <div class="card-header">ონლაინ ჩატი</div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="list-group">
                                @foreach($users as $user)
                                    <a href="{{ route('chat.show', $user->id) }}" class="list-group-item list-group-item-action bg-dark text-white border-secondary">
                                        <div class="d-flex align-items-center">
                                            <div class="avatar-container mr-3">
                                                @if($user->avatar)
                                                    <img src="{{ asset('storage/' . $user->avatar) }}" alt="{{ $user->username }}" class="rounded-circle" width="40">
                                                @else
                                                    <div class="rounded-circle bg-primary text-white d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">
                                                        {{ strtoupper(substr($user->username, 0, 1)) }}
                                                    </div>
                                                @endif
                                                
                                                @if($user->is_seller)
                                                    <span class="badge badge-success position-absolute" style="bottom: 0; right: 0;">სელერი</span>
                                                @endif
                                            </div>
                                            <div>
                                                <h6 class="mb-0">{{ $user->username }}</h6>
                                                <small class="text-muted">{{ $user->is_seller ? 'სელერი' : 'მომხმარებელი' }}</small>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="text-center py-5">
                                <h4>აირჩიეთ მომხმარებელი ჩატის დასაწყებად</h4>
                                <p class="text-muted">აირჩიეთ მომხმარებელი მარცხენა სიდან ჩატის დასაწყებად</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .avatar-container {
        position: relative;
        width: 40px;
        height: 40px;
        margin-right: 15px;
    }
    .list-group-item {
        transition: all 0.3s;
    }
    .list-group-item:hover {
        background-color: #343a40 !important;
        border-color: #007bff !important;
    }
</style>
@endsection