<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Weed Store')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        body {
            background-color: #000;
            color: #fff;
            font-family: 'Arial', sans-serif;
            background-image: url('https://images.unsplash.com/photo-1536782376847-5c9d14d97cc0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8Y2FubmFiaXN8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=800&q=60');
            background-size: cover;
            background-attachment: fixed;
            background-position: center;
            background-blend-mode: overlay;
        }
        
        .navbar {
            background-color: #0000ff !important;
            border: 3px solid #ff0000;
            border-radius: 50px;
            padding: 10px 20px;
            margin-bottom: 20px;
        }
        
        .navbar-brand, .nav-link {
            color: #fff !important;
            font-weight: bold;
        }
        
        .nav-link:hover {
            color: #ddd !important;
        }
        
        .footer {
            background-color: #222;
            padding: 20px 0;
            margin-top: 50px;
        }
        
        .footer-logo {
            max-width: 100px;
        }
        
        /* Slider styles */
        .slider-container {
            position: relative;
            overflow: hidden;
            margin-bottom: 30px;
            border-radius: 15px;
            height: 400px;
        }
        
        .slider {
            display: flex;
            transition: transform 0.5s ease-in-out;
            height: 100%;
        }
        
        .slide {
            min-width: 100%;
            background-size: cover;
            background-position: center;
            height: 100%;
        }
        
        /* Responsive styles */
        @media (max-width: 768px) {
            .slider-container {
                height: 300px;
            }
        }
        
        @media (max-width: 576px) {
            .slider-container {
                height: 200px;
            }
        }
        /* Chat styles */
        .chat-container {
            border: 1px solid #444;
            border-radius: 10px;
            margin-top: 30px;
            background-color: rgba(0, 0, 0, 0.7);
        }
        
        .chat-header {
            background-color: #222;
            padding: 10px;
            border-radius: 10px 10px 0 0;
            font-weight: bold;
        }
        
        .chat-messages {
            height: 300px;
            overflow-y: auto;
            padding: 15px;
        }
        
        .chat-input {
            display: flex;
            padding: 10px;
            border-top: 1px solid #444;
        }
        
        .chat-input input {
            flex-grow: 1;
            background-color: #333;
            border: 1px solid #555;
            color: #fff;
            padding: 8px;
            border-radius: 5px;
        }
        
        .chat-input button {
            margin-left: 10px;
            background-color: #0066ff;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .emoji-picker {
            margin-left: 10px;
            cursor: pointer;
            font-size: 1.2rem;
        }
        
        /* Seller card styles */
        .seller-card {
            border: 2px solid #00ff00;
            border-radius: 10px;
            padding: 15px;
            margin-bottom: 20px;
            background-color: rgba(0, 0, 0, 0.7);
            transition: all 0.3s ease;
            animation: borderPulse 2s infinite;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        @keyframes borderPulse {
            0% { border-color: #00ff00; }
            50% { border-color: #ff00ff; }
            100% { border-color: #00ff00; }
        }
        
        .seller-card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px rgba(0, 255, 0, 0.5);
        }
    </style>
    @yield('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Weed Store</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">მთავარი</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('chat.index') }}">ჩატი</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('tickets.index') }}">ტიკეტები</a>
                        </li>
                        @if(Auth::user()->is_seller)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('seller.dashboard') }}">სელერის პანელი</a>
                            </li>
                        @endif
                        @if(Auth::user()->is_admin)
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin.dashboard') }}">ადმინის პანელი</a>
                            </li>
                        @endif
                    @endauth
                </ul>
                <ul class="navbar-nav">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">შესვლა</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">რეგისტრაცია</a>
                        </li>
                    @else
                        <li class="nav-item me-3">
                            <a class="nav-link" href="{{ route('coinbase.deposit') }}">
                                <i class="fas fa-wallet me-1"></i> ბალანსი: ${{ number_format(Auth::user()->balance, 2) }}
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ Auth::user()->username }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end bg-dark" aria-labelledby="navbarDropdown">
                                <li>
                                    <a class="dropdown-item text-white" href="{{ route('coinbase.deposit') }}">
                                        <i class="fas fa-plus-circle me-2"></i> ბალანსის შევსება
                                    </a>
                                </li>
                                <li><hr class="dropdown-divider bg-secondary"></li>
                                <li>
                                    <a class="dropdown-item text-white" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fas fa-sign-out-alt me-2"></i> გასვლა
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        @yield('content')
    </div>

    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <img src="https://via.placeholder.com/100x50?text=WeedStore" alt="Weed Store Logo" class="footer-logo">
                    <p class="mt-2">Weed Store</p>
                </div>
                <div class="col-md-4">
                    <h5>dragtest</h5>
                    <p>ლეგალური მარიხუანას მაღაზია</p>
                </div>
                <div class="col-md-4">
                    <h5>კონტაქტი</h5>
                    <p><i class="fas fa-envelope"></i> info@weedstore.com</p>
                    <p><i class="fas fa-phone"></i> +995 555 12 34 56</p>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12 text-center">
                    <p>&copy; 2023 Weed Store. ყველა უფლება დაცულია.</p>
                </div>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Slider functionality
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.querySelector('.slider');
            if (slider) {
                const slides = document.querySelectorAll('.slide');
                const slideWidth = 100; // percentage
                let currentSlide = 0;
                
                // Auto slide every 2 seconds
                setInterval(() => {
                    currentSlide = (currentSlide + 1) % slides.length;
                    slider.style.transform = `translateX(-${currentSlide * slideWidth}%)`;
                }, 2000);
            }
        });
    </script>
    @yield('scripts')
</body>
</html>