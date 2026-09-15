@extends('frontend.layouts.master')
@section('title', __('home'))

@push('css')
<style>
    /* ==========================================================================
       PROFESSIONAL MOBILE SECTION SPACING & MARGIN/PADDING HARMONIZATION
       Standardizes vertical cadence, container gutters, and heading spacing
       across all landing page sections on mobile and tablet devices.
       ========================================================================== */
    :root {
        --mobile-font-heading-main: 22px;
        --mobile-font-heading-sub: 17px;
        --mobile-font-badge: 13px;
        --mobile-font-body: 13.5px;
    }

    /* Completely eliminate top white gap & reset body/header spacing */
    html, body {
        margin: 0 !important;
        padding-top: 0 !important;
    }
    
    header, .template-header, .header-navigation, .header-area {
        display: none !important;
        height: 0 !important;
        margin: 0 !important;
        padding: 0 !important;
    }

    section.hero-area {
        margin-top: 0 !important;
        padding-top: 40px !important;
        display: flow-root;
    }

    section.hero-area > *:first-child {
        margin-top: 0 !important;
    }

    /* Narrow overall container & component widths for Home Landing Page */
    @media (min-width: 992px) {
        .container.container-1278,
        .container-1278 {
            max-width: 1080px !important;
        }
        .hero-video-wrapper {
            max-width: 960px !important;
        }
        .lead-card {
            max-width: 920px !important;
        }
    }

    @media (max-width: 767.98px) {
        /* Standardized Section Vertical Spacing (38px top & bottom) */
        .home-page-sections > section,
        section.what-you-learn-section,
        section.syllabus-section,
        section.success-banner-section,
        section.success-story-section,
        section.offer-breakdown-section,
        section.faq-section,
        section.mc-support-section-wrapper,
        section.order-form-section {
            padding-top: 38px !important;
            padding-bottom: 38px !important;
        }

        section.about-me-section,
        section.categories-of-work-section,
        section.benefits-section,
        section.special-gift-section {
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }

        /* Hero Area Mobile Padding */
        section.hero-area {
            padding-top: 36px !important;
            padding-bottom: 36px !important;
        }

        /* Compact graphical divider banners */
        section.ad-banner-section-1,
        section.ad-banner-section-2,
        section.coupon-banner-section {
            padding-top: 24px !important;
            padding-bottom: 24px !important;
        }

        /* Container Edge Alignment */
        .container.container-1278 {
            padding-left: 16px !important;
            padding-right: 16px !important;
        }

        /* Harmonized Section Heading Spacing on Mobile */
        .common-heading.m-b-40,
        .common-heading.m-b-30,
        .common-heading {
            margin-bottom: 22px !important;
        }
        .course-section-title.mb-5,
        .course-section-title {
            margin-bottom: 22px !important;
        }

        /* ==========================================================================
           PROFESSIONAL MOBILE TYPOGRAPHY SYSTEM (4 TIERS)
           Harmonizes text hierarchy across the entire landing page on mobile.
           ========================================================================== */

        /* --------------------------------------------------------------------------
           TIER 1: MAIN SECTION HEADINGS (22px, Bold 700)
           CSS Variable: --mobile-font-heading-main
           Enforces fixed previous mobile typography on headings and all child spans/elements,
           ensuring custom desktop font sizes from text editor do NOT break mobile layout.
           -------------------------------------------------------------------------- */
        .hero-area .hero-title,
        .hero-area .hero-title *,
        .hero-title,
        .hero-title *,
        .hero-area .hero-content h1,
        .hero-area .hero-content h1 *,
        .hero-content h1,
        .hero-content h1 *,
        .common-heading h1,
        .common-heading h1 *,
        .common-heading h2,
        .common-heading h2 *,
        .course-section-title,
        .course-section-title *,
        .section-title,
        .section-title *,
        .cow-title,
        .cow-title *,
        section.about-me-section .common-heading h2,
        section.about-me-section .common-heading h2 *,
        section.about-me-section h2,
        section.about-me-section h2 *,
        section.categories-of-work-section .cow-title,
        section.categories-of-work-section .cow-title *,
        section.benefits-section .course-section-title,
        section.benefits-section .course-section-title *,
        section.benefits-section h2,
        section.benefits-section h2 *,
        section.special-gift-section .mc-special-gift-card h2,
        section.special-gift-section .mc-special-gift-card h2 *,
        section.special-gift-section h2,
        section.special-gift-section h2 *,
        section.syllabus-section .common-heading h2,
        section.syllabus-section .common-heading h2 *,
        section.syllabus-section h2,
        section.syllabus-section h2 *,
        section.success-banner-section .common-heading h2,
        section.success-banner-section .common-heading h2 *,
        section.success-story-section .common-heading h2,
        section.success-story-section .common-heading h2 *,
        section.success-story-section h2,
        section.success-story-section h2 *,
        section.offer-breakdown-section .mc-bd-light-title,
        section.offer-breakdown-section .mc-bd-light-title *,
        section.offer-breakdown-section .common-heading h2,
        section.offer-breakdown-section .common-heading h2 *,
        section.offer-breakdown-section h2,
        section.offer-breakdown-section h2 *,
        section.faq-section .common-heading h2,
        section.faq-section .common-heading h2 *,
        section.faq-section h2,
        section.faq-section h2 *,
        section.mc-support-section-wrapper .mc-support-title,
        section.mc-support-section-wrapper .mc-support-title *,
        section.mc-support-section-wrapper h2,
        section.mc-support-section-wrapper h2 *,
        section.mc-support-section-wrapper .common-heading h2,
        section.mc-support-section-wrapper .common-heading h2 *,
        section.order-form-section .lead-title,
        section.order-form-section .lead-title *,
        section.order-form-section .form-heading,
        section.order-form-section .form-heading *,
        section.order-form-section h2 *,
        section.course-description-section .description-card h2,
        section.course-description-section .description-card h2 *,
        section.course-description-section .desc-main-title,
        section.course-description-section .desc-main-title *,
        .desc-main-title,
        .desc-main-title *,
        .home-page-sections > section h2,
        .home-page-sections > section h2 *,
        .home-page-sections > section .common-heading h2,
        .home-page-sections > section .common-heading h2 * {
            font-size: var(--mobile-font-heading-main, 22px) !important;
            font-weight: 700 !important;
            line-height: 1.35 !important;
            letter-spacing: -0.01em;
            margin-bottom: 12px;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        /* --------------------------------------------------------------------------
           TIER 2: CARD & SUB-HEADINGS (17px, Semi-Bold 600)
           CSS Variable: --mobile-font-heading-sub
           Enforces fixed previous mobile typography on subtitles and all child spans/elements.
           -------------------------------------------------------------------------- */
        .hero-area .hero-subtitle,
        .hero-area .hero-subtitle *,
        .hero-area .hero-content h4,
        .hero-area .hero-content h4 *,
        .hero-subtitle,
        .hero-subtitle *,
        .cow-card-title,
        .cow-card-title *,
        .mc-audience-title-light,
        .mc-audience-title-light *,
        .custom-syllabus-accordion .accordion-button,
        .custom-syllabus-accordion .accordion-button *,
        .custom-testimonial-card .author-details h6,
        .custom-testimonial-card .author-details h6 *,
        .mc-bd-light-item-title,
        .mc-bd-light-item-title *,
        .mc-bd-light-today-box h3,
        .mc-bd-light-today-box h3 *,
        .mc-bd-light-offer-heading,
        .mc-bd-light-offer-heading *,
        .custom-faq-accordion .accordion-button,
        .custom-faq-accordion .accordion-button *,
        .faq-badge-floating h5,
        .faq-badge-floating h5 *,
        .mc-support-subtitle,
        .mc-support-subtitle *,
        .mc-feature-title,
        .mc-feature-title *,
        .mc-channel-title,
        .mc-channel-title *,
        .mc-channel-info-title,
        .mc-channel-info-title *,
        .mc-support-divider-text,
        .mc-support-divider-text *,
        .counter-label,
        .counter-label *,
        .order-form-section .modern-label,
        .order-form-section .order-summary-title,
        .order-form-section .lead-card h3,
        .order-form-section .lead-card h3 *,
        .order-form-section .lead-card h4,
        .order-form-section .lead-card h4 *,
        .sp-left h3,
        .sp-left h3 *,
        .mc-special-gift-card .mc-callout-quote .quote-price,
        .mc-special-gift-card .mc-callout-quote .quote-price *,
        .common-heading h3,
        .common-heading h3 *,
        .common-heading h4,
        .common-heading h4 *,
        .card-title,
        .card-title *,
        .sub-heading,
        .sub-heading *,
        .desc-right-title,
        .desc-right-title *,
        .desc-banner-title,
        .desc-banner-title * {
            font-size: var(--mobile-font-heading-sub, 17px) !important;
            font-weight: 600 !important;
            line-height: 1.4 !important;
            word-break: break-word;
            overflow-wrap: break-word;
        }

        /* --------------------------------------------------------------------------
           TIER 3: BADGES, TAGS & EYEBROWS (13px, Medium / Semi-Bold 500/600)
           CSS Variable: --mobile-font-badge
           -------------------------------------------------------------------------- */
        .common-heading .sub-title,
        .common-heading .sub-title *,
        .sub-title,
        .sub-title *,
        .section-tag,
        .section-tag *,
        .eyebrow,
        .eyebrow *,
        .mc-audience-check-note-light,
        .mc-audience-check-note-light *,
        .mc-gift-pill,
        .mc-gift-pill *,
        .author-details span,
        .author-details .stars,
        .mc-channel-team-label,
        .mc-team-status-label,
        .mc-support-badge,
        .mc-support-badge *,
        .lead-badge,
        .lead-badge *,
        .secure-badge span,
        .secure-badge,
        .coupon-code-badge,
        .coupon-code-badge *,
        .faq-badge-floating span,
        .mc-bd-light-eyebrow,
        .mc-bd-light-eyebrow *,
        .mc-bd-light-ribbon,
        .mc-bd-light-ribbon *,
        .mc-bd-pill-badge,
        .mc-bd-pill-badge *,
        .mc-bd-light-saved-label,
        .mc-bd-light-saved-pct,
        .mc-bd-light-orig-label,
        .mc-bd-light-security-note,
        .custom-syllabus-accordion .badge,
        .custom-syllabus-accordion .lesson-duration,
        .custom-syllabus-accordion span.duration,
        .badge,
        .badge-pill,
        .tag,
        .sp-cd-item span.label {
            font-size: var(--mobile-font-badge, 13px) !important;
            font-weight: 600 !important;
            line-height: 1.4 !important;
        }

        /* Ensure highlight marks smoothly inherit parent heading font size */
        mark.title-highlight,
        .title-highlight,
        h1 mark, h2 mark, h3 mark, h4 mark,
        .hero-title mark, .hero-subtitle mark,
        .course-section-title mark, .cow-title mark, .cow-card-title mark {
            font-size: inherit !important;
            line-height: inherit !important;
        }

        /* --------------------------------------------------------------------------
           TIER 4: BODY TEXT & PARAGRAPHS (13.5px, Regular 400)
           CSS Variable: --mobile-font-body
           -------------------------------------------------------------------------- */
        .hero-area .hero-description,
        .hero-description,
        .hero-area .hero-description p,
        .hero-content > p,
        section.about-me-section .about-me-description-content,
        section.about-me-section .about-me-description-content p,
        section.about-me-section .about-me-description-content li,
        section.about-me-section .about-me-text-block p,
        .about-me-description-content,
        .about-me-description-content p,
        .about-me-description-content li,
        .about-me-text-block p,
        .cow-card-content,
        .cow-card-content p,
        .cow-card-content li,
        .mc-audience-desc-light,
        .mc-special-gift-card .text-secondary,
        .mc-special-gift-card .quote-text,
        .mc-special-gift-card .quote-text p,
        .mc-callout-quote .quote-text,
        .custom-syllabus-accordion .course-item-title,
        .custom-syllabus-accordion .accordion-body,
        .custom-syllabus-accordion li,
        .custom-syllabus-accordion p,
        .success-banner-section .common-heading > p,
        .success-story-section .common-heading > p,
        .custom-testimonial-card p,
        .mc-bd-light-item-sub,
        .mc-bd-light-desc,
        .offer-breakdown-section .mc-bd-light-desc,
        .offer-breakdown-section .mc-bd-light-security-note,
        .custom-faq-accordion .accordion-body,
        .custom-faq-accordion .accordion-body p,
        .mc-support-description,
        .mc-support-description p,
        .mc-feature-desc,
        .mc-channel-desc,
        .mc-channel-info-desc,
        .order-form-section .lead-desc,
        .order-form-section .form-subheading,
        .order-form-section .feature-list li,
        .order-form-section p,
        .order-form-section .text-muted,
        .coupon-banner-section p,
        .home-page-sections p:not(.file_name):not(.error):not(.num),
        .section-description,
        .desc-banner-sub,
        .desc-banner-sub *,
        .course-description-content,
        .course-description-content *,
        .common-heading > p {
            font-size: var(--mobile-font-body, 13.5px) !important;
            font-weight: 400 !important;
            line-height: 1.65 !important;
        }

        /* Internal Card Padding & Responsive Alignment */
        .cow-wrapper {
            padding: 24px 14px !important;
            border-radius: 12px !important;
        }
        .cow-card-content {
            padding-left: 0 !important;
        }
        .mc-special-gift-card {
            padding: 24px 14px !important;
        }
        .what-you-learn-section .card {
            padding: 20px 14px !important;
            border-radius: 12px !important;
        }
        .mc-content-card {
            padding: 20px 14px !important;
        }
        .about-me-card {
            min-height: auto !important;
            max-height: 380px !important;
        }
        .about-me-card img {
            min-height: auto !important;
            max-height: 380px !important;
            object-fit: cover !important;
        }
        .faq-image-card img {
            min-height: auto !important;
            max-height: 320px !important;
            object-fit: cover !important;
        }

        /* Mobile Input & Button Usability (Prevents Safari Auto-Zoom & Viewport Shift) */
        .order-form-section input[type="text"],
        .order-form-section input[type="email"],
        .order-form-section input[type="tel"],
        .order-form-section input[type="password"],
        .order-form-section select,
        .order-form-section textarea {
            font-size: 16px !important;
        }
    }

    @media (max-width: 575.98px) {
        /* Extra small devices (compact phones) */
        .home-page-sections > section,
        section.what-you-learn-section,
        section.syllabus-section,
        section.success-banner-section,
        section.success-story-section,
        section.offer-breakdown-section,
        section.faq-section,
        section.mc-support-section-wrapper,
        section.order-form-section {
            padding-top: 30px !important;
            padding-bottom: 30px !important;
        }

        section.about-me-section,
        section.categories-of-work-section,
        section.benefits-section,
        section.special-gift-section {
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }

        section.hero-area {
            padding-top: 28px !important;
            padding-bottom: 28px !important;
        }

        section.ad-banner-section-1,
        section.ad-banner-section-2,
        section.coupon-banner-section {
            padding-top: 16px !important;
            padding-bottom: 16px !important;
        }

        .container.container-1278 {
            padding-left: 12px !important;
            padding-right: 12px !important;
        }
    }

    /* ==========================================================================
       RICH TITLE & SUBTITLE INLINE HARMONIZATION (SUMMERNOTE COMPATIBILITY)
       Ensures custom font sizes, colors, and spans render seamlessly inside headings
       without unwanted block margins or accidental font-size downgrades.
       ========================================================================== */
    .hero-title p,
    .hero-subtitle p,
    .course-section-title p,
    .cow-title p,
    .cow-card-title p,
    .mc-bd-light-title p,
    .mc-bd-light-eyebrow p,
    .mc-special-gift-card h2 p,
    .mc-special-gift-card .gift-badge p,
    .common-heading h1 p,
    .common-heading h2 p,
    .common-heading h3 p,
    .common-heading h4 p,
    .common-heading span.tag-badge p,
    .mc-support-title p,
    .mc-support-subtitle p,
    .highlight-banner-card h3 p,
    .highlight-banner-card div p,
    .faq-content-wrap h2 p,
    .faq-content-wrap span p {
        display: inline !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: inherit !important;
    }
</style>
@endpush

@section('base.content')
    @php
        $mcSettings = [];
        if (isset($course) && $course) {
            $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
            if (!is_array($mcSettings)) $mcSettings = [];
        }
    @endphp
    @if(!isset($mcSettings['basic_info_status']) || $mcSettings['basic_info_status'] == 1)
    @include('frontend.homePage.hero_area.hero_area_one')
    @endif

    <div class="home-page-sections">
    <!--====== Start Feature Cards Section (Life Time Access, Free Course Materials, Dedicated Support) ======-->
    {{-- @include('frontend.homePage.feature_section') --}}

    <!--====== Start About Me Section ======-->
    @include('frontend.homePage.about_me_section')

    <!--====== Start Categories of Work Section ======-->
    @include('frontend.homePage.categories_of_work')

    <!--====== Start Benefits Section ======-->
    @php
        $showBenefits = true;
        if (isset($mcSettings['show_benefits_section'])) {
            $showBenefits = !empty($mcSettings['show_benefits_section']);
        } elseif (isset($mcSettings['benefits_status'])) {
            $showBenefits = !empty($mcSettings['benefits_status']);
        }
    @endphp
    @if($showBenefits)
    @include('frontend.homePage.benefits')
    @endif

    <!--====== Start Special Gift Section ======-->
    @if(!isset($mcSettings['gift_banner_status']) || $mcSettings['gift_banner_status'] == 1)
    @include('frontend.homePage.special_gift')
    @endif


    <!--====== Start Ad Banner 1 (Upper Home Section) ======-->
    @php
        $b1ImgSetting = setting('home_ad_banner_image_1') ?: setting('home_ad_banner_image');
        $b1Url = '';
        if ($b1ImgSetting) {
            $b1Url = getFileLink('original_image', $b1ImgSetting);
        }
        $b1Status = setting('home_ad_banner_status_1') !== '0';
        $b1Link = setting('home_ad_banner_link_1') ?: setting('home_ad_banner_link');
        
        if(isset($course) && $course) {
            $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
            if(is_array($mcSettings)) {
                $b1Url = !empty($mcSettings['ad_banner_1_image_url']) ? $mcSettings['ad_banner_1_image_url'] : $b1Url;
                $b1Status = isset($mcSettings['ad_banner_1_status']) ? !empty($mcSettings['ad_banner_1_status']) : $b1Status;
                $b1Link = !empty($mcSettings['ad_banner_1_link']) ? $mcSettings['ad_banner_1_link'] : $b1Link;
            }
        }
        $b1Url = dynamic_asset($b1Url);
    @endphp
    @if(!isset($mcSettings['banners_status']) || $mcSettings['banners_status'] == 1)
@if($b1Url && $b1Status && !str_contains($b1Url, 'default'))
    <section class="ad-banner-section-1 p-t-60 p-b-60 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center" data-aos="fade-up">
                    @if($b1Link)
                        <a href="{{ $b1Link }}" target="_blank" class="d-block w-100 overflow-hidden">
                    @endif
                        <img src="{{ $b1Url }}" alt="Ad Banner 1" class="img-fluid w-100" style="border-radius: 0px !important; width: 100%; height: auto; max-height: none !important; display: block; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    @if($b1Link)
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif
@endif


    <!--====== Start What You Will Learn ======-->
    @if(isset($course) && $course && $course->outcomes)
    <section class="what-you-learn-section p-t-60 p-b-60 position-relative" style="background-color: var(--color-blue-tint, #EAF2FE);">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="common-heading text-center m-b-40" data-aos="fade-up">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: var(--color-primary, #0056D2); letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('WHAT YOU WILL LEARN') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: var(--color-text-ink, #0A1E3F); font-size: 38px; line-height: 1.25;">
                            {{ __('Course Outcomes & Key Takeaways') }}
                        </h2>
                    </div>
                    <style>
                        @media (max-width: 768px) {
                            .learn-outcomes-content,
                            .learn-outcomes-content * {
                                font-size: 14.5px !important;
                                line-height: 1.65 !important;
                                color: var(--color-text-secondary, #4B5A72) !important;
                            }
                        }
                    </style>
                    <div class="card shadow-lg border-0 p-4 p-md-5" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px; background: var(--color-white, #ffffff); border: 1px solid var(--color-border-tint, #D9E8FC) !important;">
                        <div class="learn-outcomes-content" style="color: var(--color-text-secondary, #4B5A72); font-size: 16px; line-height: 1.8;">
                            {!! $course->outcomes !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Instructor Profile ======-->
    {{--
    @if(isset($course) && $course && $course->instructor)
    <section class="instructor-section p-t-60 p-b-60 bg-white">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-lg-8 text-center">
                    <div class="common-heading text-center m-b-40" data-aos="fade-up">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #0056D2; letter-spacing: 1.5px; font-size: 14px;">
                            {{ __('MEET YOUR INSTRUCTOR') }}
                        </span>
                        <h2 class="fw-bold m-b-0" style="color: #0A1E3F; font-size: 38px; line-height: 1.25;">
                            {{ __('Learn From An Expert Mentor') }}
                        </h2>
                    </div>

                    <div class="instructor-card p-4 p-md-5 bg-white shadow-lg border border-light" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px;">
                        <img src="{{ getFileLink('100x100', $course->instructor->image) }}" 
                             class="rounded-circle mb-4 shadow" 
                             alt="{{ $course->instructor->name }}" 
                             style="width: 130px; height: 130px; object-fit: cover; border: 4px solid #0056D2; padding: 3px;">
                        
                        <h3 class="fw-bold mb-1" style="color: #0A1E3F; font-size: 24px;">{{ $course->instructor->name }}</h3>
                        <span class="d-inline-block fw-semibold mb-4 px-3 py-1 rounded-pill" style="background: var(--color-blue-tint, #EAF2FE); color: var(--color-primary, #0056D2); font-size: 14px;">
                            {{ $course->instructor->instructor->designation ?? 'Lead Instructor' }}
                        </span>
                        
                        <div class="text-secondary" style="line-height: 1.8; color: #4B5A72; font-size: 15.5px;">
                            {!! $course->instructor->about !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
    --}}





    <!--====== Start Syllabus Section ======-->
    @if(!isset($mcSettings['curriculum_status']) || $mcSettings['curriculum_status'] == 1)
    @include('frontend.homePage.syllabus')
    @endif

    <!--====== Start Success Banner Section ======-->
    @php
        $successBannerImg = setting('success_page_banner_image');
        $successBannerUrl = '';
        if (is_array($successBannerImg) && !empty($successBannerImg['original_image'])) {
            $successBannerUrl = get_media($successBannerImg['original_image'], $successBannerImg['storage'] ?? 'local');
        } elseif ($successBannerImg) {
            $successBannerUrl = getFileLink('original_image', $successBannerImg);
        }
    @endphp
    @if((string)setting('success_page_banner_status') !== '0' && $successBannerUrl && !str_contains($successBannerUrl, 'default'))
    <section class="success-banner-section p-t-60 p-b-20 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center">
                    <div class="common-heading text-center m-b-40" data-aos="fade-up">
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #0056D2; letter-spacing: 1.5px; font-size: 14px;">
                            {{ setting('success_page_banner_tag') ?: 'Success Stories' }}
                        </span>
                        <h2 class="fw-bold m-b-20" style="color: #0A1E3F; font-size: 38px; line-height: 1.25;">
                            {{ setting('success_page_banner_title') ?: 'Real People. Real Learning. Real Success.' }}
                        </h2>
                        <p class="text-muted font-16">{{ setting('success_page_banner_description') ?: 'Discover how learners are achieving their goals and building better futures with Coradius IT Center.' }}</p>
                    </div>
                    <img src="{{ $successBannerUrl }}" alt="Success Banner" class="img-fluid w-100" data-aos="fade-up" data-aos-delay="100" style="border-radius: 20px; max-height: 500px; object-fit: cover; display: block; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);">
                </div>
            </div>
        </div>
    </section>
    @endif

    <!--====== Start Success Story Section ======-->
    @if((string)setting('success_section_status') !== '0')
    @include('frontend.homePage.success')
    @endif

    <!--====== Start Offer Breakdown Section (Today's Value Breakdown) ======-->
    @if(!isset($mcSettings['breakdown_status']) || $mcSettings['breakdown_status'] == 1)
    @include('frontend.homePage.offer_breakdown')
    @endif

    <!--====== Start Ad Banner 2 (Lower Home Section) ======-->
    @php
        $b2ImgSetting = setting('home_ad_banner_image_2');
        $b2Url = '';
        if ($b2ImgSetting) {
            $b2Url = getFileLink('original_image', $b2ImgSetting);
        }
        $b2Status = setting('home_ad_banner_status_2') !== '0';
        $b2Link = setting('home_ad_banner_link_2');
        
        if(isset($course) && $course) {
            $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
            if(is_array($mcSettings)) {
                $b2Url = !empty($mcSettings['ad_banner_2_image_url']) ? $mcSettings['ad_banner_2_image_url'] : $b2Url;
                $b2Status = isset($mcSettings['ad_banner_2_status']) ? !empty($mcSettings['ad_banner_2_status']) : $b2Status;
                $b2Link = !empty($mcSettings['ad_banner_2_link']) ? $mcSettings['ad_banner_2_link'] : $b2Link;
            }
        }
        $b2Url = dynamic_asset($b2Url);
    @endphp

    @if(!isset($mcSettings['banners_status']) || $mcSettings['banners_status'] == 1)
@if($b2Url && $b2Status && !str_contains($b2Url, 'default'))
    <section class="ad-banner-section-2 p-t-60 p-b-60 bg-white overflow-hidden">
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center" data-aos="fade-up">
                    @if($b2Link)
                        <a href="{{ $b2Link }}" target="_blank" class="d-block w-100 overflow-hidden">
                    @endif
                        <img src="{{ $b2Url }}" alt="Ad Banner 2" class="img-fluid w-100" style="border-radius: 0px !important; width: 100%; height: auto; max-height: none !important; display: block; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    @if($b2Link)
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </section>
    @endif
@endif

    <!--====== Start FAQ Section ======-->
    @if(!isset($mcSettings['faq_status']) || $mcSettings['faq_status'] == 1)
    @include('frontend.homePage.faq')
    @endif

    <!--====== Start Support Section ======-->
    @if(!isset($mcSettings['support_status']) || $mcSettings['support_status'] == 1)
    @include('frontend.homePage.support')
    @endif





    <!--====== Start Coupon Banner Section ======-->
    @if(isset($active_banner_coupon) && $active_banner_coupon && $active_banner_coupon->image)
    <section class="coupon-banner-section p-t-60 p-b-60 bg-white overflow-hidden">
        <style>
            .coupon-code-badge {
                cursor: pointer;
                user-select: none;
                transition: transform 0.2s ease, box-shadow 0.2s ease, background-color 0.2s ease;
                white-space: nowrap;
            }
            .coupon-code-badge:hover {
                transform: translateX(-50%) scale(1.05) !important;
                box-shadow: 0 6px 18px rgba(0, 86, 210, 0.35) !important;
            }
            .coupon-code-badge:active {
                transform: translateX(-50%) scale(0.98) !important;
            }
            @media (max-width: 768px) {
                .coupon-banner-wrapper {
                    width: 100%;
                }
                .coupon-banner-wrapper img {
                    max-height: 220px !important;
                    width: 100% !important;
                    object-fit: cover !important;
                }
                .coupon-code-badge {
                    font-size: 14px !important;
                    padding: 6px 16px !important;
                    bottom: -16px !important;
                    max-width: 90% !important;
                }
                .coupon-code-badge svg {
                    width: 14px !important;
                    height: 14px !important;
                }
            }
            @media (max-width: 480px) {
                .coupon-code-badge {
                    font-size: 13px !important;
                    padding: 5px 14px !important;
                    bottom: -14px !important;
                }
            }
        </style>
        <div class="container container-1278">
            <div class="row justify-content-center">
                <div class="col-12 text-center" data-aos="fade-up">
                    <div class="coupon-banner-wrapper position-relative d-inline-block">
                        <img src="{{ getFileLink('original_image', $active_banner_coupon->image) }}" alt="Special Offer Coupon" class="img-fluid rounded shadow-sm" style="max-width: 100%; max-height: 400px; object-fit: cover; border: 2px dashed #0056D2;">
                        <div class="coupon-code-badge position-absolute"
                             id="bannerCouponBadge"
                             onclick="copyCouponCode('{{ $active_banner_coupon->code }}', this)"
                             title="Click to copy coupon code"
                             style="bottom: -15px; left: 50%; transform: translateX(-50%); background: #001F5C; color: white; padding: 8px 24px; border-radius: 30px; font-weight: bold; font-size: 18px; box-shadow: 0 4px 10px rgba(0,0,0,0.15); border: 2px solid #0056D2;">
                            CODE: <span style="color: #FF7A00;">{{ $active_banner_coupon->code }}</span>
                            <svg class="ms-2" xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="#FF7A00" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -2px;">
                                <rect x="9" y="9" width="13" height="13" rx="2" ry="2"></rect>
                                <path d="M5 15H4a2 2 0 0 1-2-2V4a2 2 0 0 1 2-2h9a2 2 0 0 1 2 2v1"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-4 text-muted font-15">Use this code at checkout to get {{ $active_banner_coupon->discount_type == 'percent' ? $active_banner_coupon->discount . '%' : get_price($active_banner_coupon->discount, userCurrency()) }} off!</p>
                </div>
            </div>
        </div>
    </section>

    <script>
    function copyCouponCode(code, element) {
        if (!code) return;

        function onSuccess() {
            if (element) {
                const originalContent = element.innerHTML;
                element.innerHTML = '<span style="color: #ffffff;"><svg class="me-1" xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="#ffffff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: -3px;"><polyline points="20 6 9 17 4 12"></polyline></svg> Copied!</span>';
                element.style.background = '#0056D2';
                element.style.borderColor = '#0056D2';

                setTimeout(function() {
                    element.innerHTML = originalContent;
                    element.style.background = '#001F5C';
                    element.style.borderColor = '#0056D2';
                }, 2000);
            }

            const guestCouponInput = document.getElementById('guest_coupon_code');
            if (guestCouponInput) {
                guestCouponInput.value = code;
                const couponWrapper = document.querySelector('.coupon-form-wrapper');
                if (couponWrapper) {
                    couponWrapper.style.display = 'block';
                }
            }
        }

        if (navigator.clipboard && window.isSecureContext) {
            navigator.clipboard.writeText(code).then(onSuccess).catch(function() {
                fallbackCopy();
            });
        } else {
            fallbackCopy();
        }

        function fallbackCopy() {
            try {
                var tempInput = document.createElement("input");
                tempInput.value = code;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand("copy");
                document.body.removeChild(tempInput);
                onSuccess();
            } catch (err) {
                console.error('Failed to copy coupon code: ', err);
            }
        }
    }
    </script>
    @endif

    <!--====== Start Order Form Section ======-->
    @if(!isset($mcSettings['pricing_status']) || $mcSettings['pricing_status'] == 1)
    @include('frontend.homePage.order_form')
    @endif



    <!--====== Global Countdown Script for both timers is now in footer.blade.php ======-->

    <!--====== Start Footer ======-->
    </div>
    @include('frontend.layouts.footer')
@endsection



