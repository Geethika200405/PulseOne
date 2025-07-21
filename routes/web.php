<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\MemberSettingsController;
use App\Http\Controllers\AttendanceController;

/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/
Route::view('/', 'home')->name('home');
Route::view('/about', 'about')->name('about');
Route::view('/features', 'features')->name('features');
Route::view('/challenges', 'challenges')->name('challenges');
Route::view('/contact', 'contact')->name('contact');

/*
|--------------------------------------------------------------------------
| Authentication Views
|--------------------------------------------------------------------------
*/
Route::view('/login', 'auth.login')->name('login');
Route::view('/2fa', 'auth.2fa')->name('2fa');
Route::view('/selectRole', 'auth.selectRole')->name('selectRole');

/*
|--------------------------------------------------------------------------
| Authentication Logic
|--------------------------------------------------------------------------
*/
Route::post('/login', [LoginController::class, 'login']);
Route::post('/2fa', [LoginController::class, 'verify2FA'])->name('2fa.verify');
Route::post('/2fa/resend', [LoginController::class, 'resend2FA'])->name('2fa.resend');
Route::post('/selectRole', [LoginController::class, 'submitSelectedRole'])->name('selectRole.submit');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Registration Routes
|--------------------------------------------------------------------------
*/
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register/member', [RegisterController::class, 'registerMember'])->name('register.member');
Route::post('/register/payment', [RegisterController::class, 'registerPayment'])->name('register.payment');

/*
|--------------------------------------------------------------------------
| Dashboards by Role
|--------------------------------------------------------------------------
*/
Route::view('/member/dashboard', 'memberDashboard.dashboard')->name('Member.dashboard');
Route::view('/dietitian/dashboard', 'dietitianDashboard.dashboard')->name('Dietitian.dashboard');
Route::view('/trainer/dashboard', 'trainerDashboard.dashboard')->name('Trainer.dashboard');
Route::view('/admin/dashboard', 'adminDashboard.dashboard')->name('Admin.dashboard');

/*
|--------------------------------------------------------------------------
| Member Dashboard Pages
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
 // 👤 Member views QR scanner and past attendance
    Route::get('/member/qrscanner', [AttendanceController::class, 'showMemberQR'])->name('member.qrscanner');

    // 🔘 Manual attendance marking from inside dashboard (button)
    Route::post('/member/mark-attendance', [AttendanceController::class, 'markAttendance'])->name('mark.attendance');

    // 📱 QR scan route - accessed via GET (no form, from QR code scan)
    Route::get('/mark-attendance', [AttendanceController::class, 'markAttendanceViaQR'])->name('mark.attendance.qr');


    Route::view('/member/workoutplan', 'memberDashboard.workoutplan')->name('Member.workoutplan');
    Route::view('/member/dietplan', 'memberDashboard.dietplan')->name('Member.dietplan');
    Route::view('/member/bookings', 'memberDashboard.bookings')->name('Member.bookings');
    Route::view('/member/message', 'memberDashboard.message')->name('Member.message');
    Route::view('/member/leaderboard', 'memberDashboard.leaderboard')->name('Member.leaderboard');
    Route::view('/member/payment', 'memberDashboard.payment')->name('Member.payment');

    /*
    |--------------------------------------------------------------------------
    | Member Settings
    |--------------------------------------------------------------------------
    */
    Route::get('/member/settings', [MemberSettingsController::class, 'index'])->name('Member.settings');
    Route::put('/member/settings', [MemberSettingsController::class, 'update'])->name('Member.settings.update');
    Route::delete('/member/settings/remove-image', [MemberSettingsController::class, 'removeImage'])->name('Member.settings.removeImage');
    Route::post('/member/settings/check-password', [MemberSettingsController::class, 'checkPassword'])->name('Member.settings.checkPassword');
});
