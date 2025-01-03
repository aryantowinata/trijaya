<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserDashboardController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderManagementController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\EncryptionController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'welcome'])->name('welcome');
Route::get('/cart', [PageController::class, 'cart'])->name('cart');
Route::get('/shop', [PageController::class, 'shop'])->name('shop');
Route::get('/abouts', [PageController::class, 'abouts'])->name('abouts');
Route::resource('produk', ProdukController::class)
    ->middleware(['auth', 'admin']);

Route::resource('users', UserController::class)
    ->middleware(['auth', 'admin']);

Route::resource('history_order', OrderManagementController::class)
    ->middleware(['auth', 'admin']);

Route::get('/orders/{id}', [OrderManagementController::class, 'show'])->middleware('auth', 'admin')->name('orders.show');

Route::resource('kategori', KategoriController::class)->middleware('auth', 'admin');
Route::get('/shop/category/{id}', [PageController::class, 'showByCategory'])->name('shop.category');

// Route untuk dashboard admin
Route::get('/home', [HomeController::class, 'index'])
    ->middleware('auth', 'admin')
    ->name('home');

// // Route untuk dashboard user
Route::get('/user/home', [UserDashboardController::class, 'index'])
    ->middleware('auth', 'user')
    ->name('user/home');

Route::get('/user/order', [UserDashboardController::class, 'order'])
    ->middleware('auth', 'user')
    ->name('user/order');

Route::get('/user/daftar_produk', [UserDashboardController::class, 'daftar_produk'])
    ->middleware('auth', 'user')
    ->name('user/daftar_produk');






Auth::routes();


Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
Route::put('/profile', 'ProfileController@update')->name('profile.update');

Route::get('/user/profile', [ProfileController::class, 'user'])->middleware('auth', 'user')->name('Userprofile');
Route::put('/user/Userprofile', 'ProfileController@updateUser')->middleware('auth', 'user')->name('Userprofile.update');
Route::post('/user/order/cancel/{id}', [UserDashboardController::class, 'cancelOrder'])->middleware('auth', 'user')->name('order.cancel');

Route::get('/user/orders', [UserDashboardController::class, 'orderList'])->middleware('auth', 'user')->name('user.orders');

Route::post('/user/cart/add', [CartController::class, 'add'])->middleware('auth', 'user')->name('user.cart.add');
Route::get('/user/cart', [CartController::class, 'index'])->middleware('auth', 'user')->name('user.cart.index');
Route::delete('/user/cart/remove/{id}', [CartController::class, 'remove'])->middleware('auth', 'user')->name('user.cart.remove');

Route::post('/user/order/create', [OrderController::class, 'create'])->middleware('auth', 'user')->name('user.order.create');
// Route untuk menampilkan daftar pesanan
Route::get('/user/orders', [OrderController::class, 'index'])->middleware('auth', 'user')->name('user.orders');
// Route untuk menampilkan detail pesanan
Route::get('/user/orders/{id}', [OrderController::class, 'show'])->middleware('auth', 'user')->name('user.orders.show');

Route::post('/user/checkout', [CheckoutController::class, 'checkout'])->middleware('auth', 'user')->name('user.checkout');
// Route untuk halaman Manajemen Pemesanan


Route::get('/about', function () {
    return view('about');
})->name('about');
