@extends('backend.layouts.master')
@section('title', __('Home Landing Page Setup'))
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h3 class="section-title">{{ __('Home Landing Page Setup') }}</h3>
                @php
                    $step_1_error = false;
                    $step_2_error = false;
                    $step_3_error = false;
                    $step_6_error = false;
                    $step_1_errors = ['title', 'category_id', 'subject_id', 'organization_id', 'language_id', 'level_id', 'instructor_ids', 'duration', 'capacity', 'start_date'];
                    $step_3_errors = ['price', 'discount_type', 'discount', 'discount_period', 'renew_after'];
                    $step_6_errors = ['LiveClassmeetingMethod', 'liveClassDescription', 'LiveClassmeetingLink', 'LiveClassmeetingPassword', 'LiveClassMeetingID'];

                    foreach ($step_1_errors as $step1) {
                        if ($errors->has($step1)) {
                            $step_1_error = true;
                            $request_tab = 'basic';
                            break;
                        }
                    }

                    if ($errors->has('video')) {
                        $step_2_error = true;
                    }

                    foreach ($step_3_errors as $step3) {
                        if ($errors->has($step3)) {
                            $step_3_error = true;
                            if(!$step_1_error)
                                $request_tab = 'pricing';
                            break;
                        }
                    }
                    foreach ($step_6_errors as $step6) {
                        if ($errors->has($step6)) {
                            $step_6_error = true;
                            if(!$step_1_error && !$step_3_error)
                                $request_tab = 'LiveClass';
                            break;
                        }
                    }
                @endphp
                <div class="default-tab-list bg-white redious-border p-20 p-sm-30">
                    <ul class="nav justify-content-center pb-40 mb-0 d-none" id="pills-tab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'basic' ? 'active ' : '' }}{{ $step_1_error ? 'text-danger' : '' }}"
                               data-tab="basic" id="basicInformation" data-bs-toggle="pill"
                               data-bs-target="#basicCourseInformation" role="tab"
                               aria-controls="basicCourseInformation" aria-selected="true">
                                <span
                                    class="default-tab-count {{ $step_1_error ? 'bg-danger text-white' : '' }}">1</span>{{ __('basic_information') }}
                            </a>
                        </li>
<li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'masterclass' ? 'active' : '' }}"
                               data-tab="masterclass" id="masterclass" data-bs-toggle="pill" data-bs-target="#courseMasterclass"
                               role="tab" aria-controls="courseMasterclass" aria-selected="false">
                                <span class="default-tab-count masterclassIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 2 }}
                                    @else
                                        {{ 2 }}
                                    @endif
                                </span>
                                {{ __('Masterclass Landing') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'mediaImages' ? 'active' : '' }}"
                               data-tab="mediaImages" id="mediaImages" data-bs-toggle="pill"
                               data-bs-target="#courseMediaImages" role="tab" aria-controls="courseMediaImages"
                               aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_2_error  ? 'bg-danger text-white' : '' }}">3</span>{{ __('media_images') }}
                            </a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $request_tab == 'pricing' ? 'active ' : '' }} {{ $step_3_error ? 'text-danger' : '' }}"
                               data-tab="pricing" id="pricing" data-bs-toggle="pill" data-bs-target="#coursePricing"
                               role="tab" aria-controls="coursePricing" aria-selected="false">
                                <span
                                    class="default-tab-count {{ $step_3_error  ? 'bg-danger text-white' : '' }}">4</span>{{ __('pricing') }}
                            </a>
                        </li>


                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'curriculum' ? 'active' : '' }}"
                               data-tab="curriculum" id="curriculum" data-bs-toggle="pill"
                               data-bs-target="#courseCurriculum" role="tab" aria-controls="courseCurriculum"
                               aria-selected="false"><span class="default-tab-count ">5</span> {{ __('curriculum') }}
                            </a>
                        </li>
                        <li class="nav-item {{ $course->course_type == 'live_class' ? '' : 'd-none' }}"
                            id="notLiveClass"
                            role="presentation">
                            <a class="nav-link tab_change {{ $step_6_error ? 'text-danger ' : '' }} {{ $request_tab == 'LiveClass' ? 'active' : '' }}"
                               data-tab="live_class" id="live_class" data-bs-toggle="pill"
                               data-bs-target="#courseLiveClass" role="tab" aria-controls="courseLiveClass"
                               aria-selected="false"><span class="default-tab-count {{ $step_6_error ? 'bg-danger text-white' : '' }}"> 6 </span> {{ __('Live Class') }}
                            </a>
                        </li>



                        <li class="nav-item" role="presentation">
                            <a class="nav-link tab_change {{ $step_1_error || $step_2_error || $step_3_error }} {{ $request_tab == 'faq' ? 'active' : '' }}"
                               data-tab="faq" id="faq" data-bs-toggle="pill" data-bs-target="#courseFAQ"
                               role="tab" aria-controls="courseFAQ" aria-selected="false">
                                <span class="default-tab-count coursefaqIndex">
                                    @if ($course->course_type == 'live_class')
                                        {{ 7 }}
                                    @else
                                        {{ 6 }}
                                    @endif
                                </span>
                                {{ __('faq') }}
                            </a>
                        </li>
                        
                    </ul>
                    <!-- End Edit Course tab menu -->

                    <form action="{{ route('courses.update', $course->id) }}" method="POST"
                          enctype="multipart/form-data">@csrf
                        @method('PUT')
                        <input type="hidden" name="tab" id="form_active_tab" value="{{ $request_tab }}">
                        <div class="tab-content" id="mgCourse-tabContent">
                            <div
                                class="tab-pane fade {{ $request_tab == 'basic' ? 'show active' : '' }} {{ $step_1_error ? 'show active' : '' }}"
                                id="basicCourseInformation" role="tabpanel" aria-labelledby="basicInformation"
                                tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="courseTitle" class="form-label">{{ __('course_title') }}</label>
                                            <textarea class="form-control rounded-2 ai_content_name summernote-title" id="courseTitle"
                                                      name="title" rows="3" data-height="120">{!! old('title', $course->title) !!}</textarea>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('title') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Course Title -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="courseSubtitle" class="form-label">Course Subtitle</label>
                                            <textarea class="form-control rounded-2 summernote-title" name="course_subtitle" id="courseSubtitle" rows="3" data-height="120">{!! old('course_subtitle', $course->course_subtitle) !!}</textarea>
                                        </div>
                                    </div>
                                    <!-- End Course Subtitle -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <div class="d-flex justify-content-between">
                                                <label for="shortDescription"
                                                       class="form-label">{{ __('short_description') }}</label>
                                                @include('backend.common.ai_btn', [
                                                    'name' => 'ai_short_description',
                                                    'length' => '200',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'short description for course',
                                                ])
                                            </div>
                                            <textarea class="form-control" name="short_description"
                                                      id="shortDescription">{{ old('short_description', $course->short_description) }}</textarea>
                                        </div>
                                    </div>
                                    <!-- End Short Description -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="descriptionSubtitle" class="form-label">Description Subtitle</label>
                                            <textarea class="form-control rounded-2 summernote-title" name="description_subtitle" id="descriptionSubtitle" rows="3" data-height="120">{!! old('description_subtitle', $course->description_subtitle) !!}</textarea>
                                        </div>
                                    </div>
                                    <!-- End Description Subtitle -->

                                    @php
                                        $mc_settings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings, true);
                                        $mc_settings = $mc_settings ?: [];
                                    @endphp
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="overview_btn_text" class="form-label">Hero Button Text</label>
                                            <input type="text" class="form-control" name="masterclass_settings[overview_btn_text]" id="overview_btn_text" value="{{ old('masterclass_settings.overview_btn_text', $mc_settings['overview_btn_text'] ?? '') }}">
                                        </div>
                                    </div>
                                    <!-- End Hero Button Text -->

                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <label for="overview_btn_url" class="form-label">Hero Button Link</label>
                                            <input type="text" class="form-control" name="masterclass_settings[overview_btn_url]" id="overview_btn_url" value="{{ old('masterclass_settings.overview_btn_url', $mc_settings['overview_btn_url'] ?? '') }}">
                                        </div>
                                    </div>
                                    <!-- End Hero Button Link -->

                                    <div class="col-lg-12">
                                        <div class="editor-wrapper">
                                            <div class="d-flex justify-content-between">
                                                <label class="form-label mb-1">{{ __('description') }}</label>
                                                @include('backend.common.ai_btn', [
                                                    'name' => 'ai_description',
                                                    'length' => '259',
                                                    'topic' => 'ai_content_name',
                                                    'use_case' => 'long description  for course',
                                                    'long_description' => 1,
                                                ])
                                            </div>
                                            <textarea id="product-update-editor"
                                                      name="description">{!! old('description', $course->description) !!}</textarea>
                                        </div>

                                                                                <!-- Hidden inputs for status and private course to maintain existing data without showing UI -->
                                        <input type="hidden" name="is_private" value="{{ $course->is_private }}">
                                        <input type="hidden" name="status" value="{{ $course->status }}">
                                    </div>
                                    <!-- End Description -->

                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Basic Course Information -->
<!-- Start Masterclass Landing Tab -->
                            <div class="tab-pane fade {{ $request_tab == 'desc_right_box' ? 'show active' : '' }}"
                                 id="courseDescRightBox" role="tabpanel" aria-labelledby="desc_right_box" tabindex="0">
                                @php
                                    $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
                                    if(!is_array($mcSettings)) $mcSettings = [];

                                    $defEyebrow = !empty($mcSettings['eyebrow_title']) ? $mcSettings['eyebrow_title'] : '';
                                    $defPrimaryCta = !empty($mcSettings['primary_cta_text']) ? $mcSettings['primary_cta_text'] : '';
                                    $defVideoCaption = !empty($mcSettings['video_caption']) ? $mcSettings['video_caption'] : '';
                                    $defRemainingSeats = !empty($mcSettings['remaining_seats']) ? $mcSettings['remaining_seats'] : ($course->capacity > 0 ? $course->capacity : '100');
                                    $availSeatsCount = max(0, (int)$defRemainingSeats - (int)($course->total_enrolled ?? 0));

                                    $defGoldBadgeTop = !empty($mcSettings['gold_badge_top']) ? $mcSettings['gold_badge_top'] : '';
                                    $defZoomTitle = !empty($mcSettings['zoom_title']) ? $mcSettings['zoom_title'] : '';
                                    $defZoomSubtitle = !empty($mcSettings['zoom_subtitle']) ? $mcSettings['zoom_subtitle'] : '';
                                    $defScheduleLabel = !empty($mcSettings['schedule_label']) ? $mcSettings['schedule_label'] : '';
                                    $defScheduleValue = !empty($mcSettings['schedule_value']) ? $mcSettings['schedule_value'] : '';
                                    $defLevelLabel = !empty($mcSettings['level_label']) ? $mcSettings['level_label'] : '';
                                    $defLevelValue = !empty($mcSettings['level_value']) ? $mcSettings['level_value'] : '';
                                    $defGoldOfferTitle = !empty($mcSettings['gold_offer_title']) ? $mcSettings['gold_offer_title'] : '';
                                    $defOriginalPriceLabel = !empty($mcSettings['original_price_label']) ? $mcSettings['original_price_label'] : '';
                                    $defGoldCtaText = !empty($mcSettings['gold_cta_text']) ? $mcSettings['gold_cta_text'] : '';
                                    
                                    if (!empty($mcSettings['gold_seats_text'])) {
                                        $defGoldSeatsText = preg_match('/\d+/', $mcSettings['gold_seats_text'])
                                            ? preg_replace('/\d+/', $availSeatsCount, $mcSettings['gold_seats_text'])
                                            : $mcSettings['gold_seats_text'];
                                    } else {
                                        $defGoldSeatsText = '';
                                    }

                                    $defBenefitsTitle = !empty($mcSettings['benefits_title']) ? $mcSettings['benefits_title'] : '';
                                    
                                    $benefitsList = [];
                                    if (!empty($mcSettings['benefits_list']) && is_array($mcSettings['benefits_list'])) {
                                        $benefitsList = array_values(array_filter(array_map('trim', $mcSettings['benefits_list'])));
                                    } elseif (!empty($mcSettings['benefits_items'])) {
                                        $lines = array_filter(array_map('trim', explode("\n", $mcSettings['benefits_items'])));
                                        $benefitsList = array_values($lines);
                                    } elseif (!empty($course->what_will_learn)) {
                                        $lines = array_filter(array_map('trim', explode("\n", strip_tags($course->what_will_learn))));
                                        $benefitsList = array_values($lines);
                                    }
                                    if (empty($benefitsList)) {
                                        $benefitsList = [];
                                    }

                                    $defGiftBadge = !empty($mcSettings['gift_badge']) ? $mcSettings['gift_badge'] : '';
                                    $defGiftTitle = !empty($mcSettings['gift_title']) ? $mcSettings['gift_title'] : '';
                                    $defGiftValue = !empty($mcSettings['gift_value']) ? $mcSettings['gift_value'] : '';
                                    $defGiftDescription = !empty($mcSettings['gift_description']) ? $mcSettings['gift_description'] : '';
                                    $defGiftQuote = !empty($mcSettings['gift_quote']) ? $mcSettings['gift_quote'] : '';
                                    $defGiftFooterNote = !empty($mcSettings['gift_footer_note']) ? $mcSettings['gift_footer_note'] : '';
                                    $defSupportTitle = !empty($mcSettings['support_title']) ? $mcSettings['support_title'] : '';
                                    $defSupportDescription = !empty($mcSettings['support_description']) ? $mcSettings['support_description'] : '';
                                    $defGiftCtaText = !empty($mcSettings['gift_cta_text']) ? $mcSettings['gift_cta_text'] : '';
                                    $defGiftCtaLink = !empty($mcSettings['gift_cta_link']) ? $mcSettings['gift_cta_link'] : '';

                                    $defScheduleBadge = !empty($mcSettings['schedule_badge']) ? $mcSettings['schedule_badge'] : '';
                                    $defClassScheduleTitle = !empty($mcSettings['class_schedule_title']) ? $mcSettings['class_schedule_title'] : '';
                                    $defClassScheduleTime = !empty($mcSettings['class_schedule_time']) ? $mcSettings['class_schedule_time'] : '';

                                    $defExplainerTitle = !empty($mcSettings['explainer_title']) ? $mcSettings['explainer_title'] : '';
                                    $defExplainerText = !empty($mcSettings['explainer_text']) ? $mcSettings['explainer_text'] : '';

                                    $defBreakdownSubheading = !empty($mcSettings['breakdown_subheading']) ? $mcSettings['breakdown_subheading'] : "";
                                    $defBreakdownTodayTitle = !empty($mcSettings['breakdown_today_title']) ? $mcSettings['breakdown_today_title'] : "";
                                    $defBreakdownItems = !empty($mcSettings['breakdown_items']) ? $mcSettings['breakdown_items'] : "";
                                    $defBreakdownCtaText = !empty($mcSettings['breakdown_cta_text']) ? $mcSettings['breakdown_cta_text'] : '';
                                    $defBreakdownCtaLink = !empty($mcSettings['breakdown_cta_link']) ? $mcSettings['breakdown_cta_link'] : '';

                                    $defOrderFormTitle = !empty($mcSettings['order_form_title']) ? $mcSettings['order_form_title'] : '';
                                    $defOrderFormSubtitle = !empty($mcSettings['order_form_subtitle']) ? $mcSettings['order_form_subtitle'] : '';
                                    $defNameLabel = !empty($mcSettings['name_label']) ? $mcSettings['name_label'] : '';
                                    $defNamePlaceholder = !empty($mcSettings['name_placeholder']) ? $mcSettings['name_placeholder'] : '';
                                    $defPhoneLabel = !empty($mcSettings['phone_label']) ? $mcSettings['phone_label'] : '';
                                    $defPhonePlaceholder = !empty($mcSettings['phone_placeholder']) ? $mcSettings['phone_placeholder'] : '';
                                    $defEmailLabel = !empty($mcSettings['email_label']) ? $mcSettings['email_label'] : '';
                                    $defEmailPlaceholder = !empty($mcSettings['email_placeholder']) ? $mcSettings['email_placeholder'] : '';
                                    $defAddressLabel = !empty($mcSettings['address_label']) ? $mcSettings['address_label'] : '';
                                    $defAddressPlaceholder = !empty($mcSettings['address_placeholder']) ? $mcSettings['address_placeholder'] : '';
                                    $defPasswordLabel = !empty($mcSettings['password_label']) ? $mcSettings['password_label'] : '';
                                    $defPasswordPlaceholder = !empty($mcSettings['password_placeholder']) ? $mcSettings['password_placeholder'] : '';
                                    $defTermsLabel = !empty($mcSettings['terms_label']) ? $mcSettings['terms_label'] : '';
                                    $defOrderSummaryTitle = !empty($mcSettings['order_summary_title']) ? $mcSettings['order_summary_title'] : '';
                                    $defPayNowBtnText = !empty($mcSettings['pay_now_btn_text']) ? $mcSettings['pay_now_btn_text'] : '';
                                    $defPrivacyNotice = !empty($mcSettings['privacy_notice']) ? $mcSettings['privacy_notice'] : '';

                                    $defFaqTitle = !empty($mcSettings['faq_title']) ? $mcSettings['faq_title'] : '';

                                    $faqList = [];
                                    if (!empty($mcSettings['faq_list']) && is_array($mcSettings['faq_list'])) {
                                        $faqList = $mcSettings['faq_list'];
                                    } elseif (!empty($mcSettings['faq_items'])) {
                                        $lines = array_filter(array_map('trim', explode("\n", $mcSettings['faq_items'])));
                                        foreach ($lines as $line) {
                                            $parts = explode('|', $line);
                                            if (isset($parts[0]) && isset($parts[1])) {
                                                $faqList[] = [
                                                    'question' => trim($parts[0]),
                                                    'answer'   => trim($parts[1])
                                                ];
                                            }
                                        }
                                    }
                                    if (empty($faqList)) {
                                        $faqList = [];
                                    }

                                    $defDualCtaLeft = !empty($mcSettings['dual_cta_left']) ? $mcSettings['dual_cta_left'] : '';
                                    $defDualCtaSeats = !empty($mcSettings['dual_cta_seats']) ? $mcSettings['dual_cta_seats'] : '';

                                    $defOverviewTag = !empty($mcSettings['overview_tag']) ? $mcSettings['overview_tag'] : '';
                                    $defOverviewTitle = !empty($mcSettings['overview_title']) ? $mcSettings['overview_title'] : '';
                                    $defOverviewDesc1 = !empty($mcSettings['overview_desc1']) ? $mcSettings['overview_desc1'] : '';
                                    $defOverviewDesc2 = !empty($mcSettings['overview_desc2']) ? $mcSettings['overview_desc2'] : '';
                                    $defOverviewBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : '';
                                    $defOverviewBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : '';
                                    $defOverviewImageUrl = !empty($mcSettings['overview_image_url']) ? $mcSettings['overview_image_url'] : '';
                                    $defHideOverviewSection = !empty($mcSettings['hide_overview_section']);

                                    $defDescRightTitle  = $mcSettings['desc_right_title'] ?? '';
                                    $defDescStep1Title  = $mcSettings['desc_step_1_title'] ?? '';
                                    $defDescStep1Sub    = $mcSettings['desc_step_1_sub'] ?? '';
                                    $defDescStep2Title  = $mcSettings['desc_step_2_title'] ?? '';
                                    $defDescStep2Sub    = $mcSettings['desc_step_2_sub'] ?? '';
                                    $defDescStep3Title  = $mcSettings['desc_step_3_title'] ?? '';
                                    $defDescStep3Sub    = $mcSettings['desc_step_3_sub'] ?? '';
                                    $defDescBannerIcon  = $mcSettings['desc_banner_icon'] ?? '';
                                    $defDescBannerTitle = $mcSettings['desc_banner_title'] ?? '';
                                    $defDescBannerSub   = $mcSettings['desc_banner_sub'] ?? '';
                                @endphp
                                
                                <div class="masterclass-single-page-wrapper">
                                    <!-- Course Description Right Feature Card -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                                             <label class="form-label m-0 cursor-pointer" for="show_desc_right_box">Course Description Right Box Settings</label>
                                             <div class="setting-check m-0" style="cursor: pointer;" onclick="var cb = this.querySelector('input[type=checkbox]'); if (event.target !== cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
                                                 <input type="hidden" name="masterclass_settings[show_desc_right_box]" value="0">
                                                 <input type="checkbox" name="masterclass_settings[show_desc_right_box]" value="1" id="show_desc_right_box" style="position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;"
                                                     {{ !isset($mcSettings['show_desc_right_box']) || !empty($mcSettings['show_desc_right_box']) ? 'checked' : '' }}>
                                                 <label for="show_desc_right_box" class="m-0" style="cursor: pointer;"></label>
                                             </div>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <div class="col-lg-12 mb-4">
                                                    <label class="form-label">Top Subtitle / Heading</label>
                                                    <textarea name="masterclass_settings[desc_right_title]" class="form-control rounded-2 summernote-title"
                                                              rows="2" data-height="110">{!! $defDescRightTitle !!}</textarea>

                                                </div>

                                                <!-- 3 Timeline Steps -->
                                                <div class="col-12 mb-4">
                                                    <label class="form-label">Timeline Steps</label>
                                                    <div class="row g-3">
                                                        <div class="col-md-4">
                                                            <div class="p-3 bg-light rounded-3 border">
                                                                <label class="form-label mb-2">Step 1</label>
                                                                <label class="form-label">Title</label>
                                                                <input type="text" name="masterclass_settings[desc_step_1_title]" class="form-control rounded-2 bg-white mb-2"
                                                                       value="{{ $defDescStep1Title }}">
                                                                <label class="form-label">Subtitle</label>
                                                                <input type="text" name="masterclass_settings[desc_step_1_sub]" class="form-control rounded-2 bg-white"
                                                                       value="{{ $defDescStep1Sub }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="p-3 bg-light rounded-3 border">
                                                                <label class="form-label mb-2">Step 2</label>
                                                                <label class="form-label">Title</label>
                                                                <input type="text" name="masterclass_settings[desc_step_2_title]" class="form-control rounded-2 bg-white mb-2"
                                                                       value="{{ $defDescStep2Title }}">
                                                                <label class="form-label">Subtitle</label>
                                                                <input type="text" name="masterclass_settings[desc_step_2_sub]" class="form-control rounded-2 bg-white"
                                                                       value="{{ $defDescStep2Sub }}">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="p-3 bg-light rounded-3 border">
                                                                <label class="form-label mb-2">Step 3</label>
                                                                <label class="form-label">Title</label>
                                                                <input type="text" name="masterclass_settings[desc_step_3_title]" class="form-control rounded-2 bg-white mb-2"
                                                                       value="{{ $defDescStep3Title }}">
                                                                <label class="form-label">Subtitle</label>
                                                                <input type="text" name="masterclass_settings[desc_step_3_sub]" class="form-control rounded-2 bg-white"
                                                                       value="{{ $defDescStep3Sub }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>


                                                <!-- Highlight Banner Card -->
                                                <div class="col-12">
                                                    <label class="form-label">Highlight Banner Card</label>
                                                    <div class="row g-3">
                                                        <div class="col-md-12">
                                                            <label class="form-label">Card Heading</label>
                                                            <textarea name="masterclass_settings[desc_banner_title]" class="form-control rounded-2 summernote-title"
                                                                      rows="2" data-height="110">{!! $defDescBannerTitle !!}</textarea>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <label class="form-label">Card Subtitle</label>
                                                            <textarea name="masterclass_settings[desc_banner_sub]" class="form-control rounded-2 summernote-title"
                                                                      rows="2" data-height="110">{!! $defDescBannerSub !!}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                                        </div> <!-- End masterclass-single-page-wrapper -->
                                    </div>
                                    <div class="tab-pane fade {{ $request_tab == 'benefits' ? 'show active' : '' }}"
                                         id="courseBenefits" role="tabpanel" aria-labelledby="benefits" tabindex="0">
                                        <div class="masterclass-single-page-wrapper">
                                    <!-- Section 3: Benefits Section -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3 d-flex align-items-center justify-content-between">
                                            <span class="form-label m-0">Benefits & Target Audience</span>
                                            <button type="button" class="btn sg-btn-primary btn-sm rounded-2" id="add_new_benefit_btn">
                                                Add New Benefit Point <i class="las la-plus ms-1"></i>
                                            </button>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                 <div class="col-12 mb-4">
                                                     <div class="d-flex align-items-center justify-content-between">
                                                         <label class="form-label mb-0 fw-semibold cursor-pointer" for="show_benefits_section">{{ __('Show Benefits & Target Audience Section') }}</label>
                                                         <div class="setting-check m-0" style="cursor: pointer;" onclick="var cb = this.querySelector('input[type=checkbox]'); if (event.target !== cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
                                                             <input type="hidden" name="masterclass_settings[show_benefits_section]" value="0">
                                                             <input type="hidden" name="masterclass_settings[benefits_status]" id="hidden_benefits_status" value="{{ (isset($mcSettings['show_benefits_section']) ? !empty($mcSettings['show_benefits_section']) : (!isset($mcSettings['benefits_status']) || !empty($mcSettings['benefits_status']))) ? 1 : 0 }}">
                                                             <input type="checkbox" name="masterclass_settings[show_benefits_section]" value="1" id="show_benefits_section" style="position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;"
                                                                 {{ (isset($mcSettings['show_benefits_section']) ? !empty($mcSettings['show_benefits_section']) : (!isset($mcSettings['benefits_status']) || !empty($mcSettings['benefits_status']))) ? 'checked' : '' }}
                                                                 onchange="document.getElementById('hidden_benefits_status').value = this.checked ? 1 : 0;">
                                                             <label class="m-0" style="cursor: pointer;"></label>
                                                         </div>
                                                     </div>
                                                 </div>

                                                <div class="col-lg-12 mb-4">
                                                    <label class="form-label">Benefits Heading</label>
                                                    <textarea name="masterclass_settings[benefits_title]" class="form-control rounded-2 summernote-title"
                                                              rows="2" data-height="110">{!! $defBenefitsTitle !!}</textarea>

                                                </div>

                                                <div class="col-12 mb-2">
                                                    <label class="form-label mb-2">Benefit Items</label>
                                                    <div id="benefits_items_container">
                                                        @foreach($benefitsList as $bIdx => $bItem)
                                                            <div class="benefit-single-item d-flex align-items-center gap-2 mb-3">
                                                                <span class="badge bg-light text-dark border p-2 font-13"><span class="benefit-num">{{ $bIdx + 1 }}</span></span>
                                                                <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white"
                                                                       value="{{ $bItem }}">
                                                                <a href="javascript:void(0)" class="btn btn-sm text-danger border-0 remove-benefit-btn ms-1">
                                                                    <i class="las la-trash-alt fs-5"></i>
                                                                </a>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                                        </div> <!-- End masterclass-single-page-wrapper -->
                                    </div>
                                    <div class="tab-pane fade {{ $request_tab == 'gift_banner' ? 'show active' : '' }}"
                                         id="courseGiftBanner" role="tabpanel" aria-labelledby="gift_banner" tabindex="0">
                                        <div class="masterclass-single-page-wrapper">
                                    <!-- Section 4: Special Bonus Gift -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label m-0">Special Gift Banner Offer</span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                 <div class="col-12 mb-4">
                                                     <div class="d-flex align-items-center justify-content-between">
                                                         <label class="form-label mb-0 fw-semibold cursor-pointer" for="show_gift">Show Special Gift Banner Card</label>
                                                         <div class="setting-check m-0" style="cursor: pointer;" onclick="var cb = this.querySelector('input[type=checkbox]'); if (event.target !== cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
                                                             <input type="checkbox" name="masterclass_settings[show_special_gift]" value="1" id="show_gift" style="position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;"
                                                                 {{ isset($mcSettings['show_special_gift']) ? ($mcSettings['show_special_gift'] ? 'checked' : '') : (empty($mcSettings['hide_special_gift']) ? 'checked' : '') }}>
                                                             <label for="show_gift" class="m-0" style="cursor: pointer;"></label>
                                                         </div>
                                                     </div>
                                                 </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Pill / Badge Text</label>
                                                    <textarea name="masterclass_settings[gift_badge]" class="form-control rounded-2 summernote-title"
                                                              rows="2" data-height="100">{!! $defGiftBadge !!}</textarea>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Title</label>
                                                    <textarea name="masterclass_settings[gift_title]" class="form-control rounded-2 summernote-title"
                                                              rows="2" data-height="110">{!! $defGiftTitle !!}</textarea>

                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Original Gift Value</label>
                                                    <input type="text" name="masterclass_settings[gift_value]" class="form-control rounded-2"
                                                           value="{{ $defGiftValue }}">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Red CTA Text</label>
                                                    <input type="text" name="masterclass_settings[gift_cta_text]" class="form-control rounded-2"
                                                           value="{{ $defGiftCtaText }}">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Gift Red CTA Link</label>
                                                    <input type="text" name="masterclass_settings[gift_cta_link]" class="form-control rounded-2"
                                                           value="{{ $defGiftCtaLink }}">
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <label class="form-label">Gift Description</label>
                                                    <textarea name="masterclass_settings[gift_description]" class="form-control rounded-2 summernote" rows="3">{{ $defGiftDescription }}</textarea>
                                                </div>

                                                <div class="col-lg-12 col-md-12 mb-4">
                                                    <div class="d-flex justify-content-between align-items-center mb-2">
                                                        <label class="form-label mb-0">Gift Quotes / Items</label>
                                                        <button type="button" class="btn sg-btn-primary btn-sm" id="add_gift_quote_btn">
                                                            <i class="las la-plus"></i> Add Item
                                                        </button>
                                                    </div>
                                                    <div id="gift_quotes_container">
                                                        @php
                                                            $giftQuotesList = !empty($mcSettings['gift_quotes_list']) ? $mcSettings['gift_quotes_list'] : [];
                                                            if (!is_array($giftQuotesList)) $giftQuotesList = [];
                                                            if (empty($giftQuotesList) && !empty($defGiftQuote)) {
                                                                $giftQuotesList = [['text' => strip_tags($defGiftQuote), 'price' => '']];
                                                            }
                                                        @endphp
                                                        @foreach($giftQuotesList as $gqIdx => $gqItem)
                                                            <div class="gift-quote-single-item p-3 mb-3 border rounded bg-light position-relative">
                                                                <div class="d-flex justify-content-between align-items-center mb-2">
                                                                    <span class="fw-bold">Item <span class="gift-quote-num">{{ $gqIdx + 1 }}</span></span>
                                                                    <button type="button" class="btn btn-sm text-danger remove-gift-quote-btn p-0 bg-transparent border-0">
                                                                        <i class="las la-trash-alt fs-5"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="row g-3">
                                                                    <div class="col-md-7">
                                                                        <label class="form-label mb-1">Text / Quote <span class="text-muted fw-normal">(Optional)</span></label>
                                                                        <textarea name="masterclass_settings[gift_quotes_list][{{ $gqIdx }}][text]" class="form-control rounded-2 bg-white summernote gift-quote-text" rows="2">{{ $gqItem['text'] ?? '' }}</textarea>
                                                                    </div>
                                                                    <div class="col-md-5">
                                                                        <div class="mb-3">
                                                                            <label class="form-label mb-1">Price <span class="text-muted fw-normal">(Optional)</span></label>
                                                                            <input type="text" name="masterclass_settings[gift_quotes_list][{{ $gqIdx }}][price]" class="form-control rounded-2 bg-white gift-quote-price" placeholder="e.g. 3000" value="{{ $gqItem['price'] ?? '' }}">
                                                                        </div>
                                                                        @php
                                                                            $cardMediaId = $gqItem['media_id'] ?? '';
                                                                            $cardMedia = null;
                                                                            if (!empty($cardMediaId)) {
                                                                                $cardMedia = \App\Models\MediaLibrary::find($cardMediaId);
                                                                            } elseif (!empty($gqItem['image'])) {
                                                                                if (is_numeric($gqItem['image'])) {
                                                                                    $cardMedia = \App\Models\MediaLibrary::find($gqItem['image']);
                                                                                    if ($cardMedia) {
                                                                                        $cardMediaId = $cardMedia->id;
                                                                                    }
                                                                                } else {
                                                                                    $imgBasename = basename($gqItem['image']);
                                                                                    $cardMedia = \App\Models\MediaLibrary::where('image_variants', 'like', "%{$imgBasename}%")->first();
                                                                                    if ($cardMedia) {
                                                                                        $cardMediaId = $cardMedia->id;
                                                                                    }
                                                                                }
                                                                            }
                                                                            $hasMedia = $cardMedia && $cardMedia->image_variants && arrayCheck('image_80x80', $cardMedia->image_variants) && is_file_exists($cardMedia->image_variants['image_80x80'], $cardMedia->image_variants['storage']);
                                                                            $customImageUrl = (!$hasMedia && !empty($gqItem['image'])) ? $gqItem['image'] : '';
                                                                            $isSelected = $hasMedia || !empty($customImageUrl);
                                                                        @endphp
                                                                        <div class="gift-quote-img-field">
                                                                            <input type="hidden" name="masterclass_settings[gift_quotes_list][{{ $gqIdx }}][image]" class="gift-quote-image-val" value="{{ $gqItem['image'] ?? '' }}">
                                                                            
                                                                            <div class="custom-image mb-2">
                                                                                <div class="gallery-modal" data-for="image" data-selection="single">
                                                                                    <label class="form-label mb-1">Item Image <span class="text-muted fw-normal">(Optional)</span></label>
                                                                                    <div class="file-upload-text">
                                                                                        <p><span class="file_selected">{{ $isSelected ? '1' : '0' }} </span>{{ __('files_selected') }}</p>
                                                                                        <span class="file-btn">{{ __('choose_file') }}</span>
                                                                                    </div>
                                                                                    <input class="d-none gift-quote-media-id-input" type="hidden" name="masterclass_settings[gift_quotes_list][{{ $gqIdx }}][media_id]" value="{{ $cardMediaId }}">
                                                                                </div>
                                                                                <div class="selected-files d-flex flex-wrap gap-20">
                                                                                    @if($hasMedia)
                                                                                        <div class="selected-files-item">
                                                                                            <img src="{{ getFileLink('80x80', $cardMedia->image_variants) }}"
                                                                                                 alt="{{ $cardMedia->name }}"
                                                                                                 class="selected-img">
                                                                                            <div class="remove-icon" data-id="{{ $cardMedia->id }}">
                                                                                                <i class="las la-times"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    @elseif($customImageUrl)
                                                                                        <div class="selected-files-item">
                                                                                            <img src="{{ dynamic_asset($customImageUrl) }}"
                                                                                                 alt="image"
                                                                                                 class="selected-img">
                                                                                            <div class="remove-icon" data-id="">
                                                                                                <i class="las la-times"></i>
                                                                                            </div>
                                                                                        </div>
                                                                                    @endif
                                                                                    <div class="selected-files-item {{ $isSelected ? 'd-none' : '' }}">
                                                                                        <img class="selected-img"
                                                                                             src="{{ static_asset('images/default/default-image-80x80.png') }}"
                                                                                             alt="default">
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                                        </div> <!-- End masterclass-single-page-wrapper -->
                                    </div>
                                    <div class="tab-pane fade {{ $request_tab == 'offer_breakdown' ? 'show active' : '' }}"
                                         id="courseOfferBreakdown" role="tabpanel" aria-labelledby="offer_breakdown" tabindex="0">
                                        <div class="masterclass-single-page-wrapper">
                                    <!-- Section 3.5: Offer Breakdown -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label m-0">Offer Breakdown Section</span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                 <div class="col-12 mb-3">
                                                     <div class="d-flex align-items-center justify-content-between">
                                                         <label class="form-label mb-0 fw-semibold cursor-pointer" for="breakdown_status">{{ __('Show Offer Breakdown Section') }}</label>
                                                         <div class="setting-check m-0" style="cursor: pointer;" onclick="var cb = this.querySelector('input[type=checkbox]'); if (event.target !== cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
                                                             <input type="checkbox" name="masterclass_settings[breakdown_status]" value="1" id="breakdown_status" style="position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;" {{ !empty($mcSettings['breakdown_status']) ? 'checked' : '' }}>
                                                             <label class="m-0" style="cursor: pointer;"></label>
                                                         </div>
                                                     </div>
                                                 </div>

                                                <div class="col-lg-12 mb-4">
                                                    <label class="form-label">Breakdown Today Title</label>
                                                    <textarea name="masterclass_settings[breakdown_today_title]" class="form-control rounded-2 summernote-title"
                                                              rows="2" data-height="110">{!! $defBreakdownTodayTitle !!}</textarea>

                                                </div>

                                                <div class="col-lg-12 mb-4">
                                                    <label class="form-label">Bottom Subheading</label>
                                                    <textarea name="masterclass_settings[breakdown_subheading]" class="form-control rounded-2 summernote-title"
                                                              rows="2" data-height="110">{!! $defBreakdownSubheading !!}</textarea>
                                                </div>

                                                <div class="col-lg-6 mb-4">
                                                    <label class="form-label">Original Price (Strikethrough)</label>
                                                    <input type="text" name="masterclass_settings[breakdown_original_price]" class="form-control rounded-2"
                                                           value="{{ $mcSettings['breakdown_original_price'] ?? '' }}">
                                                </div>

                                                <div class="col-12 mb-4">
                                                    <label class="form-label mb-2">Breakdown Items (One per line, Format: Title | Price)</label>
                                                    <textarea name="masterclass_settings[breakdown_items]" class="form-control rounded-2" rows="6">{{ $defBreakdownItems }}</textarea>
                                                    <small class="text-muted">Separate title and price with a pipe (|) character.</small>
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Breakdown Red CTA Text</label>
                                                    <input type="text" name="masterclass_settings[breakdown_cta_text]" class="form-control rounded-2"
                                                           value="{{ $defBreakdownCtaText }}">
                                                </div>

                                                <div class="col-lg-6 col-md-6 mb-4">
                                                    <label class="form-label">Breakdown Red CTA Link</label>
                                                    <input type="text" name="masterclass_settings[breakdown_cta_link]" class="form-control rounded-2"
                                                           value="{{ $defBreakdownCtaLink }}">
                                                </div>
                                            </div>
                                        </div>
                                     </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                                        </div> <!-- End masterclass-single-page-wrapper -->
                                    </div>
                                    <div class="tab-pane fade {{ $request_tab == 'ad_banners' ? 'show active' : '' }}"
                                         id="courseAdBanners" role="tabpanel" aria-labelledby="ad_banners" tabindex="0">
                                        <div class="masterclass-single-page-wrapper">
                                    <!-- Section 10: Masterclass Ad Banners (1 & 2) -->
                                    <div class="card border mb-4 rounded-3 shadow-sm">
                                        <div class="card-header bg-white py-3">
                                            <span class="form-label m-0">Ad Banners</span>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="row gx-20">
                                                <!-- Banner 1 -->
                                                <div class="col-12">
                                                    <label class="form-label mb-3 border-bottom pb-2 w-100">Ad Banner 1</label>
                                                </div>
                                                 <div class="col-lg-12 mb-4">
                                                     <div class="d-flex align-items-center justify-content-between">
                                                         <label class="form-label mb-0 fw-semibold cursor-pointer" for="ad_banner_1_status">{{ __('Enable Ad Banner 1') }}</label>
                                                         <div class="setting-check m-0" style="cursor: pointer;" onclick="var cb = this.querySelector('input[type=checkbox]'); if (event.target !== cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
                                                             <input type="checkbox" name="masterclass_settings[ad_banner_1_status]" value="1" id="ad_banner_1_status" style="position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;"
                                                                 {{ !empty($mcSettings['ad_banner_1_status']) ? 'checked' : '' }}>
                                                             <label class="m-0" style="cursor: pointer;"></label>
                                                         </div>
                                                     </div>
                                                 </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="form-label">Ad Banner Link URL 1</label>
                                                    <input type="text" name="masterclass_settings[ad_banner_1_link]" class="form-control rounded-2"
                                                           value="{{ $mcSettings['ad_banner_1_link'] ?? '' }}">
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    @include('backend.common.media-input', [
                                                        'title' => 'Ad Banner 1 Image',
                                                        'label' => 'Banner Image 1',
                                                        'for' => 'image',
                                                        'name' => 'ad_banner_1_media_id',
                                                        'col' => 'col-12',
                                                        'size' => '(1200x300)',
                                                        'image' => $mcSettings['ad_banner_1_media_id'] ?? ''
                                                    ])
                                                </div>

                                                <!-- Banner 2 -->
                                                <div class="col-12 mt-3">
                                                    <label class="form-label mb-3 border-bottom pb-2 w-100">Ad Banner 2</label>
                                                </div>
                                                 <div class="col-lg-12 mb-4">
                                                     <div class="d-flex align-items-center justify-content-between">
                                                         <label class="form-label mb-0 fw-semibold cursor-pointer" for="ad_banner_2_status">{{ __('Enable Ad Banner 2') }}</label>
                                                         <div class="setting-check m-0" style="cursor: pointer;" onclick="var cb = this.querySelector('input[type=checkbox]'); if (event.target !== cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
                                                             <input type="checkbox" name="masterclass_settings[ad_banner_2_status]" value="1" id="ad_banner_2_status" style="position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;"
                                                                 {{ !empty($mcSettings['ad_banner_2_status']) ? 'checked' : '' }}>
                                                             <label class="m-0" style="cursor: pointer;"></label>
                                                         </div>
                                                     </div>
                                                 </div>
                                                <div class="col-lg-6 mb-4">
                                                    <label class="form-label">Ad Banner Link URL 2</label>
                                                    <input type="text" name="masterclass_settings[ad_banner_2_link]" class="form-control rounded-2"
                                                           value="{{ $mcSettings['ad_banner_2_link'] ?? '' }}">
                                                </div>
                                                <div class="col-lg-6 mb-4">
                                                    @include('backend.common.media-input', [
                                                        'title' => 'Ad Banner 2 Image',
                                                        'label' => 'Banner Image 2',
                                                        'for' => 'image',
                                                        'name' => 'ad_banner_2_media_id',
                                                        'col' => 'col-12',
                                                        'size' => '(1200x300)',
                                                        'image' => $mcSettings['ad_banner_2_media_id'] ?? ''
                                                    ])
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                                        </div> <!-- End masterclass-single-page-wrapper -->
                                    </div>
                                    <div class="tab-pane fade {{ $request_tab == 'support' ? 'show active' : '' }}"
                                         id="courseSupport" role="tabpanel" aria-labelledby="support" tabindex="0">
                                        <div class="masterclass-single-page-wrapper">
                                    @include('backend.admin.course.masterclass_support')
                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">

                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Masterclass Landing Tab -->

                            <div
                                class="tab-pane fade {{ $request_tab == 'mediaImages' ? 'show active' : '' }}"
                                id="courseMediaImages" role="tabpanel" aria-labelledby="mediaImages" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-6 col-md-6">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="video_source"
                                                       class="form-label">{{ __('video_source') }}</label>
                                                <select id="video_source"
                                                        class="form-select form-select-lg mb-3 without_search"
                                                        name="video_source">
                                                    <option value="">{{ __('select_video_source') }}</option>
                                                    <option value="upload"
                                                        {{ old('video_source', $course->video_source) == 'upload' ? 'selected' : '' }}>
                                                        {{ __('upload') }}</option>

                                                    <option value="youtube"
                                                        {{ old('video_source', $course->video_source) == 'youtube' ? 'selected' : '' }}>
                                                        {{ __('youtube') }}</option>

                                                    <option value="vimeo"
                                                        {{ old('video_source', $course->video_source) == 'vimeo' ? 'selected' : '' }}>
                                                        {{ __('vimeo') }}</option>
                                                    <option value="mp4"
                                                        {{ old('video_source', $course->video_source) == 'mp4' ? 'selected' : '' }}>
                                                        {{ __('mp4') }}</option>
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('video_source') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Video Source -->
                                    <div
                                        class="col-lg-6 col-md-6 upload_div {{ old('video_source', $course->video_source) == 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-3">
                                            <label for="thumbnailFile"
                                                   class="form-label">{{ __('upload_video') }}</label>
                                            <label for="thumbnailFile" class="file-upload-text">
                                                <p class="file_name">
                                                    {{ getFileName(getArrayValue('image', $course->video)) }}</p>
                                                <span class="file-btn">{{ __('choose_file') }}</span>
                                            </label>
                                            <input class="d-none thumb_picker" name="video" type="file"
                                                   id="thumbnailFile">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video_file') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- End Upload Video -->
                                    <div
                                        class="col-lg-6 col-md-6 video_link {{ old('video_source', $course->video_source) && old('video_source', $course->video_source) != 'upload' ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="videoLink" class="form-label">{{ __('video_link') }}</label>
                                            <input type="text" class="form-control rounded-2" name="video_link"
                                                   id="videoLink"
                                                   value="{{ $course->video_source == 'upload' ? getFileName(getArrayValue('image', $course->video)) : $course->video }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('video') }}</p>
                                            </div>
                                        </div>
                                    </div>

                                    @include('backend.common.media-input', [
                                        'title' => 'Slider Image',
                                        'name' => 'image_media_id',
                                        'col' => 'col-12',
                                        'size' => '(402x248)',
                                        'image' => old('image_media_id', $course->image_media_id),
                                        'label' => __('thumbnail'),
                                        'edit' => $course,
                                        'image_object' => $course->image,
                                        'media_id' => $course->image_media_id,
                                    ])
                                    <div class="col-lg-6 col-md-6">
                                        <div class="custom-checkbox mt-20">
                                            <label>
                                                <input type="checkbox" value="1"
                                                    {{ old('is_downloadable', $course->is_downloadable) == 1 ? 'checked' : '' }}>
                                                <span class="">{{ __('downloadable') }}</span>
                                            </label>
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Course Media Images -->

                            <div class="tab-pane fade {{ $request_tab == 'pricing' ? 'show active' : '' }} {{ $step_3_error && !$step_2_error ? 'show active' : '' }}"
                                 id="coursePricing" role="tabpanel" aria-labelledby="pricing" tabindex="0">
                                <div class="row gx-20">
                                    <div class="col-lg-6">
                                        <div class="price-checkbox d-flex gap-12 mb-4">
                                            <label for="is_free">{{ __('free_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="is_free" name="is_free" value="1"
                                                    {{ old('is_free', $course->is_free) == 1 ? 'checked' : '' }}>
                                                <label for="is_free"></label>
                                            </div>
                                        </div>
                                        <div
                                            class="price-checkbox d-flex gap-12 mb-4 not_free_div {{ old('is_free', $course->is_free) == 1 ? 'd-none' : '' }}">
                                            <label for="discountable_course">{{ __('discountable_course') }}</label>
                                            <div class="setting-check">
                                                <input type="checkbox" id="discountable_course" name="is_discountable"
                                                       value="1"
                                                    {{ old('is_discountable', $course->is_discountable) == 1 ? 'checked' : '' }}>
                                                <label for="discountable_course"></label>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- End Free Course Option -->

                                    <div class="col-lg-6 not_free_div {{ old('is_free', $course->is_free) == 1 ? 'd-none' : '' }}">
                                        <div class="mb-4">
                                            <label for="price" class="form-label">{{ __('price') }}</label>
                                            <input type="text" class="form-control rounded-2" id="price" name="price"
                                                   value="{{ old('price', $course->price) }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('price') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Price -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable', $course->is_discountable) == 1 && old('is_free', $course->is_free) == 0 ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <div class="select-type-v2">
                                                <label for="discount_type"
                                                       class="form-label">{{ __('discount_type') }}</label>

                                                <select class="form-select form-select-lg mb-3 without_search"
                                                        id="discount_type" name="discount_type">
                                                    <option value="">{{ __('select_discount_type') }}</option>
                                                    <option value="flat"
                                                        {{ old('discount_type', $course->discount_type) == 'flat' ? 'selected' : '' }}>
                                                        {{ __('flat') }}</option>
                                                    <option value="percentage"
                                                        {{ old('discount_type', $course->discount_type) == 'percentage' ? 'selected' : '' }}>
                                                        {{ __('percentage') }}</option>
                                                </select>
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('discount_type') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Discount Type -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable', $course->is_discountable) == 1 && old('is_free', $course->is_free) == 0 ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="discount_amount"
                                                   class="form-label">{{ __('discount_amount') }}</label>
                                            <input type="text" class="form-control rounded-2" id="discount_amount"
                                                   name="discount_amount"
                                                   value="{{ old('discount_amount', $course->discount_amount) }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('discount_amount') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Discount Amount -->

                                    <div
                                        class="col-lg-6 discountable_div {{ old('is_discountable', $course->is_discountable) == 1 && old('is_free', $course->is_free) == 0 ? '' : 'd-none' }}">
                                        <div class="mb-4">
                                            <label for="liveClassDateRangePicker"
                                                   class="form-label">{{ __('discount_period') }}</label>

                                            <div class="date-picker-div text-start">
                                                <input type="text" class="form-control" name="discount_period"
                                                       id="liveClassDateRangePicker"
                                                       value="{{ old('discount_period', $course->discount_period) }}">
                                                <div class="nk-block-des text-danger">
                                                    <p class="error">{{ $errors->first('discount_period') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Date Range Picker -->
                                </div>
                                <!-- End Product images section -->

                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Course Pricing -->

                            <!-- start Curriculum Tab -->
                            <div
                                class="tab-pane fade {{ $step_3_error || $step_1_error || $step_2_error }} {{ $request_tab == 'curriculum' ? 'show active' : '' }}"
                                id="courseCurriculum" role="tabpanel" aria-labelledby="curriculum" tabindex="0">
                                <div class="row">

                                    <div class="col-lg-12 mb-4">
                                        <div class="d-flex align-items-center justify-content-between mb-3">
                                            <label class="form-label mb-0 fw-semibold cursor-pointer" for="show_curriculum_section">{{ __('Show Curriculum Section on Landing Page') }}</label>
                                            <div class="setting-check m-0" style="cursor: pointer;" onclick="var cb = this.querySelector('input[type=checkbox]'); if (event.target !== cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
                                                <input type="hidden" name="masterclass_settings[show_curriculum_section]" value="0">
                                                <input type="checkbox" name="masterclass_settings[show_curriculum_section]" value="1" id="show_curriculum_section" style="position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;"
                                                    {{ !isset($mcSettings['show_curriculum_section']) || !empty($mcSettings['show_curriculum_section']) ? 'checked' : '' }}>
                                                <label class="m-0" style="cursor: pointer;"></label>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="curriculum_title" class="form-label">{{ __('Curriculum Section Title') }}</label>
                                            <input type="text" name="masterclass_settings[curriculum_title]" id="curriculum_title" class="form-control rounded-2"
                                                   value="{{ $mcSettings['curriculum_title'] ?? '' }}">
                                            <small class="text-muted d-block mt-1"><i class="las la-info-circle me-1 text-primary"></i> Use <code>{word}</code> or <code>&lt;mark&gt;word&lt;/mark&gt;</code> to highlight text.</small>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-between align-items-center mb-20">
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#section"
                                                    class="btn sg-btn-primary add_modal">{{ __('add_module') }} <i
                                                    class="las la-plus"></i></button>
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="accordion editCourseCurriculum" id="editCourse">
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach ($sections as $key => $section)
                                                <div class="accordion-item" data-id="{{ $section->id }}">
                                                    <input type="hidden" name="order_no"
                                                           class="sections section_{{ $section->id }}"
                                                           value="{{ $section->order_no }}">
                                                    <h2 class="accordion-header" id="{{ $key }}">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#courseSection{{ $id = $section->id }}"
                                                                aria-expanded="true"
                                                                aria-controls="courseSection{{ $id }}">
                                                            {{ __('module') }} {{ ++$key }} :
                                                            {{ $section->title }}
                                                        </button>
                                                        <ul class="d-flex align-items-center course-edit-action gap-12">
                                                            <li class="dropdown">
                                                                <a class="dropdown-toggle" href="#"
                                                                   data-bs-toggle="dropdown" aria-expanded="false">
                                                                    {{ __('add_lesson') }}
                                                                </a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#video_lesson">{{ __('add_video_lesson') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#audio_lesson">{{ __('add_audio_lesson') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item lesson_modal"
                                                                           href="#" data-bs-toggle="modal"
                                                                           data-section="{{ json_encode($section) }}"
                                                                           data-bs-target="#doc_lesson">{{ __('add_doc_lesson') }}</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li>
                                                                <a href="#"
                                                                   class="btn sg-btn-outline-primary lesson_modal"
                                                                   data-section="{{ json_encode($section) }}"
                                                                   data-bs-toggle="modal"
                                                                   data-bs-target="#add_quiz">{{ __('add_quiz') }}</a>
                                                            </li>
                                                            <li class="listMove">
                                                                <a href="#" class="icon btn sg-btn-outline-primary">
                                                                    <i class="las la-arrows-alt"></i>
                                                                </a>
                                                            </li>
                                                            <li class="dropdown pe-0">
                                                                <a class="dropdown-toggle icon" href="#"
                                                                   data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                        class="las la-ellipsis-v"></i></a>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item edit_modal"
                                                                           href="javascript:void(0)"
                                                                           data-fetch_url="{{ route('sections.edit', $section->id) }}"
                                                                           data-route="{{ route('sections.update', $section->id) }}"
                                                                           data-modal="editSection">{{ __('edit_section') }}</a>
                                                                    </li>
                                                                    <li><a class="dropdown-item"
                                                                           href="javascript:void(0)"
                                                                           onclick="delete_row('{{ route('sections.destroy', $section->id) }}',null,true)"
                                                                           data-toggle="tooltip"
                                                                           data-original-title="{{ __('delete') }}">{{ __('delete') }}</a>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                        </ul>
                                                    </h2>
                                                    <div id="courseSection{{ $id }}"
                                                         class="accordion-collapse collapse {{ $i == 0 && (count($lessons->where('section_id', $section->id)) > 0 || count($section->quizzes) > 0) ? 'show' : '' }}"
                                                         aria-labelledby="courseSectionOne"
                                                         data-bs-parent="#editCourse">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="moveable-list-view mt-20 mt-md-0"
                                                                         id="lesson_sortable">
                                                                        @if (count($lessons) > 0)
                                                                            @foreach ($lessons->where('section_id', $section->id) as $k => $lesson)
                                                                                <div class="list-view"
                                                                                     data-id="{{ $lesson->id }}">
                                                                                    <div
                                                                                        class="list-view-content d-flex align-items-center gap-30">
                                                                                        <span class="icon"><i
                                                                                                @class([
                                                                                                    'las',
                                                                                                    'la-play' => $lesson->lesson_type == 'video',
                                                                                                    'la-music' => $lesson->lesson_type == 'audio',
                                                                                                    'la-file-invoice' => $lesson->lesson_type == 'doc',
                                                                                                ])></i></span>
                                                                                        <p>{{ __('lesson') }}
                                                                                            {{ ++$k }}
                                                                                            : {{ $lesson->title }}</p>
                                                                                    </div>


                                                                                    <ul
                                                                                        class="d-flex align-items-center gap-20">
                                                                                        <li><a href="#"
                                                                                               class="icon edit_modal"
                                                                                               data-fetch_url="{{ route('lessons.edit', $lesson->id) }}"
                                                                                               data-route="{{ route('lessons.update', $lesson->id) }}"
                                                                                               data-modal="edit_{{ $lesson->lesson_type }}_lesson"
                                                                                               data-bs-custom-class="custom-tooltip"
                                                                                               data-bs-toggle="tooltip"
                                                                                               data-bs-placement="top"
                                                                                               data-bs-title="{{ __('edit') }}"><i
                                                                                                    class="lar la-edit"></i></a>
                                                                                        </li>

                                                                                        <li><a href="#"
                                                                                               class="icon"
                                                                                               onclick="delete_row('{{ route('lessons.destroy', $lesson->id) }}',null,true)"
                                                                                               data-bs-toggle="tooltip"
                                                                                               data-bs-placement="top"
                                                                                               data-bs-title="{{ __('delete') }}"><i
                                                                                                    class="las la-times"></i></a>
                                                                                        </li>

                                                                                        <li
                                                                                            class="list-view-icon lessonMove lesson_modal">
                                                                                            <a href="#"><i
                                                                                                    class="las la-arrows-alt"></i></a>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                                <!-- End List View -->
                                                                            @endforeach
                                                                        @endif

                                                                    </div>
                                                                    @foreach ($section->quizzes as $quiz)
                                                                        <div class="list-view fixed-list-view mt-20">
                                                                            <div
                                                                                class="list-view-content d-flex align-items-center gap-30">
                                                                                <span class="icon"><i
                                                                                        class="las la-question"></i></span>
                                                                                <div>
                                                                                    <h6>{{ $quiz->title }}</h6>
                                                                                    <p>Question 5
                                                                                        | {{ __('time') }}
                                                                                        {{ $quiz->duration }}
                                                                                        {{ __('minutes') }}
                                                                                        | {{ __('total_marks') }}
                                                                                        {{ $quiz->total_marks }} </p>
                                                                                </div>
                                                                            </div>


                                                                            <ul
                                                                                class="action-btn d-flex align-items-center gap-20 px-20">
                                                                                <li><a href="#"
                                                                                        @class(['active', 'bg-danger' => $quiz->status == 0])>{{ $quiz->status == 1 ? __('active') : __('in_active') }}</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="{{ route('quizzes.edit', $quiz->id) }}"
                                                                                       class="icon"
                                                                                       data-bs-toggle="tooltip"
                                                                                       data-bs-placement="top"
                                                                                       data-bs-title="{{ __('edit') }}"><i
                                                                                            class="lar la-edit"></i></a>
                                                                                </li>
                                                                                <li><a href="#" class="icon"
                                                                                       data-bs-toggle="tooltip"
                                                                                       onclick="delete_row('{{ route('quizzes.destroy', $quiz->id) }}',null,true)"
                                                                                       data-bs-placement="top"
                                                                                       data-bs-title="{{ __('destroy') }}"><i
                                                                                            class="lar la-trash-alt"></i></a>
                                                                                </li>
                                                                            </ul>
                                                                        </div>
                                                                    @endforeach
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @php
                                                    $i++;
                                                @endphp
                                            @endforeach
                                            <!-- End Course Module 1 Accordion ITEM -->
                                        </div>
                                    </div>

                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Curriculum Tab -->

                            <!-- Start Live Class Tab -->
                            <div class="tab-pane fade {{ $step_6_error && (!$step_1_error && !$step_2_error && !$step_3_error) ? 'show active' : '' }}" id="courseLiveClass" role="tabpanel" aria-labelledby="courseLiveClass"
                                 tabindex="0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="mb-20">
                                            <div class="col">
                                                <div class="mb-20">
                                                    <label for="liveClassDate" class="form-label">Live Class
                                                        Date</label>
                                                    <input id="liveClassDateRangePicker" name="dateRange" type="text"
                                                           class="form-control rounded-2">
                                                    <div class="nk-block-des text-danger">
                                                        <p class="dateRange_error error"></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('dateRange') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Date Range Picker -->

                                    <div class="col-lg-12">
                                        <div class="mb-3 d-flex">
                                            <label class="form-label">Meeting Method :</label>
                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="zoom" {{$liveClass && $liveClass->meeting_method === 'zoom' ? 'checked' : '' }} >
                                                    <span class="ms-12">Zoom</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="google_meet" {{$liveClass && $liveClass->meeting_method === 'google_meet' ? 'checked' : '' }} >
                                                    <span class="ms-12">Google Meet</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="jitsi" {{$liveClass && $liveClass->meeting_method === 'jitsi' ? 'checked' : '' }} >
                                                    <span class="ms-12">Jitsi</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="team" {{$liveClass && $liveClass->meeting_method === 'team' ? 'checked' : '' }} >
                                                    <span class="ms-12">Team</span>
                                                </label>
                                            </div>

                                            <div class="custom-radio mx-20">
                                                <label>
                                                    <input type="radio" name="LiveClassmeetingMethod"
                                                           value="microsoft_team" {{$liveClass && $liveClass->meeting_method === 'microsoft_team' ? 'checked' : '' }} >
                                                    <span class="ms-12">Microsoft Teams</span>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassmeetingMethod') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting Method -->

                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="liveDescription" class="form-label">Description</label>
                                            <textarea class="form-control" id="liveDescription"
                                                      name="liveClassDescription"
                                                      style="height: 100px"> {{ $liveClass->description??  '' }}</textarea>
                                        </div>
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('liveClassDescription') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Description -->


                                    <div class="col-lg-12">
                                        <div class="mb-4">
                                            <label for="meetingLink" class="form-label">Meeting Link</label>
                                            <input type="text" class="form-control rounded-2"
                                                   name="LiveClassmeetingLink" id="meetingLink"
                                                   value="{{ $liveClass->meeting_link ??  old('metting_link') }}">
                                            <div class="nk-block-des text-danger">
                                                <p class="error">{{ $errors->first('LiveClassmeetingLink') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- End Meeting Link -->

                                    <div class="col-lg-6">
                                        <label for="MeetingID" class="form-label">Meeting ID</label>
                                        <input type="number" class="form-control rounded-2" name="LiveClassMeetingID"
                                               id="MeetingID"
                                               value="{{ $liveClass->meeting_id ??  old('metting_id') }}">
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassMeetingID') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting ID -->

                                    <div class="col-lg-6">
                                        <label for="meetingPassword" class="form-label">Meeting Password</label>
                                        <input type="text" class="form-control rounded-2"
                                               name="LiveClassmeetingPassword" id="meetingPassword"
                                               value="{{ $liveClass->meeting_password ??  old('metting_password')}}">
                                        <div class="nk-block-des text-danger">
                                            <p class="error">{{ $errors->first('LiveClassmeetingPassword') }}</p>
                                        </div>
                                    </div>
                                    <!-- End Meeting Password -->

                                </div>
                                <div class="col-lg-12">
                                    <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                        <button type="submit" name="save_and_published" value="1" class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                    </div>
                                </div>
                            </div>
                            <!-- End Live Class Tab -->



                            <!-- Start faq Tab -->
                            <div
                                class="tab-pane fade {{ $request_tab == 'faq' ? 'show active' : '' }} {{ $step_1_error || $step_2_error || $step_3_error }}"
                                id="courseFAQ" role="tabpanel" aria-labelledby="faq" tabindex="0">
                                <div class="row">
                                    <div class="col-lg-12">
                                        
                                         <!-- FAQ Section Header & Toggle Switch -->
                                         <div class="card mb-4 border-0 shadow-sm">
                                             <div class="card-body p-3">
                                                  <div class="d-flex align-items-center justify-content-between">
                                                      <label class="form-label mb-0 fw-semibold cursor-pointer" for="faq_status">{{ __('Enable FAQ Section') }}</label>
                                                      <div class="setting-check m-0" style="cursor: pointer;" onclick="var cb = this.querySelector('input[type=checkbox]'); if (event.target !== cb) { cb.checked = !cb.checked; cb.dispatchEvent(new Event('change')); }">
                                                          <input type="hidden" name="masterclass_settings[faq_status]" id="hidden_faq_status" value="{{ (!isset($mcSettings['faq_status']) || !empty($mcSettings['faq_status'])) ? 1 : 0 }}">
                                                          <input type="checkbox" name="masterclass_settings[faq_status]" value="1" id="faq_status" style="position: absolute; opacity: 0; width: 0; height: 0; pointer-events: none;"
                                                              {{ (!isset($mcSettings['faq_status']) || !empty($mcSettings['faq_status'])) ? 'checked' : '' }}
                                                              onchange="document.getElementById('hidden_faq_status').value = this.checked ? 1 : 0;">
                                                          <label class="m-0" style="cursor: pointer;"></label>
                                                      </div>
                                                  </div>
                                             </div>
                                         </div>

                                         <!-- FAQ Section Title & Settings -->
                                         <div class="card mb-4 border-0 shadow-sm">
                                             <div class="card-body p-4">
                                                 <div class="form-group mb-3">
                                                     <label for="faq_title" class="form-label fw-semibold">{{ __('FAQ Section Title') }}</label>
                                                     <textarea name="masterclass_settings[faq_title]" id="faq_title" class="form-control rounded-2 summernote-title"
                                                               rows="2" data-height="110">{!! $mcSettings['faq_title'] ?? '' !!}</textarea>
                                                     <small class="text-muted d-block mt-1"><i class="las la-info-circle me-1 text-primary"></i> Use <code>{word}</code> or <code>&lt;mark&gt;word&lt;/mark&gt;</code> to highlight text.</small>
                                                 </div>

                                                 <div class="form-group mb-0">
                                                     <label for="faq_subtitle" class="form-label fw-semibold">{{ __('FAQ Section Tag / Subtitle') }}</label>
                                                     <textarea name="masterclass_settings[faq_subtitle]" id="faq_subtitle" class="form-control rounded-2 summernote-title"
                                                               rows="2" data-height="110">{!! $mcSettings['faq_subtitle'] ?? '' !!}</textarea>
                                                 </div>
                                             </div>
                                         </div>

                                         <!-- FAQ Image Upload -->
                                         <div class="mb-4">
                                             @include('backend.common.media-input', [
                                                 'title' => __('FAQ Section Image'),
                                                 'label' => __('FAQ Section Image'),
                                                 'for' => 'image',
                                                 'name' => 'faq_image_media_id',
                                                 'col' => 'col-12 mb-0',
                                                 'size' => '',
                                                 'image' => $mcSettings['faq_image_media_id'] ?? ($course->faq_image ?? '')
                                             ])
                                         </div>

                                        <div class="oftions-content-right mb-20">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#add_faq"
                                               class="button-default">{{ __('add_faq') }} <i
                                                    class="las la-plus"></i></a>
                                        </div>
                                        <div class="accordion accordion-v2" id="faqsContent">
                                            @foreach ($faqs as $key => $faq)
                                                <div class="accordion-item">
                                                    <h2 class="accordion-header" id="faq{{ $key }}">
                                                        <button class="accordion-button" type="button"
                                                                data-bs-toggle="collapse"
                                                                data-bs-target="#faq{{ $key }}Collapse"
                                                                aria-expanded="true"
                                                                aria-controls="faq{{ $key }}Collapse">
                                                            {{ $faq->question }}
                                                            <ul class="d-flex align-items-center gap-20">
                                                                <li data-bs-toggle="modal"
                                                                    data-bs-target="#faqsEditModal">
                                                                    <a class="icon edit_modal" href="javascript:void(0)"
                                                                       data-fetch_url="{{ route('faqs.edit', $faq->id) }}"
                                                                       data-route="{{ route('faqs.update', $faq->id) }}"
                                                                       data-modal="edit_faq"
                                                                       data-bs-custom-class="custom-tooltip"
                                                                       data-bs-toggle="tooltip" data-bs-placement="top"
                                                                       data-bs-title="{{ __('edit') }}"><i
                                                                            class="lar la-edit"></i></a>
                                                                </li>

                                                                <li><a href="javascript:void(0)"
                                                                       onclick="delete_row('{{ route('faqs.destroy', $faq->id) }}',null,true)"
                                                                       data-toggle="tooltip"
                                                                       data-original-title="{{ __('delete') }}"
                                                                       class="icon" data-bs-toggle="tooltip"
                                                                       data-bs-placement="top"
                                                                       data-bs-title="{{ __('delete') }}"><i
                                                                            class="las la-times"></i></a></li>
                                                            </ul>
                                                        </button>
                                                    </h2>
                                                    <div id="faq{{ $key }}Collapse"
                                                         class="accordion-collapse collapse {{ $key == 0 ? 'show' : '' }}"
                                                         aria-labelledby="faq{{ $key }}"
                                                         data-bs-parent="#faqsContent">
                                                        <div class="accordion-body">
                                                            <div class="row">
                                                                <div class="col-lg-12">
                                                                    <div class="faqAns">
                                                                        <p>{!! $faq->answer !!}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="d-flex justify-content-end align-items-center mt-30">
                                            <div class="d-flex align-items-center gap-3">
                                                <button type="submit" name="save_and_published" value="1"
                                                        class="btn sg-btn-primary">{{ __('save_&_publish') }}</button>
                                            </div>


                                            @include('backend.common.loading-btn', [
                                                'class' => 'btn sg-btn-primary',
                                            ])
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End FAQ Tab -->

                            <!-- Lead Form Tab -->
                            <div class="tab-pane fade {{ $request_tab == 'lead_form' ? 'show active' : '' }}"
                                 id="courseLeadForm" role="tabpanel" tabindex="0">
                                <div class="card border mb-4 rounded-3 shadow-sm">
                                    <div class="card-header bg-white py-3">
                                        <span class="form-label m-0">{{ __('Lead Form Settings') }}</span>
                                    </div>
                                    <div class="card-body p-4">
                                        <div class="row gx-20">
                                            <!-- Lead Form Title / Heading -->
                                            <div class="col-12 mb-4">
                                                <label for="order_form_title" class="form-label">{{ __('Lead Form Title / Heading') }}</label>
                                                <textarea name="masterclass_settings[order_form_title]" id="order_form_title" class="form-control rounded-2 summernote-title"
                                                          rows="2" data-height="110">{!! $mcSettings['order_form_title'] ?? 'আপনার ফ্রি স্পটটি নিশ্চিত করুন' !!}</textarea>
                                                <small class="text-muted d-block mt-1"><i class="las la-info-circle me-1 text-primary"></i> Use <code>{word}</code> or <code>&lt;mark&gt;word&lt;/mark&gt;</code> to highlight text.</small>
                                            </div>

                                            <!-- Lead Form Subtitle -->
                                            <div class="col-12 mb-4">
                                                <label for="order_form_subtitle" class="form-label">{{ __('Lead Form Subtitle / Description') }}</label>
                                                <textarea name="masterclass_settings[order_form_subtitle]" id="order_form_subtitle" class="form-control rounded-2 summernote-title"
                                                          rows="2" data-height="110">{!! $mcSettings['order_form_subtitle'] ?? 'অ্যাক্সেস ডিটেইলস পাঠাতে আপনার সঠিক তথ্য দিন।' !!}</textarea>
                                                <small class="text-muted d-block mt-1"><i class="las la-info-circle me-1 text-primary"></i> Use <code>{word}</code> or <code>&lt;mark&gt;word&lt;/mark&gt;</code> to highlight text.</small>
                                            </div>

                                            <!-- Submit Button Text -->
                                            <div class="col-lg-6 col-md-6 mb-4">
                                                <label for="order_form_button_text" class="form-label">{{ __('Submit Button Text') }}</label>
                                                <input type="text" name="masterclass_settings[order_form_button_text]" id="order_form_button_text" class="form-control rounded-2"
                                                       value="{{ $mcSettings['order_form_button_text'] ?? ($mcSettings['pay_now_btn_text'] ?? ($mcSettings['order_btn_text'] ?? '')) }}"
                                                       placeholder="e.g. ফ্রি এক্সেস নিন">
                                            </div>

                                            <!-- Bottom Text Editor -->
                                            <div class="col-lg-12 mb-4">
                                                <label for="order_form_bottom_text" class="form-label">{{ __('Bottom Text (Below Button)') }}</label>
                                                <textarea name="masterclass_settings[order_form_bottom_text]" id="order_form_bottom_text" class="form-control rounded-2 summernote"
                                                          rows="3">{!! $mcSettings['order_form_bottom_text'] ?? '' !!}</textarea>
                                            </div>

                                            <!-- Banner Image Upload (Optional) -->
                                            @include('backend.common.media-input', [
                                                'title' => __('Lead Form Banner Image'),
                                                'name' => 'order_form_image_media_id',
                                                'col' => 'col-12 mb-0',
                                                'size' => '(Recommended: 500x700 - Leave empty to hide left banner image)',
                                                'image' => $mcSettings['order_form_image_media_id'] ?? '',
                                                'label' => __('Upload / Select Banner Image from Media (Left Blue Banner)'),
                                                'media_id' => $mcSettings['order_form_image_media_id'] ?? ''
                                            ])
                                        </div>
                                    </div>
                                </div>

                                <div class="d-flex justify-content-end align-items-center mt-30 pt-3 border-top">
                                    <button type="submit" name="save_and_published" value="1"
                                            class="btn sg-btn-primary px-4">{{ __('save_&_publish') }}</button>
                                </div>
                            </div>
                            <!-- End Lead Form Tab -->

                        </div>
                    </form>
                </div>
                <!-- End Default Tab List -->
            </div>
        </div>
    </div>
    @include('backend.admin.course.modals')
    @include('backend.common.delete-script')
    @include('backend.common.gallery-modal')
@endsection
@push('css_asset')
    <link rel="stylesheet" href="{{ static_asset('admin/css/dropzone.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ static_asset('admin/css/bootstrap-datepicker.min.css') }}">
@endpush
@push('js_asset')
    <!--====== media.js ======-->
    <script src="{{ static_asset('admin/js/axios.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/dropzone.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/moment.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/daterangepicker.js') }}"></script>
    <script src="{{ static_asset('admin/js/sortable.min.js') }}"></script>
    <script src="{{ static_asset('admin/js/bootstrap-datepicker.min.js') }}"></script>
@endpush
@push('js')
    {{ $dataTable->scripts() }}
    <script src="{{ static_asset('admin/js/media.js?ver=1.0.0') }}"></script>
    <script src="{{ static_asset('admin/js/ai_writer.js') }}"></script>
    <script>
        let section_id = '';
        var numbeonelive = 7;
        var numbeone = 6;
        var numbertwoLive = 8;
        var numbertwo = 7;
        var numberthreeLive = 9;
        var numberThree = 8;
        $(document).ready(function () {
            searchCategory($('#select_category'));
            searchOrganization($('#ins_by_org'));
            $(document).on('click', "#mgCourse-tabContent a.btn_action, .mc-step-btn", function (e) {
                e.preventDefault();
                let target = $(this).attr('data-bs-target');
                if (target) {
                    let navLink = document.querySelector('.nav-link[data-bs-target="' + target + '"]');
                    if (navLink) {
                        let tabInstance = bootstrap.Tab.getOrCreateInstance(navLink);
                        tabInstance.show();
                    }
                }
            });

            $(document).on('click', '.tab_change', function () {
                let href = $(this).attr('href');
                if (href && href.indexOf('tab=') !== -1) {
                    let tabName = href.split('tab=')[1];
                    changeUrl('tab', tabName);
                }
            });
            $(document).on('click', '#add_new_benefit_btn', function () {
                let count = $('#benefits_items_container .benefit-single-item').length;
                let html = `
                    <div class="benefit-single-item d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-light text-dark border p-2 font-13"><span class="benefit-num">${count + 1}</span></span>
                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white">
                        <a href="javascript:void(0)" class="btn btn-sm text-danger border-0 remove-benefit-btn ms-1">
                            <i class="las la-trash-alt fs-5"></i>
                        </a>
                    </div>
                `;
                $('#benefits_items_container').append(html);
            });

            $(document).on('click', '.remove-benefit-btn', function () {
                $(this).closest('.benefit-single-item').remove();
                $('#benefits_items_container .benefit-single-item').each(function (i) {
                    $(this).find('.benefit-num').text(i + 1);
                });
            });

            $(document).on('input change', '#mc_total_seats_input', function () {
                let totalSeats = parseInt($(this).val()) || 0;
                let enrolled = parseInt($(this).data('enrolled')) || 0;
                let avail = Math.max(0, totalSeats - enrolled);
                
                let goldVal = $('#mc_gold_seats_input').val();
                if (goldVal && /\d+/.test(goldVal)) {
                    $('#mc_gold_seats_input').val(goldVal.replace(/\d+/, avail));
                } else {
                    $('#mc_gold_seats_input').val('আর মাত্র ' + avail + ' সিট বাকি');
                }
            });

            $(document).on('click', '#add_new_faq_btn', function () {
                let index = $('#faq_items_container .faq-single-item').length;
                let html = `
                    <div class="faq-single-item card border mb-3 bg-light rounded-3 p-3 position-relative">
                        <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                            <span class="fw-bold text-primary fs-6"><i class="fas fa-question-circle me-1"></i> FAQ Question #<span class="faq-num">${index + 1}</span></span>
                            <button type="button" class="btn btn-sm btn-outline-danger remove-faq-btn py-1 px-2">
                                <i class="fas fa-trash-alt me-1"></i> Delete
                            </button>
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small text-dark">Question (প্রশ্ন)</label>
                            <input type="text" name="masterclass_settings[faq_list][${index}][question]" class="form-control rounded-2 bg-white">
                        </div>
                        <div>
                            <label class="form-label fw-bold small text-dark">Answer (উত্তর)</label>
                            <textarea name="masterclass_settings[faq_list][${index}][answer]" class="form-control rounded-2 bg-white" rows="2"></textarea>
                        </div>
                    </div>
                `;
                $('#faq_items_container').append(html);
            });

            $(document).on('click', '.remove-faq-btn', function () {
                $(this).closest('.faq-single-item').remove();
                $('#faq_items_container .faq-single-item').each(function (i) {
                    $(this).find('.faq-num').text(i + 1);
                });
            });
            // Add Gift Quote Item
            $(document).on('click', '#add_gift_quote_btn', function () {
                let index = $('#gift_quotes_container .gift-quote-single-item').length;
                let html = `
                    <div class="gift-quote-single-item p-3 mb-3 border rounded bg-light position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="fw-bold">Item <span class="gift-quote-num">${index + 1}</span></span>
                            <button type="button" class="btn btn-sm text-danger remove-gift-quote-btn p-0 bg-transparent border-0">
                                <i class="las la-trash-alt fs-5"></i>
                            </button>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-7">
                                <label class="form-label mb-1">Text / Quote <span class="text-muted fw-normal">(Optional)</span></label>
                                <textarea name="masterclass_settings[gift_quotes_list][${index}][text]" class="form-control rounded-2 bg-white summernote gift-quote-text" rows="2"></textarea>
                            </div>
                            <div class="col-md-5">
                                <div class="mb-3">
                                    <label class="form-label mb-1">Price <span class="text-muted fw-normal">(Optional)</span></label>
                                    <input type="text" name="masterclass_settings[gift_quotes_list][${index}][price]" class="form-control rounded-2 bg-white gift-quote-price" placeholder="e.g. 3000">
                                </div>
                                <div class="gift-quote-img-field">
                                    <input type="hidden" name="masterclass_settings[gift_quotes_list][${index}][image]" class="gift-quote-image-val" value="">
                                    <div class="custom-image mb-2">
                                        <div class="gallery-modal" data-for="image" data-selection="single">
                                            <label class="form-label mb-1">Item Image <span class="text-muted fw-normal">(Optional)</span></label>
                                            <div class="file-upload-text">
                                                <p><span class="file_selected">0 </span>{{ __('files_selected') }}</p>
                                                <span class="file-btn">{{ __('choose_file') }}</span>
                                            </div>
                                            <input class="d-none gift-quote-media-id-input" type="hidden" name="masterclass_settings[gift_quotes_list][${index}][media_id]" value="">
                                        </div>
                                        <div class="selected-files d-flex flex-wrap gap-20">
                                            <div class="selected-files-item">
                                                <img class="selected-img" src="{{ static_asset('images/default/default-image-80x80.png') }}" alt="default">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                let $newItem = $(html);
                $('#gift_quotes_container').append($newItem);
                if ($.fn.summernote) {
                    $newItem.find('.summernote').summernote({
                        tabsize: 2,
                        height: 200,
                        fontNames: ["sans-serif", "Arial"],
                        fontsize: "16",
                        disableResize: true,
                        disableResizeEditor: true,
                        resize: false,
                        toolbar: [
                            ["font", ["bold", "underline"]],
                            ["fontname", ["fontname"]],
                            ["fontsize", ["fontsize"]],
                            ["color", ["color"]],
                            ["para", ["ul", "ol", "paragraph"]],
                            ["table", ["table"]],
                            ["insert", ["link", "picture", "video"]],
                            ["view", ["fullscreen", "help"]],
                        ],
                    });
                }
            });

            function reindexGiftQuotes() {
                $('#gift_quotes_container .gift-quote-single-item').each(function (i) {
                    $(this).find('.gift-quote-num').text(i + 1);
                    $(this).find('.gift-quote-text').attr('name', `masterclass_settings[gift_quotes_list][${i}][text]`);
                    $(this).find('.gift-quote-price').attr('name', `masterclass_settings[gift_quotes_list][${i}][price]`);
                    $(this).find('.gift-quote-image-val').attr('name', `masterclass_settings[gift_quotes_list][${i}][image]`);
                    $(this).find('.gift-quote-media-id-input').attr('name', `masterclass_settings[gift_quotes_list][${i}][media_id]`);
                });
            }

            $(document).on('click', '.remove-gift-quote-btn', function () {
                $(this).closest('.gift-quote-single-item').remove();
                reindexGiftQuotes();
            });

            $(document).on('click', '.gift-quote-single-item .remove-icon', function () {
                $(this).closest('.gift-quote-single-item').find('.gift-quote-image-val').val('');
                $(this).closest('.gift-quote-single-item').find('.gift-quote-media-id-input').val('');
            });

            // Add Support Icon & Link Item
            $(document).on('click', '#add_support_icon_btn', function () {
                let index = $('#support_icons_container .support-icon-single-item').length;
                let html = `
                    <div class="support-icon-single-item p-3 mb-3 border rounded bg-white position-relative">
                        <div class="d-flex justify-content-between align-items-center mb-2 pb-2 border-bottom">
                            <span class="text-dark font-14 fw-normal">Icon & Link <span class="support-icon-num">${index + 1}</span></span>
                            <button type="button" class="btn btn-sm text-danger remove-support-icon-btn p-0 bg-transparent border-0" title="Remove">
                                <i class="las la-trash-alt fs-5"></i>
                            </button>
                        </div>
                        <div class="row g-3 align-items-end">
                            <div class="col-md-6 col-12">
                                <label class="form-label small mb-1 font-13 fw-normal text-muted">Upload Icon (Optional)</label>
                                <input type="file" name="support_icon_files[${index}]" class="form-control form-control-sm rounded-2 fw-normal" accept="image/*">
                            </div>
                            <div class="col-md-6 col-12">
                                <label class="form-label small mb-1 font-13 fw-normal text-muted">Link / URL</label>
                                <input type="text" name="masterclass_settings[support_icons_list][${index}][url]" class="form-control form-control-sm rounded-2 fw-normal">
                            </div>
                        </div>
                    </div>
                `;
                $('#support_icons_container').append(html);
            });

            $(document).on('click', '.remove-support-icon-btn', function () {
                $(this).closest('.support-icon-single-item').remove();
                $('#support_icons_container .support-icon-single-item').each(function (i) {
                    $(this).find('.support-icon-num').text(i + 1);
                });
            });


            let sections = document.getElementById("editCourse");
            if (sections) {
                new Sortable(sections, {
                    handle: '.listMove',
                    animation: 150,
                    onSort: function (evt) {
                        let form = {
                            _token: '{{ csrf_token() }}',
                            ids: [],
                            course_id: '{{ $course->id }}',
                        };
                        let nodes = evt.from.childNodes;

                        $.each(nodes, function (index, value) {
                            if ($(this).hasClass('accordion-item')) {
                                form.ids.push($(this).data('id'));
                            }
                        });
                        $.ajax({
                            url: '{{ route('course.sections.order') }}',
                            type: 'POST',
                            data: form,
                            success: function (data) {
                                if (data.error) {
                                    toastr.error(data.error);
                                }
                            },
                            error: function (data) {
                                toastr.error('Something went wrong');
                            }
                        });
                    },
                });
            }
            let lessons = document.getElementById("lesson_sortable");
            if (lessons) {
                new Sortable(lessons, {
                    handle: '.lessonMove',
                    animation: 150,
                    onSort: function (evt) {
                        let form = {
                            _token: '{{ csrf_token() }}',
                            ids: [],
                            section_id: section_id,
                        };
                        let nodes = evt.from.childNodes;

                        $.each(nodes, function (index, value) {
                            if ($(this).hasClass('list-view')) {
                                form.ids.push($(this).data('id'));
                            }
                        });
                        $.ajax({
                            url: '{{ route('section.lessons.order') }}',
                            type: 'POST',
                            data: form,
                            success: function (data) {
                                if (data.error) {
                                    toastr.error(data.error);
                                }
                                else{
                                    toastr.success(data.success);
                                }
                            },
                            error: function (data) {
                                toastr.error('Something went wrong');
                            }
                        });
                    },
                });
            }
            $('#dateRangePicker').daterangepicker({
                startDate: '{{ Carbon\Carbon::parse($course->discount_start_at)->format('m/d/Y') }}',
                endDate: '{{ Carbon\Carbon::parse($course->discount_end_at)->format('m/d/Y') }}',
            });
            $('.datePickerUP').datepicker({});
            $('#liveClassDateRangePicker').daterangepicker({
                startDate: '{{ Carbon\Carbon::parse($course->discount_start_at)->format('m/d/Y') }}',
                endDate: '{{ Carbon\Carbon::parse($course->discount_end_at)->format('m/d/Y') }}',
            });
            $('.liveClassDateRangePicker').datepicker({});
            $(document).on('change', "#video_source", function () {
                let video_source = $(this).val();

                if (!video_source) {
                    $('.video_link').addClass('d-none');
                    $('.upload_div').addClass('d-none');
                } else if (video_source == 'upload') {
                    $('.video_link').addClass('d-none');
                    $('.upload_div').removeClass('d-none');
                } else {
                    $('.video_link').removeClass('d-none');
                    $('.upload_div').addClass('d-none');
                }
            });

            $(document).on('change', ".thumb_picker", function (e) {
                let fileName = e.target.files[0] ? e.target.files[0].name : '{{ __("video") }}';
                $(this).closest('.mb-3').find('.file_name').text(fileName);
            });
            $(document).on('change', ".lesson_source", function () {
                let video_source = $(this).val();

                if (video_source == 'upload') {
                    $('.lesson_link').addClass('d-none');
                    $('.lesson_upload_div').removeClass('d-none');
                } else {
                    $('.lesson_link').removeClass('d-none');
                    $('.lesson_upload_div').addClass('d-none');
                }
            });
            $(document).on('change', "#is_free", function () {
                let is_free = $(this).is(':checked');

                if (is_free) {
                    $('.not_free_div').addClass('d-none');
                    $('.discountable_div').addClass('d-none');
                    $('.renewable_div').addClass('d-none');
                    $("#discountable_course").prop('checked', false);
                } else {
                    $('.not_free_div').removeClass('d-none');
                }
            });
            $(document).on('change', "#discountable_course", function () {
                let is_discountable = $(this).is(':checked');
                if (is_discountable) {
                    $('.discountable_div').removeClass('d-none');
                } else {
                    $('.discountable_div').addClass('d-none');
                }
            });
            $(document).on('click', ".lesson_modal", function () {
                let section = $(this).data('section');
                section_id = section.id;
                $('.section_id').val(section.id);
            });
            /*$(document).on('click', "#basicInformation", function () {
                searchCategory($('#select_category'));
                searchOrganization($('#ins_by_org'));
            });*/
            $(document).on('change','#courseType',function () {
                var selectedValue = $(this).val();
                if (selectedValue === 'live_class') {
                    $("#notLiveClass").removeClass('d-none');
                    $('.coursefaqIndex').text(7);
                    $('#curriculum_next_btn').attr('data-bs-target', '#courseLiveClass');
                    $('#faq_back_btn').attr('data-bs-target', '#courseLiveClass');

                } else if (selectedValue === 'course') {
                    $("#notLiveClass").addClass('d-none');
                    $('.coursefaqIndex').text(6);
                    $('#curriculum_next_btn').attr('data-bs-target', '#courseFAQ');
                    $('#faq_back_btn').attr('data-bs-target', '#courseCurriculum');

                }
            });
            $(document).on('click', '.tab_change', function () {
                var tab = $(this).attr('data-tab');
                changeUrl('tab', tab);
            });
            $(document).on('click', '.deleteResource', function (event) {
                event.preventDefault();
                let url = $(this).data('url');
                axios.delete(url, {
                    params: {
                        method: 'DELETE',
                        course_id: $(this).data('course'),
                    }
                })
                    .then(response => {
                        console.log(response.data);
                        $('#resourceListContainer').html(response.data);
                        toastr.success('Deleted Successfully')
                    })
                    .catch(error => {
                        console.log(error.message);
                    })
            });
            $(document).on("submit", "#storeResource", function (e) {
                e.preventDefault();
                let selector = this;
                $(selector).find(".loading_button").removeClass("d-none");
                $(selector).find("p.error").text("");
                $(selector).find(":submit").addClass("d-none");
                let action = $(selector).attr("action");
                let method = $(selector).attr("method");
                let formData = new FormData(selector);
                let modal = $(selector).find('.is_modal').val();

                axios.post(action, formData)

                    .then(response => {

                        $('#resourceListContainer').html(response.data);

                        if (modal_id && !modal) {
                            $(selector).find(".loading_button").addClass("d-none");
                            $(selector).find(":submit").removeClass("d-none");
                            toastr.success('Created Successfully');
                            modal_id.modal("hide");
                            $(selector).trigger("reset");
                            modal_id
                                .find(".create_sub_title")
                                .removeClass("d-none");
                            modal_id.find(".edit_sub_title").addClass("d-none");
                            $(".dataTable").DataTable().ajax.reload();
                        } else {
                            if (response.route) {
                                window.location.href = response.route;
                            } else {
                                location.reload();
                            }
                        }

                    })
                    .catch(error => {
                        let message = error.response.data.errors.file[0] || error.response.data.error
                        toastr.error(message)
                        $(selector).find(".loading_button").addClass("d-none");
                        $(selector).find(":submit").removeClass("d-none");

                    })

            });

            // Dynamic Gold Card Info Point Repeater
            let goldPointCounter = $('#gold_points_container .gold-point-single-item').length;
            $('#add_new_gold_point_btn').on('click', function () {
                let idx = goldPointCounter++;
                let html = `
                    <div class="gold-point-single-item card border p-3 mb-3 bg-light rounded-2">
                        <div class="row gx-2 align-items-center">
                            <div class="col-md-3 col-12 mb-2 mb-md-0">
                                <label class="form-label small text-muted mb-1">Icon Class</label>
                                <input type="text" name="masterclass_settings[gold_info_points][${idx}][icon]" class="form-control rounded-2 bg-white"
                                       value="fas fa-check-circle">
                            </div>
                            <div class="col-md-4 col-12 mb-2 mb-md-0">
                                <label class="form-label small text-muted mb-1">Title / Label</label>
                                <input type="text" name="masterclass_settings[gold_info_points][${idx}][title]" class="form-control rounded-2 bg-white">
                            </div>
                            <div class="col-md-4 col-12 mb-2 mb-md-0">
                                <label class="form-label small text-muted mb-1">Subtitle / Value</label>
                                <input type="text" name="masterclass_settings[gold_info_points][${idx}][value]" class="form-control rounded-2 bg-white">
                            </div>
                            <div class="col-md-1 col-12 text-end">
                                <label class="form-label d-none d-md-block opacity-0 mb-1">Del</label>
                                <a href="javascript:void(0)" class="btn btn-sm text-danger border-0 remove-gold-point-btn">
                                    <i class="las la-trash-alt fs-4"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                `;
                $('#gold_points_container').append(html);
            });

            $(document).on('click', '.remove-gold-point-btn', function () {
                $(this).closest('.gold-point-single-item').remove();
            });

            // Dynamic Benefits Repeater
            $('#add_new_benefit_btn').on('click', function () {
                let count = $('#benefits_items_container .benefit-single-item').length;
                let html = `
                    <div class="benefit-single-item d-flex align-items-center gap-2 mb-3">
                        <span class="badge bg-light text-dark border p-2 font-13"><span class="benefit-num">${count + 1}</span></span>
                        <input type="text" name="masterclass_settings[benefits_list][]" class="form-control rounded-2 bg-white">
                        <a href="javascript:void(0)" class="btn btn-sm text-danger border-0 remove-benefit-btn ms-1">
                            <i class="las la-trash-alt fs-5"></i>
                        </a>
                    </div>
                `;
                $('#benefits_items_container').append(html);
            });

            $(document).on('click', '.remove-benefit-btn', function () {
                $(this).closest('.benefit-single-item').remove();
                $('#benefits_items_container .benefit-single-item').each(function (idx) {
                    $(this).find('.benefit-num').text(idx + 1);
                });
            });
        });

        function changeUrl(type, val) {
            var url = new URL(window.location.href);
            var params = new URLSearchParams(url.search);

            params.set(type, val);

            var newUrl = url.origin + url.pathname + '?' + params.toString();
            window.history.pushState({
                path: newUrl
            }, '', newUrl);
        }
    </script>
@endpush











