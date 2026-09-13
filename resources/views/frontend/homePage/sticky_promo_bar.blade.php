@php
    $showStickyBar = setting('show_sticky_promo_bar');
    
    $mcSettings = [];
    if (isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if (!is_array($mcSettings)) $mcSettings = [];
    }
    
    $title = !empty($mcSettings['sticky_promo_title']) 
        ? $mcSettings['sticky_promo_title'] 
        : (setting('sticky_promo_title', app()->getLocale()) ?: setting('sticky_promo_title'));
    
    $heroBtnText = !empty($mcSettings['overview_btn_text']) 
        ? $mcSettings['overview_btn_text'] 
        : (setting('sticky_promo_btn_text', app()->getLocale()) ?: setting('sticky_promo_btn_text'));
    $btnText = $heroBtnText;
    $rawBtnLink = setting('sticky_promo_btn_link');
    if (empty($rawBtnLink) || $rawBtnLink === '#' || $rawBtnLink === '#register') {
        $btnLink = (request()->is('/') || request()->is('home*') || isHome()) ? '#register' : url('/#register');
    } else {
        $btnLink = \Illuminate\Support\Str::startsWith($rawBtnLink, ['http://', 'https://', '/']) ? $rawBtnLink : url($rawBtnLink);
    }
@endphp

@if($showStickyBar == 1)
<style>
    .sticky-promo-container {
        width: 100%;
        margin: 0 auto 40px auto;
        position: relative;
    }
    
    .sticky-promo-wrapper {
        width: 100%;
        background: var(--color-blue-tint, #EAF2FE);
        border: 1.5px solid var(--color-border-tint, #C7DCFA);
        border-radius: 12px;
        box-shadow: 0 6px 24px rgba(0, 86, 210, 0.12);
        transition: all 0.3s ease;
        z-index: 1040;
    }

    .sp-inner-container {
        display: flex;
        flex-wrap: wrap;
        width: 100%;
        max-width: 1278px;
        margin: 0 auto;
        align-items: center;
    }
    
    .sticky-promo-wrapper.is-sticky {
        position: fixed;
        bottom: 0;
        left: 0;
        transform: none;
        width: 100%;
        max-width: 100%;
        border-radius: 0;
        margin: 0;
        border-left: none;
        border-right: none;
        border-bottom: none;
        border-top: 1.5px solid var(--color-border-tint, #C7DCFA);
        background: var(--color-blue-tint, #EAF2FE);
        box-shadow: 0 -4px 25px rgba(0, 31, 92, 0.12);
        backdrop-filter: blur(10px);
    }

    .sp-left {
        flex: 1;
        min-width: 300px;
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: flex-start;
    }

    .sp-left h3 {
        color: var(--color-text-ink, #0A1E3F);
        margin: 0;
        font-size: 19px;
        font-weight: 700;
        letter-spacing: -0.2px;
    }

    .sp-middle {
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .sp-countdown {
        display: flex;
        gap: 8px;
        user-select: none;
    }

    .sp-cd-item {
        background: #FFFFFF;
        color: var(--color-text-ink, #0A1E3F);
        border-radius: 8px;
        padding: 6px 14px;
        min-width: 52px;
        text-align: center;
        font-weight: bold;
        border: 1px solid var(--color-border-tint, #D9E8FC);
        box-shadow: 0 2px 6px rgba(0, 31, 92, 0.05);
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .sp-cd-item .num {
        font-size: 17px;
        font-weight: 800;
        color: var(--color-accent-orange, #FF7A00);
        line-height: 1.2;
    }

    .sp-cd-item span.label {
        font-size: 9px;
        color: var(--color-text-secondary, #4B5A72);
        text-transform: uppercase;
        margin-top: 3px;
        letter-spacing: 0.5px;
        font-weight: 700;
    }

    .sp-right {
        padding: 12px 24px;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        min-width: 200px;
        position: relative;
    }

    .sp-right .btn-enroll {
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        padding: 12px 28px !important;
        font-size: 15px !important;
        font-weight: 700 !important;
        line-height: 1.2 !important;
        border-radius: 8px !important;
        background-color: var(--color-primary, #0056D2) !important;
        border: none !important;
        color: #ffffff !important;
        box-shadow: 0 4px 14px rgba(0, 86, 210, 0.35);
        overflow: hidden !important;
        position: relative;
        transition: all 0.3s ease;
        user-select: none;
    }

    .sp-right .btn-enroll::before,
    .sp-right .btn-enroll::after {
        content: none !important;
        display: none !important;
        opacity: 0 !important;
        visibility: hidden !important;
    }

    .sp-right .btn-enroll:hover {
        background-color: var(--color-primary-hover, #FF7A00) !important;
        border-color: var(--color-primary-hover, #FF7A00) !important;
        color: #ffffff !important;
        transform: translateY(-1px);
        box-shadow: 0 6px 18px rgba(255, 122, 0, 0.45);
    }

    .sp-right .btn-enroll i {
        font-size: 14px;
        margin-left: 0 !important;
        line-height: 1;
    }

    /* Button Border Beam Animation styles */
    .btn-border-beam-svg {
        position: absolute;
        top: 0 !important;
        left: 0 !important;
        width: 100% !important;
        height: 100% !important;
        pointer-events: none;
        z-index: 1;
        border-radius: inherit;
        overflow: hidden !important;
    }

    .btn-border-beam-rect {
        stroke-linecap: round;
        animation: btn-border-beam-travel 4s linear infinite;
        will-change: stroke-dashoffset;
        filter: drop-shadow(0 0 3px rgba(251, 191, 36, 0.8));
    }

    @keyframes btn-border-beam-travel {
        0% {
            stroke-dashoffset: var(--btn-perimeter, 400);
        }
        100% {
            stroke-dashoffset: 0;
        }
    }
    
    .sticky-promo-anchor {
        width: 100%;
        height: 1px;
    }

    @media (max-width: 768px) {
        .sp-inner-container {
            flex-direction: row;
            flex-wrap: wrap;
            padding: 8px 10px;
            align-items: center;
        }
        .sp-left {
            flex: 0 0 100%;
            max-width: 100%;
            justify-content: center;
            padding: 0 0 8px 0;
            min-width: 0;
        }
        .sp-middle {
            flex: 0 0 55%;
            max-width: 55%;
            justify-content: flex-start;
            padding: 0;
            min-width: 0;
        }
        .sp-right {
            flex: 0 0 45%;
            max-width: 45%;
            justify-content: flex-end;
            padding: 0;
            min-width: 0;
        }
        .sp-right .btn-enroll {
            padding: 8px 14px !important;
            font-size: 13px !important;
            border-radius: 8px !important;
        }
        .sp-left h3 {
            font-size: 14px;
            text-align: center;
            line-height: 1.2;
            margin: 0;
            color: var(--color-text-ink, #0A1E3F);
        }
        .sp-countdown {
            gap: 4px;
        }
        .sp-cd-item {
            padding: 4px;
            min-width: 38px;
            background: #FFFFFF;
            border: 1px solid var(--color-border-tint, #D9E8FC);
        }
        .sp-cd-item .num {
            font-size: 13px;
            color: var(--color-accent-orange, #FF7A00);
        }
        .sp-cd-item span.label {
            font-size: 8px;
            margin-top: 2px;
            color: var(--color-text-secondary, #4B5A72);
        }
        .sticky-promo-wrapper.is-sticky {
            border-radius: 0;
            max-width: 100%;
            border-left: none;
            border-right: none;
            border-top: 1.5px solid var(--color-border-tint, #C7DCFA);
            background: var(--color-blue-tint, #EAF2FE);
        }
    }
</style>

<div class="container container-1278 px-lg-0 px-3">
    <div class="sticky-promo-container">
        <div class="sticky-promo-anchor"></div>
        <div class="sticky-promo-wrapper sp-banner">
            <div class="sp-inner-container">
                @if(!empty($title))
                <div class="sp-left">
                    <h3>{{ $title }}</h3>
                </div>
                @endif
                <div class="sp-middle">
                    <div class="sp-countdown js-countdown">
                        <div class="sp-cd-item">
                            <span class="num js-hours">00</span>
                            <span class="label">{{ __('HRS') }}</span>
                        </div>
                        <div class="sp-cd-item">
                            <span class="num js-minutes">00</span>
                            <span class="label">{{ __('MIN') }}</span>
                        </div>
                        <div class="sp-cd-item">
                            <span class="num js-seconds">00</span>
                            <span class="label">{{ __('SEC') }}</span>
                        </div>
                    </div>
                </div>
                @if(!empty($btnText))
                 <div class="sp-right">
                    <a href="{{ $btnLink }}" class="template-btn btn-enroll position-relative">
                        <!-- Border Beam SVG -->
                        <svg class="btn-border-beam-svg">
                            <defs>
                                <linearGradient id="btn-beam-gradient" x1="0%" y1="0%" x2="100%" y2="100%">
                                    <stop offset="0%" stop-color="#ffc107" stop-opacity="0" />
                                    <stop offset="30%" stop-color="#ffc107" stop-opacity="0.85" />
                                    <stop offset="50%" stop-color="#ffffff" stop-opacity="1" />
                                    <stop offset="70%" stop-color="#ffc107" stop-opacity="0.85" />
                                    <stop offset="100%" stop-color="#ffc107" stop-opacity="0" />
                                </linearGradient>
                            </defs>
                            <rect class="btn-border-beam-rect" fill="none" stroke="url(#btn-beam-gradient)" stroke-width="2.5" rx="3" ry="3" />
                        </svg>
                        <span class="btn-text-content" style="position: relative; z-index: 2; display: inline-flex; align-items: center; justify-content: center; gap: 8px;">
                            <span>{{ $btnText }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    const containers = document.querySelectorAll('.sticky-promo-container');
    
    containers.forEach(container => {
        const promoBar = container.querySelector('.sp-banner');
        const anchor = container.querySelector('.sticky-promo-anchor');
        
        if (promoBar && anchor) {
            const handleScroll = () => {
                const rect = anchor.getBoundingClientRect();
                const stickyThreshold = window.innerHeight - promoBar.offsetHeight;
                
                // If the anchor is below the point where the sticky bar sits
                if (rect.top > stickyThreshold) {
                    container.style.height = promoBar.offsetHeight + 'px';
                    promoBar.classList.add('is-sticky');
                    const scrollTopBtn = document.getElementById('fixed-scroll-top');
                    if (scrollTopBtn) {
                        scrollTopBtn.style.setProperty('bottom', (promoBar.offsetHeight + 20) + 'px', 'important');
                        scrollTopBtn.style.setProperty('transition', 'bottom 0.3s ease');
                    }
                } else {
                    promoBar.classList.remove('is-sticky');
                    container.style.height = 'auto';
                    const scrollTopBtn = document.getElementById('fixed-scroll-top');
                    if (scrollTopBtn) {
                        scrollTopBtn.style.removeProperty('bottom');
                    }
                }
            };

            window.addEventListener('scroll', handleScroll, { passive: true });
            window.addEventListener('resize', handleScroll, { passive: true });
            // Initial check
            handleScroll();
        }

        // Button Border Beam calculation
        const enrollBtn = container.querySelector('.btn-enroll');
        if (enrollBtn) {
            const btnSvg = enrollBtn.querySelector('.btn-border-beam-svg');
            const btnRect = enrollBtn.querySelector('.btn-border-beam-rect');
            if (btnSvg && btnRect) {
                let btnFrame;
                const updateBtnBeam = () => {
                    if (btnFrame) cancelAnimationFrame(btnFrame);
                    btnFrame = requestAnimationFrame(() => {
                        const w = enrollBtn.offsetWidth;
                        const h = enrollBtn.offsetHeight;
                        if (w <= 0 || h <= 0) return;

                        btnSvg.setAttribute('viewBox', `0 0 ${w} ${h}`);
                        
                        const strokeWidth = 2.5;
                        const inset = strokeWidth / 2;
                        const rectW = Math.max(0, w - strokeWidth);
                        const rectH = Math.max(0, h - strokeWidth);
                        
                        const computedStyle = window.getComputedStyle(enrollBtn);
                        const borderRadius = parseFloat(computedStyle.borderRadius) || 10;
                        const rx = Math.max(0, borderRadius - inset);
                        
                        btnRect.setAttribute('x', inset.toString());
                        btnRect.setAttribute('y', inset.toString());
                        btnRect.setAttribute('width', rectW.toString());
                        btnRect.setAttribute('height', rectH.toString());
                        btnRect.setAttribute('rx', rx.toString());
                        btnRect.setAttribute('ry', rx.toString());
                        
                        const perimeter = 2 * (rectW + rectH);
                        btnRect.style.setProperty('--btn-perimeter', perimeter.toString());
                        
                        // Set beam length to 25% of the perimeter
                        const beamLen = perimeter * 0.25;
                        btnRect.style.strokeDasharray = `${beamLen} ${perimeter - beamLen}`;
                    });
                };
                
                updateBtnBeam();
                window.addEventListener('resize', updateBtnBeam);
                if (window.ResizeObserver) {
                    const ro = new ResizeObserver(updateBtnBeam);
                    ro.observe(enrollBtn);
                }
            }
        }

        const countdownEl = container.querySelector('.js-countdown');
        if (countdownEl) {
            const durationMs = ((1 * 3600) + (59 * 60) + 59) * 1000; // 1 hr 59 min 59 sec
            const storageKey = 'sticky_promo_timer_end_v2';
            let promoEndTime = localStorage.getItem(storageKey);
            let now = new Date().getTime();
            
            if (!promoEndTime || parseInt(promoEndTime) <= now || parseInt(promoEndTime) > (now + durationMs)) {
                promoEndTime = now + durationMs;
                localStorage.setItem(storageKey, promoEndTime);
            }
            
            let countDownDate = parseInt(promoEndTime);

            const x = setInterval(function() {
                let now = new Date().getTime();
                let distance = countDownDate - now;
                
                if (distance <= 0) {
                    countDownDate = now + durationMs;
                    localStorage.setItem(storageKey, countDownDate);
                    distance = countDownDate - now;
                }

                const daysEl = countdownEl.querySelector(".js-days");
                const hoursEl = countdownEl.querySelector(".js-hours");
                const minsEl = countdownEl.querySelector(".js-minutes");
                const secsEl = countdownEl.querySelector(".js-seconds");
                
                const hours = Math.floor(distance / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);
                
                if(daysEl) daysEl.innerHTML = "00";
                if(hoursEl) hoursEl.innerHTML = hours < 10 ? '0' + hours : hours;
                if(minsEl) minsEl.innerHTML = minutes < 10 ? '0' + minutes : minutes;
                if(secsEl) secsEl.innerHTML = seconds < 10 ? '0' + seconds : seconds;
            }, 1000);
        }
    });
});
</script>
@endif

