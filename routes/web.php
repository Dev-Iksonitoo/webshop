<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Seller\SellerController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\CoinbaseController;

Route::get('/', function () {
    return view('welcome');
});

// Coinbase Webhook
Route::post('/webhook/coinbase', [CoinbaseController::class, 'handleWebhook'])->name('coinbase.webhook');

// ავთენტიფიკაციის მარშრუტები
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ჩატის მარშრუტები
Route::middleware(['auth'])->group(function () {
    Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
    Route::get('/chat/{userId}', [ChatController::class, 'show'])->name('chat.show');
    Route::post('/chat/send', [ChatController::class, 'send'])->name('chat.send');
    
    // ტიკეტების მარშრუტები
    Route::get('/tickets', [TicketController::class, 'index'])->name('tickets.index');
    Route::get('/tickets/create', [TicketController::class, 'create'])->name('tickets.create');
    Route::post('/tickets', [TicketController::class, 'store'])->name('tickets.store');
    Route::get('/tickets/{id}', [TicketController::class, 'show'])->name('tickets.show');
    Route::post('/tickets/{id}/reply', [TicketController::class, 'reply'])->name('tickets.reply');
    Route::post('/tickets/{id}/close', [TicketController::class, 'close'])->name('tickets.close');
    
    // Coinbase ინტეგრაციის მარშრუტები
    Route::get('/deposit', [CoinbaseController::class, 'showDepositForm'])->name('coinbase.deposit');
    Route::post('/deposit/charge', [CoinbaseController::class, 'createCharge'])->name('coinbase.create-charge');
    Route::get('/deposit/success', [CoinbaseController::class, 'success'])->name('coinbase.success');
    Route::get('/deposit/cancel', [CoinbaseController::class, 'cancel'])->name('coinbase.cancel');
});

// ადმინისტრატორის მარშრუტები
Route::prefix('admin')->middleware(['auth'])->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/sellers', [AdminController::class, 'sellers'])->name('sellers');
    Route::post('/sellers/{id}/verify', [AdminController::class, 'verifySeller'])->name('sellers.verify');
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('tickets');
    Route::get('/tickets/{id}', [AdminController::class, 'viewTicket'])->name('tickets.view');
    Route::post('/tickets/{id}/respond', [AdminController::class, 'respondTicket'])->name('tickets.respond');
    Route::post('/tickets/{id}/close', [AdminController::class, 'closeTicket'])->name('tickets.close');
});

// გამყიდველის მარშრუტები
Route::prefix('seller')->middleware(['auth'])->name('seller.')->group(function () {
    Route::get('/', [SellerController::class, 'dashboard'])->name('dashboard');
    
    // პროდუქტების მართვა
    Route::get('/products', [SellerController::class, 'products'])->name('products');
    Route::get('/products/create', [SellerController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [SellerController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{id}/edit', [SellerController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{id}', [SellerController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{id}', [SellerController::class, 'deleteProduct'])->name('products.delete');
    
    // ტიკეტების მართვა
    Route::get('/tickets', [SellerController::class, 'tickets'])->name('tickets');
    Route::get('/tickets/{id}', [SellerController::class, 'viewTicket'])->name('tickets.view');
    Route::post('/tickets/{id}/respond', [SellerController::class, 'respondTicket'])->name('tickets.respond');
    Route::post('/tickets/{id}/close', [SellerController::class, 'closeTicket'])->name('tickets.close');
});
