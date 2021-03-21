<?php
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\SslCommerzPaymentController;

Route::get("/", [FrontendController::class, 'index']);
Route::get("about", [FrontendController::class, 'about']);
Route::get("contact", [FrontendController::class, 'contact']);
Route::get("portfolio", [FrontendController::class, 'portfolio']);
Route::get("product/details/{product_id}", [FrontendController::class, 'product_details']);
Route::get("shop", [FrontendController::class, 'shop']);
Route::get("shop/category/{category_id}", [FrontendController::class, 'shop_category']);
Route::get("search", [FrontendController::class, 'search']);

Auth::routes();

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/home');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware('verified');
Route::post('/user/insert', [HomeController::class, 'userinsert'])->name('userinsert');
Route::get('/download/invoice/{invoice_id}', [HomeController::class, 'downloadinvoice'])->name('downloadinvoice')->name('downloadinvoice');
Route::get('/send/invoice/{invoice_id}', [HomeController::class, 'sendinvoice'])->name('sendinvoice');
Route::post('/send/email', [HomeController::class, 'sendemail'])->name('sendemail');

Route::get('/category', [CategoryController::class, 'index']);
Route::post('/category/insert', [CategoryController::class, 'insert']);
Route::get('/category/delete/{category_id}', [CategoryController::class, 'delete']);

Route::get('/subcategory', [SubCategoryController::class, 'index']);
Route::post('/subcategory/insert', [SubCategoryController::class, 'insert']);
Route::get('/subcategory/delete/{subcategory_id}', [SubCategoryController::class, 'delete']);
Route::get('/subcategory/edit/{subcategory_id}', [SubCategoryController::class, 'edit']);
Route::post('/subcategory/update/{subcategory_id}', [SubCategoryController::class, 'update']);
Route::get('/subcategory/restore/{subcategory_id}', [SubCategoryController::class, 'restore']);
Route::get('/subcategory/permanent/delete/{subcategory_id}', [SubCategoryController::class, 'permanentdelete']);
Route::post('/subcategory/mark/delete', [SubCategoryController::class, 'markdelete']);
Route::get('/subcategory/all/delete', [SubCategoryController::class, 'alldelete']);

Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profile/name/change', [ProfileController::class, 'namechange']);
Route::post('/profile/password/change', [ProfileController::class, 'passwordchange']);
Route::post('/profile/photo/change', [ProfileController::class, 'photochange']);

Route::get('/product', [ProductController::class, 'index']);
Route::post('/product/insert', [ProductController::class, 'insert']);

Route::post('/add/to/cart', [CartController::class, 'addtocart']);
Route::get('/cart/delete/{cart_id}', [CartController::class, 'cartdelete']);

Route::get('/cart', [CartController::class, 'cart']); //cart page without coupon
Route::get('/cart/{coupon_name}', [CartController::class, 'cart']); //cart page with coupon

Route::post('/update/cart', [CartController::class, 'updatecart']);

Route::get('/checkout', [CartController::class, 'checkout']);
Route::post('/getCityList', [CartController::class, 'getCityList']);
Route::post('/checkout/post', [CartController::class, 'checkoutpost']);

Route::get('/coupon', [CouponController::class, 'index'])->name('roadofcoupon');
Route::post('/coupon/insert', [CouponController::class, 'insert'])->name('roadofcouponinsert');

// SSLCOMMERZ Start
Route::get('/example1', [SslCommerzPaymentController::class, 'exampleEasyCheckout']);
Route::get('/online/payment', [SslCommerzPaymentController::class, 'exampleHostedCheckout']);

Route::post('/pay', [SslCommerzPaymentController::class, 'index']);
Route::post('/pay-via-ajax', [SslCommerzPaymentController::class, 'payViaAjax']);

Route::post('/success', [SslCommerzPaymentController::class, 'success']);
Route::post('/fail', [SslCommerzPaymentController::class, 'fail']);
Route::post('/cancel', [SslCommerzPaymentController::class, 'cancel']);

Route::post('/ipn', [SslCommerzPaymentController::class, 'ipn']);
//SSLCOMMERZ END
