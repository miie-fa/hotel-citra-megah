<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DownloadInvoiceController;
use App\Http\Controllers\FaqsController;
use App\Http\Controllers\Front\BlogController;
use App\Http\Controllers\Front\CartController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\User\OrderController;
use App\Http\Controllers\Front\ContactController;
use App\Http\Controllers\Front\AboutController;
use App\Http\Controllers\Front\BookingController;
use App\Http\Controllers\Front\RoomsController;
use App\Http\Controllers\Front\TermsConditionsController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaypalController;
use App\Http\Controllers\PrivacyPoliceController;
use App\Http\Controllers\User\CommentController;
use App\Http\Controllers\User\UserDashboardController;
use App\Http\Controllers\User\UserReviewController;
use App\Livewire\HomeSettings;


// Front
Route::get('log-viewers', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index']);

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/booking/submit', [BookingController::class, 'cart_submit'])->name('cart_submit');
Route::get('/booking', [BookingController::class, 'index'])->name('booking-form');
Route::get('/cart', [BookingController::class, 'cart_view'])->name('cart');
Route::get('/cart/delete/{id}', [BookingController::class, 'cart_delete'])->name('cart_delete');
Route::get('/checkout', [BookingController::class, 'checkout'])->name('checkout');

Route::post('/payment', [BookingController::class, 'payment'])->name('payment');
Route::post('/payment/ipaymu/{price}', [BookingController::class, 'ipaymu'])->name('ipaymu');
Route::post('/payment/pay_at_hotel/{price}', [BookingController::class, 'pay_at_hotel'])->name('pay_at_hotel');
Route::post('/notify', [BookingController::class, 'notify'])->name('notify');

Route::controller(BookingController::class)
    ->prefix('paypal')
    ->group(function () {
        Route::view('payment', 'paypal.index')->name('create.payment');
        Route::get('handle-payment', 'handlePayment')->name('make.payment');
        Route::get('cancel-payment', 'paymentCancel')->name('cancel.payment');
        Route::get('payment-success', 'paymentSuccess')->name('success.payment');
    });

    Route::prefix('/callback')->name('callback.')->group(function () {
    Route::get('/return', function ()  {return view('pages.callback.return');})->name('return');
    Route::get('/cancel', function ()  {return view('pages.callback.cancel');})->name('cancel');
});

Route::get('/about', [AboutController::class, 'index'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/send-message', [ContactController::class, 'sendEmail'])->name('send.contact');

Route::get('/faqs', [FaqsController::class, 'index'])->name('faqs');
Route::get('/privacy-police', [PrivacyPoliceController::class, 'index'])->name('privacy_police');
Route::get('/terms-and-conditions', [TermsConditionsController::class, 'index'])->name('terms_conditions');
Route::get('/room', [RoomsController::class, 'index'])->name('rooms');
Route::get('/room/search', [RoomsController::class, 'search'])->name('search_room');
Route::get('/room/{id}', [RoomsController::class, 'detail_room'])->name('detail_room');
Route::get('/rooms/{id}', 'RoomController@show');
Route::post('/rooms-proses', [RoomsController::class, 'prosesPemesanan'])->name('proses_pemesanan');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/post/{slug}', [BlogController::class, 'detailBlog'])->name('post');

// Customer
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/register-process', [AuthController::class, 'registerProcess'])->name('register.process');
Route::post('/login-process', [AuthController::class, 'loginProcess'])->name('login.process');

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//guest token validated number
Route::get('activication', [AuthController::class,'activication'])->name('activication');

Route::post('activication/process', [AuthController::class,'activication_process'])->name('activication.process');

Route::get('forgot-password', [ForgotPasswordController::class, 'showForgotPasswordForm'])->name('forgot.password');
Route::post('forgot-password', [ForgotPasswordController::class, 'submitForgotPasswordForm'])->name('forgot.password.post');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password');
Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

/** User Login **/
Route::prefix('user')->group(function() {
    Route::get('/verification', [AuthController::class, 'verifyEmail'])->name('verification');
    Route::post('/verification/resend-email-verification', [AuthController::class, 'resendEmailVerification'])->name('resend-email-verification');

    Route::get('/verification/success/{token}', [AuthController::class, 'verifyEmailProcess'])->name('verification.process');

    Route::get('/send-email-verification', [AuthController::class, 'sendEmailVerification'])->name('send-email-verification');

    Route::middleware(['auth', 'role:user'])->group(function(){
        Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
        Route::resource('/users', UserDashboardController::class);
        Route::get('/order', [OrderController::class, 'index'])->name('order');
        Route::get('/order/detail/{id}', [OrderController::class, 'detail_order'])->name('order-details');
        Route::get('/user/edit', [UserDashboardController::class, 'edit'])->name('user.edit');
        Route::get('/invoices', [InvoiceController::class, 'index'])->name('invoice');
        // Di web.php
        Route::get('/review', [UserReviewController::class, 'index'])->name('review');
        Route::post('/submit-review', 'UserReviewController@submitReview');
        Route::delete('/user/{id}', [UserDashboardController::class, 'delete'])->name('user.delete');
        Route::get('/user/order/cancel/{id}', [OrderController::class, 'cancel_order'])->name('order.cancel');

    Route::post('/user/update/{id}', [UserDashboardController::class, 'update'])->name('user.update');
    Route::post('/submit-review/{order}', [CommentController::class, 'submitReview'])->name('submit-review');

    });
});


// Route::get('/{record}/invoice', [DownloadInvoiceController::class, 'download'])->name('order.invoice.download');
Route::get('print-pdf/stream/{record}', [DownloadInvoiceController::class, 'getPDF'])->name('order.invoice.download');
Route::get('print-pdf/stream/{record}', [DownloadInvoiceController::class, 'getPDF'])->name('order.invoice.download');

/** User Dashboard **/

/** Admin Login **/
Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function() {
    Route::get('/dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard');
});
// Route::prefix('admin')->middleware(['auth', 'role:admin'])->group(function() {
//     Route::get('/dashboard',[AdminDashboardController::class, 'index'])->name('admin.dashboard');

//     // Hotel
//     Route::resource('/hotel', AdminHotelController::class);
//     // Room
//     Route::resource('/amenity', AdminAmenityController::class);
//     Route::resource('/room', AdminRoomController::class);
//     Route::get('room/gallery/{id}', [AdminRoomController::class, 'gallery'])->name('room.gallery');
//     Route::post('room/gallery/store/{id}', [AdminRoomController::class, 'gallery_store'])->name('room.gallery.store');
//     Route::delete('room/gallery/delete/{id}', [AdminRoomController::class, 'gallery_delete'])->name('room.gallery.delete');
//     // Blog
//     Route::resource('/post', AdminPostController::class);
//     Route::resource('/order', AdminOrderController::class);
//     // Order
//     Route::get('/order', [AdminOrderController::class, 'index'])->name('order.index');
//     Route::get('/order/detail/{id}', [AdminOrderController::class, 'show'])->name('order.detail');

//     // Page
//     Route::get('/page/about', [AdminPageController::class, 'about'])->name('about.index');
// });

/** Admin Dashboard **/
