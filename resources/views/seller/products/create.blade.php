@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card seller-card">
                <div class="card-header">
                    <h5 class="mb-0">პროდუქტის დამატება</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('seller.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="name" class="form-label">პროდუქტის სახელი</label>
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                                @error('name')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="description" class="form-label">აღწერა</label>
                                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                                @error('description')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="price" class="form-label">ფასი (₾)</label>
                                <input type="number" step="0.01" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price') }}" required>
                                @error('price')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="weight" class="form-label">წონა (გრამი)</label>
                                <input type="number" step="0.01" class="form-control @error('weight') is-invalid @enderror" id="weight" name="weight" value="{{ old('weight') }}" required>
                                @error('weight')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">ქალაქი</label>
                                <input type="text" class="form-control @error('city') is-invalid @enderror" id="city" name="city" value="{{ old('city') }}" required>
                                @error('city')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="district" class="form-label">რაიონი</label>
                                <input type="text" class="form-control @error('district') is-invalid @enderror" id="district" name="district" value="{{ old('district') }}" required>
                                @error('district')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="address" class="form-label">მისამართი</label>
                                <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address" value="{{ old('address') }}" required>
                                @error('address')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row mb-3">
                            <div class="col-md-12">
                                <label for="address_photo" class="form-label">მისამართის ფოტო</label>
                                <input type="file" class="form-control @error('address_photo') is-invalid @enderror" id="address_photo" name="address_photo" required>
                                <small class="text-muted">მაქსიმალური ზომა: 2MB</small>
                                @error('address_photo')
                                    <span class="invalid-feedback">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-danger">პროდუქტის დამატება</button>
                            <a href="{{ route('seller.products') }}" class="btn btn-outline-secondary">გაუქმება</a>
                        </div>
                    </form>
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
    
    .form-control {
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: 1px solid #444;
    }
    
    .form-control:focus {
        background-color: rgba(0, 0, 0, 0.7);
        color: white;
        border-color: #ff0000;
        box-shadow: 0 0 0 0.25rem rgba(255, 0, 0, 0.25);
    }
</style>
@endsection