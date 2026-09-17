<!--====== Start FAQ Section ======-->
@if(isset($course) && count($course->faqs) > 0 && (!isset($mcSettings['faq_status']) || !empty($mcSettings['faq_status'])))
<style>
    .custom-faq-accordion .accordion-item {
        border: 1px solid var(--color-border-tint, #D9E8FC);
        border-radius: 8px !important;
        margin-bottom: 16px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.02);
        overflow: hidden;
        transition: all 0.3s ease;
        background: var(--color-white, #ffffff);
        position: relative;
    }
    .custom-faq-accordion .accordion-item::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 70px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23F0F6FF' fill-opacity='1' d='M0,256L60,245.3C120,235,240,213,360,208C480,203,600,213,720,218.7C840,224,960,224,1080,218.7C1200,213,1320,203,1380,197.3L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: bottom center;
        background-repeat: no-repeat;
        z-index: 0;
        pointer-events: none;
    }
    .custom-faq-accordion .accordion-header,
    .custom-faq-accordion .accordion-collapse {
        position: relative;
        z-index: 1;
    }
    .custom-faq-accordion .accordion-item:hover {
        border-color: var(--color-primary, #0056D2);
        box-shadow: 0 8px 20px rgba(0, 86, 210, 0.08);
    }
    .custom-faq-accordion .accordion-button {
        background-color: transparent;
        color: var(--color-text-ink, #0A1E3F);
        font-weight: 700;
        font-size: 17px;
        padding: 22px 26px;
        box-shadow: none !important;
        border: none;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .custom-faq-accordion .accordion-button:not(.collapsed) {
        color: var(--color-primary, #0056D2);
        background-color: transparent;
    }
    .custom-faq-accordion .accordion-button::after {
        display: none;
    }
    .custom-faq-accordion .faq-toggle-icon {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background-color: var(--color-blue-tint, #EAF2FE);
        color: var(--color-primary, #0056D2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 18px;
        font-weight: 400;
        transition: all 0.3s ease;
        flex-shrink: 0;
        margin-left: 15px;
    }
    .custom-faq-accordion .accordion-button:not(.collapsed) .faq-toggle-icon {
        background-color: var(--color-primary, #0056D2);
        color: #ffffff;
        transform: rotate(45deg);
    }
    .custom-faq-accordion .accordion-body {
        background-color: transparent;
        color: var(--color-text-secondary, #4B5A72);
        font-size: 15px;
        line-height: 1.75;
        padding: 0 26px 24px 26px;
        border-top: none;
    }
    .faq-image-card {
        position: relative;
        border-radius: 8px;
        overflow: hidden;
        border: 6px solid #ffffff;
    }
    .faq-image-card img {
        width: 100%;
        height: auto;
        max-height: 500px;
        object-fit: cover;
        display: block;
        border-radius: 8px;
    }
    .faq-badge-floating {
        position: absolute;
        bottom: 25px;
        left: 25px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(10px);
        padding: 16px 24px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        gap: 15px;
    }

    /* Mobile & Tablet Responsive Media Queries */
    @media (max-width: 991.98px) {
        .faq-section {
            padding-top: 40px !important;
            padding-bottom: 40px !important;
        }
        .faq-image-card {
            margin-top: 25px;
            border-width: 4px;
        }
        .faq-image-card img {
            min-height: auto !important;
            max-height: 360px !important;
            height: 300px !important;
        }
        .custom-faq-accordion .accordion-button {
            font-size: 15px;
            padding: 16px 18px;
        }
        .custom-faq-accordion .accordion-body {
            padding: 0 18px 18px 18px;
            font-size: 14px;
        }
        .faq-content-wrap .common-heading h2 {
            font-size: 22px !important;
        }
    }

    @media (max-width: 575.98px) {
        .faq-image-card img {
            height: 220px !important;
            max-height: 240px !important;
        }
        .faq-badge-floating {
            bottom: 12px;
            left: 12px;
            right: 12px;
            padding: 10px 14px;
            gap: 10px;
        }
        .faq-badge-floating h5 {
            font-size: 0.85rem !important;
        }
        .faq-badge-floating span {
            font-size: 0.75rem !important;
            line-height: 1.3;
            display: block;
        }
        .faq-badge-icon {
            width: 36px !important;
            height: 36px !important;
            font-size: 1rem !important;
        }
        .custom-faq-accordion .faq-toggle-icon {
            width: 28px;
            height: 28px;
            font-size: 15px;
            margin-left: 10px;
        }
    }
</style>

<section class="faq-section p-t-60 p-b-60 position-relative" id="faq" style="background-color: #F8FAFE !important;">
    <div class="container container-1278">
        <div class="row">
            
            <!-- Full Width Title/Subtitle -->
            <div class="col-12">
                @php
                    $mcSettings = [];
                    if(isset($course) && $course) {
                        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
                        if(!is_array($mcSettings)) $mcSettings = [];
                    }
                    $faqTitle = !empty($mcSettings['faq_title']) ? $mcSettings['faq_title'] : '';
                    $faqSubtitle = !empty($mcSettings['faq_subtitle']) ? $mcSettings['faq_subtitle'] : '';
                    $faqBadgeTitle = !empty($mcSettings['faq_badge_title']) ? $mcSettings['faq_badge_title'] : '';
                    $faqBadgeSubtitle = !empty($mcSettings['faq_badge_subtitle']) ? $mcSettings['faq_badge_subtitle'] : '';
                @endphp
                @if(!empty($faqSubtitle) || !empty($faqTitle))
                <div class="common-heading m-b-30 text-center">
                    @if(!empty($faqSubtitle))
                        <span class="sub-title fw-bold m-b-12 d-inline-block" style="color: #0056D2; letter-spacing: 1.5px; font-size: 14px;">
                            {!! format_title_highlight($faqSubtitle) !!}
                        </span>
                    @endif
                    @if(!empty($faqTitle))
                        <h2 class="fw-bold m-b-0" style="color: #0A1E3F; font-size: 28px; line-height: 1.25;">
                            {!! format_title_highlight($faqTitle) !!}
                        </h2>
                    @endif
                </div>
                @endif
            </div>

            <!-- Full Width Image -->
            <div class="col-12 mb-5" data-aos="fade-up">
                @php
                    $faqImgUrl = '';
                    if (!empty($mcSettings['faq_image_media_id'])) {
                        $faqMedia = \App\Models\MediaLibrary::find($mcSettings['faq_image_media_id']);
                        if ($faqMedia && !empty($faqMedia->image_variants)) {
                            $faqImgUrl = getFileLink('original_image', $faqMedia->image_variants);
                        }
                    }
                    if (!$faqImgUrl && !empty($mcSettings['faq_image_url'])) {
                        $faqImgUrl = dynamic_asset($mcSettings['faq_image_url']);
                    }
                    if (!$faqImgUrl && !empty($course->faq_image)) {
                        $faqImgUrl = getFileLink('original_image', $course->faq_image);
                    }
                    if (!$faqImgUrl || str_contains($faqImgUrl, 'default')) {
                        $faqImgUrl = static_asset('images/faq/faq_classroom.jpg');
                    }
                @endphp

                <div class="faq-image-card" style="border-radius: 12px; border: none; box-shadow: 0 10px 30px rgba(0, 86, 210, 0.08);">
                    <img src="{{ $faqImgUrl }}" alt="{{ strip_tags($faqTitle) ?: 'FAQ' }}" style="border-radius: 12px; height: auto; max-height: 500px; width: 100%; object-fit: cover;">
                    
                    @if(!empty($faqBadgeTitle) || !empty($faqBadgeSubtitle))
                    <div class="faq-badge-floating d-flex">
                        <div class="faq-badge-icon d-flex align-items-center justify-content-center" 
                             style="width: 46px; height: 46px; border-radius: 8px; background: var(--color-blue-tint, #EAF2FE); color: var(--color-primary, #0056D2); font-size: 1.3rem;">
                            <i class="fas fa-question-circle"></i>
                        </div>
                        <div>
                            @if(!empty($faqBadgeTitle))
                            <h5 class="fw-bold mb-0" style="color: #0A1E3F; font-size: 1rem;">{!! format_title_highlight($faqBadgeTitle) !!}</h5>
                            @endif
                            @if(!empty($faqBadgeSubtitle))
                            <span style="color: #4B5A72; font-size: 0.85rem;">{!! format_title_highlight($faqBadgeSubtitle) !!}</span>
                            @endif
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- Full Width FAQ Accordion -->
            <div class="col-12">
                <div class="faq-content-wrap">
                    <div class="accordion custom-faq-accordion" id="courseFaqAccordion">
                        @foreach($course->faqs as $key => $faq)
                        <div class="accordion-item" data-aos="fade-up" data-aos-delay="{{ $loop->index * 80 }}">
                            <h2 class="accordion-header" id="headingFaq{{ $key }}">
                                <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapseFaq{{ $key }}" 
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}" 
                                        aria-controls="collapseFaq{{ $key }}">
                                    <span>{{ $faq->question }}</span>
                                    <span class="faq-toggle-icon">+</span>
                                </button>
                            </h2>
                            <div id="collapseFaq{{ $key }}" 
                                 class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" 
                                 aria-labelledby="headingFaq{{ $key }}" 
                                 data-bs-parent="#courseFaqAccordion">
                                 <div class="accordion-body">
                                     {!! $faq->answer !!}
                                 </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endif
<!--====== End FAQ Section ======-->
