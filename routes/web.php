<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\SliderController;
use App\Http\Controllers\admin\TestimonialController;
use App\Http\Controllers\admin\SettingsController;
use App\Http\Controllers\admin\PostsController;
use App\Http\Controllers\admin\PermissionController;
use App\Http\Controllers\admin\RoleController;
use App\Http\Controllers\admin\UserController;
use App\Http\Middleware\TimeRestrictedAccess;
use App\Models\Slider;
use App\Models\Permission;
use App\Models\Testimonial;
use App\Models\Posts;
use App\Models\User;
use App\Http\Controllers\SocialAuthController;



Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect']);
Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback']);

Route::get('/', function () {

    $sliders =Slider::all();
    $testimonials =Testimonial::all();
    return view('frontend.Home',compact('sliders','testimonials'));
});

Route::get('/about',function(){
    return view('frontend.about');

});

Route::get('/service', function () {
    return view('frontend.service');
})->middleware([TimeRestrictedAccess::class]);



Route::get('/blog',function(){

    $posts = Posts::orderby('created_at','desc')->paginate(3);
    return view('frontend.blog',compact('posts'));
});

Route::get('/blog/{slug}', function ($slug) {
    $post = Posts::where('slug', $slug)->first();
    return view('frontend.post-single',compact('post'));
});

Route::get('/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::controller(SliderController::class)->middleware(['auth', 'verified'])->group(function () {
    Route::get('/SliderIndex','Index')->name('slider.index');     
    Route::post('/saveSlider','storeslider')->name('slider.store');
    Route::post('/sliderUpdate','updateslider')->name('slider.update');
    Route::get('/deleteSlider/{id}','deleteslider')->name('slider.delete');
});

Route::controller(TestimonialController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/TestimonialIndex','Index')->name('Testimonial.index');
    Route::post('/saveTestimonial','storeTestimonial')->name('Testimonial.store');
    Route::post('/TestimonialUpdate','updateTestimonial')->name('Testimonial.update');
    Route::get('/deleteTestimonial/{id}','deleteTestimonial')->name('Testimonial.delete');
});

Route::controller(SettingsController::class)->middleware(['auth','verified'])->group(function (){
   Route::get('/settings','index')->name('settings'); 
   Route::post('/settingUpdate','update')->name('settings.update');
});

Route::controller(PostsController::class)->middleware(['auth','verified'])->group(function (){
    Route::get('/postIndex','Index')->name('posts.index');
    Route::post('/postsStore','storePost')->name('posts.store');
    Route::post('/postsUpdate','updatePost')->name('posts.update');
    Route::get('/postsDelete/{id}','deletePost')->name('posts.delete');
    Route::post('/commentIndex/{id}','indexComment')->name('comments.index');
});

 Route::controller(PermissionController::class)->middleware(['auth','verified'])->group(function (){
    
    Route::get('/permissionIndex','index');
    Route::post('/savePermission','storepermission')->name('permission.store');
    Route::post('/permissionUpdate','updatepermission')->name('permission.update');
    Route::get('/deletePermission/{id}','deletepermission')->middleware(['role:super-admin'])->name('permission.delete');
 });

  Route::controller(RoleController::class)->middleware(['auth','verified'])->group(function (){
    
    Route::get('/roleIndex','index');
    Route::post('/saveRole','storerole')->name('role.store');
    Route::post('/roleUpdate','updaterole')->name('role.update');
    Route::get('/deleteRole/{id}','deleterole')->middleware(['role:super-admin'])->name('role.delete');

    Route::get('/permissionToRole/{id}','givePermissionToRole')->name('role.givePermissionToRole');
    Route::put('/givePermissionToRole/{id}','giveRoleToPermission')->name('role.giveRoleToPermission');
 });

  Route::controller(UserController::class)->middleware(['auth','verified','role:super admin|admin'])->group(function (){
    
    Route::get('/userIndex','index');
    Route::post('/saveUser','storeuser')->name('user.store');
    Route::post('/userUpdate','updateuser')->name('user.update');
    Route::get('/deleteUser/{id}','deleteuser')->middleware(['role:super admin'])->name('user.delete');
 });



    Route::post('/commentIndex/{id}', [PostsController::class, 'indexComment'])->name('comments.index');

require __DIR__.'/auth.php';
