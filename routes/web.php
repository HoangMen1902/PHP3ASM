<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Middleware\CartMiddleware;
use App\Http\Middleware\CheckoutMiddleware;
use App\Http\Controllers\AppointmentController;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\BlogController;
use App\Livewire\Auth\Login;
use App\Http\Controllers\ProductController;
use App\Http\Middleware\Authenticate;
use App\Livewire\Settings\Address;
use App\Livewire\Settings\Order;
use Illuminate\Support\Facades\Route;
    use App\Livewire\Components\AppointmentForm;
use App\Livewire\Settings\Appointment;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index']);
Route::get('/blog-detail', [BlogController::class, 'singlePost']);
Route::get('/contact', [ContactController::class, 'index']);
Route::get('/portfolio', [PortfolioController::class, 'index']);
Route::get('/about', [AboutController::class, 'index']);
Route::get('/service', [ServiceController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
Route::get('/cart', [CartController::class, 'index']);
Route::get('/products/{id}', [ProductController::class, 'show']);
Route::get('/checkout', [CheckoutController::class, 'index'])->middleware([CheckoutMiddleware::class, Authenticate::class]);
Route::get('/thanks-page', [HomeController::class, 'thanks']);
Route::get('/international-success/{checkout_id}', [CheckoutController::class, 'internationalCompleted']);
Route::get('/international-cancel', [CheckoutController::class, 'internationalCancel']);

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])
    ->middleware('auth')
    ->name('logout');
Route::get('/booking', [AppointmentController::class, 'index']);
    
Route::get('/service', [ServiceController::class, 'index']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('login');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');
Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
    Route::get('settings/address', Address::class)->name('settings.address');
    Route::get('settings/order', Order::class)->name('settings.order');
    Route::get('settings/appointment', Appointment::class)->name('settings.appointment');
});


Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');
Route::view('/head', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');




Route::post('/add-to-cart', [CartController::class, 'cartInsert'])->middleware([Authenticate::class, CartMiddleware::class]);
Route::post('/checkout', [CheckoutController::class, 'checkout'])->middleware('auth');
require __DIR__ . '/auth.php';
