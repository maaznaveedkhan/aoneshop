<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FrontEndController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', [FrontendController::class, 'HomePage'])->name('/');

// cart controller
Route::get('cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('add-to-cart/{id}', [FrontendController::class, 'addToCart'])->name('add.to.cart');
Route::patch('update-cart', [FrontendController::class, 'update'])->name('update.cart');
Route::delete('remove-from-cart', [FrontendController::class, 'remove'])->name('remove.from.cart');
Route::get('/search/zip/codes', [FrontEndController::class, 'searchZipCodes'])->name('search.zip.code');
Route::get('/view/product/details/{id}', [FrontEndController::class, 'viewProductDetails'])->name('view.product.details');

Route::get('/all/categories', [FrontEndController::class, 'allCategories'])->name('view.all.categories');
Route::get('view/category/products/{id}', [FrontEndController::class, 'viewCategory'])->name('view.category.products');

Route::get('/enter/the/address',[FrontEndController::class, 'address'])->name('enter.address');
Route::get('/search/prouducts/',[FrontEndController::class, 'searchProductsResults'])->name('search.results.products');

Route::post('ckeditor/upload/project', [App\Http\Controllers\CKEditorController::class,'add_project'])->name('ckeditor-project-upload');
Route::get('/admin/login', [AdminController::class, 'adminLogin'])->name('admin.login');
Route::post('/admin/check/', [AdminController::class, 'adminLoginData'])->name('admin.login.data');
Route::get('/admin/register', [AdminController::class, 'adminRegister'])->name('admin.register');
Route::post('/admin/register/check', [AdminController::class, 'adminRegisterData'])->name('admin.register.data');

Route::group(['prefix'=>'admin', 'middleware'=>'admin'], function(){
    Route::get('dashboard/', [AdminController::class, 'adminDashboard'])->name('admin.dashboard');
    Route::get('logout/', [AdminController::class, 'adminLogout'])->name('admin.logout');
    Route::get('profifle/{id}', [AdminController::class, 'edit_profile'])->name('admin_profile');
    Route::get('dashboard',[App\Http\Controllers\AdminController::class,'admin_dashboard'])->name('admin_dashboard');

    Route::get('sliders',[App\Http\Controllers\AdminController::class,'admin_sliders'])->name('admin_slider');
    Route::post('add_slider',[App\Http\Controllers\AdminController::class,'add_slider'])->name('add_slider');

    Route::get('categories',[App\Http\Controllers\CategoryController::class,'index'])->name('admin_categories');
    Route::post('create_category',[App\Http\Controllers\CategoryController::class,'create_category'])->name('create_category');
    Route::get('view_category/{id}',[App\Http\Controllers\CategoryController::class,'view_category'])->name('view_category');
    Route::post('update_category/{id}',[App\Http\Controllers\CategoryController::class,'update_category'])->name('update_category');
    Route::get('delete_category/{id}',[App\Http\Controllers\CategoryController::class,'delete_category'])->name('delete_category');

    Route::get('products',[App\Http\Controllers\ProductController::class,'index'])->name('admin_products');
    Route::get('new_product',[App\Http\Controllers\ProductController::class,'create'])->name('new_product');
    Route::post('create_product',[App\Http\Controllers\ProductController::class,'store'])->name('create_product');
    Route::get('edit_product/{id}',[App\Http\Controllers\ProductController::class,'edit'])->name('edit_product');
    Route::post('update_product/{id}',[App\Http\Controllers\ProductController::class,'update'])->name('update_product');
    Route::get('delete_product/{id}',[App\Http\Controllers\ProductController::class,'destroy'])->name('delete_product');
    // Product Attributes
    Route::get('add_attribute', [App\Http\Controllers\AttributeController::class, 'attribute_form'])->name('admin_attribute_form');
    Route::get('set-data', [App\Http\Controllers\AttributeController::class, 'setData'])->name('session.create');
    Route::get('zipcodes',[App\Http\Controllers\AdminController::class,'zipcodes'])->name('admin_zipcodes');
    Route::post('add_zipcode',[App\Http\Controllers\AdminController::class,'add_zipcode'])->name('add_zipcode');

    Route::get('orders',[App\Http\Controllers\OrderController::class,'orders'])->name('admin_orders');
    Route::get('order_detail',[App\Http\Controllers\OrderController::class,'order_detail'])->name('admin_order_detail');

});

Route::group(['prefix'=>'user', 'middleware'=>'auth'], function(){
    Route::get('/checkout', [FrontEndController::class, 'checkout'])->name('checkout');
    // Route::get('/home', [App\Http\Controllers\UserController::class,'user_dashboard'])->name('home');
    Route::get('dashboard',[App\Http\Controllers\UserController::class,'user_dashboard'])->name('home');
    Route::get('/place/order', [OrderController::class, 'placeOrder'])->name('order.place');
});

// Route::prefix('admin')->group(function () {
//     Route::get('dashboard',[App\Http\Controllers\AdminController::class,'admin_dashboard'])->name('admin.dashboard');

//     Route::get('categories',[App\Http\Controllers\CategoryController::class,'index'])->name('admin_categories');
//     Route::post('create_category',[App\Http\Controllers\CategoryController::class,'create_category'])->name('create_category');
//     Route::get('delete_category/{id}',[App\Http\Controllers\CategoryController::class,'delete_category'])->name('delete_category');

//     Route::get('products',[App\Http\Controllers\ProductController::class,'products'])->name('admin_products');
//     Route::get('new_product',[App\Http\Controllers\ProductController::class,'new_product'])->name('new_product');
//     Route::post('create_product',[App\Http\Controllers\ProductController::class,'create_product'])->name('create_product');
//     Route::get('delete_product/{id}',[App\Http\Controllers\ProductController::class,'delete_product'])->name('delete_product');
//     Route::get('edit_product/{id}',[App\Http\Controllers\ProductController::class,'edit_product'])->name('edit_product');
//     Route::get('update_product/{id}',[App\Http\Controllers\ProductController::class,'update_product'])->name('update_product');
// });
// Route::prefix('user')->group(function () {
//     Route::get('dashboard',[App\Http\Controllers\UserController::class,'user_dashboard'])->name('user_dashboard');
// });

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
