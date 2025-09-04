@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-light">ჩემი პროდუქტები</h2>
        <a href="{{ route('seller.products.create') }}" class="btn btn-danger">
            <i class="fas fa-plus"></i> პროდუქტის დამატება
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="card seller-card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>სახელი</th>
                            <th>ქალაქი</th>
                            <th>რაიონი</th>
                            <th>წონა</th>
                            <th>ფასი</th>
                            <th>სტატუსი</th>
                            <th>მოქმედებები</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->city }}</td>
                                <td>{{ $product->district }}</td>
                                <td>{{ $product->weight }} გრ</td>
                                <td>₾{{ number_format($product->price, 2) }}</td>
                                <td>
                                    <span class="badge bg-{{ $product->available ? 'success' : 'danger' }}">
                                        {{ $product->available ? 'ხელმისაწვდომი' : 'ამოწურული' }}
                                    </span>
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('seller.products.edit', $product->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('seller.products.delete', $product->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('დარწმუნებული ხართ?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">პროდუქტები არ არის</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="d-flex justify-content-center mt-4">
                {{ $products->links() }}
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
    
    .table-dark {
        background-color: transparent;
    }
    
    .table-dark td, .table-dark th {
        border-color: #444;
    }
    
    .pagination {
        --bs-pagination-color: #fff;
        --bs-pagination-bg: rgba(0, 0, 0, 0.5);
        --bs-pagination-border-color: #ff0000;
        --bs-pagination-hover-color: #fff;
        --bs-pagination-hover-bg: #ff0000;
        --bs-pagination-hover-border-color: #ff0000;
        --bs-pagination-active-color: #fff;
        --bs-pagination-active-bg: #ff0000;
        --bs-pagination-active-border-color: #ff0000;
    }
</style>
@endsection