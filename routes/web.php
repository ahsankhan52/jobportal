<?php
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    if (!$request->hasValidSignature()) {
        abort(403, 'Invalid signature.');
    }
    $request->fulfill();
    return redirect('/login');
})->middleware(['signed'])->name('verification.verify');



Route::get('/register/seeker', [UserController::class, 'createSeeker'])->name('create.seeker');
Route::post('/register/seeker', [UserController::class, 'storeSeeker'])->name('store.seeker');

Route::get('/register/employer', [UserController::class, 'createEmployer'])->name('create.employer');
Route::post('/register/employer', [UserController::class, 'storeEmployer'])->name('store.employer');

Route::get('/login', [UserController::class, 'login'])->name('login');
Route::post('/login', [UserController::class, 'postLogin'])->name('login.post');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('verified')->name('dashboard');
Route::get('/verify', [DashboardController::class, 'verify'])->name('verification.notice');

Route::get('/resend/verification/email', [DashboardController::class, 'resend'])->name('resend.email');

Route::get('subscribe', [SubscriptionController::class, 'subscribe'])->middleware('auth');

Route::get('pay/weekly', [SubscriptionController::class, 'initiatePayment'])->name('pay.weekly')->middleware('auth');
Route::get('pay/monthly', [SubscriptionController::class, 'initiatePayment'])->name('pay.monthly')->middleware('auth');
Route::get('pay/yearly', [SubscriptionController::class, 'initiatePayment'])->name('pay.yearly')->middleware('auth');