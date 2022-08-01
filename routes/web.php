<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\PagesController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminPagesController;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Wishlist\WishlistController;
use App\Http\Controllers\Cart\CartController;
use App\Http\Controllers\DeliveryPerson\DeliverPersonController;
use App\Http\Controllers\Order\OrdersController;
use App\Http\Controllers\Supplier\SupplierController;
use App\Http\Controllers\Supplier\ManageSupplies;
use App\Http\Controllers\Reviews\ReviewController;
use App\Http\Controllers\Deliver\DeliverController;
use App\Http\Controllers\Invoice\InvoiceController;
use App\Http\Controllers\Report\ReportController;
USE App\Http\Controllers\GRN\GenerateGoodRecievedNote;
use App\Http\Controllers\Mail\MailController;

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

Route::get('/', [App\Http\Controllers\User\PagesController::class, 'homePage'])->name('Home');
Route::get('/about', [App\Http\Controllers\User\PagesController::class, 'aboutPage'])->name('About-us');
Route::get('/contact', [App\Http\Controllers\User\PagesController::class, 'contactPage'])->name('Contact-us');
Route::get('/categories', [App\Http\Controllers\User\PagesController::class, 'categories'])->name('Categories');
Route::get('/vegetables', [App\Http\Controllers\User\PagesController::class, 'vegetables'])->name('Categories-vegetables');
Route::get('/fruits', [App\Http\Controllers\User\PagesController::class, 'fruitPage'])->name('Categories-Fruits');
Route::get('/dryrations', [App\Http\Controllers\User\PagesController::class, 'dryPage'])->name('Categories-DryRations');
Route::get('/chilled', [App\Http\Controllers\User\PagesController::class, 'chillPage'])->name('Categories-Chilled');
Route::get('/beverage', [App\Http\Controllers\User\PagesController::class, 'beveragePage'])->name('Categories-Beverages');
Route::get('/backery', [App\Http\Controllers\User\PagesController::class, 'backeryPage'])->name('Categories-Backery');
Route::get('/meat&seafood', [App\Http\Controllers\User\PagesController::class, 'meatPage'])->name('Categories-Meat&SeaFood');
Route::get('/grocery', [App\Http\Controllers\User\PagesController::class, 'groceryPage'])->name('Categories-Grocery');
Route::get('/others', [App\Http\Controllers\User\PagesController::class, 'othersPage'])->name('Categories-Others');
Route::get('/product/show/{id}', [App\Http\Controllers\Admin\ProductsController::class, 'show'])->name('ShowProduct');


Route::prefix('user')->name('user.')->group(function(){

    Route::middleware(['guest','PreventBackHistory'])->group(function () {
        Route::view('/login', 'User.login')->name('Login');
        Route::view('/register', 'User.register')->name('Signup');
        Route::view('/', 'User.home')->name('Home');
        Route::post('/create', [UserController::class, 'create'])->name('create');
        Route::post('/check', [UserController::class, 'check'])->name('check');
    });
    Route::middleware(['auth','PreventBackHistory'])->group(function () {
        Route::view('/', 'User.home')->name('Home');
        Route::post('/logout',[UserController::class, 'logout'])->name('logout');
        Route::view('/user/editprofile', 'User.editprofile')->name('EditProfile');
        Route::post('/user/editprofile/{id}',[UserController::class, 'updateProfile'])->name('UpdateProfile');

        Route::view('/user/my-wishlist', 'User.mywishlist')->name('My-Wishlist');
        Route::view('/user/my-orders', 'User.myorder')->name('My-Orders');
        Route::post('/add-wishlist/{product_id}/{user_id}',[WishlistController::class,'addToWishlist'])->name('addToWishlist');
        Route::delete('/wishlist/{product_id}/{user_id}',[WishlistController::class,'removeFromWishlist'])->name('removeFromWishlist');

        Route::view('/user/my-cart', 'User.cart')->name('My-Cart');
        Route::post('/add-cart', [CartController::class, 'addToCart'])->name('addToCart');
        Route::post('/cart-update', [CartController::class, 'updateCart'])->name('updateCart');
        Route::delete('/cart/{id}',[CartController::class, 'removeFromCart'])->name('removeFromCart');
        Route::get('/checkout', [OrdersController::class,'checkoutPage'])->name('Checkout');
        Route::post('/orders', [OrdersController::class, 'store'])->name('placeOrder');

        // Route::view('/addreview','User.addreview')->name('AddReviews');
        // Route::get('/addreview',[ReviewController::class, 'index'])->name('Review');
        Route::post('/reviews', [ReviewController::class, 'store'])->name('storeReview');
        Route::get('/reviews/create/{id}',[ReviewController::class, 'create'])->name('createReview');
        Route::delete('/reviews/{id}',[ReviewController::class, 'destroy'])->name('destroyreviews');

    });

});
    Route::get('/orders/{id}',[OrderController::class,'viewOrder'])->name('viewOrders');

Route::prefix('admin')->name('admin.')->group(function(){

    Route::middleware(['guest:admin','PreventBackHistory'])->group(function () {
        Route::view('/login', 'Admin.login')->name('Login');
        Route::post('/check', [AdminController::class, 'check'])->name('check');
    });
    Route::middleware(['auth:admin','PreventBackHistory'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('Dashboard');
        Route::post('/logout',[AdminController::class, 'logout'])->name('logout');
        //Items
        Route::get('/products',[ProductsController::class, 'index'])->name('Products');
        Route::post('/products',[ProductsController::class, 'store'])->name('storeproduct');
        Route::get('/products/create',[ProductsController::class, 'create'])->name('createproduct');
        Route::get('/products/{id}/edit', [ProductsController::class, 'edit'])->name('editproduct');
        Route::post('/products/{id}',[ProductsController::class, 'update'])->name('updateproduct');
        Route::delete('/products/{id}',[ProductsController::class, 'destroy'])->name('destroyproduct');

        //deliverPerson
        Route::get('/deliverperson', [DeliverPersonController::class, 'index'])->name('DeliverPerson');
        Route::view('/dpregister', 'DeliverPerson.Register')->name('DP-Register');
        Route::post('/deliverperson',[DeliverPersonController::class, 'store'])->name('storeperson');
        Route::get('/deliverperson/create', [DeliverPersonController::class, 'create'])->name('createperson');
        Route::delete('/deliverperson/{id}',[DeliverPersonController::class, 'destroy'])->name('deleteperson');

        //suppliers
        Route::get('/supplier', [SupplierController::class, 'index'])->name('Suppliers');
        Route::get('/supplier/create', [SupplierController::class, 'create'])->name('RegisterSupplier');
        Route::post('/supplier', [SupplierController::class, 'store'])->name('sotresupplier');
        //supplier purchase order
        Route::get('/supplyorder',[ManageSupplies::class, 'index'])->name('PurchasingRequest');
        Route::get('/supplyorder/create', [ManageSupplies::class, 'create'])->name('RequestOrder');
        Route::post('/supplyorder/create',[ManageSupplies::class, 'store'])->name('storepurchase');
        Route::get('/supplyorder/{id}',[ManageSupplies::class, 'show'])->name('showPurchaseOrder');
        Route::post('/supplyorder-update',[ManageSupplies::class, 'update'])->name('updatePurchaseOrder');
        //GRN
        Route::get('supplyorder/GRN/{id}',[GenerateGoodRecievedNote::class, 'GenerateGRN'])->name('GoodRecievedNote');

        //orders
        Route::get('/orders', [OrdersController::class, 'index'])->name('Orders');
        Route::get('/orders/{id}',[OrdersController::class, 'show'])->name('ordershow');
        Route::delete('/orders/{id}',[OrdersController::class, 'destroy'])->name('destroyorder');

        // invoice
        Route::get('/orders/invoice/{id}',[InvoiceController::class, 'CustomerinvoiceGenarate'])->name('invoicegenarate');

        //delivers
        Route::get('/delivers',[DeliverController::class, 'index'])->name('delivers');
        Route::post('/delivers/{id}',[DeliverController::class, 'update'])->name('updatedelivers');
        Route::get('/delivers/{id}',[DeliverController::class, 'show'])->name('delivershow');

        // reports
        Route::view('/reports','Admin.reportPage')->name('reports');
        Route::post('/reports/view',[ReportController::class, 'genarateReport'])->name('genarateReport');
        Route::get('/reports/print/{report}/{fromDate}/{toDate}',[ReportController::class, 'printReport'])->name('printReport');

        Route::view('/home', 'DeliverPerson.home')->name('DP-Home');

    });

});
Route::get('/products/{id}',[ProductsController::class, 'show'])->name('productshow');

Route::prefix('delivery-person')->name('delivery-person.')->group(function(){

    Route::middleware(['guest:delivery-person'])->group(function () {
        Route::view('/login', 'DeliverPerson.Login')->name('DP-Login');
        Route::post('/check', [DeliverPersonController::class, 'check'])->name('check');
    });

    Route::middleware(['auth:delivery-person'])->group(function () {
        Route::view('/home', 'DeliverPerson.home')->name('DP-Home');
        Route::get('/deliverinfo',[DeliverPersonController::class, 'show'])->name('DeliverDetails');
    });
});

Auth::routes();
