<?php

use App\Http\Controllers\Admin;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MyPageController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('login', [Admin\LoginController::class, 'showLoginForm'])->middleware('guest:admin')->name('admin.login');
    Route::post('login', [Admin\LoginController::class, 'login']);

    Route::middleware('auth:admin')->group(function () {
        Route::get('logout', [Admin\LoginController::class, 'logout'])->name('admin.logout');

        Route::get('', [Admin\HomeController::class, 'index'])->name('admin.home');

        Route::get('major_categories', [Admin\MajorCategoryController::class, 'index'])->name('admin.major_categories.index');
        Route::get('major_categories/create', [Admin\MajorCategoryController::class, 'create'])->name('admin.major_categories.create');
        Route::post('major_categories', [Admin\MajorCategoryController::class, 'store'])->name('admin.major_categories.store');
        Route::get('major_categories/{majorCategory}', [Admin\MajorCategoryController::class, 'show'])->name('admin.major_categories.show');
        Route::get('major_categories/{majorCategory}/edit', [Admin\MajorCategoryController::class, 'edit'])->name('admin.major_categories.edit');
        Route::put('major_categories/{majorCategory}', [Admin\MajorCategoryController::class, 'update'])->name('admin.major_categories.update');
        Route::delete('major_categories/{majorCategory}', [Admin\MajorCategoryController::class, 'destroy'])->name('admin.major_categories.destroy');

        Route::get('categories', [Admin\CategoryController::class, 'index'])->name('admin.categories.index');
        Route::get('categories/create', [Admin\CategoryController::class, 'create'])->name('admin.categories.create');
        Route::post('categories', [Admin\CategoryController::class, 'store'])->name('admin.categories.store');
        Route::get('categories/{category}', [Admin\CategoryController::class, 'show'])->name('admin.categories.show');
        Route::get('categories/{category}/edit', [Admin\CategoryController::class, 'edit'])->name('admin.categories.edit');
        Route::put('categories/{category}', [Admin\CategoryController::class, 'update'])->name('admin.categories.update');
        Route::delete('categories/{category}', [Admin\CategoryController::class, 'destroy'])->name('admin.categories.destroy');

        Route::get('products', [Admin\ProductController::class, 'index'])->name('admin.products.index');
        Route::get('products/create', [Admin\ProductController::class, 'create'])->name('admin.products.create');
        Route::post('products', [Admin\ProductController::class, 'store'])->name('admin.products.store');
        Route::get('products/{product}', [Admin\ProductController::class, 'show'])->name('admin.products.show');
        Route::get('products/{product}/edit', [Admin\ProductController::class, 'edit'])->name('admin.products.edit');
        Route::put('products/{product}', [Admin\ProductController::class, 'update'])->name('admin.products.update');
        Route::delete('products/{product}', [Admin\ProductController::class, 'destroy'])->name('admin.products.destroy');

        Route::get('users', [Admin\UserController::class, 'index'])->name('admin.users.index');
        Route::delete('users/{user}', [Admin\UserController::class, 'changeStatus'])->name('admin.users.change_status');

        Route::get('orders', [Admin\OrderController::class, 'index'])->name('admin.orders.index');

        Route::get('sales', [Admin\SaleController::class, 'index'])->name('admin.sales.index');
    });
});

Route::get('', [HomeController::class, 'index'])->name('home');
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->middleware('guest')->name('register');
Route::post('register', [RegisterController::class, 'register']);
Route::get('login', [LoginController::class, 'showLoginForm'])->middleware('guest')->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('categories/{category}/products', [ProductController::class, 'index'])->name('products.index');
Route::get('products/{product}', [ProductController::class, 'show'])->name('products.show');
Route::get('carts', [CartController::class, 'index'])->name('carts.index');
Route::post('carts', [CartController::class, 'add'])->name('carts.add');
Route::put('carts/{cart}', [CartController::class, 'update'])->name('carts.update');
Route::delete('carts', [CartController::class, 'destroy'])->name('carts.destroy');
Route::post('favorites', [FavoriteController::class, 'addDestroy'])->name('favorites.add_destroy');
Route::get('favorites', [FavoriteController::class, 'index'])->name('favorites.index');
Route::delete('favorites', [FavoriteController::class, 'destroy'])->name('favorites.destroy');
Route::post('products/{product}/reviews', [ProductController::class, 'review'])->name('products.review');
Route::get('mypage', [MyPageController::class, 'index'])->name('mypage.index');
Route::get('mypage/profile/edit', [MyPageController::class, 'profileEdit'])->name('mypage.profile.edit');
Route::put('mypage/profile', [MyPageController::class, 'profileUpdate'])->name('mypage.profile.update');
Route::delete('mypage/users', [MyPageController::class, 'userDestroy'])->name('mypage.users.destroy');
Route::get('mypage/address/edit', [MyPageController::class, 'addressEdit'])->name('mypage.address.edit');
Route::put('mypage/address', [MyPageController::class, 'addressUpdate'])->name('mypage.address.update');
Route::get('mypage/password/edit', [MyPageController::class, 'passwordEdit'])->name('mypage.password.edit');
Route::put('mypage/password', [MyPageController::class, 'passwordUpdate'])->name('mypage.password.update');
Route::get('mypage/credit_card/create', [MyPageController::class, 'createCreditCard'])->name('mypage.credit_card.create');
Route::post('mypage/credit_card', [MyPageController::class, 'storeCreditCard'])->name('mypage.credit_card.store');
Route::get('mypage/orders', [MyPageController::class, 'orders'])->name('mypage.orders.index');
Route::get('mypage/orders/{order}', [MyPageController::class, 'purchaseHistory'])->name('mypage.orders.show');
Route::post('payment', [PaymentController::class, 'payment'])->name('payment');
