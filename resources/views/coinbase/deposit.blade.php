@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card bg-dark text-white border-danger">
                <div class="card-header bg-danger text-white">
                    <h3 class="mb-0">ბალანსის შევსება</h3>
                </div>
                <div class="card-body">
                    @if (session('error'))
                        <div class="alert alert-danger">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('coinbase.create-charge') }}">
                        @csrf

                        <div class="form-group mb-4">
                            <label for="amount" class="form-label">თანხა (USD)</label>
                            <div class="input-group">
                                <span class="input-group-text">$</span>
                                <input type="number" class="form-control @error('amount') is-invalid @enderror" 
                                    id="amount" name="amount" value="{{ old('amount') }}" 
                                    min="1" step="0.01" required>
                            </div>
                            @error('amount')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <h5>გადახდის მეთოდები:</h5>
                            <div class="d-flex flex-wrap gap-3 mt-3">
                                <div class="payment-method">
                                    <img src="https://www.coinbase.com/assets/images/og-default-04-2021.jpg" 
                                        alt="Coinbase" class="img-fluid" style="max-height: 40px;">
                                    <span>Coinbase</span>
                                </div>
                                <div class="payment-method">
                                    <img src="https://bitcoin.org/img/icons/opengraph.png?1693519667" 
                                        alt="Bitcoin" class="img-fluid" style="max-height: 40px;">
                                    <span>Bitcoin</span>
                                </div>
                                <div class="payment-method">
                                    <img src="https://ethereum.org/static/a110735dade3f354a46fc2446cd52476/f3a29/eth-home-icon.webp" 
                                        alt="Ethereum" class="img-fluid" style="max-height: 40px;">
                                    <span>Ethereum</span>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-danger btn-lg w-100">
                                გადახდა
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="card bg-dark text-white border-info mt-4">
                <div class="card-header bg-info text-white">
                    <h4 class="mb-0">ინფორმაცია</h4>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i> ბალანსის შევსება შესაძლებელია კრიპტოვალუტით.</li>
                        <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i> გადახდის დასრულების შემდეგ თანხა ავტომატურად დაემატება თქვენს ბალანსს.</li>
                        <li class="mb-2"><i class="fas fa-info-circle text-info me-2"></i> პრობლემის შემთხვევაში დაგვიკავშირდით ადმინისტრაციას.</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .payment-method {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 10px;
        border: 1px solid #444;
        border-radius: 8px;
        background-color: #333;
        min-width: 100px;
        text-align: center;
    }
    
    .payment-method span {
        margin-top: 8px;
        font-size: 14px;
    }
</style>
@endsection