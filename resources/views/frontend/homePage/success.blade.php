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
    $successSubtitle = !empty($mcSettings['success_description']) ? $mcSettings['success_description'] : setting('success_section_description');

    $getVideoInfo = function($video) {
        if (empty($video)) return null;
        $video = trim($video);

        // Check YouTube
        if (preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $video, $matches)) {
            return [
                'type' => 'youtube',
                'url'  => 'https://www.youtube.com/embed/' . $matches[1] . '?autoplay=1&rel=0'
            ];
        }

        // Check Vimeo
        if (preg_match('/vimeo\.com\/(?:channels\/(?:\w+\/)?|groups\/([^\/]*)\/videos\/|album\/(\d+)\/video\/|video\/|)(\d+)/i', $video, $matches)) {
            return [
                'type' => 'vimeo',
                'url'  => 'https://player.vimeo.com/video/' . $matches[3] . '?autoplay=1'
            ];
        }

        // Local or direct video file
        $url = \Illuminate\Support\Str::startsWith($video, ['http://', 'https://']) ? $video : asset($video);
        return [
            'type' => 'video',
            'url'  => $url
        ];
    };
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
    
    /* Media Container on Top of Card */
    .custom-testimonial-card .card-top-media {
        position: relative;
        width: 100%;
        height: 220px;
        overflow: hidden;
        cursor: pointer;
        background-color: #0A1E3F;
    }
    .custom-testimonial-card .card-top-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.45s ease, opacity 0.3s ease;
        display: block;
    }
    .custom-testimonial-card:hover .card-top-image {
        transform: scale(1.06);
        opacity: 0.92;
    }

    /* Play Button Overlay */
    .story-media-overlay {
        position: absolute;
        inset: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        background: rgba(10, 30, 63, 0.22);
        transition: background 0.3s ease;
    }
    .custom-testimonial-card:hover .story-media-overlay {
        background: rgba(10, 30, 63, 0.42);
    }
    .story-play-btn {
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: #ffffff;
        color: var(--color-primary, #0056D2);
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 20px rgba(0, 86, 210, 0.35);
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .story-play-btn svg {
        margin-left: 3px;
        fill: var(--color-primary, #0056D2);
        transition: fill 0.3s ease;
    }
    .custom-testimonial-card:hover .story-play-btn {
        transform: scale(1.15);
        background: #FF7A00;
        box-shadow: 0 6px 24px rgba(255, 122, 0, 0.5);
    }
    .custom-testimonial-card:hover .story-play-btn svg {
        fill: #ffffff;
    }

    /* Video Tag Badge */
    .story-badge-video {
        position: absolute;
        top: 12px;
        left: 12px;
        background: rgba(0, 86, 210, 0.9);
        color: #ffffff;
        font-size: 11px;
        font-weight: 700;
        padding: 4px 10px;
        border-radius: 20px;
        backdrop-filter: blur(4px);
        display: inline-flex;
        align-items: center;
        gap: 5px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.2);
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

    /* Story Media Popup Modal - Pretty Large White Theme */
    .story-media-modal {
        position: fixed;
        inset: 0;
        z-index: 999999;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 24px;
        opacity: 0;
        visibility: hidden;
        transition: opacity 0.3s ease, visibility 0.3s ease;
    }
    .story-media-modal.is-open {
        opacity: 1;
        visibility: visible;
    }
    .story-modal-backdrop {
        position: absolute;
        inset: 0;
        background: rgba(8, 20, 40, 0.82);
        backdrop-filter: blur(10px);
        -webkit-backdrop-filter: blur(10px);
    }
    .story-modal-dialog {
        position: relative;
        z-index: 2;
        width: 95%;
        max-width: 1120px;
        max-height: 94vh;
        background: #ffffff;
        border-radius: 18px;
        overflow-y: auto;
        overflow-x: hidden;
        border: 1px solid rgba(0, 0, 0, 0.08);
        box-shadow: 0 30px 80px rgba(0, 0, 0, 0.45);
        display: flex;
        flex-direction: column;
        transform: scale(0.92);
        transition: transform 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
    }
    .story-media-modal.is-open .story-modal-dialog {
        transform: scale(1);
    }
    .story-modal-close {
        position: absolute;
        top: 18px;
        right: 18px;
        width: 42px;
        height: 42px;
        border-radius: 50%;
        background: rgba(0, 0, 0, 0.68);
        border: 1.5px solid rgba(255, 255, 255, 0.3);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        z-index: 10;
        transition: all 0.25s ease;
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.25);
    }
    .story-modal-close:hover {
        background: #FF7A00;
        border-color: #FF7A00;
        color: #ffffff;
        transform: rotate(90deg) scale(1.08);
    }
    .story-modal-media-holder {
        width: 100%;
        background: #F8FAFC;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 420px;
    }
    .story-modal-media-holder iframe {
        width: 100%;
        aspect-ratio: 16 / 9;
        border: none;
        display: block;
        background: #000000;
    }
    .story-modal-media-holder video {
        width: 100%;
        max-height: 72vh;
        object-fit: contain;
        display: block;
        background: #000000;
    }
    .story-modal-media-holder img {
        width: 100%;
        max-height: 72vh;
        object-fit: contain;
        display: block;
        background: #F8FAFC;
    }
    .story-modal-footer {
        padding: 26px 36px 30px;
        background: #ffffff;
        border-top: 1px solid #E8EEF5;
        color: #0F172A;
    }
    .story-modal-author-info h5 {
        margin: 0 0 4px 0;
        color: #0A1E3F;
        font-size: 22px;
        font-weight: 700;
        line-height: 1.3;
    }
    .story-modal-author-info span {
        font-size: 15px;
        color: #64748B;
        font-weight: 500;
    }
    .story-modal-desc {
        margin: 14px 0 0 0;
        font-size: 16.5px;
        line-height: 1.75;
        color: #334155;
    }
    @media (max-width: 767px) {
        .story-modal-dialog {
            width: 96%;
            max-height: 92vh;
            border-radius: 14px;
        }
        .story-modal-media-holder {
            min-height: 250px;
        }
        .story-modal-media-holder video,
        .story-modal-media-holder img {
            max-height: 52vh;
        }
        .story-modal-footer {
            padding: 18px 20px 22px;
        }
        .story-modal-author-info h5 {
            font-size: 18px;
        }
        .story-modal-desc {
            font-size: 14.5px;
        }
    }
</style>

<section class="success-story-section p-t-60 p-b-60 position-relative" id="success" style="background-color: #ffffff;">
    <div class="container container-1278">
        <!-- Section Header (Left aligned with Eyebrow, Title, Subtitle & Button) -->
        <div class="row mb-4 mb-md-5">
            <div class="col-12 col-lg-8">
                <div class="common-heading" data-aos="fade-up" dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                    @if(!empty($successEyebrow))
                        <span class="sub-title text-uppercase fw-bold m-b-12 d-inline-block" style="color: #0056D2; letter-spacing: 1.5px; font-size: 14px;">
                            {!! format_title_highlight($successEyebrow) !!}
                        </span>
                    @endif
                    @if(!empty($successTitle))
                        <h2 class="fw-bold m-b-12" style="color: #0A1E3F; font-size: 32px; line-height: 1.25;">
                            {!! format_title_highlight($successTitle) !!}
                        </h2>
                    @endif
                    @if(!empty($successSubtitle))
                        <div class="m-b-20" style="color: #4B5A72; font-size: 16px; line-height: 1.7; max-width: 680px;">
                            {!! $successSubtitle !!}
                        </div>
                    @endif
                    @if(!empty($successBtnText))
                        <div class="m-t-20">
                            <a href="{{ $successBtnUrl }}" class="template-btn" style="border-radius: 8px;">
                                {{ $successBtnText }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Bottom Tier: Full-Width Showcase Grid / Slider -->
        <div class="row">
            <div class="col-12">
                @if(count($success_stories) > 0)
                    @if(count($success_stories) > 2)
                        <div class="success-slider-container">
                            <div class="success-slider" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                                @foreach($success_stories as $success)
                                    @php
                                        $mediaType = $success->media_type ?? (!empty($success->video) ? 'video' : 'image');
                                        $hasVideo  = ($mediaType === 'video' && !empty($success->video));
                                        $videoInfo = $hasVideo ? $getVideoInfo($success->video) : null;
                                        $fullImage = getFileLink('original_image', $success->image);
                                        $cardImage = getFileLink('473x337', $success->image);
                                    @endphp
                                    <div class="px-2 pb-2 h-100">
                                        <div class="custom-testimonial-card">
                                            <div class="card-top-media js-open-story-modal"
                                                 role="button"
                                                 tabindex="0"
                                                 title="{{ __('Click to preview') }}"
                                                 data-title="{{ $success->title }}"
                                                 data-position="{{ $success->position ?? __('Student') }}"
                                                 data-desc="{{ $success->description }}"
                                                 data-image="{{ $fullImage }}"
                                                 data-has-video="{{ $videoInfo ? '1' : '0' }}"
                                                 data-video-type="{{ $videoInfo['type'] ?? '' }}"
                                                 data-video-url="{{ $videoInfo['url'] ?? '' }}">
                                                
                                                <img class="card-top-image" src="{{ $cardImage }}" alt="{{ $success->title }} Preview">
                                                
                                                @if($videoInfo)
                                                    <div class="story-media-overlay">
                                                        <span class="story-badge-video"><i class="fas fa-play" style="font-size: 9px;"></i> {{ __('Watch Story') }}</span>
                                                        <div class="story-play-btn">
                                                            <svg width="22" height="22" viewBox="0 0 24 24">
                                                                <polygon points="6 3 20 12 6 21 6 3"></polygon>
                                                            </svg>
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
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
                        <div class="row g-4 justify-content-center" data-direction="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">
                            @foreach($success_stories as $success)
                                @php
                                    $mediaType = $success->media_type ?? (!empty($success->video) ? 'video' : 'image');
                                    $hasVideo  = ($mediaType === 'video' && !empty($success->video));
                                    $videoInfo = $hasVideo ? $getVideoInfo($success->video) : null;
                                    $fullImage = getFileLink('original_image', $success->image);
                                    $cardImage = getFileLink('473x337', $success->image);
                                @endphp
                                <div class="col-md-6 col-lg-4 d-flex align-items-stretch">
                                    <div class="custom-testimonial-card w-100" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                                        <div class="card-top-media js-open-story-modal"
                                             role="button"
                                             tabindex="0"
                                             title="{{ __('Click to preview') }}"
                                             data-title="{{ $success->title }}"
                                             data-position="{{ $success->position ?? __('Student') }}"
                                             data-desc="{{ $success->description }}"
                                             data-image="{{ $fullImage }}"
                                             data-has-video="{{ $videoInfo ? '1' : '0' }}"
                                             data-video-type="{{ $videoInfo['type'] ?? '' }}"
                                             data-video-url="{{ $videoInfo['url'] ?? '' }}">
                                            
                                            <img class="card-top-image" src="{{ $cardImage }}" alt="{{ $success->title }} Preview">
                                            
                                            @if($videoInfo)
                                                <div class="story-media-overlay">
                                                    <span class="story-badge-video"><i class="fas fa-play" style="font-size: 9px;"></i> {{ __('Watch Story') }}</span>
                                                    <div class="story-play-btn">
                                                        <svg width="22" height="22" viewBox="0 0 24 24">
                                                            <polygon points="6 3 20 12 6 21 6 3"></polygon>
                                                        </svg>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
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
        </div>
    </div>

    <!-- Story Media Popup Modal -->
    <div id="storyMediaModal" class="story-media-modal" aria-hidden="true" role="dialog">
        <div class="story-modal-backdrop js-close-story-modal"></div>
        <div class="story-modal-dialog">
            <button type="button" class="story-modal-close js-close-story-modal" aria-label="Close">
                <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="18" y1="6" x2="6" y2="18"></line>
                    <line x1="6" y1="6" x2="18" y2="18"></line>
                </svg>
            </button>
            <div class="story-modal-media-holder" id="storyMediaHolder">
                <!-- Media injected here dynamically -->
            </div>
            <div class="story-modal-footer">
                <div class="story-modal-author-info">
                    <h5 id="storyModalTitle"></h5>
                    <span id="storyModalPosition"></span>
                </div>
                <p id="storyModalDesc" class="story-modal-desc"></p>
            </div>
        </div>
    </div>
</section>
<!--====== End Success Story Section ======-->

@push('js')
<script>
    $(document).ready(function() {
        // Slick Slider initialization
        if ($('.success-slider').length) {
            const isRtl = $('.success-slider').data('direction') === 'rtl';
            $('.success-slider').slick({
                rtl: isRtl,
                dots: true,
                arrows: false,
                infinite: true,
                speed: 500,
                slidesToShow: 3,
                slidesToScroll: 1,
                autoplay: true,
                autoplaySpeed: 4000,
                responsive: [
                    {
                        breakpoint: 1200,
                        settings: {
                            slidesToShow: 2,
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

        // Detect drag in slick so drag won't trigger click modal
        let isDragging = false;
        $('.success-slider').on('beforeChange', function() {
            isDragging = true;
        });
        $('.success-slider').on('afterChange', function() {
            setTimeout(function() { isDragging = false; }, 80);
        });
        $('.success-slider').on('mousedown touchstart', function() {
            isDragging = false;
        });
        $('.success-slider').on('mousemove touchmove', function() {
            isDragging = true;
        });

        // Popup Modal Handling
        const $modal = $('#storyMediaModal');
        const $holder = $('#storyMediaHolder');
        const $title = $('#storyModalTitle');
        const $position = $('#storyModalPosition');
        const $desc = $('#storyModalDesc');

        function openModal(data) {
            $holder.empty();

            if (data.hasVideo === '1' && data.videoUrl) {
                if (data.videoType === 'youtube' || data.videoType === 'vimeo') {
                    const iframe = document.createElement('iframe');
                    iframe.src = data.videoUrl;
                    iframe.setAttribute('allow', 'autoplay; fullscreen');
                    iframe.setAttribute('allowfullscreen', 'true');
                    $holder.append(iframe);
                } else {
                    const video = document.createElement('video');
                    video.src = data.videoUrl;
                    video.controls = true;
                    video.autoplay = true;
                    video.playsInline = true;
                    $holder.append(video);
                }
            } else if (data.image) {
                const img = document.createElement('img');
                img.src = data.image;
                img.alt = data.title || 'Success Story';
                $holder.append(img);
            }

            $title.text(data.title || '');
            $position.text(data.position || '');
            if (data.desc) {
                $desc.text('"' + data.desc + '"').show();
            } else {
                $desc.text('').hide();
            }

            $modal.addClass('is-open').attr('aria-hidden', 'false');
            $('body').css('overflow', 'hidden');
        }

        function closeModal() {
            $modal.removeClass('is-open').attr('aria-hidden', 'true');
            $holder.empty(); // Immediately stops any playing video/audio
            $('body').css('overflow', '');
        }

        $(document).on('click', '.js-open-story-modal', function(e) {
            if (isDragging) return;
            e.preventDefault();

            const $this = $(this);
            openModal({
                hasVideo: $this.attr('data-has-video'),
                videoType: $this.attr('data-video-type'),
                videoUrl: $this.attr('data-video-url'),
                image: $this.attr('data-image'),
                title: $this.attr('data-title'),
                position: $this.attr('data-position'),
                desc: $this.attr('data-desc')
            });
        });

        // Close on X or backdrop click
        $(document).on('click', '.js-close-story-modal', function(e) {
            e.preventDefault();
            closeModal();
        });

        // Close on Escape key
        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $modal.hasClass('is-open')) {
                closeModal();
            }
        });
    });
</script>
@endpush
