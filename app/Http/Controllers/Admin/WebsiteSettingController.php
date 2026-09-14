<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeScreen;
use App\Repositories\CourseRepository;
use App\Repositories\LanguageRepository;
use App\Repositories\LessonRepository;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\UserRepository;
use App\Traits\ImageTrait;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class WebsiteSettingController extends Controller
{
    use ImageTrait;

    protected $setting;

    protected $language;

    public function __construct(SettingRepository $setting, LanguageRepository $language)
    {
        $this->setting  = $setting;
        $this->language = $language;
    }

    public function homePage(UserRepository $userRepository, SubjectRepository $subjectRepository, LessonRepository $lessonRepository, CourseRepository $courseRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $sections    = HomeScreen::where('type', 'home_page')->orderBy('position')->get();

            $instructors = $subjects = $lessons = $courses = $featured_courses = [];

            foreach ($sections->whereIn('section', ['instructors', 'subject', 'lesson_with_mentor', 'single_course', 'featured_course']) as $section) {
                if (arrayCheck('ids', $section->contents)) {
                    if ($section->section == 'instructors') {
                        $instructors = array_merge($instructors, $section->contents['ids']);
                    }
                    if ($section->section == 'subject') {
                        $subjects = array_merge($subjects, $section->contents['ids']);
                    }
                    if ($section->section == 'lesson_with_mentor') {
                        $lessons = array_merge($lessons, $section->contents['ids']);
                    }
                    if ($section->section == 'single_course') {
                        $courses = array_merge($courses, $section->contents['ids']);
                    }
                    if ($section->section == 'featured_course') {
                        $featured_courses = array_merge($featured_courses, $section->contents['ids']);
                    }
                }
            }

            $data        = [
                'sections'         => $sections,
                'instructors'      => $userRepository->findUsers(['role_id' => 2, 'ids' => $instructors]),
                'subjects'         => $subjectRepository->activeSubject(['ids' => $subjects]),
                'lessons'          => $lessonRepository->activeLesson(['ids' => $lessons]),
                'courses'          => $courseRepository->findCourses($courses),
                'featured_courses' => $courseRepository->findCourses($featured_courses),
            ];

            return view('backend.admin.website_setting.home_page', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function updateHomePage(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $validator = Validator::make($request->all(), [
            'builder' => 'required',
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => __('please_add_at_least_one_section')]);
        }

        DB::beginTransaction();
        try {
            HomeScreen::where('type', 'home_page')->delete();
            $height_1 = $width_1 = $height_2 = $width_2 = null;
            $i        = 1;
            foreach ($request->builder as $key => $builder) {
                $exploded  = explode('_', $key);
                $num       = end($exploded);
                $substring = '_'.$num;
                $section   = is_numeric($num) ? str_replace($substring, '', $key) : $key;
                if ($section == 'become_instructor') {
                    $width_1  = '615';
                    $height_1 = '623';
                }
                if ($section == 'fun_fact') {
                    if (arrayCheck('image1', $builder)) {
                        $width_1  = '266';
                        $height_1 = '250';
                    }
                    if (arrayCheck('image2', $builder)) {
                        $width_2  = '296';
                        $height_2 = '285';
                    }
                }

                if ($section == 'video_slider') {
                    foreach (getArrayValue('links', $builder, []) as $k => $value) {
                        $image                         = $this->getImageWithRecommendedSize($value['media_id'], 1030, 520);
                        $builder['links'][$k]['image'] = $image;
                    }
                }

                $data      = [
                    'type'       => 'home_page',
                    'section'    => $section,
                    'contents'   => $builder,
                    'media_id_1' => arrayCheck('image1', $builder) ? $builder['image1'] : null,
                    'image_1'    => arrayCheck('image1', $builder) ? $this->getImageWithRecommendedSize($builder['image1'], $width_1, $height_1) : '',
                    'media_id_2' => arrayCheck('image2', $builder) ? $builder['image2'] : null,
                    'image_2'    => arrayCheck('image2', $builder) ? $this->getImageWithRecommendedSize($builder['image2'], $width_2, $height_2) : '',
                    'position'   => $i,
                ];
                HomeScreen::create($data);
                $i++;
            }

            DB::commit();
            Toastr::success(__('home_screen_updated_successfully'));

            return response()->json(['success' => __('home_screen_updated_successfully')]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function deleteHomeSection($id): JsonResponse
    {
        try {
            HomeScreen::destroy($id);

            return response()->json([
                'success' => __('delete_successfully'),
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function themes(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.website_setting.themes');
    }

    public function updateThemes(Request $request): JsonResponse
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
            $this->setting->update($request);

            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function popup(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.popup', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function savePopupSetting(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'popup_title' => 'required',
        ]);

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function callToAction(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.cta', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveCtaSetting(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'cta_title' => 'required',
        ]);

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function instructorContent(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.become_instructor_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveInstructorContent(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'become_instructor_title' => 'required',
        ]);

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function webinarSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.webinar_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveWebinarSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.webinar_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }

    public function featureSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.feature_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveFeatureSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.feature_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }

    public function aboutSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.about_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveAboutSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.about_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);

            // Synchronize all active language records for about_me text fields so dashboard changes apply globally
            $aboutMeKeys = [
                'about_me_tag',
                'about_me_title',
                'about_me_description',
                'about_me_btn_text',
                'about_me_btn_url',
            ];

            $allLanguages = \App\Models\Language::all();
            foreach ($aboutMeKeys as $key) {
                if ($request->has($key)) {
                    $val = $request->input($key, '') ?? '';
                    foreach ($allLanguages as $langItem) {
                        \App\Models\Setting::updateOrCreate(
                            ['title' => $key, 'lang' => $langItem->locale],
                            ['value' => $val]
                        );
                    }
                }
            }

            if ($request->has('about_me_media_id')) {
                $mediaId = $request->input('about_me_media_id');
                if (!empty($mediaId)) {
                    $media = \App\Models\MediaLibrary::find($mediaId);
                    if ($media && !empty($media->image_variants)) {
                        \App\Models\Setting::updateOrCreate(['title' => 'about_me_image', 'lang' => 'en'], ['value' => serialize($media->image_variants)]);
                        \App\Models\Setting::updateOrCreate(['title' => 'about_me_media_id', 'lang' => 'en'], ['value' => $mediaId]);
                    }
                } else {
                    \App\Models\Setting::updateOrCreate(['title' => 'about_me_image', 'lang' => 'en'], ['value' => '']);
                    \App\Models\Setting::updateOrCreate(['title' => 'about_me_media_id', 'lang' => 'en'], ['value' => '']);
                }
            }

            \Illuminate\Support\Facades\Cache::flush();

            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }

    public function categoriesOfWorkSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.categories_of_work_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function newsletterSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.newsletter_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function stickyPromoSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.sticky_promo', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function successStorySection(Request $request)
    {
        $data['title'] = __('Success Story Section');
        $data['active_setting'] = 'success_story_section';
        $data['lang'] = request()->lang ?? setting('default_language');
        return view('backend.admin.website_setting.success_story_section', $data);
    }

    public function saveSuccessStorySection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.success_story_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        $request->validate([
            'success_section_eyebrow' => 'nullable|string',
            'success_section_title' => 'nullable|string',
            'success_section_btn_text' => 'nullable|string|max:255',
            'success_section_btn_url' => 'nullable|string|max:255',
        ]);

        try {
            $this->setting->update($request);

            $successStoryKeys = [
                'success_section_status',
                'success_section_eyebrow',
                'success_section_title',
                'success_section_description',
                'success_section_btn_text',
                'success_section_btn_url',
            ];

            $allLanguages = \App\Models\Language::all();
            foreach ($successStoryKeys as $key) {
                if ($request->has($key)) {
                    $val = $request->input($key, '') ?? '';
                    \App\Models\Setting::updateOrCreate(
                        ['title' => $key, 'lang' => 'en'],
                        ['value' => $val]
                    );
                    foreach ($allLanguages as $langItem) {
                        \App\Models\Setting::updateOrCreate(
                            ['title' => $key, 'lang' => $langItem->locale],
                            ['value' => $val]
                        );
                    }
                }
            }

            // Sync with any course masterclass_settings so stale course data never overrides
            $courses = \App\Models\Course::whereNotNull('masterclass_settings')->get();
            foreach ($courses as $c) {
                $mc = is_array($c->masterclass_settings) ? $c->masterclass_settings : json_decode($c->masterclass_settings, true);
                if (is_array($mc)) {
                    if ($request->has('success_section_eyebrow')) {
                        $mc['success_eyebrow'] = $request->input('success_section_eyebrow');
                    }
                    if ($request->has('success_section_title')) {
                        $mc['success_title'] = $request->input('success_section_title');
                    }
                    if ($request->has('success_section_description')) {
                        $mc['success_subtitle'] = $request->input('success_section_description');
                        $mc['success_description'] = $request->input('success_section_description');
                    }
                    if ($request->has('success_section_btn_text')) {
                        $mc['success_btn_text'] = $request->input('success_section_btn_text');
                    }
                    if ($request->has('success_section_btn_url')) {
                        $mc['success_btn_url'] = $request->input('success_section_btn_url');
                    }
                    $c->masterclass_settings = $mc;
                    $c->save();
                }
            }

            \Illuminate\Support\Facades\Cache::flush();

            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return redirect()->route('website.success_story_section');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()]);
            }
            return back();
        }
    }

    public function saveStickyPromoSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.sticky_promo');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);

            $promoKeys = [
                'show_sticky_promo_bar',
                'sticky_promo_title',
                'sticky_promo_btn_text',
                'sticky_promo_btn_link',
            ];

            $allLanguages = \App\Models\Language::all();
            foreach ($promoKeys as $key) {
                if ($request->has($key)) {
                    $val = $request->input($key, '') ?? '';
                    \App\Models\Setting::updateOrCreate(
                        ['title' => $key, 'lang' => 'en'],
                        ['value' => $val]
                    );
                    foreach ($allLanguages as $langItem) {
                        \App\Models\Setting::updateOrCreate(
                            ['title' => $key, 'lang' => $langItem->locale],
                            ['value' => $val]
                        );
                    }
                }
            }

            \Illuminate\Support\Facades\Cache::flush();

            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            if ($request->ajax()) {
                return response()->json(['error' => $e->getMessage()]);
            }
            return back();
        }
    }

    public function saveCategoriesOfWorkSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.categories_of_work_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            // Process cards and images
            $cards = $request->input('categories_of_work_cards', []);
            $existing_cards = setting('categories_of_work_cards');
            $existing_cards = is_array($existing_cards) ? $existing_cards : [];

            if (is_array($cards)) {
                foreach ($cards as $key => $card) {
                    if (!empty($card['media_id'])) {
                        $media = \App\Models\MediaLibrary::find($card['media_id']);
                        if ($media && !empty($media->image_variants)) {
                            $cards[$key]['image'] = getFileLink('original_image', $media->image_variants);
                            $cards[$key]['media_id'] = $card['media_id'];
                        }
                    } elseif ($request->hasFile("categories_of_work_cards.{$key}.image")) {
                        $image = $request->file("categories_of_work_cards.{$key}.image");
                        $filename = time() . '_' . $key . '.' . $image->getClientOriginalExtension();
                        $image->move(public_path('images/home_sections'), $filename);
                        $cards[$key]['image'] = 'images/home_sections/' . $filename;
                    } elseif (isset($existing_cards[$key]['image'])) {
                        // Keep existing image if not uploaded new
                        $cards[$key]['image'] = $existing_cards[$key]['image'];
                        if (isset($existing_cards[$key]['media_id'])) {
                            $cards[$key]['media_id'] = $existing_cards[$key]['media_id'];
                        }
                    }

                    // Remove any remaining UploadedFile objects to prevent serialization errors
                    if (isset($cards[$key]) && is_array($cards[$key])) {
                        foreach ($cards[$key] as $field => $val) {
                            if ($val instanceof \Illuminate\Http\UploadedFile || $val instanceof \Symfony\Component\HttpFoundation\File\UploadedFile) {
                                unset($cards[$key][$field]);
                            }
                        }
                    }
                }
                
                // Manually save the setting to avoid SettingRepository serialization issues with UploadedFile
                $setting = \App\Models\Setting::where('title', 'categories_of_work_cards')->first();
                if (!$setting) {
                    $setting = new \App\Models\Setting();
                    $setting->title = 'categories_of_work_cards';
                    $setting->lang = 'en';
                }
                $setting->value = serialize($cards);
                $setting->save();

                // Remove from request entirely so SettingRepository ignores it
                $request->request->remove('categories_of_work_cards');
                $request->files->remove('categories_of_work_cards');
            }

            // Create a new request entirely devoid of the cards field to absolutely guarantee SettingRepository won't see it
            $cleanRequest = new \Illuminate\Http\Request();
            $cleanRequest->replace($request->except('categories_of_work_cards'));

            $this->setting->update($cleanRequest);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }

    public function whyChooseSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.why_choose_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveWhyChooseSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.why_choose_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }



    public function adBannerSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.ad_banner_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveAdBannerSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.ad_banner_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }

    public function saveSuccessBanner(Request $request)
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }

    public function singleCourseSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.single_course_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveSingleCourseSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.single_course_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }

    public function seo(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.seo', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveSeoSetting(Request $request): JsonResponse
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
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function google(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin.website_setting.google_setup');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveGoogleSetup(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'tracking_code'      => 'required_if:is_google_analytics_activated,==,1',
            'recaptcha_Site_key' => 'required_if:is_recaptcha_activated,==,1',
            'recaptcha_secret'   => 'required_if:is_recaptcha_activated,==,1',
        ]);
        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function customCss(Request $request): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin.website_setting.custom_css');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function customJs(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin.website_setting.custom_js');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveCustomCssAndJs(Request $request): JsonResponse
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
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function fbPixel(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            return view('backend.admin.website_setting.fb_pixel');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveFbPixel(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'facebook_pixel_id' => 'required_if:is_facebook_pixel_activated,==,1',
        ]);
        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function gdpr(Request $request, PageRepository $pageRepository): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'pages'     => $pageRepository->activePages(['lang' => app()->getLocale()]),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.gdpr', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveGdpr(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'cookies_agreement' => 'required_if:cookies_status,==,1',
        ]);
        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function themeOptions(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $courses = \App\Models\Course::where('status', 'approved')->get();
        return view('backend.admin.website_setting.theme_options', compact('courses'));
    }

    public function updateThemesOptions(Request $request): JsonResponse
    {
        // dd(json_encode($request->all()));
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        try {

            $this->setting->update($request);

            //            Artisan::call('google-fonts:fetch');

            Artisan::call('storage:link');

            DB::commit();

            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function headerFooter(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.website_setting.header_footer');
    }

    public function updateHeaderFooter(Request $request): JsonResponse
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
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }



    public function counterSection(Request $request)
    {
        try {
            $data = [
                'languages' => $this->language->all(),
                'lang'      => $request->lang == '' ? app()->getLocale() : $request->lang,
            ];

            return view('backend.admin.website_setting.counter_section', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function saveCounterSection(Request $request)
    {
        if ($request->isMethod('get')) {
            return redirect()->route('website.counter_section');
        }

        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }
            Toastr::error(__('this_function_is_disabled_in_demo_server'));
            return back();
        }

        try {
            $this->setting->update($request);
            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            if ($request->ajax()) {
                return response()->json($data);
            }

            return back();
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json([
                    'error' => $e->getMessage(),
                ]);
            }
            Toastr::error($e->getMessage());
            return back();
        }
    }

    public function firebase(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.firebase');
    }

    public function firebaseUpdate(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'api_key'             => 'required',
            'auth_domain'         => 'required',
            'project_id'          => 'required',
            'storage_bucket'      => 'required',
            'messaging_sender_id' => 'required',
            'app_id'              => 'required',
            'measurement_id'      => 'required',
        ]);

        try {
            $request->setMethod('POST');
            $request->request->add(['is_google_login_activated' => $request->has('is_google_login_activated') ? 1 : 0]);
            $request->request->add(['is_facebook_login_activated' => $request->has('is_facebook_login_activated') ? 1 : 0]);
            $request->request->add(['is_twitter_login_activated' => $request->has('is_twitter_login_activated') ? 1 : 0]);

            $this->setting->update($request);

            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }

    public function chatMessenger(): \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        return view('backend.admin.system_setting.chat_messenger');
    }

    public function saveMessengerSetting(Request $request): \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'facebook_page_id'         => 'required_if:fb,==,1',
            'facebook_messenger_color' => 'required_if:fb,==,1',
            'tawk_property_id'         => 'required_if:tawk,==,1',
            'tawk_widget_id'           => 'required_if:tawk,==,1',
        ]);

        try {
            $this->setting->update($request);

            Toastr::success(__('update_successful'));
            $data = [
                'success' => __('update_successful'),
            ];

            return response()->json($data);
        } catch (\Exception $e) {
            $data = [
                'error' => $e->getMessage(),
            ];

            return response()->json($data);
        }
    }
}
