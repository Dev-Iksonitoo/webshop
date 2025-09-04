<?php $__env->startSection('title', 'Weed Store - მთავარი გვერდი'); ?>

<?php $__env->startSection('styles'); ?>
<style>
    .welcome-text {
        text-align: center;
        margin: 40px 0;
    }
    
    .welcome-text h1 {
        font-size: 3rem;
        color: #00ff00;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        margin-bottom: 20px;
    }
    
    .welcome-text p {
        font-size: 1.2rem;
        color: #ddd;
        max-width: 800px;
        margin: 0 auto;
    }
    
    .section-title {
        color: #00ff00;
        text-align: center;
        margin: 40px 0 30px;
        font-size: 2rem;
        font-weight: bold;
    }
    
    .featured-products {
        margin-top: 40px;
    }
    
    .slide-content {
        position: relative;
        z-index: 10;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        padding: 20px;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 10px;
    }
    
    .trusted-sellers {
        margin-top: 60px;
        margin-bottom: 40px;
    }
    
    .seller-rating {
        color: #ffcc00;
    }
    
    .seller-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(60px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
</style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <div class="welcome-text">
        <h1>კეთილი იყოს თქვენი მობრძანება Weed Store-ში</h1>
        <p>ლეგალური მარიხუანას პროდუქტების ონლაინ მაღაზია</p>
    </div>
    
<?php $__env->startSection('content'); ?>
    <!-- Slider Section -->
    <div class="slider-container">
        <div class="slider">
            <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1603909223429-69bb7101f420?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 text-center slide-content">
                            <h2 class="display-4 text-white">საუკეთესო ხარისხის პროდუქცია</h2>
                            <p class="lead text-white">მხოლოდ შემოწმებული მომწოდებლებისგან</p>
                            <button class="btn btn-custom mt-3">შეიძინე ახლავე</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1536152470836-b943b246224c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 text-center slide-content">
                            <h2 class="display-4 text-white">უსაფრთხო გარიგებები</h2>
                            <p class="lead text-white">გარანტირებული მიწოდება და ანონიმურობა</p>
                            <button class="btn btn-custom mt-3">გაიგე მეტი</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="slide" style="background-image: url('https://images.unsplash.com/photo-1603386329225-868f9b1ee6c9?ixlib=rb-4.0.3&auto=format&fit=crop&w=1000&q=80');">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">
                        <div class="col-12 text-center slide-content">
                            <h2 class="display-4 text-white">გახდი სანდო გამყიდველი</h2>
                            <p class="lead text-white">დაიწყე შენი ბიზნესი ჩვენთან ერთად</p>
                            <button class="btn btn-custom mt-3">დარეგისტრირდი</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Welcome Text -->
    <div class="container">
        <div class="welcome-text">
            <h1>მოგესალმებით Weed Store-ში</h1>
            <p>ჩვენ გთავაზობთ უმაღლესი ხარისხის მარიხუანას და მასთან დაკავშირებულ პროდუქციას. ყველა ჩვენი პროდუქტი მოწმდება ხარისხის კონტროლის მკაცრი სტანდარტებით. ჩვენი პლატფორმა უზრუნველყოფს უსაფრთხო და ანონიმურ გარიგებებს სანდო გამყიდველებთან.</p>
        </div>
    </div>

    <!-- Featured Products -->
    <div class="container">
        <h2 class="section-title">პოპულარული პროდუქტები</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1603386329225-868f9b1ee6c9?auto=format&fit=crop&w=500&q=80" alt="პროდუქტი 1" class="product-image">
                    <h4 class="product-title">Purple Haze</h4>
                    <p class="product-seller">გამყიდველი: GreenMaster</p>
                    <p class="product-price">50₾ / გრამი</p>
                    <button class="btn btn-custom">კალათაში დამატება</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1603909223429-69bb7101f420?auto=format&fit=crop&w=500&q=80" alt="პროდუქტი 2" class="product-image">
                    <h4 class="product-title">OG Kush</h4>
                    <p class="product-seller">გამყიდველი: HerbKing</p>
                    <p class="product-price">45₾ / გრამი</p>
                    <button class="btn btn-custom">კალათაში დამატება</button>
                </div>
            </div>
            <div class="col-md-4">
                <div class="product-card">
                    <img src="https://images.unsplash.com/photo-1536152470836-b943b246224c?auto=format&fit=crop&w=500&q=80" alt="პროდუქტი 3" class="product-image">
                    <h4 class="product-title">Amnesia Haze</h4>
                    <p class="product-seller">გამყიდველი: CannaExpert</p>
                    <p class="product-price">55₾ / გრამი</p>
                    <button class="btn btn-custom">კალათაში დამატება</button>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Trusted Sellers Section -->
    <div class="container trusted-sellers">
        <h2 class="section-title">სანდო გამყიდველები</h2>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="product-card text-center">
                    <i class="fas fa-user-circle fa-5x mb-3" style="color: #00ff00;"></i>
                    <h4 class="product-title">GreenMaster</h4>
                    <p><i class="fas fa-star seller-rating"></i> 4.9/5 (120 შეფასება)</p>
                    <button class="btn btn-custom">პროფილის ნახვა</button>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="product-card text-center">
                    <i class="fas fa-user-circle fa-5x mb-3" style="color: #00ff00;"></i>
                    <h4 class="product-title">HerbKing</h4>
                    <p><i class="fas fa-star seller-rating"></i> 4.8/5 (98 შეფასება)</p>
                    <button class="btn btn-custom">პროფილის ნახვა</button>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="product-card text-center">
                    <i class="fas fa-user-circle fa-5x mb-3" style="color: #00ff00;"></i>
                    <h4 class="product-title">CannaExpert</h4>
                    <p><i class="fas fa-star seller-rating"></i> 4.7/5 (85 შეფასება)</p>
                    <button class="btn btn-custom">პროფილის ნახვა</button>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
<script>
    // Slider functionality
    $(document).ready(function() {
        let currentSlide = 0;
        const slides = $('.slide');
        const slideCount = slides.length;
        
        // Function to show a specific slide
        function showSlide(index) {
            if (index >= slideCount) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = slideCount - 1;
            } else {
                currentSlide = index;
            }
            
            $('.slider').css('transform', `translateX(-${currentSlide * 100}%)`);
        }
        
        // Auto-advance slides every 5 seconds
        setInterval(function() {
            showSlide(currentSlide + 1);
        }, 5000);
    });
</script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\ADMIN\Desktop\ტრეა\weed-store\resources\views/welcome.blade.php ENDPATH**/ ?>