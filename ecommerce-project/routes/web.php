<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\HomeComponent;
use App\Http\Livewire\ShopComponent;
use App\Http\Livewire\CartComponent;
use App\Http\Livewire\CheckoutComponent;
use App\Http\Livewire\UserDashboardComponent;
use App\Http\Livewire\AdminDashboardComponent;
use App\Http\Livewire\Admin\AdminCategoryComponent;
use App\Http\Livewire\DetailsComponent;
use App\Http\Livewire\CategoryComponent;
use App\Http\Livewire\SearchComponent;
use App\Http\Livewire\Admin\AdminAddCategoryComponent;
use App\Http\Livewire\Admin\AdminEditCategoryComponent;
use App\Http\Livewire\Admin\AdminProductComponent;
use App\Http\Livewire\Admin\AdminAddProductComponent;
use App\Http\Livewire\Admin\AdminEditProductComponent;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', HomeComponent::class);

Route::get('/shop', ShopComponent::class);

Route::get('/cart', CartComponent::class)->name('product.cart');
// Route::post('/cart', CartComponent::class)->name('product.cart');

Route::get('/checkout', CheckoutComponent::class);

Route::get('/product/{id}', DetailsComponent::class)->name('product.detail');

Route::get('/product_category/{category_slug}', CategoryComponent::class);

Route::get('/search', SearchComponent::class)->name('product.search');


// Route::middleware([
//     'auth:sanctum',
//     config('jetstream.auth_session'),
//     'verified'
// ])->group(function () {
//     Route::get('/dashboard', function () {
//         return view('dashboard');
//     })->name('dashboard');
// });

// for User or Customer
Route::middleware([
    'auth:sanctum',
    'verified'
])->group(function () {
    Route::get('user/dashboard', UserDashboardComponent::class)->name('user.dashboard');
});


// for Admin
Route::middleware(['auth:sanctum','verified','authadmin'])->group(function(){
    Route::get('admin/dashboard', AdminDashboardComponent::class)->name('admin.dashboard');
    Route::get('admin/categories', AdminCategoryComponent::class)->name('admin.categories');
    Route::get('admin/category/add', AdminAddCategoryComponent::class)->name('admin.addcategory');
    Route::get('admin/category/edit/{category_slug}', AdminEditCategoryComponent::class)->name('admin.editcategory');
    Route::get('admin/product', AdminProductComponent::class)->name('admin.product');
    Route::get('admin/product/add', AdminAddProductComponent::class)->name('admin.addproduct');
    Route::get('admin/product/edit/{product_slug}', AdminEditProductComponent::class)->name('admin.editproduct');
});
