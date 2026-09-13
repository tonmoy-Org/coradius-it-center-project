<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\HomeScreen;
use App\Models\Lesson;
use App\Models\Rating;
use App\Models\Subscriber;
use App\Models\User;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SuccessStoryRepository;
use App\Traits\SendMailTrait;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    use SendMailTrait;

    public function index(
        SuccessStoryRepository $successStoriesRepository
    ): View|
    Factory|
    JsonResponse|
    Application {
        try {
            $data = [];
            $websiteMode = setting('website_mode');
            
            if ($websiteMode == 'single_course' || !$websiteMode) {
                $singleCourseId = setting('single_course_id');
                if ($singleCourseId) {
                    $data['course'] = \App\Models\Course::with(['category.language', 'lessons', 'instructor', 'reviews'])
                        ->where('id', $singleCourseId)
                        ->where('status', 'approved')
                        ->first();
                } else {
                    $data['course'] = \App\Models\Course::with(['category.language', 'lessons', 'instructor', 'reviews'])->where('status', 'approved')->first();
                }
            } else {
                $data['course'] = null;
            }
            $data['hero_course'] = \App\Models\Course::where('status', 'approved')->latest()->first();
            $featuredStories = $successStoriesRepository->activeStories(['featured' => 1]);
            $data['success_stories'] = $featuredStories->count() > 0 ? $featuredStories : $successStoriesRepository->activeStories();

            // Fetch active coupon for banner display
            $activeCoupons = \App\Models\Coupon::active()
                ->where('start_date', '<=', now())
                ->where('end_date', '>', now())
                ->whereNotNull('image')
                ->latest()
                ->get();
            
            $validCoupon = null;
            foreach ($activeCoupons as $coupon) {
                if ($coupon->type == 'global') {
                    $validCoupon = $coupon;
                    break;
                } elseif ($coupon->type == 'course' && isset($data['course']) && in_array($data['course']->id, $coupon->course_ids ?? [])) {
                    $validCoupon = $coupon;
                    break;
                }
            }
            $data['active_banner_coupon'] = $validCoupon;

            // dd($data);

            return view('frontend.home', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function subscribe(Request $request): JsonResponse
    {
        $request->validate(
            [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
            ],
            [
                'email.unique' => __('email_already_subscribed'),
            ]
        );
        if ($request->dont_show_this) {
            session()->put('dont_show', $request->dont_show_this);
        }

        try {
            Subscriber::create($request->all());

            return response()->json(['success' => __('successfully_subscribed')]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function UpdateWebsiteSetting(Request $request, SettingRepository $setting): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        try {

            $setting->update($request);
            $response = [
                'status'  => 'success',
                'title'   => 'success',
                'message' => __('update_successful'),
            ];
            Toastr::success(__('update_successful'));

            return response()->json($response);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            $data = [
                'message' => __($e->getMessage()),
            ];

            return response()->json($data);
        }
    }

    public function page($link, PageRepository $pageRepository)
    {
        $page = $pageRepository->findByLink($link);
        if (!$page) {
            abort(404);
        }
        $lang      = request()->lang ?? app()->getLocale();
        $page_info = $pageRepository->getByLang($page->id, $lang);

        return view('frontend.page', compact('page_info'));
    }

    public function privacyPolicy(PageRepository $pageRepository)
    {
        try {
            $page = \App\Models\Page::where('link', 'privacy-policy')->orWhere('link', 'privacy_policy')->first();
            if ($page) {
                $page_info = $pageRepository->getByLang($page->id, app()->getLocale());
                if ($page_info && !empty($page_info->content)) {
                    return view('frontend.page', compact('page_info'));
                }
            }
        } catch (\Exception $e) {}
        return view('frontend.privacy_policy');
    }

    public function termsPolicy(PageRepository $pageRepository)
    {
        try {
            $page = \App\Models\Page::where('link', 'terms-and-conditions')->orWhere('link', 'terms_conditions')->first();
            if ($page) {
                $page_info = $pageRepository->getByLang($page->id, app()->getLocale());
                if ($page_info && !empty($page_info->content)) {
                    return view('frontend.page', compact('page_info'));
                }
            }
        } catch (\Exception $e) {}
        return view('frontend.terms_conditions');
    }

    public function refundPolicy(PageRepository $pageRepository)
    {
        try {
            $page = \App\Models\Page::where('link', 'refund-policy')->orWhere('link', 'refund_policy')->first();
            if ($page) {
                $page_info = $pageRepository->getByLang($page->id, app()->getLocale());
                if ($page_info && !empty($page_info->content)) {
                    return view('frontend.page', compact('page_info'));
                }
            }
        } catch (\Exception $e) {}
        return view('frontend.refund_policy');
    }
}
