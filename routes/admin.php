<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AjaxController;
use App\Http\Controllers\Admin\AssignmentController;
use App\Http\Controllers\Admin\BadgeController;
use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CourseController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LessonController;
use App\Http\Controllers\Admin\LiveClassController;
use App\Http\Controllers\Admin\MediaLibraryController;
use App\Http\Controllers\Admin\PackageSolutionController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\QuizController;
use App\Http\Controllers\Admin\QuizQuestionController;
use App\Http\Controllers\Admin\ResourceController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\SuccessStoryController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WebsiteSetting\FooterSettingController;
use App\Http\Controllers\Admin\WebsiteSetting\HeaderSettingController;
use App\Http\Controllers\Admin\WebsiteSettingController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => localeRoutePrefix()], function () {
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'adminCheck', 'PermissionCheck']], function () {
        Route::resource('badges', BadgeController::class)->except(['show']);
        Route::get('/', [AdminController::class, 'index'])->name('admin.dashboard')->middleware(['auth', 'verified']);

        Route::resource('contacts', ContactController::class)->except(['show']);
        Route::resource('coupons', CouponController::class)->except(['show']);

        Route::resource('services', ServiceController::class)->except(['show']);
        Route::resource('pages', PageController::class)->except(['show', 'update']);
        Route::post('pages/update/{id}', [PageController::class, 'update'])->name('pages.update');

        //    Manage Courses
        Route::resource('courses', CourseController::class);
        Route::get('courses/{course}/students', [CourseController::class, 'students'])->name('course.students');
        Route::get('courses/{course}/statistics', [CourseController::class, 'statistics'])->name('course.statistics');
        Route::post('course-publish', [CourseController::class, 'published'])->name('course.publish');

        Route::resource('sections', SectionController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::post('sections-order', [SectionController::class, 'sectionsOrder'])->name('course.sections.order');
        Route::resource('lessons', LessonController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::post('lessons-order', [LessonController::class, 'lessonOrder'])->name('section.lessons.order');
        Route::resource('faqs', FaqController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::resource('assignments', AssignmentController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::resource('quizzes', QuizController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::resource('quiz-questions', QuizQuestionController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::post('load-more-course', [AjaxController::class, 'loadInstructorCourse'])->name('load.more.course');

        Route::resource('books', BookController::class);
        Route::post('load-more-books', [AjaxController::class, 'loadInstructorBooks'])->name('load.more.books');

        Route::resource('live-classes', LiveClassController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::resource('resources', ResourceController::class)->only(['store', 'edit', 'update', 'destroy']);
        Route::get('resources/{id}/download', [ResourceController::class, 'download'])->name('resources.download');
        //book store
        Route::get('book-list', [BookController::class, 'index'])->name('backend.admin.book.index');



        //media library
        Route::get('media-library', [MediaLibraryController::class, 'index'])->name('media-library.index');
        Route::post('add-media', [MediaLibraryController::class, 'store'])->name('media-library.store');
        Route::delete('delete-media', [MediaLibraryController::class, 'delete'])->name('media.destroy');

        Route::group(['as' => 'users.'], function () {
            Route::post('user-status', [UserController::class, 'statusChange'])->name('status');
            Route::delete('users/delete/{id}', [UserController::class, 'instructorDelete'])->name('destroy');
        });
        Route::delete('delete-media', [MediaLibraryController::class, 'delete'])->name('media.destroy');


        //chat setting (CMS)


        //website setting
        //website theme setting
        //website theme options
        Route::get('theme-options', [WebsiteSettingController::class, 'themeOptions'])->name('theme.options');
        Route::post('theme-options', [WebsiteSettingController::class, 'updateThemesOptions'])->name('theme.options');





        //website footer-content
        Route::get('footer-content', [FooterSettingController::class, 'footerContent'])->name('footer.content');

        Route::get('social-link-setting', [FooterSettingController::class, 'socialLinkSetting'])->name('footer.social-links');

        Route::post('social-link-setting', [FooterSettingController::class, 'saveSocialLinkSetting'])->name('footer.social-links');

        Route::get('newsletter-setting', [FooterSettingController::class, 'newsletterSetting'])->name('footer.newsletter-settings');

        Route::get('useful-link-setting', [FooterSettingController::class, 'usefulLinkSetting'])->name('footer.useful-links');


        Route::get('quick-link-setting', [FooterSettingController::class, 'quickLinkSetting'])->name('footer.quick-links');


        Route::get('copyright-setting', [FooterSettingController::class, 'copyrightSetting'])->name('footer.copyright');


        Route::get('save-call-to-action', function () {
        });


        //website webinar section setting
        Route::match(['get', 'post'], 'save-webinar-section', [WebsiteSettingController::class, 'saveWebinarSection'])->name('website.webinar_section.save');

        //website feature section setting
        Route::match(['get', 'post'], 'save-feature-section', [WebsiteSettingController::class, 'saveFeatureSection'])->name('website.feature_section.save');

        //website about section setting
        Route::get('about-section', [WebsiteSettingController::class, 'aboutSection'])->name('website.about_section');
        Route::match(['get', 'post'], 'save-about-section', [WebsiteSettingController::class, 'saveAboutSection'])->name('website.about_section.save');

        //website categories of work section setting
        Route::get('categories-of-work-section', [WebsiteSettingController::class, 'categoriesOfWorkSection'])->name('website.categories_of_work_section');
        Route::get('newsletter-section', [WebsiteSettingController::class, 'newsletterSection'])->name('website.newsletter_section');
        Route::get('sticky-promo-section', [WebsiteSettingController::class, 'stickyPromoSection'])->name('website.sticky_promo');
        Route::get('success-story-section', [WebsiteSettingController::class, 'successStorySection'])->name('website.success_story_section');
        Route::match(['get', 'post'], 'save-success-story-section', [WebsiteSettingController::class, 'saveSuccessStorySection'])->name('website.success_story_section.save');
        Route::match(['get', 'post'], 'save-categories-of-work-section', [WebsiteSettingController::class, 'saveCategoriesOfWorkSection'])->name('website.categories_of_work_section.save');

        //website why choose section setting
        Route::match(['get', 'post'], 'save-why-choose-section', [WebsiteSettingController::class, 'saveWhyChooseSection'])->name('website.why_choose_section.save');



        //website ad banner section setting
        Route::get('ad-banner-section', [WebsiteSettingController::class, 'adBannerSection'])->name('website.ad_banner_section');
        Route::match(['get', 'post'], 'save-ad-banner-section', [WebsiteSettingController::class, 'saveAdBannerSection'])->name('website.ad_banner_section.save');

        //website single course section setting
        Route::get('single-course-section', [WebsiteSettingController::class, 'singleCourseSection'])->name('website.single_course_section');
        Route::match(['get', 'post'], 'save-single-course-section', [WebsiteSettingController::class, 'saveSingleCourseSection'])->name('website.single_course_section.save');

        //website counter section setting
        Route::get('counter-section', [WebsiteSettingController::class, 'counterSection'])->name('website.counter_section');
        Route::match(['get', 'post'], 'save-counter-section', [WebsiteSettingController::class, 'saveCounterSection'])->name('website.counter_section.save');

        //website seo
        Route::get('website-seo', [WebsiteSettingController::class, 'seo'])->name('website.seo');
        Route::post('website-seo', [WebsiteSettingController::class, 'saveSeoSetting'])->name('website.seo');

        //website seo
        Route::get('google-setup', [WebsiteSettingController::class, 'google'])->name('google.setup');
        Route::post('google-setup', [WebsiteSettingController::class, 'saveGoogleSetup'])->name('google.setup');

        //custom js and css
        Route::get('custom-js', [WebsiteSettingController::class, 'customJs'])->name('custom.js');
        Route::get('custom-css', [WebsiteSettingController::class, 'customCss'])->name('custom.css');

        //facebook pixel
        Route::get('facebook-pixel', [WebsiteSettingController::class, 'fbPixel'])->name('fb.pixel');
        Route::post('facebook-pixel', [WebsiteSettingController::class, 'saveFbPixel'])->name('fb.pixel');

        //gdpr
        Route::get('gdpr', [WebsiteSettingController::class, 'gdpr'])->name('gdpr');
        Route::post('gdpr', [WebsiteSettingController::class, 'saveGdpr'])->name('gdpr');

        //success-story
        Route::resource('success-stories', SuccessStoryController::class)->except(['show']);
        Route::post('save-success-banner', [WebsiteSettingController::class, 'saveSuccessBanner'])->name('website.success_banner.save');



        /*------==== Marketing ------------------======= */
        //coupons
        Route::resource('coupons', CouponController::class)->except(['show']);



        //packages
        Route::resource('packages', PackageSolutionController::class)->except(['show']);
        Route::POST('packages/{subscribe}', [PackageSolutionController::class, 'PackageSubscribe'])->name('packages.subscribe');
        Route::get('packages/subscribe-list', [PackageSolutionController::class, 'PackageSubscribeList'])->name('packages.subscribe-list');

        //admin profile
        Route::get('profile', [AdminController::class, 'profile'])->name('user.profile');
        Route::patch('user-update', [AdminController::class, 'profileUpdate'])->name('user.update');
        Route::get('password-change', [AdminController::class, 'passwordChange'])->name('user.password-change');
        Route::post('password-update', [AdminController::class, 'passwordUpdate'])->name('user.password-update');

    });

    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified'], 'as' => 'users.'], function () {
        Route::get('users/verified/{verify}', [UserController::class, 'instructorVerified'])->name('verified');
        Route::get('users/ban/{id}', [UserController::class, 'instructorBan'])->name('ban');
    });
    Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified']], function () {
        Route::delete('delete/home-section/{id}', [WebsiteSettingController::class, 'deleteHomeSection'])->name('delete.home.section');
        Route::post('update-footer-setting', [FooterSettingController::class, 'updateSetting'])->name('footer.update-setting');
        Route::post('update-footer-menu', [FooterSettingController::class, 'menuUpdate'])->name('footer.update-menu');
        Route::post('custom-css', [WebsiteSettingController::class, 'saveCustomCssAndJs'])->name('custom.css.js');


        Route::post('course-status', [CourseController::class, 'statusChange'])->name('course.status');
        Route::post('live-class-status', [LiveClassController::class, 'statusChange'])->name('live.class.status');
        Route::post('pages-status', [PageController::class, 'statusChange'])->name('page.status.change');
        Route::post('coupon-status', [CouponController::class, 'statusChange'])->name('coupon.status.change');
        Route::post('success-status', [SuccessStoryController::class, 'statusChange'])->name('success.status.change');
        Route::post('success-feature', [SuccessStoryController::class, 'featuredChange'])->name('success.feature.change');
        Route::post('testimonial-status', [TestimonialController::class, 'statusChange'])->name('testimonial.status.change');
        Route::post('brand-status', [BrandController::class, 'statusChange'])->name('brand.status.change');
        Route::post('package-status', [PackageSolutionController::class, 'statusChange'])->name('package.status.change');
    });
    //for ajax request
    Route::prefix('ajax')->as('ajax.')->middleware(['auth', 'verified'])->group(function () {
        Route::get('categories', [AjaxController::class, 'categories'])->name('categories');
        Route::get('users', [AjaxController::class, 'user'])->name('users');
        Route::get('instructors', [AjaxController::class, 'instructor'])->name('instructors');
        Route::get('organizations', [AjaxController::class, 'organizations'])->name('organizations');
        Route::get('success-stories', [AjaxController::class, 'successStory'])->name('stories');
        Route::get('selectedcourseID/{id}', [AjaxController::class, 'selectedCourse']);
        Route::get('lessons', [AjaxController::class, 'lessons'])->name('lessons');
        Route::get('courses', [AjaxController::class, 'courses'])->name('courses');
        Route::get('blogs', [AjaxController::class, 'blogs'])->name('blogs');
        Route::get('books', [AjaxController::class, 'getBooks'])->name('books');
        Route::get('states-by-country', [AjaxController::class, 'getStates'])->name('states');
        Route::get('cities-by-state', [AjaxController::class, 'getCities'])->name('cities');
    });
});
