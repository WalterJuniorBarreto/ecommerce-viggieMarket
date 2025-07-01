<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ShippingAddressController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AdminAuthController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ReportController;



// Rutas públicas
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/{id}/{slug}', [ProductController::class, 'details'])->name('product.details');
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
Route::get('/shop', [ProductController::class, 'shop'])->name('shop.index');
Route::post('/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

// Rutas de autenticación (manteniendo las existentes)
require __DIR__.'/auth.php';

// Rutas para usuarios autenticados (sin cambios)
Route::middleware('auth')->group(function () {
    // Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Carrito y checkout
    Route::get('/checkout', [CartController::class, 'checkout'])->name('cart.checkout');
    Route::post('/sync/cart-wishlist', [CartController::class, 'syncCartWishlist'])->name('sync.cart.wishlist');
    Route::delete('/cart/{product_id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/wishlist/{product_id}', [WishlistController::class, 'remove'])->name('wishlist.remove');
    
    // Direcciones y pagos
    Route::post('/shipping-address', [ShippingAddressController::class, 'store'])->name('shipping.store');
    Route::post('/checkout/stripe', [PaymentController::class, 'checkout'])->name('stripe.checkout');
    Route::get('/checkout/success', [PaymentController::class, 'success'])->name('checkout.success');
    Route::get('/checkout/cancel', [PaymentController::class, 'cancel'])->name('checkout.cancel');
    
    // Dashboard de usuario
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::post('/dashboard/address', [ShippingAddressController::class, 'storeAddress'])->name('address.store');
    Route::put('/dashboard/address/{id}', [ShippingAddressController::class, 'updateAddress'])->name('address.update');
    Route::delete('/dashboard/address/{id}', [ShippingAddressController::class, 'destroyAddress'])->name('address.destroy');
    Route::put('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
});

// Nuevas rutas para administradores (agregamos esto al final)
Route::middleware(['web'])->prefix('admin')->group(function () {

    // 🔐 Login de admin (fuera del grupo protegido)
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // 🔒 Rutas protegidas solo para admins autenticados
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        // Gestión de productos
        Route::resource('/products', ProductController::class);

        // Gestión de órdenes
        Route::get('/orders', [OrderController::class, 'index'])->name('admin.orders.index');
        Route::get('/orders/{order}', [OrderController::class, 'show'])->name('admin.orders.show');
        Route::put('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.updateStatus');

        // Gestión de usuarios
        Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
        Route::put('/users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggleStatus');

        // Reportes
        Route::get('/reports/sales', [ReportController::class, 'sales'])->name('admin.reports.sales');
    });
});
