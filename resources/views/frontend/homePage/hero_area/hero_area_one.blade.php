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
                    

                    {{-- Title first --}}
                    <h1 class="hero-title mb-2" style="color: #ffffff;">{!! format_title_highlight($hero_course->title) !!}</h1>

                    {{-- Subtitle second --}}
                    @if($hero_course->course_subtitle)
                        <h4 class="hero-subtitle mb-3" style="color: #ffffff;">{!! format_title_highlight($hero_course->course_subtitle) !!}</h4>
                    @endif
                    
                    {{-- Description --}}
                    @if($hero_course->short_description)
                        <p class="hero-description mb-4 mx-auto" style="color: #cbd5e1; max-width: 750px;">
                            {{ $hero_course->short_description }}
                        </p>
                    @endif

                    {{-- Video or Image --}}
                    <div class="hero-video-wrapper has-border-beam video-container position-relative mt-4 shadow-lg mx-auto" style="border-radius: 8px; overflow: hidden; background: #000; max-width: 960px; border: 2px solid rgba(0, 86, 210, 0.4); aspect-ratio: 16 / 9;">
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
                            <rect class="border-beam-rect" fill="none" stroke="url(#beam-gradient)" stroke-width="2.5" rx="8" ry="8" />
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
                            <img src="{{ getFileLink('original_image', $hero_course->image) }}" alt="{{ strip_tags($hero_course->title) }}" class="img-fluid w-100" width="960" height="540" fetchpriority="high" loading="eager" decoding="async" style="object-fit: cover; max-height: 550px;">
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
             style="background: #ffffff; border: 1px solid rgba(0, 86, 210, 0.08); border-radius: 12px; box-shadow: 0 10px 30px -5px rgba(0, 56, 148, 0.05);">
            
            <!-- Background Wave Shape -->
            <div style="position: absolute; top: 0; left: 0; width: 100%; height: auto; z-index: 0; opacity: 0.04; pointer-events: none;">
                <svg viewBox="0 0 1440 320" preserveAspectRatio="none" style="width: 100%; height: 180px;">
                    <path fill="#0056D2" fill-opacity="1" d="M0,128L48,138.7C96,149,192,171,288,181.3C384,192,480,192,576,170.7C672,149,768,107,864,101.3C960,96,1056,128,1152,133.3C1248,139,1344,117,1392,106.7L1440,96L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z"></path>
                </svg>
            </div>

            <!-- Background Network Node Design -->
            <div style="position: absolute; top: 15%; right: -5%; width: 500px; height: 500px; z-index: 0; opacity: 0.05; pointer-events: none;">
                <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg">
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
            
            <div class="position-relative" style="z-index: 1;">
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

                $hasBannerCard = !empty($descBannerIcon) || !empty($descBannerTitle) || !empty($descBannerSub);
                $showDescRightBox = isset($mcSettings['show_desc_right_box']) ? !empty($mcSettings['show_desc_right_box']) : true;
                $hasRightContent = $showDescRightBox && !empty($descRightTitle);
            @endphp

            <div class="row g-4 g-lg-5 align-items-start justify-content-center">
                <!-- Left Column -->
                <div class="col-lg-12 col-md-12 text-center">
                    <div class="quote-decorator mb-2 d-flex justify-content-center">
                        <svg width="38" height="30" viewBox="0 0 40 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 18.2857C0 8.19048 6.09524 1.52381 16 0V6.47619C10.6667 7.61905 8.19048 10.8571 8.19048 15.0476H16V32H0V18.2857ZM24 18.2857C24 8.19048 30.0952 1.52381 40 0V6.47619C34.6667 7.61905 32.1905 10.8571 32.1905 15.0476H40V32H24V18.2857Z" fill="#0056D2"/>
                        </svg>
                    </div>
                    @if(!empty($descSubtitle))
                        <h2 class="mb-3 fw-bold desc-main-title text-center" style="color: #0A1E3F; font-size: 28px; line-height: 1.35; letter-spacing: -0.02em;">
                            {!! format_title_highlight($descSubtitle) !!}
                        </h2>
                    @endif
                    
                    <div class="course-description-content text-center" style="color: #475569; font-size: 15.5px; line-height: 1.85; font-weight: 400;">
                        {!! $descContent !!}
                    </div>
                </div>

                @if($hasRightContent)
                <!-- Right Column: Statement Layout (Centered without border/icon) -->
                <div class="col-lg-12 col-md-12 mt-2 text-center">
                    @if(!empty($descRightTitle))
                        <div class="py-2 text-center">
                            <h4 class="fw-bold m-0 desc-right-title text-center" style="color: #0A1E3F; font-size: 22px; line-height: 1.6; letter-spacing:-0.01em;">
                                {!! format_title_highlight($descRightTitle) !!}
                            </h4>
                        </div>
                    @endif
                </div>
                @endif
            </div>

            @if($hasBannerCard)
            <!-- Full Width Highlight Banner Card Below Text -->
            <div class="row mt-5">
                <div class="col-12">
                    <div class="highlight-banner-card has-border-beam text-center" 
                         style="background: linear-gradient(135deg, #0045B8 0%, #0056D2 40%, #1a78ff 80%, #4facfe 100%); border-radius: 16px; box-shadow: 0 15px 35px rgba(0,86,210,0.25); position: relative; overflow: hidden; padding: 40px 25px;">
                        <!-- Border Beam SVG -->
                        <svg class="border-beam-svg">
                            <defs>
                                <linearGradient id="beam-gradient-card" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#FF7A00" stop-opacity="0" />
                                    <stop offset="25%" stop-color="#FF7A00" stop-opacity="0.9" />
                                    <stop offset="50%" stop-color="#FFB800" stop-opacity="1" />
                                    <stop offset="75%" stop-color="#3B8AF2" stop-opacity="0.9" />
                                    <stop offset="100%" stop-color="#0056D2" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <rect class="border-beam-rect" fill="none" stroke="url(#beam-gradient-card)" stroke-width="2.5" rx="16" ry="16" />
                        </svg>
                        <div style="position:absolute;top:-50px;right:-50px;width:180px;height:180px;background:radial-gradient(circle,rgba(255,255,255,0.15) 0%,transparent 65%);pointer-events:none;"></div>
                        
                        <div class="d-flex flex-column align-items-center justify-content-center gap-2 position-relative" style="z-index: 1;">
                            @if(!empty($descBannerTitle))
                                <h3 class="m-0 fw-bold desc-banner-title" style="color: #ffffff; font-size: 28px; font-weight: 800; letter-spacing: -0.01em; text-shadow: 0 4px 15px rgba(0,0,0,0.2);">
                                    {!! format_title_highlight($descBannerTitle) !!}
                                </h3>
                            @endif
                            @if(!empty($descBannerSub))
                                <div class="mt-2 desc-banner-sub" style="color: rgba(255,255,255,0.9); font-size: 16px; font-weight: 500; line-height: 1.6;">
                                    {!! format_title_highlight($descBannerSub) !!}
                                </div>
                            @endif
                        </div>
                    </div>
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
        let plyrLoaded = false;
        function loadPlyrPlayers() {
            if (plyrLoaded) return;
            plyrLoaded = true;
            if (typeof Plyr !== 'undefined') {
                const ytPlayers = document.querySelectorAll('.yt_player');
                ytPlayers.forEach(function(el) { new Plyr(el); });
                const html5Players = document.querySelectorAll('video.course-intro-video');
                html5Players.forEach(function(el) { new Plyr(el); });
            } else {
                // Retry once after JS loads if Plyr not available yet
                setTimeout(function() {
                    if (typeof Plyr !== 'undefined') {
                        document.querySelectorAll('.yt_player').forEach(function(el) { new Plyr(el); });
                        document.querySelectorAll('video.course-intro-video').forEach(function(el) { new Plyr(el); });
                    }
                }, 800);
            }
        }

        const videoWrapper = document.querySelector('.hero-video-wrapper');
        if (videoWrapper) {
            // Load on interaction
            videoWrapper.addEventListener('click', loadPlyrPlayers, { once: true });
            videoWrapper.addEventListener('pointerover', loadPlyrPlayers, { once: true });
            videoWrapper.addEventListener('touchstart', loadPlyrPlayers, { once: true, passive: true });

            // IntersectionObserver: load when video enters viewport
            if ('IntersectionObserver' in window) {
                var obs = new IntersectionObserver(function(entries) {
                    entries.forEach(function(entry) {
                        if (entry.isIntersecting) {
                            // Delay slightly so it doesn't block initial paint
                            setTimeout(loadPlyrPlayers, 400);
                            obs.disconnect();
                        }
                    });
                }, { threshold: 0.1 });
                obs.observe(videoWrapper);
            } else {
                // Fallback: load after 3s
                setTimeout(loadPlyrPlayers, 3000);
            }
        }

        // Modern Tech Cursor Follower & Stardust Particle Animation
        const heroSection = document.querySelector('.hero-area');
        const isFinePointer = window.matchMedia && window.matchMedia('(hover: hover) and (pointer: fine)').matches;

        if (heroSection && isFinePointer) {
            const shapes = heroSection.querySelectorAll('.hero-shape');
            
            // Canvas for micro-stardust particles
            const canvas = document.createElement('canvas');
            canvas.className = 'hero-cursor-canvas';
            heroSection.appendChild(canvas);
            const ctx = canvas.getContext('2d');

            // Outer follower ring
            const ring = document.createElement('div');
            ring.className = 'hero-cursor-follower';
            heroSection.appendChild(ring);

            // Center glow dot
            const dot = document.createElement('div');
            dot.className = 'hero-cursor-dot';
            heroSection.appendChild(dot);

            let width = 0, height = 0;
            function resizeCanvas() {
                width = heroSection.clientWidth;
                height = heroSection.clientHeight;
                canvas.width = width;
                canvas.height = height;
            }
            resizeCanvas();
            window.addEventListener('resize', resizeCanvas);

            let mouseX = -100, mouseY = -100;
            let ringX = -100, ringY = -100;
            let isInside = false;
            let isHoveringInteractive = false;
            let lastSpawnX = 0, lastSpawnY = 0;
            const particles = [];
            const palette = [
                'rgba(56, 189, 248, ',  // Electric cyan
                'rgba(96, 165, 250, ',  // Light blue
                'rgba(251, 191, 36, ',  // Golden amber
                'rgba(255, 255, 255, '   // Pure white sparkle
            ];

            heroSection.addEventListener('mouseenter', function() {
                isInside = true;
                ring.style.opacity = '1';
                dot.style.opacity = '1';
            });

            heroSection.addEventListener('mouseleave', function() {
                isInside = false;
                ring.style.opacity = '0';
                dot.style.opacity = '0';
                shapes.forEach(shape => {
                    shape.style.transform = 'translate(0px, 0px)';
                });
            });

            heroSection.addEventListener('mousemove', function(e) {
                const rect = heroSection.getBoundingClientRect();
                mouseX = e.clientX - rect.left;
                mouseY = e.clientY - rect.top;

                // Direct position for instant-response center dot
                dot.style.left = mouseX + 'px';
                dot.style.top = mouseY + 'px';

                // Check interactive hover target
                const target = e.target;
                const interactive = target && target.closest('a, button, .template-btn, .hero-video-wrapper, .plyr, input, select');
                if (interactive && !isHoveringInteractive) {
                    isHoveringInteractive = true;
                    ring.classList.add('is-hovered');
                    dot.classList.add('is-hovered');
                } else if (!interactive && isHoveringInteractive) {
                    isHoveringInteractive = false;
                    ring.classList.remove('is-hovered');
                    dot.classList.remove('is-hovered');
                }

                // Spawn stardust particle on movement
                const dist = Math.hypot(mouseX - lastSpawnX, mouseY - lastSpawnY);
                if (dist > 12 && particles.length < 35) {
                    lastSpawnX = mouseX;
                    lastSpawnY = mouseY;
                    const angle = Math.random() * Math.PI * 2;
                    const speed = Math.random() * 0.8 + 0.3;
                    particles.push({
                        x: mouseX + (Math.random() - 0.5) * 8,
                        y: mouseY + (Math.random() - 0.5) * 8,
                        vx: Math.cos(angle) * speed,
                        vy: Math.sin(angle) * speed - 0.2,
                        size: Math.random() * 2.5 + 1.2,
                        color: palette[Math.floor(Math.random() * palette.length)],
                        alpha: 1,
                        decay: Math.random() * 0.025 + 0.02
                    });
                }
            });

            function render() {
                if (isInside || particles.length > 0) {
                    // Smooth lerp for ring follower
                    ringX += (mouseX - ringX) * 0.2;
                    ringY += (mouseY - ringY) * 0.2;
                    ring.style.left = ringX + 'px';
                    ring.style.top = ringY + 'px';

                    // Parallax shapes
                    if (isInside) {
                        shapes.forEach(shape => {
                            const speed = parseFloat(shape.getAttribute('data-speed')) || 1;
                            const moveX = (mouseX - width / 2) * (speed / 100);
                            const moveY = (mouseY - height / 2) * (speed / 100);
                            shape.style.transform = `translate(${moveX}px, ${moveY}px)`;
                        });
                    }

                    // Render particles
                    ctx.clearRect(0, 0, width, height);
                    for (let i = particles.length - 1; i >= 0; i--) {
                        const p = particles[i];
                        p.x += p.vx;
                        p.y += p.vy;
                        p.alpha -= p.decay;
                        p.size *= 0.97;

                        if (p.alpha <= 0.05 || p.size <= 0.3) {
                            particles.splice(i, 1);
                            continue;
                        }

                        ctx.save();
                        ctx.beginPath();
                        ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
                        ctx.fillStyle = p.color + p.alpha + ')';
                        ctx.shadowColor = '#38bdf8';
                        ctx.shadowBlur = 6;
                        ctx.fill();
                        ctx.restore();
                    }
                } else if (particles.length === 0 && !isInside) {
                    ctx.clearRect(0, 0, width, height);
                }
                requestAnimationFrame(render);
            }
            render();
        }

        // Border Beam animation dimensions tracker
        const beamContainers = document.querySelectorAll('.has-border-beam');
        beamContainers.forEach(container => {
            const beamSvg = container.querySelector('.border-beam-svg');
            const beamRect = container.querySelector('.border-beam-rect');
            
             if (beamSvg && beamRect) {
                let rAfFrame;
                function updateBeam() {
                    if (rAfFrame) cancelAnimationFrame(rAfFrame);
                    rAfFrame = requestAnimationFrame(() => {
                        const w = container.clientWidth;
                        const h = container.clientHeight;
                        
                        beamSvg.setAttribute('viewBox', `0 0 ${w} ${h}`);
                        
                        const strokeWidth = 2.5;
                        const inset = strokeWidth / 2;
                        const rectW = w - strokeWidth;
                        const rectH = h - strokeWidth;
                        
                        beamRect.setAttribute('x', inset.toString());
                        beamRect.setAttribute('y', inset.toString());
                        beamRect.setAttribute('width', rectW.toString());
                        beamRect.setAttribute('height', rectH.toString());
                        
                        const computedStyle = window.getComputedStyle(container);
                        const borderRadius = parseFloat(computedStyle.borderRadius) || 0;
                        const rx = Math.max(0, borderRadius - inset);
                        beamRect.setAttribute('rx', rx.toString());
                        beamRect.setAttribute('ry', rx.toString());
                        
                        // Perimeter calculation (accounting for rounded corners)
                        const perimeter = 2 * (rectW + rectH) - rx * (8 - 2 * Math.PI);
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
                    ro.observe(container);
                }
            }
        });
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

.hero-title p,
.hero-subtitle p {
    display: inline !important;
    margin: 0 !important;
    padding: 0 !important;
    line-height: inherit !important;
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

/* Modern Tech Cursor Follower & Stardust Trail */
.hero-cursor-canvas {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    pointer-events: none !important;
    z-index: 2;
}

.hero-cursor-follower {
    position: absolute;
    top: 0;
    left: 0;
    width: 36px;
    height: 36px;
    margin-top: -18px;
    margin-left: -18px;
    border-radius: 50%;
    border: 1.5px solid rgba(56, 189, 248, 0.65);
    background: radial-gradient(circle, rgba(56, 189, 248, 0.14) 0%, rgba(56, 189, 248, 0.02) 70%, transparent 100%);
    box-shadow: 0 0 16px rgba(56, 189, 248, 0.35), inset 0 0 8px rgba(56, 189, 248, 0.15);
    pointer-events: none !important;
    z-index: 3;
    opacity: 0;
    transform: scale(0.85);
    transition: opacity 0.3s cubic-bezier(0.16, 1, 0.3, 1), 
                transform 0.25s cubic-bezier(0.16, 1, 0.3, 1),
                border-color 0.25s ease,
                box-shadow 0.25s ease,
                background 0.25s ease;
    will-change: left, top, opacity, transform;
}

.hero-cursor-dot {
    position: absolute;
    top: 0;
    left: 0;
    width: 6px;
    height: 6px;
    margin-top: -3px;
    margin-left: -3px;
    border-radius: 50%;
    background: #38bdf8;
    box-shadow: 0 0 10px #38bdf8, 0 0 16px rgba(56, 189, 248, 0.85);
    pointer-events: none !important;
    z-index: 4;
    opacity: 0;
    transition: opacity 0.2s ease, transform 0.2s ease;
    will-change: left, top, opacity;
}

/* Hover state when hovering clickable elements in hero */
.hero-cursor-follower.is-hovered {
    transform: scale(1.65);
    border-color: rgba(251, 191, 36, 0.85);
    background: radial-gradient(circle, rgba(251, 191, 36, 0.18) 0%, rgba(56, 189, 248, 0.05) 70%, transparent 100%);
    box-shadow: 0 0 22px rgba(251, 191, 36, 0.45), inset 0 0 10px rgba(251, 191, 36, 0.2);
}

.hero-cursor-dot.is-hovered {
    transform: scale(1.3);
    background: #fbbf24;
    box-shadow: 0 0 12px #fbbf24, 0 0 20px rgba(251, 191, 36, 0.85);
}

/* Video Wrapper styling */
.hero-video-wrapper {
    border-radius: 8px !important;
    border: 2px solid rgba(0, 86, 210, 0.4) !important;
    box-shadow: 0 30px 60px -15px rgba(0, 86, 210, 0.3), 
                0 0 50px 10px rgba(59, 138, 242, 0.12) !important;
    transition: box-shadow 0.6s cubic-bezier(0.16, 1, 0.3, 1) !important;
}

.hero-video-wrapper:hover {
    border-color: rgba(0, 86, 210, 0.4) !important;
    box-shadow: 0 30px 70px -10px rgba(0, 86, 210, 0.4) !important;
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
    transform: translateY(-2px);
    background: #FF7A00 !important;
    background-color: #FF7A00 !important;
    box-shadow: 0 8px 22px rgba(255, 122, 0, 0.45);
}
.hero-btns .template-btn::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.35), transparent);
    transition: all 0.6s ease;
}
.hero-btns .template-btn:hover::before {
    left: 100%;
}

/* Mobile Viewport Styles (< 768px) */
@media (max-width: 767.98px) {
    .hero-area {
        padding-top: 36px !important;
        padding-bottom: 30px !important;
    }

    .hero-badge {
        font-size: 12px !important;
        line-height: 1.2 !important;
        font-weight: 600 !important;
    }

    .hero-title,
    .hero-title * {
        font-size: 24px !important;
        line-height: 1.35 !important;
        font-weight: 700 !important;
        margin-bottom: 8px !important;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    .hero-subtitle,
    .hero-subtitle * {
        font-size: 16px !important;
        line-height: 1.45 !important;
        font-weight: 600 !important;
        margin-bottom: 12px !important;
        word-break: break-word;
        overflow-wrap: break-word;
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
        padding-top: 15px !important;
        padding-bottom: 15px !important;
    }

    .description-card {
        padding: 20px 16px !important;
    }

    .description-card h2,
    .desc-main-title,
    .desc-main-title * {
        font-size: 20px !important;
        line-height: 1.35 !important;
        font-weight: 700 !important;
        margin-bottom: 12px !important;
        word-break: break-word !important;
        overflow-wrap: break-word !important;
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
    .course-description-content h4,
    .course-description-content h5,
    .course-description-content h6 {
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

    /* ── Course Description Right Box & Title Highlight Styles ── */
    .desc-right-title mark.title-highlight,
    .desc-right-title mark,
    .title-highlight {
        background: #DCEBFE !important;
        color: #0056D2 !important;
        padding: 2px 8px !important;
        border-radius: 4px !important;
        font-weight: 700 !important;
        display: inline-block !important;
        line-height: 1.4 !important;
    }

    .desc-right-box {
        padding: 28px !important;
        margin-top: 0 !important;
    }

    @media (max-width: 767.98px) {
        .desc-right-box {
            padding: 18px 14px !important;
            margin-top: 10px !important;
        }

        .desc-right-title,
        .desc-right-title * {
            font-size: 16px !important;
            line-height: 1.45 !important;
            font-weight: 700 !important;
            margin-bottom: 14px !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
        }

        .timeline-nodes-wrapper {
            margin-bottom: 16px !important;
            padding-top: 4px !important;
            padding-bottom: 4px !important;
        }
        .timeline-nodes-wrapper .timeline-line {
            top: 11px !important;
            left: 16.66% !important;
            right: 16.66% !important;
        }
        .timeline-nodes-wrapper .node-dot {
            width: 15px !important;
            height: 15px !important;
            border-width: 2px !important;
            margin-bottom: 6px !important;
        }
        .timeline-nodes-wrapper .node-dot span {
            width: 5px !important;
            height: 5px !important;
        }
        .desc-step-title,
        .desc-step-title * {
            font-size: 12px !important;
            line-height: 1.3 !important;
            font-weight: 700 !important;
            word-break: break-word !important;
        }
        .desc-step-sub,
        .desc-step-sub * {
            font-size: 10.5px !important;
            line-height: 1.25 !important;
            word-break: break-word !important;
        }

        .highlight-banner-card {
            padding: 16px 12px !important;
        }
        .desc-banner-icon {
            font-size: 22px !important;
            line-height: 1 !important;
        }
        .desc-banner-title,
        .desc-banner-title * {
            font-size: 18px !important;
            line-height: 1.35 !important;
            font-weight: 700 !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
        }
        .desc-banner-sub,
        .desc-banner-sub * {
            font-size: 13.5px !important;
            line-height: 1.5 !important;
            font-weight: 500 !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
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

