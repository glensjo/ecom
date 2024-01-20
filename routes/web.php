<?php

use App\Http\Controllers\ProfileController;
use App\Livewire\Admin\AdminAddCategoryComponent;
use App\Livewire\Admin\AdminAddProductComponent;
use App\Livewire\Admin\AdminCategoriesComponent;
use App\Livewire\Admin\AdminDashboardComponent;
use App\Livewire\Admin\AdminEditCategoryComponent;
use App\Livewire\Admin\AdminEditProductComponent;
use App\Livewire\Admin\AdminOrderComponent;
use App\Livewire\Admin\AdminProductComponent;
use App\Livewire\Admin\AdminReportComponent;
use App\Livewire\CartComponent;
use App\Livewire\CategoryComponent;
use App\Livewire\CheckoutComponent;
use App\Livewire\ContactComponent;
use App\Livewire\DetailsComponent;
use App\Livewire\HomeComponent;
use App\Livewire\SearchComponent;
use App\Livewire\ShopComponent;
use App\Livewire\User\UserDashboardComponent;
use App\Livewire\User\UserReportComponent;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get("/", HomeComponent::class)->name("home.index");

Route::get("/shop", ShopComponent::class)->name("shop");

Route::get("/product/{slug}", DetailsComponent::class)->name("product.details");

Route::get("/cart", CartComponent::class)->name("shop.cart");

Route::get("/checkout", CheckoutComponent::class)->name("shop.checkout");

Route::get('/product-category/{slug}', CategoryComponent::class)->name('product.category');

Route::get("/search", SearchComponent::class)->name("product.search");

Route::get("/contact", ContactComponent::class)->name("contact");

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
    Route::get('/user/report', UserReportComponent::class)->name('user.report');
});

Route::middleware(['auth','authadmin'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('/admin/categories', AdminCategoriesComponent::class)->name('admin.categories');
    Route::get('/admin/category/add', AdminAddCategoryComponent::class)->name('admin.category.add');
    Route::get('/admin/category/edit/{category_id}', AdminEditCategoryComponent::class)->name('admin.category.edit');
    Route::get('/admin/products', AdminProductComponent::class)->name('admin.products');
    Route::get('/admin/product/add', AdminAddProductComponent::class)->name('admin.product.add');
    Route::get('/admin/product/edit/{product_id}', AdminEditProductComponent::class)->name('admin.product.edit');
    Route::get('/admin/orders', AdminOrderComponent::class)->name('admin.orders');
    Route::get('/admin/reports', AdminReportComponent::class)->name('admin.report');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
