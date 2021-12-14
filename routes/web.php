<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ChangePass;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Models\Category;
use App\Models\HomeAbout;
use App\Models\Multipic;
use Illuminate\Support\Facades\Route;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');




Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->latest()->first();
    $images = Multipic::all();

    return view('home',compact('brands','abouts','images'));
});


Route::get('home', function () {
    echo "this is home page ";
});

Route::get('/about', function () {
    return view('about');
})->middleware('check');

Route::get('/contact', function () {
    return view('contact');
});


//Category Controller
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'Addcat'])->name('store.category');
Route::get('category/edit/{id}', [CategoryController::class, 'Edit']);
Route::post('category/update/{id}', [CategoryController::class, 'Update']);
Route::get('softdelete/category/{id}', [CategoryController::class, 'SoftDelete']);
Route::get('category/restore/{id}', [CategoryController::class, 'Restore']);
Route::get('category/pdelete/{id}', [CategoryController::class, 'PDelete']);

//Brand Controller
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add',[BrandController::class,'StoreBrand'])->name('store.brand');
Route::get('brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('brand/update/{id}', [BrandController::class, 'Update']);
Route::get('brand/delete/{id}',[BrandController::class,'Delete']);
// MultiImage Route
Route::get('/multi/image', [BrandController::class, 'Multimage'])->name('multi.image');
Route::post('/multi/add',[BrandController::class,'StoreImg'])->name('store.image');



//All Admin Routes
Route::get('home/slider',[HomeController::class,'HomeSlider'])->name('home.slider');
Route::get('add/slider',[HomeController::class,'AddSlider'])->name('add.slider');
Route::Post('store/slider',[HomeController::class,'StoreSlider'])->name('store.slider');
Route::get('slider/edit/{id}', [HomeController::class, 'Edit']);
Route::post('slider/update/{id}', [HomeController::class, 'Update']);
Route::get('slider/delete/{id}',[HomeController::class,'Delete']);

//Home About All Route
Route::get('home/about',[AboutController::class,'HomeAbout'])->name('home.about');
Route::get('add/about',[AboutController::class,'AddAbout'])->name('add.about');
Route::Post('store/about',[AboutController::class,'StoreAbout'])->name('store.about');
Route::get('about/edit/{id}', [AboutController::class, 'Edit']);
Route::post('about/update/{id}', [AboutController::class, 'Update']);
Route::get('about/delete/{id}',[AboutController::class,'Delete']);

//portfolio Page route
Route::get('/portfolio',[AboutController::class,'Portfolio'])->name('portfolio');
//Contact controller Route
Route::get('admin/contact',[ContactController::class,'AdminContact'])->name('admin.contact');
Route::get('admin/add/contact',[ContactController::class,'AddContact'])->name('add.contact');
Route::Post('admin/store/contact',[ContactController::class,'store'])->name('store.contact');
Route::get('contact/edit/{id}', [ContactController::class, 'Edit']);
Route::post('contact/update/{id}', [ContactController::class, 'Update']);
Route::get('contact/delete/{id}',[ContactController::class,'Delete']);
//contact home page route
Route::get('/contact',[ContactController::class,'Contact'])->name('contact');
Route::post('/contact/form',[ContactController::class,'contForm'])->name('contact.form');
Route::get('admin/message',[ContactController::class,'AdminMessage'])->name('admin.message');
Route::get('message/delete/{id}',[ContactController::class,'MessageDelete']);







Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    //Elequent query
    // $users = User::all();

    //Query Builder
    // $users = DB::table('users')->get();
    return view('admin.index');
})->name('dashboard');
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');
// Route::get('/register', [BrandController::class, 'Register'])->name('user.register');

//Change Password and user Profile Routes
Route::get('/user/password',[ChangePass::class,'Cpassword'])->name('change.password');
Route::post('/pass/update',[ChangePass::class,'UpdatePassword'])->name('pass.update');
//profile update routes
Route::get('/profile/update',[ChangePass::class,'PUpdate'])->name('profile.update');
Route::post('/user/profile/update',[ChangePass::class,'UserProfileUpdate'])->name('update.user.profile');

