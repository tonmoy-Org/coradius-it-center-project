@php
    $lang = app()->getLocale();
    $status = setting('about_me_status');
    $tag = setting('about_me_tag', $lang);
    $title = setting('about_me_title', $lang);
    $desc1 = setting('about_me_description', $lang);
    $desc2 = setting('about_me_description_2', $lang);
    
    $mcSettings = [];
    if (isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
    }
    if (isset($hero_course) && $hero_course && empty($mcSettings)) {
        $mcSettings = is_array($hero_course->masterclass_settings) ? $hero_course->masterclass_settings : json_decode($hero_course->masterclass_settings ?? '[]', true);
    }
    
    $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : null;
    $btnText = $heroBtnText ?: setting('about_me_btn_text', $lang);
    $rawBtnUrl = setting('about_me_btn_url', $lang);
    if (empty($rawBtnUrl) || $rawBtnUrl === '#') {
        $btnUrl = (request()->is('/') || request()->is('home*') || isHome()) ? '#register' : url('/#register');
    } else {
        $btnUrl = \Illuminate\Support\Str::startsWith($rawBtnUrl, ['http://', 'https://', '/']) ? $rawBtnUrl : url($rawBtnUrl);
    }

    $aboutImgSetting = setting('about_me_image');
    $aboutImgUrl = '';
    if ($aboutImgSetting) {
        $aboutImgUrl = getFileLink('original_image', $aboutImgSetting);
    }
    if (!$aboutImgUrl || str_contains($aboutImgUrl, 'default')) {
        $aboutMediaId = setting('about_me_media_id');
        if ($aboutMediaId) {
            $media = \App\Models\MediaLibrary::find($aboutMediaId);
            if ($media && !empty($media->image_variants)) {
                $aboutImgUrl = getFileLink('original_image', $media->image_variants);
            }
        }
    }
    if (!$aboutImgUrl || str_contains($aboutImgUrl, 'default')) {
        $aboutImgUrl = static_asset('images/about/about_me_instructor.jpg');
    }
@endphp

<style>
    .about-me-description-content {
        line-height: 1.85 !important;
        color: var(--color-text-secondary, #4B5A72) !important;
    }
    .about-me-description-content p {
        line-height: 1.85 !important;
        color: var(--color-text-secondary, #4B5A72) !important;
        margin-bottom: 16px;
    }
    .about-me-description-content ul {
        list-style: disc outside !important;
        padding-left: 0 !important;
        margin-bottom: 20px !important;
    }
    .about-me-description-content ol {
        list-style: decimal outside !important;
        padding-left: 0 !important;
        margin-bottom: 20px !important;
    }
    .about-me-description-content li {
        display: list-item !important;
        margin-left: 25px !important;
        margin-bottom: 10px !important;
        line-height: 1.7 !important;
        color: var(--color-text-secondary, #4B5A72) !important;
    }

    @media (min-width: 768px) {
        .about-me-description-content,
        .about-me-description-content p,
        .about-me-description-content li {
            font-size: 16px !important;
        }
    }
    @media (max-width: 767.98px) {
        .about-me-description-content,
        .about-me-description-content p,
        .about-me-description-content li {
            font-size: var(--mobile-font-body, 13.5px) !important;
            line-height: 1.65 !important;
        }
    }
</style>

@if($status !== '0')
<section class="about-me-section p-t-80 p-b-80 position-relative overflow-hidden bg-white" id="about">
    <!-- Background Network Node Design -->
    <div style="position: absolute; top: 10%; right: -5%; width: 500px; height: 500px; z-index: 0; opacity: 0.05; pointer-events: none;">
        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
            <circle cx="100" cy="100" r="30" fill="none" stroke="#0056D2" stroke-width="2"/>
            <circle cx="100" cy="100" r="15" fill="#0056D2" />
            <line x1="100" y1="70" x2="100" y2="20" stroke="#0056D2" stroke-width="2"/>
            <line x1="100" y1="130" x2="100" y2="180" stroke="#0056D2" stroke-width="2"/>
            <line x1="70" y1="100" x2="20" y2="100" stroke="#0056D2" stroke-width="2"/>
            <line x1="130" y1="100" x2="180" y2="100" stroke="#0056D2" stroke-width="2"/>
            <line x1="78.7" y1="78.7" x2="43.4" y2="43.4" stroke="#0056D2" stroke-width="2"/>
            <line x1="121.3" y1="121.3" x2="156.6" y2="156.6" stroke="#0056D2" stroke-width="2"/>
            <line x1="78.7" y1="121.3" x2="43.4" y2="156.6" stroke="#0056D2" stroke-width="2"/>
            <line x1="121.3" y1="78.7" x2="156.6" y2="43.4" stroke="#0056D2" stroke-width="2"/>
            <circle cx="100" cy="20" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
            <circle cx="100" cy="180" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
            <circle cx="20" cy="100" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
            <circle cx="180" cy="100" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
            <circle cx="43.4" cy="43.4" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
            <circle cx="156.6" cy="156.6" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
            <circle cx="43.4" cy="156.6" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
            <circle cx="156.6" cy="43.4" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
        </svg>
    </div>
    <div class="container container-1278 position-relative" style="z-index: 1;">
        <div class="row align-items-center g-4 g-lg-5">
            <!-- Left Side Image Card -->
            <div class="col-lg-5 col-md-12" data-aos="fade-right">
                <div class="about-me-card position-relative overflow-hidden shadow-sm" 
                     style="border-radius: 16px; min-height: 500px; border: 1px solid var(--color-border-tint, #D9E8FC); box-shadow: 0 10px 30px rgba(0, 86, 210, 0.08);">
                    <!-- Background Network Node Design inside Image Card -->
                    <div style="position: absolute; top: -10%; right: -10%; width: 280px; height: 280px; z-index: 0; opacity: 0.12; pointer-events: none;">
                        <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" style="width: 100%; height: 100%;">
                            <circle cx="100" cy="100" r="30" fill="none" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="100" cy="100" r="15" fill="#0056D2" />
                            <line x1="100" y1="70" x2="100" y2="20" stroke="#0056D2" stroke-width="2"/>
                            <line x1="100" y1="130" x2="100" y2="180" stroke="#0056D2" stroke-width="2"/>
                            <line x1="70" y1="100" x2="20" y2="100" stroke="#0056D2" stroke-width="2"/>
                            <line x1="130" y1="100" x2="180" y2="100" stroke="#0056D2" stroke-width="2"/>
                            <line x1="78.7" y1="78.7" x2="43.4" y2="43.4" stroke="#0056D2" stroke-width="2"/>
                            <line x1="121.3" y1="121.3" x2="156.6" y2="156.6" stroke="#0056D2" stroke-width="2"/>
                            <line x1="78.7" y1="121.3" x2="43.4" y2="156.6" stroke="#0056D2" stroke-width="2"/>
                            <line x1="121.3" y1="78.7" x2="156.6" y2="43.4" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="100" cy="20" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="100" cy="180" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="20" cy="100" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="180" cy="100" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="43.4" cy="43.4" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="156.6" cy="156.6" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="43.4" cy="156.6" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
                            <circle cx="156.6" cy="43.4" r="15" fill="none" stroke="#0056D2" stroke-width="2"/>
                        </svg>
                    </div>
                    <img src="{{ $aboutImgUrl }}" alt="About Me Instructor" 
                         class="img-fluid w-100 position-relative" 
                         loading="lazy" decoding="async"
                         style="object-fit: cover; width: 100%; height: 100%; min-height: 500px; border-radius: 16px; display: block; z-index: 1;">
                </div>
            </div>

            <!-- Right Side Text Content -->
            <div class="col-lg-7 col-md-12" data-aos="fade-left" data-aos-delay="100">
                <div class="about-me-text-block ps-lg-4">
                    <div class="common-heading">
                        @if($tag)
                            <span class="sub-title text-uppercase fw-bold m-b-15 d-inline-block" style="color: var(--color-primary, #0056D2); letter-spacing: 2px; font-size: 15px;">
                                {{ __($tag) }}
                            </span>
                        @endif

                        @if($title)
                            <h2 class="m-b-25 fw-bold" style="color: var(--color-text-ink, #0A1E3F); font-size: 36px; line-height: 1.3;">
                                {!! format_title_highlight(__($title)) !!}
                            </h2>
                        @endif

                        @if($desc1)
                            <div class="m-b-30 about-me-description-content">
                                {!! __($desc1) !!}
                            </div>
                        @endif

                        @if($btnText)
                            <a href="{{ $btnUrl }}" class="template-btn about-me-btn get-access-btn">
                                {{ __($btnText) }}
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif
