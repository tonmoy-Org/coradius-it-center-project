<!--====== Start Success Story Section ======-->
@php
    if(!isset($success_stories) || count($success_stories) == 0) {
        $success_stories = \App\Models\SuccessStory::active()->featured()->latest()->get();
        if(count($success_stories) == 0) {
            $success_stories = \App\Models\SuccessStory::active()->latest()->get();
        }
    }

    $mcSettings = [];
    if (isset($hero_course) && $hero_course->masterclass_settings) {
        $mcSettings = is_array($hero_course->masterclass_settings) 
            ? $hero_course->masterclass_settings 
            : json_decode($hero_course->masterclass_settings, true);
    }

    $successEyebrow  = !empty($mcSettings['success_eyebrow']) ? $mcSettings['success_eyebrow'] : (setting('success_section_eyebrow') ?: '');
    $successTitle    = !empty($mcSettings['success_title']) ? $mcSettings['success_title'] : (isset($section->contents['title']) && !empty($section->contents['title']) ? $section->contents['title'] : (setting('success_section_title') ?: ''));
    $heroBtnText     = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : null;
    $successBtnText  = !empty($mcSettings['success_btn_text']) ? $mcSettings['success_btn_text'] : ($heroBtnText ?: setting('success_section_btn_text'));
    $successBtnUrl   = !empty($mcSettings['success_btn_url']) ? $mcSettings['success_btn_url'] : (setting('success_section_btn_url') ?: '#register');
@endphp
<style>
    /* Equal Height Card Container */
    .custom-testimonial-card {
        background: var(--color-white, #ffffff);
        border-radius: 8px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
        height: 100%;
        display: flex;
        flex-direction: column;
        overflow: hidden;
        border: 1px solid var(--color-border-tint, #D9E8FC);
        transition: all 0.3s ease;
        width: 100%;
    }
    .custom-testimonial-card:hover {
        border-color: var(--color-primary, #0056D2);
        box-shadow: 0 15px 35px rgba(0, 86, 210, 0.12);
        transform: translateY(-5px);
    }
    .custom-testimonial-card .card-top-image {
        width: 100%;
        height: 220px;
        object-fit: cover;
    }
    .custom-testimonial-card .card-body {
        padding: 26px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }
    .custom-testimonial-card p {
        color: var(--color-text-secondary, #4B5A72);
        font-size: 15.5px;
        line-height: 1.75;
        margin-bottom: 22px;
        display: -webkit-box;
        -webkit-line-clamp: 4;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .custom-testimonial-author {
        display: flex;
        align-items: center;
        margin-top: auto;
    }
    .custom-testimonial-author > img {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        margin-right: 14px;
        object-fit: cover;
        border: 2px solid var(--color-primary, #0056D2);
        padding: 2px;
    }
    .author-details {
        display: flex;
        flex-direction: column;
    }
    .author-details h6 {
        margin: 0 0 2px 0;
        font-size: 16px;
        font-weight: 700;
        color: var(--color-text-ink, #0A1E3F); 
    }
    .author-details span {
        font-size: 13px;
        color: var(--color-text-muted, #8A96A8);
        margin-bottom: 4px;
        font-weight: 500;
    }
    .author-details .stars {
        color: var(--color-accent-gold, #FFB800);
        font-size: 13px;
    }

    /* Slick Equal Height Slides Fix */
    .success-slider .slick-track {
        display: flex !important;
    }
    .success-slider .slick-slide {
        height: inherit !important;
    }
    .success-slider .slick-slide > div {
        height: 100%;
    }

    /* Custom Navigation Dots */
    .success-slider .slick-dots {
        position: relative;
        bottom: 0;
        margin-top: 30px;
        display: flex !important;
        justify-content: center;
        align-items: center;
        gap: 8px;
        list-style: none;
        padding: 0;
    }
    .success-slider .slick-dots li {
        margin: 0;
        width: auto;
        height: auto;
    }
    .success-slider .slick-dots li button {
        width: 8px;
        height: 8px;
        padding: 0;
        border-radius: 50%;
        background: #cbd5e1;
        border: none;
        outline: none;
        font-size: 0;
        transition: all 0.3s ease;
    }
    .success-slider .slick-dots li.slick-active button {
        background: var(--color-primary, #0056D2);
        width: 24px;
        border-radius: 6px;
    }
</style>

<section class="success-story-section p-t-60 p-b-60 position-relative" id="success" style="background-color: #ffffff;">
    <div class="container container-1278">
        <div class="row align-items-center g-5">
            
            <!-- Testimonial Cards Column -->
            <div class="col-lg-7 order-2 order-lg-1">
                @if(count($success_stories) > 0)
                    @if(count($success_stories) > 2)
                        <div class="success-slider-container">
                            <div class="success-slider" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                                @foreach($success_stories as $success)
                                    <div class="px-2 pb-2 h-100">
                                        <div class="custom-testimonial-card">
                                            <img class="card-top-image" src="{{ getFileLink('473x337', $success->image) }}" alt="Success Story Preview">
                                            <div class="card-body">
                                                <p>"{{ $success->description }}"</p>
                                                <div class="custom-testimonial-author">
                                                    <img src="{{ getFileLink('40x40', $success->image) }}" alt="{{ $success->title }}">
                                                    <div class="author-details">
                                                        <h6>{{ $success->title }}</h6>
                                                        <span>{{ $success->position ?? __('Student') }}</span>
                                                        <div class="stars">
                                                            @php $rating = (float)($success->rating ?? 5); @endphp
                                                            @for($i = 1; $i <= 5; $i++)
                                                                @if($rating >= $i)
                                                                    <i class="fas fa-star"></i>
                                                                @elseif($rating >= ($i - 0.5))
                                                                    <i class="fas fa-star-half-alt"></i>
                                                                @else
                                                                    <i class="far fa-star"></i>
                                                                @endif
                                                            @endfor
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @else
                        <div class="row g-4 d-flex align-items-stretch" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                            @foreach($success_stories as $success)
                                <div class="col-md-6 d-flex align-items-stretch">
                                    <div class="custom-testimonial-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                        <img class="card-top-image" src="{{ getFileLink('473x337', $success->image) }}" alt="Success Story Preview">
                                        <div class="card-body">
                                            <p>"{{ $success->description }}"</p>
                                            <div class="custom-testimonial-author">
                                                <img src="{{ getFileLink('40x40', $success->image) }}" alt="{{ $success->title }}">
                                                <div class="author-details">
                                                    <h6>{{ $success->title }}</h6>
                                                    <span>{{ $success->position ?? __('Student') }}</span>
                                                    <div class="stars">
                                                        @php $rating = (float)($success->rating ?? 5); @endphp
                                                        @for($i = 1; $i <= 5; $i++)
                                                            @if($rating >= $i)
                                                                <i class="fas fa-star"></i>
                                                            @elseif($rating >= ($i - 0.5))
                                                                <i class="fas fa-star-half-alt"></i>
                                                            @else
                                                                <i class="far fa-star"></i>
                                                            @endif
                                                        @endfor
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @else
                    @include('frontend.not_found', $data=['title'=> 'success stories'])
                @endif
            </div>

            <!-- Content & Heading Column -->
            <div class="col-lg-5 order-1 order-lg-2 ps-lg-4 mb-4 mb-lg-0">
                <div class="common-heading" data-aos="fade-left" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    @if(!empty($successEyebrow))
                        <span class="sub-title text-uppercase fw-bold m-b-15 d-inline-block" style="color: #0056D2; letter-spacing: 1.5px; font-size: 14px;">
                            {!! format_title_highlight($successEyebrow) !!}
                        </span>
                    @endif
                    @if(!empty($successTitle))
                        <h2 class="fw-bold m-b-20" style="color: #0A1E3F; font-size: 28px; line-height: 1.25;">
                            {!! format_title_highlight($successTitle) !!}
                        </h2>
                    @endif
                    @if(!empty($successSubtitle))
                        <p class="m-b-25" style="color: #4B5A72; font-size: 16px; line-height: 1.7;">
                            {{ $successSubtitle }}
                        </p>
                    @endif
                    @if(!empty($successBtnText))
                        <a href="{{ $successBtnUrl }}" class="template-btn" style="border-radius: 8px;">
                            {{ $successBtnText }}
                        </a>
                    @endif
                </div>
            </div>

        </div>
    </div>
</section>
<!--====== End Success Story Section ======-->

@push('js')
<script>
    $(document).ready(function() {
        if ($('.success-slider').length) {
            $('.success-slider').slick({
                dots: true,
                arrows: false,
                infinite: true,
                speed: 500,
                slidesToShow: 2,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                responsive: [
                    {
                        breakpoint: 992,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    },
                    {
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1,
                            slidesToScroll: 1
                        }
                    }
                ]
            });
        }
    });
</script>
@endpush
