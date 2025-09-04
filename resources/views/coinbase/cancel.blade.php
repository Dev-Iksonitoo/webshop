@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-warning">
                <div class="card-header bg-warning text-dark">
                    <h3 class="mb-0">გადახდა გაუქმებულია</h3>
                </div>
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-times-circle text-warning" style="font-size: 80px;"></i>
                    </div>
                    <h4 class="mb-3">თქვენი გადახდა გაუქმდა</h4>
                    <p class="mb-4">თქვენ გააუქმეთ გადახდის პროცესი. თქვენი ბალანსი არ შეიცვალა.</p>
                    
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-light">
                            <i class="fas fa-home me-2"></i> მთავარ გვერდზე დაბრუნება
                        </a>
                        <a href="{{ route('coinbase.deposit') }}" class="btn btn-warning text-dark">
                            <i class="fas fa-redo me-2"></i> ხელახლა ცდა
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection