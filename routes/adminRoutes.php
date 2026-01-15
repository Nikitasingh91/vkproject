<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\HomePageController;
use App\Http\Controllers\ServicesController;
use App\Http\Controllers\HomeProductsController;
use App\Http\Controllers\WebSiteElementsController;
use App\Http\Controllers\TestimonialController;
use App\Http\Controllers\ClientController;

use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\VerticalController;
Route::get("login",[AdminController::class,"Login"])->name("login");
Route::get("logout",[AdminCOntroller::class,"logout"])->name("logout");
Route::post("AdminUserLogin",[AdminController::class,"AdminLoginUser"])->name("AdminLogin");
Route::get("getmenu-items",[HomePageController::class,"getMenu"]);
//pages

Route::middleware(['auth'])->group(function () {

    Route::get("/new-dashboard",[AdminController::class,"dashboard"])->name("new-dashboard");

    // Route::get("site-navigation",[AdminController::class,"siteNav"])->name("siteNav");
    // Route::post("addEditNavigation",[AdminController::class,"addEditNavigation"])->name("addNaviagtion");
    // Route::post("deleteNavigation",[AdminController::class,"deleteNavigation"])->name("deleteNavigation");
    // Route::post("navDataTable",[AdminController::class,"navDataTable"])->name("navDataTable");

    Route::get("manage-gallery",[AdminController::class,"manageGallery"])->name("manageGallery");
    Route::post("addGalleryItems",[AdminController::class,"addGalleryItems"])->name("addGalleryItems");
    Route::post("addGalleryDataTable",[AdminController::class,"addGalleryDataTable"])->name("addGalleryDataTable");
 
    Route::get("add-web-site-elements", [WebSiteElementsController::class, "addWebSiteElements"])->name("webSiteElements");
    Route::post("save-web-site-element", [WebSiteElementsController::class, "saveWebSiteElement"])->name("saveWebSiteElement");
    Route::post("web-site-elements-data", [WebSiteElementsController::class, "getWebElementsData"])->name("webSiteElementsData");
    
    Route::get("slider-admin", [SliderController::class, "slider"])->name("Slider");
    Route::post("save-Slide", [SliderController::class, "saveSlide"])->name("saveSlide");
    Route::post("slider-data", [SliderController::class, "sliderData"])->name("sliderData");

       Route::get("blog-admin", [BlogController::class, "blogSlider"])->name("blogSlider");
    Route::post("save-blog", [BlogController::class, "saveBlog"])->name("saveBlog");
    Route::post("blog-data", [BlogController::class, "blogData"])->name("blogData");

    Route::get("products-admin", [ServicesController::class, "servicesSlider"])->name("servicesSlider");
    Route::post("products", [ServicesController::class, "servicesSaveSlide"])->name("servicesSaveSlide");
    Route::post("products-data", [ServicesController::class, "servicesData"])->name("servicesData");

        
    Route::get("home-products-admin", [HomeProductsController::class, "homeDestinationsSlider"])->name("homeDestinationsSlider");
    Route::post("home-products-services", [HomeProductsController::class, "homeDestinationsSaveSlide"])->name("homeDestinationsSaveSlide");
    Route::post("home-products-data", [HomeProductsController::class, "homeDestinationsData"])->name("homeDestinationsData");

    Route::post("manage-contact-data", [ServicesController::class, "managecontactdata"])->name("managecontactdata");

    Route::get("manage-testimonials",[TestimonialController::class,"managetestimonials"])->name("managetestimonials");
    Route::post("addtestimonialsItems",[TestimonialController::class,"addTestimonial"])->name("addTestimonial");
     Route::post("testimonialsDataTable",[TestimonialController::class,"testimonialsDataTable"])->name("testimonialsDataTable");

    Route::get('/manage-clients', [ClientController::class, 'manageClients'])->name('manageClients');
Route::post('/clients-data', [ClientController::class, 'clientsDataTable'])->name('clientsDataTable');
Route::post('/add-client', [ClientController::class, 'addClient'])->name('addClient');

Route::get("manage-verticals", [VerticalController::class, "manageVerticals"])
    ->name("manageVerticals");

Route::post("verticals-data", [VerticalController::class, "verticalsData"])
    ->name("verticalsData");

Route::post("save-vertical", [VerticalController::class, "saveVertical"])
    ->name("saveVertical");
Route::get('/vertical/{slug}', [VerticalController::class, 'show']);

    Route::get("contact-us-data", function () {
    return view("HomePage.ContactUsdata");
})->name("ContactUsData");
   Route::get("contact-us-data", [ContactUsController::class, "manageContactUs"])->name("manageContactUs");
     
    // POST route for DataTables Ajax
    Route::post("contact-us-data", [ContactUsController::class, "ContactUsData"])->name("ContactUsData");

});