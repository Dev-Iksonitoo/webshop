@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-success">
                <div class="card-header bg-success text-white">
                    <h3 class="mb-0">გადახდა წარმატებით დასრულდა</h3>
                </div>
                <div class="card-body text-center py-5">
                    <div class="mb-4">
                        <i class="fas fa-check-circle text-success" style="font-size: 80px;"></i>
                    </div>
                    <h4 class="mb-3">თქვენი გადახდა მიღებულია!</h4>
                    <p class="mb-4">თანხა მალე დაემატება თქვენს ბალანსს. ეს პროცესი შეიძლება გაგრძელდეს რამდენიმე წუთი.</p>
                    
                    <div class="d-flex justify-content-center gap-3 mt-4">
                        <a href="{{ route('home') }}" class="btn btn-outline-light">
                            <i class="fas fa-home me-2"></i> მთავარ გვერდზე დაბრუნება
                        </a>
                        <a href="{{ route('coinbase.deposit') }}" class="btn btn-success">
                            <i class="fas fa-plus-circle me-2"></i> კიდევ შევსება
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection