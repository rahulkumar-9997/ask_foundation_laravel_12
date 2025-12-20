<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontHomeController;
use App\Http\Controllers\Frontend\DonationController;
use App\Http\Controllers\Frontend\SiteMapController;

use App\Http\Controllers\Backend\LoginController;
use App\Http\Controllers\Backend\ForgotPasswordController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\MenuController;
use App\Http\Controllers\Backend\CacheController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogController;
use App\Http\Controllers\Backend\DoctorsController;
use App\Http\Controllers\Backend\ActivitiesController;

Route::get('/', [FrontHomeController::class, 'home'])->name('home');
Route::get('blog', [FrontHomeController::class, 'blogList'])->name('blog');
Route::get('blog/{slug}', [FrontHomeController::class, 'blogDetails'])->name('blog.details');
Route::get('our-doctors', [FrontHomeController::class, 'ourDoctorsList'])->name('our-doctors');
Route::get('our-doctors/{slug}', [FrontHomeController::class, 'ourDoctorsDetails'])->name('doctor.details');
Route::get('donate-us', [DonationController::class, 'donateUs'])->name('donate-us');
Route::post('donate-us', [DonationController::class, 'donateStore'])->name('donate-confirmation.store');
Route::get('donate-confirmation/{token}', [DonationController::class, 'confirmation'])->name('donate.confirmation');

Route::post('/payment/callback', [DonationController::class, 'paymentCallback'])
    ->name('payment.callback');

// success/failure pages
Route::get('/donate/success', [DonationController::class, 'success'])->name('donate.success');
Route::get('/donate/failed', [DonationController::class, 'failed'])->name('donate.failed');

Route::get('contact-us', [FrontHomeController::class, 'contactUs'])->name('contact-us');
Route::post('contact-us-submit', [FrontHomeController::class, 'contactSubmitForm'])->name('contact-us.submit');
Route::get('about-us', [FrontHomeController::class, 'aboutUs'])->name('about-us');
Route::get('focus-areas/bone-health-orthopedics', [FrontHomeController::class, 'boneHealth'])->name('focus.bone');
Route::get('focus-areas/road-safety-programs', [FrontHomeController::class, 'roadSafety'])->name('focus.road');
Route::get('focus-areas/preventive-medicine', [FrontHomeController::class, 'preventiveMedicine'])->name('focus.preventive');
Route::get('focus-areas/medical-education', [FrontHomeController::class, 'medicalEducation'])->name('focus.education');
Route::get('our-activities', [FrontHomeController::class, 'ourActivities'])->name('our-activities');
Route::get('our-activities/{slug}', [FrontHomeController::class, 'ourActivitiesDetails'])->name('activities.details');
Route::get('/sitemap.xml', [SiteMapController::class, 'index'])->name('sitemap.xml');
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm']);
    Route::post('/login', [LoginController::class, 'login'])->name('login');
    Route::get('forget/password', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password');
    Route::post('forget.password', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.submit');

    Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
    Route::post('reset-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');
    Route::get('/logout', [LoginController::class, 'logout'])->name('logout');
});

Route::group(['middleware' => ['auth']], function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/get-daily-visitors', [DashboardController::class, 'getDailyVisitors'])->name('get-daily-visitors');

    Route::resource('manage-banner', BannerController::class)->names('manage-banner');
    Route::resource('manage-blog', BlogController::class)->names('manage-blog');
    Route::resource('manage-doctors', DoctorsController::class)->names('manage-doctors');
    Route::resource('manage-activities', ActivitiesController::class)->names('manage-activities');

    Route::get('manage-activities/add-more-images/{id}', [ActivitiesController::class, 'addMoreImages'])
        ->name('manage-activities.addMoreImages');

    Route::post('manage-activities/add-more-images/submit', [ActivitiesController::class, 'addMoreImagesSubmit'])
        ->name('manage-activities.addMoreImages.submit');

    Route::delete('activities-image/{id}', [ActivitiesController::class, 'destroyImage'])
        ->name('activities-image.destroy');

    Route::get('manage-activities/add-more-videos/{id}', [ActivitiesController::class, 'addMoreVideos'])
        ->name('manage-activities.addMoreVideos');
    Route::post('manage-activities/add-more-videos/submit', [ActivitiesController::class, 'addMoreVideosSubmit'])
        ->name('manage-activities.addMoreVideos.submit');

    Route::delete('activities-videos/{id}', [ActivitiesController::class, 'destroyVideo'])
        ->name('activities-vidos.destroy');

    Route::get('/clear-cache', [CacheController::class, 'clearCache'])->name('clear-cache');
    Route::resource('pages', PageController::class);
    Route::resource('menus', MenuController::class);
    Route::get('menu/items/{menu}', [MenuController::class, 'displayMenuItem'])->name('menus.items');
    Route::post('menu/{menu}/item', [MenuController::class, 'storeItem'])->name('menu.item.store');

    Route::get('menu/{menu}/item/{item}/edit', [MenuController::class, 'editItem'])
        ->name('menu.item.edit');
    Route::put('menu/{menu}/item/{item}', [MenuController::class, 'updateItem'])->name('menu.item.update');
    Route::delete('menu/{menu}/item/{item}', [MenuController::class, 'destroyItem'])->name('menu.item.destroy');
    Route::post('menus/{menu}/items/order', [MenuController::class, 'orderItems'])->name('menus.items.order');
});
