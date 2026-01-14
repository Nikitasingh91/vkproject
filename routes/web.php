<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\DestinationController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\OurServicesModelController;
use App\Http\Controllers\TestimonialsController;
//use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
//     return Inertia::render('Welcome', [
//         'canLogin' => Route::has('login'),
//         'canRegister' => Route::has('register'),
//         'laravelVersion' => Application::VERSION,
//         'phpVersion' => PHP_VERSION,
//     ]);
// });

Route::get("/", [HomePageController::class, "homePage"]);
// Route::get("comingsoon",[HomePageController::class,function(){
//     return view("HomePage.ComingSoon");
// }]);
Route::get("comingsoon", [HomePageController::class, "ComingSoon"])->name("ComingSoon");
Route::get("about-us", [HomePageController::class, "aboutUs"])->name("aboutUs");
Route::get("terms-conditions", [HomePageController::class, "termsConditions"])->name("termsConditions");
Route::get("shipping-delivery-policy", [HomePageController::class, "shippingDeliverypolicy"])->name("shippingDeliverypolicy");
Route::get("cancellation-refund-policy", [HomePageController::class, "CancellationRefundPolicy"])->name("CancellationRefundPolicy");
Route::get("privacy-policy", [HomePageController::class, "privacyPolicy"])->name("privacyPolicy");
// Route::get("services",[HomePageController::class,"destinations"])->name("destinations");
Route::get("services", [HomePageController::class, "productPage"])->name("productPage");
Route::get('/service/{slug}', [HomePageController::class, 'productPage'])->name('service.details');


// Route::get("report",[HomePageController::class,"reportPage"])->name("reportPage");
Route::get("event", [HomePageController::class, "galleryPages"])->name("galleryPages");
Route::get("contact-us", [HomePageController::class, "contactUs"])->name("contactUs");
Route::get("blog", [HomePageController::class, "blogPage"])->name("blogPage");
// Route::get("get-home-page-dd",[DestinationController::class,"getHomePageDestinations"])->name("getHomePageDestinations");
// Route::get("get-home-page-services",[OurServicesModelController::class,"getHomePageServices"])->name("getHomePageServices");
Route::post("contact-us-form", [ContactUsController::class, "saveContactUsDetails"])->name("saveContactUsDetails");
Route::get('refresh-captcha', [HomePageController::class, "refreshCapthca"])->name("refreshCaptcha");

Route::get('/sitemap', function () {
    return view('sitemap'); // This will load resources/views/sitemap.blade.php
})->name('sitemap');
// Route::get("get-testimonials-home-page", [TestimonialsController::class, "getHomePageTestimonials"])->name("getHomePageTestimonials");
Route::get('/test-session', function () {
    session(['test_value' => 'hello123']);
    return session('test_value');
});

// require __DIR__.'/auth.php';

include_once "adminRoutes.php";
