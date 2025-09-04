@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2 class="text-light mb-4">გამყიდველის პანელი</h2>
    
    <div class="row">
        <!-- სტატისტიკის ბარათები -->
        <div class="col-md-3 mb-4">
            <div class="card seller-card">
                <div class="card-body">
                    <h5 class="card-title">შემოსული თანხა</h5>
                    <h2 class="card-text">₾{{ number_format($totalRevenue, 2) }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card seller-card">
                <div class="card-body">
                    <h5 class="card-title">პროდუქტები</h5>
                    <h2 class="card-text">{{ $totalProducts }}</h2>
                    <a href="{{ route('seller.products') }}" class="btn btn-sm btn-danger">მართვა</a>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card seller-card">
                <div class="card-body">
                    <h5 class="card-title">შეკვეთები</h5>
                    <h2 class="card-text">{{ $totalOrders }}</h2>
                </div>
            </div>
        </div>
        
        <div class="col-md-3 mb-4">
            <div class="card seller-card">
                <div class="card-body">
                    <h5 class="card-title">მიმდინარე შეკვეთები</h5>
                    <h2 class="card-text">{{ $pendingOrders }}</h2>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <!-- ბოლო შეკვეთები -->
        <div class="col-md-8 mb-4">
            <div class="card seller-card">
                <div class="card-header">
                    <h5 class="mb-0">ბოლო შეკვეთები</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>მომხმარებელი</th>
                                    <th>პროდუქტი</th>
                                    <th>თანხა</th>
                                    <th>სტატუსი</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentOrders as $order)
                                <tr>
                                    <td>{{ $order->id }}</td>
                                    <td>{{ $order->user->username }}</td>
                                    <td>{{ $order->product->name }}</td>
                                    <td>₾{{ number_format($order->total_price, 2) }}</td>
                                    <td>
                                        <span class="badge bg-{{ $order->status == 'completed' ? 'success' : ($order->status == 'pending' ? 'warning' : 'danger') }}">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- ტიკეტები და სწრაფი მოქმედებები -->
        <div class="col-md-4 mb-4">
            <div class="card seller-card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">ტიკეტები</h5>
                </div>
                <div class="card-body">
                    <h3 class="text-center">{{ $tickets }}</h3>
                    <p class="text-center">ღია ტიკეტი</p>
                    
                    @if($tickets > 0)
                        <div class="text-center mt-3">
                            <a href="{{ route('seller.tickets') }}" class="btn btn-danger">ტიკეტების ნახვა</a>
                        </div>
                    @endif
                </div>
            </div>
            
            <div class="card seller-card">
                <div class="card-header">
                    <h5 class="mb-0">სწრაფი მოქმედებები</h5>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('seller.products.create') }}" class="btn btn-danger">პროდუქტის დამატება</a>
                        <a href="{{ route('seller.products') }}" class="btn btn-outline-danger">პროდუქტების მართვა</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .seller-card {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border: 1px solid #ff0000;
        border-radius: 10px;
    }
    
    .seller-card .card-header {
        background-color: rgba(0, 0, 0, 0.5);
        border-bottom: 1px solid #ff0000;
    }
    
    .table-dark {
        background-color: transparent;
    }
    
    .table-dark td, .table-dark th {
        border-color: #444;
    }
</style>
@endsection