@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>ახალი ტიკეტის შექმნა</span>
                    <a href="{{ route('tickets.index') }}" class="btn btn-outline-primary btn-sm">უკან დაბრუნება</a>
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('tickets.store') }}">
                        @csrf

                        <div class="form-group">
                            <label for="seller_id">სელერი</label>
                            <select id="seller_id" class="form-control bg-dark text-white @error('seller_id') is-invalid @enderror" name="seller_id" required>
                                <option value="">აირჩიეთ სელერი</option>
                                @foreach($sellers as $seller)
                                    <option value="{{ $seller->id }}">{{ $seller->username }}</option>
                                @endforeach
                            </select>
                            @error('seller_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="subject">თემა</label>
                            <input id="subject" type="text" class="form-control bg-dark text-white @error('subject') is-invalid @enderror" name="subject" value="{{ old('subject') }}" required>
                            @error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="message">შეტყობინება</label>
                            <textarea id="message" class="form-control bg-dark text-white @error('message') is-invalid @enderror" name="message" rows="5" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-0">
                            <button type="submit" class="btn btn-primary">
                                ტიკეტის გაგზავნა
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection