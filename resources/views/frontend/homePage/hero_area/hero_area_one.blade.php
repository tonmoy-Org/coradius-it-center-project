@php
    $lang = App::getLocale();
@endphp

@if(isset($hero_course) && $hero_course)
<section class="hero-area p-t-60 p-b-60 text-center position-relative overflow-hidden" style="background: linear-gradient(180deg, var(--color-hero-bg-start, #001F5C) 0%, var(--color-hero-bg-end, #0B1226) 100%);">
    <!-- Floating background decorative shapes -->
    <div class="hero-bg-shapes">
        <div class="hero-shape hero-shape-1" data-speed="1.5"></div>
        <div class="hero-shape hero-shape-2" data-speed="-1.2"></div>
        <div class="hero-shape hero-shape-3" data-speed="2"></div>
        <div class="hero-shape hero-shape-4" data-speed="-0.8"></div>
    </div>
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-xl-11 col-lg-12 col-md-12">
                <div class="hero-content" data-aos="fade-up" data-aos-delay="200">
                    
                    {{-- Subject --}}
                    @if($hero_course->subject)
                        <div class="mb-3">
                            <a href="javascript:void(0)" style="text-decoration: none; display: inline-block;">
                                <span class="badge hero-badge hero-badge-animated" style="background-color: rgba(0, 86, 210, 0.2); color: #3B8AF2; padding: 6px 14px; border-radius: 20px; border: 1px solid rgba(59, 138, 242, 0.35); cursor: pointer;">{{ trim($hero_course->subject->title) }}</span>
                            </a>
                        </div>
                    @endif
                    
                    {{-- Title first --}}
                    <h1 class="hero-title mb-2" style="color: #ffffff;">{{ $hero_course->title }}</h1>

                    {{-- Subtitle second --}}
                    @if($hero_course->course_subtitle)
                        <h4 class="hero-subtitle mb-3" style="color: #ffffff;">{{ $hero_course->course_subtitle }}</h4>
                    @endif
                    
                    {{-- Description --}}
                    @if($hero_course->short_description)
                        <p class="hero-description mb-4 mx-auto" style="color: #cbd5e1; max-width: 750px;">
                            {{ $hero_course->short_description }}
                        </p>
                    @endif

                    {{-- Video or Image --}}
                    <div class="hero-video-wrapper video-container position-relative mt-4 shadow-lg mx-auto" style="border-radius: 12px; overflow: hidden; background: #000; max-width: 1150px; border: 2px solid rgba(0, 86, 210, 0.4);">
                        <!-- Border Beam SVG -->
                        <svg class="border-beam-svg">
                            <defs>
                                <linearGradient id="beam-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#FF7A00" stop-opacity="0" />
                                    <stop offset="25%" stop-color="#FF7A00" stop-opacity="0.9" />
                                    <stop offset="50%" stop-color="#FFB800" stop-opacity="1" />
                                    <stop offset="75%" stop-color="#3B8AF2" stop-opacity="0.9" />
                                    <stop offset="100%" stop-color="#0056D2" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <rect class="border-beam-rect" fill="none" stroke="url(#beam-gradient)" stroke-width="2.5" rx="12" ry="12" />
                        </svg>
                        @if($hero_course->video_source && $hero_course->video)
                            @include('frontend.components.video', [
                                'source' => $hero_course->video_source, 
                                'video'  => $hero_course->video, 
                                'class'  => 'course-intro-video yt_player w-100', 
                                'image'  => $hero_course->image,
                                'size'   => 'original_image'
                            ])
                        @else
                            <img src="{{ getFileLink('original_image', $hero_course->image) }}" alt="{{ $hero_course->title }}" class="img-fluid w-100" style="object-fit: cover; max-height: 550px;">
                        @endif
                    </div>
                    
                    @php
                        $mcSettings = [];
                        if (isset($hero_course) && $hero_course->masterclass_settings) {
                            $mcSettings = is_array($hero_course->masterclass_settings) 
                                ? $hero_course->masterclass_settings 
                                : json_decode($hero_course->masterclass_settings, true);
                        }
                        $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : __('Enroll Now');
                        $heroBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : '#register';
                    @endphp
                    <ul class="hero-btns d-flex justify-content-center align-items-center mt-4 mb-0">
                        <li>
                            <a href="{{ $heroBtnUrl }}" class="template-btn hero-btn">
                                {{ $heroBtnText }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

<!--====== Start Counter Section ======-->
@include('frontend.homePage.counter_section')

@if((isset($hero_course->description) && !empty(strip_tags($hero_course->description))) || !empty($mcSettings['description_content']))
@if(!isset($mcSettings['description_status']) || $mcSettings['description_status'] == 1)
<section class="course-description-section p-t-60 p-b-60 bg-white">
    <div class="container container-1278">
        <div class="description-card p-4 p-md-5 position-relative overflow-hidden" 
             style="background-color: var(--color-blue-tint, #EAF2FE); border: 1px solid var(--color-border-tint, #C7DCFA); border-radius: 20px; box-shadow: 0 10px 30px rgba(0, 86, 210, 0.06);">
            
            @php
                $descSubtitle = !empty($hero_course->description_subtitle) 
                    ? $hero_course->description_subtitle 
                    : (!empty($mcSettings['description_subtitle']) ? $mcSettings['description_subtitle'] : '');
                $descContent = !empty($hero_course->description) 
                    ? $hero_course->description 
                    : ($mcSettings['description_content'] ?? '');

                $descRightTitle  = !empty($mcSettings['desc_right_title']) ? $mcSettings['desc_right_title'] : '';
                $descStep1Title  = !empty($mcSettings['desc_step_1_title']) ? $mcSettings['desc_step_1_title'] : '';
                $descStep1Sub    = !empty($mcSettings['desc_step_1_sub']) ? $mcSettings['desc_step_1_sub'] : '';
                $descStep2Title  = !empty($mcSettings['desc_step_2_title']) ? $mcSettings['desc_step_2_title'] : '';
                $descStep2Sub    = !empty($mcSettings['desc_step_2_sub']) ? $mcSettings['desc_step_2_sub'] : '';
                $descStep3Title  = !empty($mcSettings['desc_step_3_title']) ? $mcSettings['desc_step_3_title'] : '';
                $descStep3Sub    = !empty($mcSettings['desc_step_3_sub']) ? $mcSettings['desc_step_3_sub'] : '';
                $descBannerIcon  = !empty($mcSettings['desc_banner_icon']) ? $mcSettings['desc_banner_icon'] : '';
                $descBannerTitle = !empty($mcSettings['desc_banner_title']) ? $mcSettings['desc_banner_title'] : '';
                $descBannerSub   = !empty($mcSettings['desc_banner_sub']) ? $mcSettings['desc_banner_sub'] : '';

                $hasTimelineSteps = !empty($descStep1Title) || !empty($descStep1Sub) || !empty($descStep2Title) || !empty($descStep2Sub) || !empty($descStep3Title) || !empty($descStep3Sub);
                $hasBannerCard = !empty($descBannerIcon) || !empty($descBannerTitle) || !empty($descBannerSub);
                $showDescRightBox = isset($mcSettings['show_desc_right_box']) ? !empty($mcSettings['show_desc_right_box']) : true;
                $hasRightContent = $showDescRightBox && (!empty($descRightTitle) || $hasTimelineSteps || $hasBannerCard);
            @endphp

            <div class="row g-4 g-lg-5 align-items-center">
                <!-- Left Column -->
                <div class="{{ $hasRightContent ? 'col-lg-6' : 'col-lg-12' }} col-md-12">
                    <div class="quote-decorator mb-2" style="color: var(--color-primary, #0056D2); font-size: 55px; line-height: 1; font-family: Georgia, serif; font-weight: bold;">
                        “
                    </div>
                    @if(!empty($descSubtitle))
                        <h2 class="mb-3 fw-bold" style="color: var(--color-text-ink, #0A1E3F); font-size: 30px; line-height: 1.3;">
                            {!! format_title_highlight($descSubtitle) !!}
                        </h2>
                    @endif
                    
                    <div class="course-description-content" style="color: var(--color-text-secondary, #4B5A72); font-size: 16px; line-height: 1.85; font-weight: 400;">
                        {!! $descContent !!}
                    </div>
                </div>

                @if($hasRightContent)
                <!-- Right Column: Structured Feature Layout -->
                <div class="col-lg-6 col-md-12">
                    <div class="p-3 p-md-4 rounded-4" style="background: var(--color-white, #FFFFFF); border: 1px solid var(--color-border-tint, #D9E8FC); box-shadow: 0 4px 18px rgba(0, 31, 92, 0.05);">
                        <!-- Top Subtitle -->
                        @if(!empty($descRightTitle))
                            <h4 class="fw-bold mb-4" style="color: var(--color-text-ink, #0A1E3F); font-size: 17.5px; line-height: 1.65;">
                                {!! format_title_highlight($descRightTitle) !!}
                            </h4>
                        @endif

                        @if($hasTimelineSteps)
                        <!-- 3-Step Timeline Nodes -->
                        <div class="timeline-nodes-wrapper position-relative mb-4 py-2">
                            <div class="timeline-line" style="position: absolute; top: 18px; left: 10%; right: 10%; height: 2px; background: var(--color-border-tint, #D9E8FC); z-index: 1;"></div>
                            <div class="row text-center position-relative" style="z-index: 2;">
                                <div class="col-4">
                                    <div class="node-dot mx-auto mb-2 rounded-circle" style="width: 14px; height: 14px; background: var(--color-primary, #0056D2); border: 3px solid #ffffff; box-shadow: 0 0 0 2px var(--color-primary, #0056D2);"></div>
                                    @if(!empty($descStep1Title))
                                        <div class="fw-bold" style="color: var(--color-text-ink, #0A1E3F); font-size: 14px;">{{ $descStep1Title }}</div>
                                    @endif
                                    @if(!empty($descStep1Sub))
                                        <div style="color: var(--color-text-muted, #8A96A8); font-size: 11.5px;">{{ $descStep1Sub }}</div>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <div class="node-dot mx-auto mb-2 rounded-circle" style="width: 14px; height: 14px; background: var(--color-primary, #0056D2); border: 3px solid #ffffff; box-shadow: 0 0 0 2px var(--color-primary, #0056D2);"></div>
                                    @if(!empty($descStep2Title))
                                        <div class="fw-bold" style="color: var(--color-text-ink, #0A1E3F); font-size: 14px;">{{ $descStep2Title }}</div>
                                    @endif
                                    @if(!empty($descStep2Sub))
                                        <div style="color: var(--color-text-muted, #8A96A8); font-size: 11.5px;">{{ $descStep2Sub }}</div>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <div class="node-dot mx-auto mb-2 rounded-circle" style="width: 14px; height: 14px; background: var(--color-primary, #0056D2); border: 3px solid #ffffff; box-shadow: 0 0 0 2px var(--color-primary, #0056D2);"></div>
                                    @if(!empty($descStep3Title))
                                        <div class="fw-bold" style="color: var(--color-text-ink, #0A1E3F); font-size: 14px;">{{ $descStep3Title }}</div>
                                    @endif
                                    @if(!empty($descStep3Sub))
                                        <div style="color: var(--color-text-muted, #8A96A8); font-size: 11.5px;">{{ $descStep3Sub }}</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endif

                        @if($hasBannerCard)
                        <!-- Inner Highlight Banner Card -->
                        <div class="highlight-banner-card p-3 p-md-4 rounded-3 text-center" 
                             style="background: var(--color-white, #ffffff); border: 2px solid var(--color-primary, #0056D2); box-shadow: 0 4px 15px rgba(0, 86, 210, 0.12);">
                            <div class="d-flex align-items-center justify-content-center gap-2 mb-2">
                                @if(!empty($descBannerIcon))
                                    <span style="font-size: 26px;">{{ $descBannerIcon }}</span>
                                @endif
                                @if(!empty($descBannerTitle))
                                    <h3 class="m-0 fw-bold" style="color: var(--color-accent-orange, #FF7A00); font-size: 22px; letter-spacing: 0.5px;">
                                        {!! format_title_highlight($descBannerTitle) !!}
                                    </h3>
                                @endif
                            </div>
                            @if(!empty($descBannerSub))
                                <p class="m-0 fw-semibold" style="color: var(--color-text-secondary, #4B5A72); font-size: 14.5px;">
                                    {{ $descBannerSub }}
                                </p>
                            @endif
                        </div>
                        @endif
                    </div>
                </div>
                @endif
            </div>

        </div>
    </div>
</section>
@endif
@endif

@push('js')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (typeof Plyr !== 'undefined') {
            const ytPlayers = document.querySelectorAll('.yt_player');
            ytPlayers.forEach(function(el) {
                new Plyr(el);
            });
            const html5Players = document.querySelectorAll('video.course-intro-video');
            html5Players.forEach(function(el) {
                new Plyr(el);
            });
        }

        // Parallax and cursor glow animation
        const heroSection = document.querySelector('.hero-area');
        if (heroSection) {
            const shapes = heroSection.querySelectorAll('.hero-shape');
            const glow = document.createElement('div');
            glow.className = 'hero-mouse-glow';
            heroSection.appendChild(glow);

            heroSection.addEventListener('mousemove', function(e) {
                const rect = heroSection.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;

                glow.style.left = x + 'px';
                glow.style.top = y + 'px';

                shapes.forEach(shape => {
                    const speed = parseFloat(shape.getAttribute('data-speed')) || 1;
                    const moveX = (x - rect.width / 2) * (speed / 100);
                    const moveY = (y - rect.height / 2) * (speed / 100);
                    shape.style.transform = `translate(${moveX}px, ${moveY}px)`;
                });
            });

            heroSection.addEventListener('mouseleave', function() {
                shapes.forEach(shape => {
                    shape.style.transform = 'translate(0px, 0px)';
                });
            });
        }

        // Border Beam animation dimensions tracker
        const videoWrapper = document.querySelector('.hero-video-wrapper');
        if (videoWrapper) {
            const beamSvg = videoWrapper.querySelector('.border-beam-svg');
            const beamRect = videoWrapper.querySelector('.border-beam-rect');
            
             if (beamSvg && beamRect) {
                let rAfFrame;
                function updateBeam() {
                    if (rAfFrame) cancelAnimationFrame(rAfFrame);
                    rAfFrame = requestAnimationFrame(() => {
                        const w = videoWrapper.clientWidth;
                        const h = videoWrapper.clientHeight;
                        
                        beamSvg.setAttribute('viewBox', `0 0 ${w} ${h}`);
                        
                        const strokeWidth = 2.5;
                        const inset = strokeWidth / 2;
                        const rectW = w - strokeWidth;
                        const rectH = h - strokeWidth;
                        
                        beamRect.setAttribute('x', inset.toString());
                        beamRect.setAttribute('y', inset.toString());
                        beamRect.setAttribute('width', rectW.toString());
                        beamRect.setAttribute('height', rectH.toString());
                        
                        // Perimeter calculation
                        const perimeter = 2 * (rectW + rectH);
                        beamRect.style.setProperty('--perimeter', perimeter);
                        
                        // Set beam length to 25% of the container perimeter
                        const beamLen = perimeter * 0.25;
                        beamRect.style.strokeDasharray = `${beamLen} ${perimeter - beamLen}`;
                    });
                }
                
                updateBeam();
                window.addEventListener('resize', updateBeam);
                
                if (window.ResizeObserver) {
                    const ro = new ResizeObserver(updateBeam);
                    ro.observe(videoWrapper);
                }
            }
        }
    });
</script>
@endpush

@push('css')
<style>
/* Desktop Default Typography */
.hero-badge {
    font-size: 14px;
    font-weight: 600;
    line-height: 1 !important;
}

.hero-title {
    font-size: 32px;
    font-weight: 700;
    line-height: 1.3;
}

.hero-subtitle {
    font-size: 24px;
    font-weight: 500;
}

.hero-description {
    font-size: 16px;
    line-height: 1.6;
}

.hero-btn {
    font-size: 16px;
    line-height: 1.2;
    font-weight: 600;
    min-height: 52px;
    display: inline-flex;
    align-items: center;
    justify-content: center;
}

/* Background elements styling */
.hero-area {
    position: relative;
    overflow: hidden;
}

.hero-bg-shapes {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    pointer-events: none;
    z-index: 1;
}

.hero-area .container {
    position: relative;
    z-index: 2;
}

/* Glowing Orbs */
.hero-shape {
    position: absolute;
    opacity: 0.12;
    transition: transform 0.2s cubic-bezier(0.25, 0.46, 0.45, 0.94);
    will-change: transform;
    pointer-events: none;
}

.hero-shape-1 {
    top: 10%;
    left: 6%;
    width: 250px;
    height: 250px;
    border-radius: 50%;
    background: radial-gradient(circle, #3B8AF2 0%, transparent 70%);
    filter: blur(40px);
    animation: hero-float-slow 12s ease-in-out infinite;
}

.hero-shape-2 {
    bottom: 12%;
    right: 5%;
    width: 320px;
    height: 320px;
    border-radius: 50%;
    background: radial-gradient(circle, #0056D2 0%, transparent 70%);
    filter: blur(50px);
    animation: hero-float-slow-rev 15s ease-in-out infinite;
}

/* Dotted Grid shape */
.hero-shape-3 {
    top: 15%;
    right: 12%;
    width: 140px;
    height: 140px;
    background-image: radial-gradient(rgba(255, 255, 255, 0.08) 1.5px, transparent 1.5px);
    background-size: 18px 18px;
    animation: hero-float-slow 20s ease-in-out infinite;
}

/* Hollow clean geometric ring */
.hero-shape-4 {
    bottom: 22%;
    left: 10%;
    width: 90px;
    height: 90px;
    border: 2px dashed rgba(255, 255, 255, 0.07);
    border-radius: 50%;
    animation: hero-spin 40s linear infinite;
}

/* Floating Animation Keyframes */
@keyframes hero-float-slow {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(-18px) rotate(8deg);
    }
    100% {
        transform: translateY(0px) rotate(0deg);
    }
}

@keyframes hero-float-slow-rev {
    0% {
        transform: translateY(0px) rotate(0deg);
    }
    50% {
        transform: translateY(18px) rotate(-8deg);
    }
    100% {
        transform: translateY(0px) rotate(0deg);
    }
}

@keyframes hero-spin {
    to {
        transform: rotate(360deg);
    }
}

/* Mouse cursor glow tracker */
.hero-mouse-glow {
    position: absolute;
    width: 500px;
    height: 500px;
    background: radial-gradient(circle, rgba(59, 138, 242, 0.22) 0%, rgba(0, 86, 210, 0.08) 45%, rgba(0, 86, 210, 0) 70%);
    border-radius: 50%;
    pointer-events: none;
    transform: translate(-50%, -50%);
    z-index: 1;
    opacity: 0;
    transition: opacity 0.5s ease;
    mix-blend-mode: screen;
    will-change: left, top, opacity;
}

.hero-area:hover .hero-mouse-glow {
    opacity: 1;
}

/* Video Wrapper styling */
.hero-video-wrapper {
    border-radius: 12px !important;
    border-color: rgba(0, 86, 210, 0.45) !important;
    box-shadow: 0 30px 60px -15px rgba(0, 86, 210, 0.3), 
                0 0 50px 10px rgba(59, 138, 242, 0.12) !important;
    transition: box-shadow 0.6s cubic-bezier(0.16, 1, 0.3, 1), 
                border-color 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
    will-change: box-shadow, border-color;
}

.hero-video-wrapper:hover {
    border-color: rgba(255, 122, 0, 0.65) !important;
    box-shadow: 0 30px 70px -10px rgba(0, 86, 210, 0.4), 
                0 0 60px 15px rgba(255, 122, 0, 0.15) !important;
}

/* Border Beam SVG and rect styles */
.border-beam-svg {
    position: absolute;
    inset: 0;
    width: 100%;
    height: 100%;
    pointer-events: none;
    z-index: 10;
}

.border-beam-rect {
    stroke-linecap: round;
    animation: border-beam-travel 8s linear infinite;
    will-change: stroke-dashoffset;
    filter: drop-shadow(0 0 4px rgba(255, 122, 0, 0.7));
}

@keyframes border-beam-travel {
    0% {
        stroke-dashoffset: var(--perimeter, 2000);
    }
    100% {
        stroke-dashoffset: 0;
    }
}

/* Badge hover transition */
.hero-badge-animated {
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    transition: all 0.3s cubic-bezier(0.25, 0.46, 0.45, 0.94);
}
.hero-badge-animated:hover {
    transform: scale(1.05);
    background-color: rgba(255, 255, 255, 0.25) !important;
    box-shadow: 0 0 15px rgba(59, 138, 242, 0.35);
}

/* Global button hover glow just for hero section */
.hero-btns .template-btn {
    position: relative;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
}
.hero-btns .template-btn:hover {
    transform: translateY(-3px);
    box-shadow: 0 10px 20px rgba(255, 122, 0, 0.35);
}
.hero-btns .template-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.25), transparent);
    transition: all 0.6s ease;
}
.hero-btns .template-btn:hover::before {
    left: 100%;
}

/* Mobile Viewport Styles (< 768px) */
@media (max-width: 767.98px) {
    .hero-area {
        padding-top: 88px !important;
        padding-bottom: 30px !important;
    }

    .hero-badge {
        font-size: 12px !important;
        line-height: 1.2 !important;
        font-weight: 600 !important;
    }

    .hero-title {
        font-size: 24px !important;
        line-height: 1.4 !important;
        font-weight: 700 !important;
        margin-bottom: 8px !important;
    }

    .hero-subtitle {
        font-size: 16px !important;
        line-height: 1.45 !important;
        font-weight: 600 !important;
        margin-bottom: 12px !important;
    }

    .hero-description {
        font-size: 14px !important;
        line-height: 1.65 !important;
        font-weight: 400 !important;
        margin-bottom: 16px !important;
    }

    .hero-btn {
        font-size: 14px !important;
        line-height: 1.2 !important;
        font-weight: 600 !important;
        height: 40px !important;
        min-height: 40px !important;
        padding: 8px 22px !important;
        border-radius: 6px !important;
    }

    .course-description-section {
        padding-top: 25px !important;
        padding-bottom: 20px !important;
    }

    .description-card {
        padding: 20px 16px !important;
    }

    .description-card h2 {
        font-size: 20px !important;
        margin-bottom: 12px !important;
    }

    .course-description-content,
    .course-description-content * {
        font-size: 14.5px !important;
        line-height: 1.65 !important;
        color: #4B5A72 !important;
    }
    .course-description-content h1,
    .course-description-content h2,
    .course-description-content h3,
    .course-description-content h4 {
        font-size: 16px !important;
        font-weight: 600 !important;
        color: #0A1E3F !important;
        margin-top: 10px !important;
        margin-bottom: 6px !important;
    }
    .course-description-content p,
    .course-description-content span,
    .course-description-content div {
        font-size: 14.5px !important;
        line-height: 1.65 !important;
        color: #4B5A72 !important;
        margin-bottom: 8px !important;
    }
    .course-description-content strong,
    .course-description-content b {
        font-weight: 600 !important;
        color: #0056D2 !important;
    }
}

/* Brand overrides for course description rich text content */
.course-description-content strong,
.course-description-content b {
    color: #0056D2 !important;
}
.course-description-content mark {
    background-color: #FFB800 !important;
    color: #0A1E3F !important;
    padding: 2px 6px;
    border-radius: 4px;
}
.course-description-content [style*="rgb(18, 62, 43)"],
.course-description-content [style*="#123e2b"],
.course-description-content [style*="#0d4630"],
.course-description-content [style*="#047857"] {
    background-color: #001F5C !important;
    color: #FFFFFF !important;
    border-radius: 6px !important;
    padding: 4px 12px !important;
    display: inline-block !important;
}
.course-description-content [style*="rgb(79, 183, 145)"],
.course-description-content [style*="#10b981"],
.course-description-content [style*="#25ab7c"],
.course-description-content [style*="#2db37c"] {
    color: #0056D2 !important;
}
.course-description-content [style*="rgb(255, 255, 0)"] {
    background-color: #FFB800 !important;
    color: #0A1E3F !important;
    border-radius: 4px !important;
    padding: 2px 8px !important;
}
</style>
@endpush
@else
<section class="hero-area hero-area-v5 p-t-120 p-b-60 p-b-md-40 text-center">
    <div class="container container-1278">
        <h2 class="text-white">No Course Found</h2>
    </div>
</section>
@endif

