 <?php

use Illuminate\Support\Facades\Route;

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
Route::get('/', [App\Http\Controllers\AllController::class,'cate'])->name('main');




Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->middleware('verified')->name('home');
Route::get('/invoice/{id}', [App\Http\Controllers\UserOrderController::class, 'invoice'])->middleware('auth')->name('invoice');



Route::post('PaymentProcessing',[App\Http\Controllers\AllController::class,'payment'])->name('pay');

Route::get('ConfirmOrder/checkout',[App\Http\Controllers\AllController::class,'checkout'])->middleware('auth')->name('order.checkout');

Route::get('productinfo/{id}',[App\Http\Controllers\AllController::class,'single'])->name('single');
Route::get('additemintocard/{id}',[App\Http\Controllers\AllController::class,'addcart'])->middleware('auth')->name('card.add');
Route::post('removeiteminfromcard/{id}',[App\Http\Controllers\AllController::class,'removecard'])->middleware('auth')->name('card.remove');
Route::post('updatecard/{id}',[App\Http\Controllers\AllController::class,'updatecart'])->middleware('auth')->name('card.update');

Route::get('YourCard',[App\Http\Controllers\AllController::class,'card'])->middleware('auth')->name('yourcard');









Route::prefix('Admin')->group(function (){




Route::get('login', [App\Http\Controllers\Admin\LoginController::class,'showLoginForm'])->name('admin-login-form');
Route::post('login', [App\Http\Controllers\Admin\LoginController::class,'login'])->name('admin-login');
Route::post('logout', [App\Http\Controllers\Admin\LoginController::class,'logout'])->name('admin-logout');
Route::get('register', [App\Http\Controllers\Admin\RegisterController::class,'showRegistrationForm'])->name('admin-register-form');
Route::post('register', [App\Http\Controllers\Admin\RegisterController::class,'register'])->name('admin-register');
Route::get('password/reset', [App\Http\Controllers\Admin\ForgotPasswordController::class,'showLinkRequestForm'])->name('admin.password.request');
Route::post('password/email', [App\Http\Controllers\Admin\ForgotPasswordController::class,'sendResetLinkEmail'])->name('admin.password.email');
 Route::get('password/reset/{email}/{token}',[App\Http\Controllers\Admin\ResetPasswordController::class,'showResetForm'])->name('admin.password.reset');
 Route::post('password/reset', [App\Http\Controllers\Admin\ResetPasswordController::class,'reset'])->name('admin.password.update');
Route::get('password/confirm', [App\Http\Controllers\Admin\ConfirmPasswordController::class,'showConfirmForm'])->name('admin.password.confirm.form');
Route::post('password/confirm', [App\Http\Controllers\Admin\ConfirmPasswordController::class,'confirm'])->name('admin.passowrd.confirm');
Route::get('email/verify/{token}',[App\Http\Controllers\Admin\VerificationController::class,'verify'])->name('admin.verify');
Route::post('email/resend',[App\Http\Controllers\Admin\VerificationController::class,'resend'])->name('admin.resend');





});





Route::prefix('Admin')->middleware('auth:admin')->group(function(){

Route::get('home',function(){

        return view('admin.home');
});

Route::get('return',[App\Http\Controllers\Admin\AdminController::class,'allreturn'])->name('orderreturn');
Route::get('returnupdaterequest/{id}',[App\Http\Controllers\Admin\AdminController::class,'returnupdaterequest'])->name('return.update.request');

Route::Post('returnupdate/{id}',[App\Http\Controllers\Admin\AdminController::class,'returnupdate'])->name('return.update');





Route::get('order/trash',[App\Http\Controllers\Admin\OrderController::class,'trash'])->name('ordertrash');
Route::get('order/remove/{id}',[App\Http\Controllers\Admin\OrderController::class,'porder'])->name('porder');

Route::get('user/trash',[App\Http\Controllers\Admin\ProfileController::class,'trash'])->name('usertrash');
Route::get('user/restore/{id}',[App\Http\Controllers\Admin\ProfileController::class,'restore'])->name('userrestore');
Route::get('user/remove/{id}',[App\Http\Controllers\Admin\ProfileController::class,'remove'])->name('userremove');

Route::get('customer/billingdetails',[App\Http\Controllers\Admin\AdminController::class,'billing'])->name('bill');
Route::get('trashed',[App\Http\Controllers\Admin\AdminController::class,'temp'])->name('admintemp');
Route::get('restore/{id}',[App\Http\Controllers\Admin\AdminController::class,'restore'])->name('adminrestore');
Route::get('remove/{id}',[App\Http\Controllers\Admin\AdminController::class,'remove'])->name('adminremove');
Route::get('Adminprofile',[App\Http\Controllers\Admin\AdminController::class,'adminpro'])->name('adminprofile');
Route::get('addcategories',[App\Http\Controllers\Admin\CategoryController::class,'add'])->name('addcate');
Route::get('tempcate',[App\Http\Controllers\Admin\CategoryController::class,'tempcate'])->name('tempcate');
Route::get('categoryrestore/{id}',[App\Http\Controllers\Admin\CategoryController::class,'restore'])->name('category.restore');
Route::get('categoryremove/{id}',[App\Http\Controllers\Admin\CategoryController::class,'remove'])->name('category.remove');
Route::view('product/extras','admin.product.part')->name('admin.extras');
Route::get('addProduct',[App\Http\Controllers\Admin\ProductController::class,'addProduct'])->name('addProduct');
Route::get('tempProduct',[App\Http\Controllers\Admin\ProductController::class,'tempcate'])->name('tempproduct');
Route::get('productrestore/{id}',[App\Http\Controllers\Admin\ProductController::class,'restore'])->name('product.restore');
Route::get('productremove/{id}',[App\Http\Controllers\Admin\ProductController::class,'remove'])->name('product.remove');


Route::resource('adminpanel',App\Http\Controllers\Admin\AdminController::class);
Route::resource('customers', App\Http\Controllers\Admin\CustomerController::class);
Route::resource('profile',   App\Http\Controllers\Admin\ProfileController::class);
Route::resource('categories',App\Http\Controllers\Admin\CategoryController::class);
Route::resource('products',  App\Http\Controllers\Admin\ProductController::class);
Route::resource('orders',    App\Http\Controllers\Admin\OrderController::class);
Route::resource('reports',   App\Http\Controllers\Admin\ReportController::class);


});

Route::resource('state',App\Http\Controllers\Admin\StateController::class);
Route::resource('city', App\Http\Controllers\Admin\CityController::class);



Route::prefix('user')->middleware('auth')->group(function(){

    
    Route::resource('userprofile',App\Http\Controllers\UserProfileController::class);
    Route::resource('userorders', App\Http\Controllers\UserOrderController::class);
    Route::resource('userpayment',App\Http\Controllers\UserPaymentController::class);
    Route::resource('userreturn', App\Http\Controllers\UserReturnController::class);


});

Route::resource('subscribe',App\Http\Controllers\SubscribeController::class);
Route::resource('pincode',App\Http\Controllers\PincodeController::class);



?>
                  


           
