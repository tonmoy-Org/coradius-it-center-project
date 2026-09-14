@php
    $status = setting('counter_section_status');
    
    $counterItems = setting('counter_items');
    if (!is_array($counterItems) || empty($counterItems)) {
        $counterItems = [];
        for ($c = 1; $c <= 4; $c++) {
            $t = setting("counter_{$c}_title");
            $v = setting("counter_{$c}_count");
            if (!empty($t) || !empty($v)) {
                $counterItems[] = ['title' => $t ?: '', 'count' => $v ?: ''];
            }
        }
    }
@endphp

@if($status !== '0' && count($counterItems) > 0)
<style>
    .counter-section-standalone {
        position: relative;
        z-index: 10;
    }
    .counter-card-box {
        background: var(--color-white, #ffffff) !important;
        border-radius: 14px;
        box-shadow: 0 8px 24px rgba(0, 31, 92, 0.05);
        padding: 38px 20px 45px 20px;
        text-align: center;
        position: relative;
        overflow: hidden;
        transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        min-height: 190px;
        border: 1px solid var(--color-border-tint, #D9E8FC);
    }
    .counter-card-box:hover {
        transform: translateY(-4px);
        border-color: var(--color-border-hover, #C7DCFA);
        box-shadow: 0 14px 32px rgba(0, 86, 210, 0.12);
    }
    .counter-label {
        color: var(--color-text-ink, #0A1E3F) !important;
        font-size: 22px !important;
        font-weight: 700 !important;
        line-height: 1.25;
        margin-bottom: 4px;
        letter-spacing: -0.01em;
    }
    .counter-dot-line {
        width: 85px;
        height: 1px;
        background-color: var(--color-border-tint, #D9E8FC);
        margin: 8px auto 12px auto;
        position: relative;
    }
    .counter-dot {
        width: 6px;
        height: 6px;
        background-color: var(--color-primary, #0056D2);
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .counter-number {
        color: var(--color-primary, #0056D2) !important;
        font-size: 34px !important;
        font-weight: 800 !important;
        line-height: 1.1;
        letter-spacing: -0.02em;
        font-family: var(--header-font, "Outfit", "Hind Siliguri", system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif);
    }
    .counter-bottom-wave {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 40px;
        pointer-events: none;
        overflow: hidden;
        border-bottom-left-radius: 14px;
        border-bottom-right-radius: 14px;
    }
    @media (max-width: 767.98px) {
        .counter-section-standalone {
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }
        .course-description-section {
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }
        .about-me-section {
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }
        .categories-of-work-section {
            padding-top: 15px !important;
            padding-bottom: 15px !important;
        }
        .counter-card-box {
            padding: 22px 10px 28px 10px !important;
            min-height: 135px !important;
            border-radius: 12px;
        }
        .counter-label {
            font-size: var(--mobile-font-heading-sub, 17px) !important;
            font-weight: 600 !important;
            margin-bottom: 2px;
        }
        .counter-number {
            font-size: 22px !important;
        }
        .counter-dot-line {
            width: 50px;
            margin: 6px auto 8px auto;
        }
        .counter-bottom-wave {
            height: 30px;
        }
    }
    @media (max-width: 380px) {
        .counter-card-box {
            padding: 18px 6px 24px 6px !important;
            min-height: 125px !important;
        }
        .counter-label {
            font-size: 14px !important;
        }
        .counter-number {
            font-size: 20px !important;
        }
        .counter-dot-line {
            width: 40px;
        }
    }
</style>

<section class="counter-section counter-section-standalone bg-white p-t-60 p-b-60" style="background-color: #ffffff !important;">
    <div class="container container-1278">
        <div class="row align-items-stretch justify-content-center g-2 g-sm-3 g-md-4">
            @php
                $itemCount = count($counterItems);
                if ($itemCount == 1) {
                    $colClass = 'col-lg-6 col-md-8 col-12';
                } elseif ($itemCount == 2) {
                    $colClass = 'col-lg-6 col-md-6 col-6';
                } elseif ($itemCount == 3) {
                    $colClass = 'col-lg-4 col-md-6 col-6';
                } else {
                    $colClass = 'col-lg-3 col-md-6 col-6';
                }
            @endphp

            @foreach($counterItems as $index => $item)
                @php
                    $itemTitle = $item['title'] ?? '';
                    $itemVal   = $item['count'] ?? '';
                @endphp
                <div class="{{ $colClass }}" data-aos="fade-up" data-aos-delay="{{ 50 * ($index + 1) }}">
                    <div class="counter-card-box">
                        <span class="counter-label d-block">
                            {{ __($itemTitle) }}
                        </span>
                        <div class="counter-dot-line">
                            <span class="counter-dot"></span>
                        </div>
                        <h3 class="counter-number mb-0" data-count="{{ $itemVal }}">
                            {{ $itemVal }}
                        </h3>
                        <div class="counter-bottom-wave">
                            <svg viewBox="0 0 500 150" preserveAspectRatio="none" style="height: 100%; width: 100%;">
                                <path d="M0.00,49.98 C150.00,150.00 349.20,-49.98 500.00,49.98 L500.00,150.00 L0.00,150.00 Z" style="stroke: none; fill: var(--color-blue-tint, #EAF2FE);"></path>
                            </svg>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const counterElements = document.querySelectorAll('.counter-number[data-count]');
    if (!counterElements.length) return;

    const bnDigits = ['০', '১', '২', '৩', '৪', '৫', '৬', '৭', '৮', '৯'];
    const arDigits = ['٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩'];

    function toAsciiDigits(str) {
        return str
            .replace(/[০-৯]/g, d => bnDigits.indexOf(d))
            .replace(/[٠-٩]/g, d => arDigits.indexOf(d));
    }

    function toBanglaDigits(str) {
        return str.replace(/[0-9]/g, d => bnDigits[d]);
    }

    function toArabicDigits(str) {
        return str.replace(/[0-9]/g, d => arDigits[d]);
    }

    function animateCounter(el) {
        if (el.dataset.counterAnimated === 'true') return;
        el.dataset.counterAnimated = 'true';

        const rawString = (el.getAttribute('data-count') || el.innerText || '').trim();
        if (!rawString) return;

        // Match numeric part across English (0-9), Bangla (০-৯), and Arabic (٠-٩) digits
        const match = rawString.match(/([0-9\u09E6-\u09EF\u0660-\u0669]+(?:,[0-9\u09E6-\u09EF\u0660-\u0669]+)*(?:\.[0-9\u09E6-\u09EF\u0660-\u0669]+)?)/);
        if (!match) return;

        const rawMatched = match[0];
        const isBangla = /[\u09E6-\u09EF]/.test(rawMatched);
        const isArabic = /[\u0660-\u0669]/.test(rawMatched);
        const hasCommas = rawMatched.includes(',');

        // Convert matched digits to ASCII for calculation
        const asciiMatched = toAsciiDigits(rawMatched);
        const cleanNumberStr = asciiMatched.replace(/,/g, '');
        const targetNum = parseFloat(cleanNumberStr);
        if (isNaN(targetNum)) return;

        // Determine decimal precision if present
        const decimalParts = cleanNumberStr.split('.');
        const decimals = decimalParts.length > 1 ? decimalParts[1].length : 0;

        const prefix = rawString.substring(0, match.index);
        const suffix = rawString.substring(match.index + rawMatched.length);

        const duration = 2000;
        const startTime = performance.now();

        // Helper to format numbers with commas and appropriate digit locale
        function formatVal(val) {
            let numStr = decimals > 0 ? val.toFixed(decimals) : Math.floor(val).toString();
            if (hasCommas) {
                const parts = numStr.split('.');
                parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ',');
                numStr = parts.join('.');
            }
            if (isBangla) {
                return toBanglaDigits(numStr);
            }
            if (isArabic) {
                return toArabicDigits(numStr);
            }
            return numStr;
        }

        // Initialize display to starting state
        el.innerText = prefix + formatVal(0) + suffix;

        function update(currentTime) {
            const elapsedTime = currentTime - startTime;
            const progress = Math.min(elapsedTime / duration, 1);

            // Smooth cubic ease-out
            const easeProgress = 1 - Math.pow(1 - progress, 3);
            const currentNum = easeProgress * targetNum;

            el.innerText = prefix + formatVal(currentNum) + suffix;

            if (progress < 1) {
                requestAnimationFrame(update);
            } else {
                el.innerText = rawString;
            }
        }

        requestAnimationFrame(update);
    }

    if ('IntersectionObserver' in window) {
        const observerOptions = {
            root: null,
            rootMargin: '0px',
            threshold: 0.15
        };

        const observer = new IntersectionObserver((entries, observerInstance) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observerInstance.unobserve(entry.target);
                }
            });
        }, observerOptions);

        counterElements.forEach(el => observer.observe(el));
    } else {
        counterElements.forEach(el => animateCounter(el));
    }
});
</script>
@endif
