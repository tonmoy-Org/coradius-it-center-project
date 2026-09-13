<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Site\AuthController;
use App\Http\Controllers\Site\CartController;
use App\Http\Controllers\Site\CourseController;
use App\Http\Controllers\Site\FrontendController;
use App\Http\Controllers\Site\ProfileController;
use App\Http\Controllers\Site\PurchaseController;
use App\Http\Controllers\Student\TicketController;
use App\Http\Controllers\Student\WishlistController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => localeRoutePrefix()], function () {
    Route::get('/', [FrontendController::class, 'index'])->name('home');
    Route::match(['get', 'post'], 'app-setting', [HomeController::class, 'changeAppSetting'])->name('change.app.setting');

    Route::middleware('auth')->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    });

    Route::get('cache-clear', [HomeController::class, 'cacheClear'])->name('cache.clear');

    /*--------------------=================================== Frontend route ===========================================*/

    /*===================authentication route=============*/
    Route::group(['prefix' => 'student', 'as' => 'student.'], function () {
        Route::post('logout', [AuthController::class, 'logout'])->name('logout');
        Route::any('sign-up', function() {
            abort(404);
        })->name('sign_up');
    });
    Route::get('activation/{email}/{code}', [AuthController::class, 'activation']);
    Route::get('password-forgot', [AuthController::class, 'forgotPassword'])->name('password.forgot');
    Route::post('password-forgot', [AuthController::class, 'forgot'])->name('forgot.password-email');
    Route::get('confirm-otp/{phone}/{otp}', [AuthController::class, 'confirmOtp']);
    Route::get('confirm-password-otp', [AuthController::class, 'passwordOtpSubmit'])->name('confirm.password.otp-submit');
    Route::post('confirm.password-update', [AuthController::class, 'passwordUpdate'])->name('confirm.password-update');
    /*===================authentication route=============*/

    Route::post('socialLogin', [AuthController::class, 'socialLogin'])->name('social.login');

    Route::group(['middleware' => 'studentCheck'], function () {
        Route::match(['get', 'post'], 'checkout', [PurchaseController::class, 'checkout'])->name('checkout');
        Route::get('user/invoice/{trx_id}', [PurchaseController::class, 'invoice'])->name('user.invoice');
        Route::match(['get', 'post'], 'user/complete-order', [PurchaseController::class, 'completeOrder'])->name('complete.order');
        Route::get('user/download-invoice/{trx_id}', [PurchaseController::class, 'downloadInvoice'])->name('download.invoice');
        Route::get('free-course', [PurchaseController::class, 'completeOrder'])->name('free.course');
        Route::post('onesignal/update-subscription', [ProfileController::class, 'oneSignalSubscribe'])->name('onesignal.update-subscription');



        /*============== Profile login ===========================*/
        Route::get('dashboard', [ProfileController::class, 'myProfile'])->name('my-profile');
        Route::get('my-profile', [ProfileController::class, 'myProfile']);
        Route::get('edit-profile', [ProfileController::class, 'editProfile'])->name('edit.profile');
        Route::post('profile-update', [ProfileController::class, 'updateProfile'])->name('profile-update');
        Route::post('apply-coupon', [CartController::class, 'applyCoupon'])->name('apply.coupon');
        Route::get('delete-apply-coupon/{id}', [CartController::class, 'deleteAppliedCoupon'])->name('delete.applied.coupon');

        Route::group(['as' => 'course.'], function () {
            Route::get('purchase-courses', [ProfileController::class, 'purchaseCourses'])->name('purchase');
            Route::get('recently-viewed-courses', [ProfileController::class, 'recentlyViewedCourses'])->name('recently-viewed');
            Route::get('wishlist-courses', [WishlistController::class, 'wishlists'])->name('wishlist');
        });
        Route::post('add-remove-wishlist', [WishlistController::class, 'addOrRemoveWishlist'])->name('add.remove.wishlist');

        Route::group(['as' => 'book.'], function () {
            Route::get('purchase-book', [ProfileController::class, 'purchaseBook'])->name('purchase');
            Route::get('recently-viewed-book', [ProfileController::class, 'recentlyViewedBook'])->name('recently-viewed');
            Route::get('wishlist-book', [ProfileController::class, 'wishlistBook'])->name('wishlist');
        });
        Route::get('notification', [ProfileController::class, 'notification'])->name('notification');
        Route::post('notification', [ProfileController::class, 'notificationUpdate'])->name('notification.update');
        Route::post('delete', [ProfileController::class, 'notificationDelete'])->name('notification.delete');
        Route::get('setting', [ProfileController::class, 'profileSetting'])->name('setting');
        Route::post('setting-status-change', [ProfileController::class, 'systemStatus'])->name('setting.status.change');
        Route::post('user/account', [ProfileController::class, 'accountDelete']);
        Route::get('change-password', [AuthController::class, 'changePassword'])->name('change.password');
        Route::post('change-password', [AuthController::class, 'changePasswordUpdate'])->name('change.password-update');
        Route::get('meetings', [ProfileController::class, 'meeting'])->name('meetings');
        Route::get('my-assignment', [ProfileController::class, 'myAssignment'])->name('my-assignment');
        Route::get('assignment-details/{slug}]', [ProfileController::class, 'assignmentDetails'])->name('assignment.details');
        Route::post('assignment-submit', [ProfileController::class, 'assignmentSubmit'])->name('assignment.submit');
        Route::post('assignment-submit-delete', [ProfileController::class, 'submittedAssignmentDelete'])->name('assignment.submit.delete');
        /*============== Profile login ===========================*/

        Route::get('my-course/{slug}', [CourseController::class, 'myCourse'])->name('my-course');
        Route::get('my-quiz/{slug}', [CourseController::class, 'myQuiz'])->name('my-quiz');
        Route::post('my-answer', [CourseController::class, 'quizAnswerSubmit'])->name('quiz-answer');
        Route::post('save-progress', [CourseController::class, 'saveProgress'])->name('save-progress');
        Route::get('course/{course}/lesson/{slug}', [CourseController::class, 'lessonDetails'])->name('lesson.details');
        Route::get('course/resource', [CourseController::class, 'courseResource'])->name('resource.details');
        Route::get('answers/{slug}', [CourseController::class, 'showQuizAnswer'])->name('quiz-answer.show');
        Route::post('course-refund', [PurchaseController::class, 'refund'])->name('course.refund');
        Route::get('support', [TicketController::class, 'support'])->name('help.support');
        Route::resource('support-tickets', TicketController::class);
        Route::post('support-tickets-reply', [TicketController::class, 'reply'])->name('support-tickets.reply');
        Route::get('download-resource/{id}', [ProfileController::class, 'resourceDownload'])->name('download.resource');
    });

    Route::post('subscribe', [FrontendController::class, 'subscribe'])->name('subscribe');

    Route::get('course/{slug}', function() { return redirect('/'); })->name('course.details');

    //web setting change
    Route::post('update-website-setting', [FrontendController::class, 'UpdateWebsiteSetting'])->name('update.website-setting');

    //add to cart route
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add.cart');
    Route::post('masterclass-checkout', [CartController::class, 'masterclassCheckout'])->name('masterclass.checkout');
    Route::post('check-guest-coupon', [CartController::class, 'checkGuestCoupon'])->name('check.guest.coupon');
    Route::get('item/remove', [CartController::class, 'itemRemove']);
    Route::get('cart-view', [CartController::class, 'cartView'])->name('cart.view');

    //dynamic page route
    Route::get('page/{link}', [FrontendController::class, 'page']);

    // Policy Pages
    Route::get('privacy-policy', [FrontendController::class, 'privacyPolicy'])->name('privacy.policy');
    Route::get('terms-and-conditions', [FrontendController::class, 'termsPolicy'])->name('terms.conditions');
    Route::get('refund-policy', [FrontendController::class, 'refundPolicy'])->name('refund.policy');
});

require __DIR__.'/auth.php';
