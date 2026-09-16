<?php

use App\Models\Word;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Application;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\DonateController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashbordController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\OrgClientController;
use App\Http\Controllers\VolunteerController;
use App\Http\Controllers\DonationMailController;


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginHandle'])->name('loginSubmit')->middleware('throttle:6,1');

Route::middleware("auth")->group(function () {

    Route::post('/logout', [AuthController::class, 'logoutHandle'])->name('logout');
Route::get('/dashboad', [DashbordController::class, 'index'])->name('dashboad');

 Route::resource('/projects', ProjectController::class)->scoped(["project"=>"slug"]);
 Route::resource('/events', EventController::class)->scoped(["event"=>"slug"]);
 Route::resource('/profiles', ProfileController::class);
 Route::resource('/posts', PostController::class)->scoped(["post"=>"slug"]);

 Route::put('/change/Password', [ProfileController::class,'changePassword'])->name("change-password")->middleware('throttle:6,1');
 Route::put('/change/profile', [ProfileController::class,'changePicture'])->name("change-profile");

});


Route::middleware(['role:admin'])->group(function () {
Route::resource('/volunteers', VolunteerController::class)->scoped(["project"=>"slug"]);
Route::resource('/members', MemberController::class)->scoped(["member"=>"slug"]);
Route::resource('/categories', CategoryController::class)->scoped(["category"=>"slug"]);
Route::resource('/clients', OrgClientController::class);
Route::resource('/positions', PositionController::class)->scoped(["position"=>"slug"]);
Route::resource('/users', UserController::class)->scoped(["user"=>"slug"]);
});

Route::get('/generate-sitemap', [SitemapController::class, 'generate']);

Route::get('/website/members', [WebsiteController::class, 'members'])->name('member-list');
Route::get('/website/event/', [WebsiteController::class, 'eventList'])->name('event-list');
Route::get('/website/event/{event:slug}', [WebsiteController::class, 'eventShow'])->name('event-view');
Route::get('/website/contact', [WebsiteController::class, 'contactForm'])->name('contact');
Route::get('/website/about', [WebsiteController::class, 'aboutUs'])->name('about');
Route::get('/website/donate', [DonateController::class, 'donate'])->name('donate');
Route::post('/website/donate', [DonationMailController::class, 'send'])->name('donate.store');
Route::get('/website/project/view/{project:slug}', [WebsiteController::class, 'showProject'])->name('project-show');

