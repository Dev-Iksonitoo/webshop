@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card bg-dark text-white">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>ჩემი ტიკეტები</span>
                    <a href="{{ route('tickets.create') }}" class="btn btn-primary btn-sm">ახალი ტიკეტი</a>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(count($tickets) > 0)
                        <div class="table-responsive">
                            <table class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>თემა</th>
                                        <th>სელერი</th>
                                        <th>სტატუსი</th>
                                        <th>შექმნის თარიღი</th>
                                        <th>მოქმედება</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($tickets as $ticket)
                                        <tr>
                                            <td>{{ $ticket->id }}</td>
                                            <td>{{ $ticket->subject }}</td>
                                            <td>
                                                @if($ticket->seller)
                                                    {{ $ticket->seller->username }}
                                                @else
                                                    <span class="text-muted">წაშლილი სელერი</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if($ticket->status == 'open')
                                                    <span class="badge badge-info">ღია</span>
                                                @elseif($ticket->status == 'awaiting')
                                                    <span class="badge badge-warning">პასუხის მოლოდინში</span>
                                                @elseif($ticket->status == 'answered')
                                                    <span class="badge badge-success">პასუხგაცემული</span>
                                                @elseif($ticket->status == 'closed')
                                                    <span class="badge badge-secondary">დახურული</span>
                                                @endif
                                            </td>
                                            <td>{{ $ticket->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-info btn-sm">ნახვა</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-5">
                            <h4>ტიკეტები არ არის</h4>
                            <p class="text-muted">თქვენ ჯერ არ გაქვთ შექმნილი ტიკეტები</p>
                            <a href="{{ route('tickets.create') }}" class="btn btn-primary">შექმენით ახალი ტიკეტი</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection