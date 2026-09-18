@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
        if(!is_array($mcSettings)) $mcSettings = [];
        
        $totalCapacity = !empty($mcSettings['remaining_seats']) && is_numeric($mcSettings['remaining_seats']) 
            ? (int)$mcSettings['remaining_seats'] 
            : ($course->capacity > 0 ? $course->capacity : 100);
        $totalEnrolled = (int)$course->total_enrolled;
        $remainingSeats = max(0, $totalCapacity - $totalEnrolled);
    } else {
        $remainingSeats = 100;
    }

    $showSpecialGift = isset($mcSettings['show_special_gift']) ? $mcSettings['show_special_gift'] : empty($mcSettings['hide_special_gift']);
    
    $formatCurrencyText = function($text) {
        if (empty($text)) return $text;
        $sym  = '৳';
        $text = preg_replace('/(?:\$|৳)\s*র\b/u', 'টাকার', $text);
        return str_replace(['$', 'USD', 'TK', 'Tk', 'টাকা'], $sym, $text);
    };

    $toNum = function($str) {
        $numStr = preg_replace('/[^\d]/', '', (string)$str);
        $bengaliDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        $englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
        $numStr = str_replace($bengaliDigits, $englishDigits, $numStr);
        return is_numeric($numStr) ? (float)$numStr : 0;
    };

    $toBengaliNum = function($num) {
        $englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
        $bengaliDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        $formatted = is_numeric($num) ? number_format((float)$num) : (string)$num;
        return str_replace($englishDigits, $bengaliDigits, $formatted);
    };

    $formatPriceDisplay = function($rawPrice) use ($formatCurrencyText, $toNum, $toBengaliNum) {
        if (empty($rawPrice)) return '';
        $sym = '৳';
        $numericVal = $toNum($rawPrice);
        if ($numericVal > 0) {
            return $sym . $toBengaliNum($numericVal);
        }
        return str_replace(['$', 'USD'], $sym, (string)$rawPrice);
    };

    $freePriceText = function() {
        return '৳০';
    };

    $stripEmojis = function($text) {
        if (empty($text)) return '';
        return trim(preg_replace('/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', '', $text));
    };

    $formatDashTitle = function($html) {
        if (empty($html)) return '';

        $pattern = '/(\s*&mdash;\s*|\s*—\s*|\s*–\s*|\s*--\s*|\s+-\s+)/u';
        if (preg_match($pattern, $html)) {
            $parts = preg_split($pattern, $html, 2);
            if (count($parts) === 2 && !empty(trim(strip_tags($parts[0]))) && !empty(trim(strip_tags($parts[1])))) {
                $main = trim($parts[0]);
                $sub = trim($parts[1]);

                $mainClean = preg_replace('/^<p>(.*?)<\/p>$/is', '$1', $main);
                $subClean = preg_replace('/^<p>(.*?)<\/p>$/is', '$1', $sub);

                return '<div class="mc-gift-title-main">' . $mainClean . '</div>' .
                       '<div class="mc-gift-sub-line"></div>' .
                       '<div class="mc-gift-title-sub">' . $subClean . '</div>';
            }
        }
        return $html;
    };

    $giftBadge = !empty($mcSettings['gift_badge']) ? $stripEmojis($mcSettings['gift_badge']) : '';
    $giftTitle = !empty($mcSettings['gift_title']) ? $stripEmojis($mcSettings['gift_title']) : '';
    $giftSubtitle = !empty($mcSettings['gift_subtitle']) ? $mcSettings['gift_subtitle'] : '';
    $giftValue = !empty($mcSettings['gift_value']) ? $mcSettings['gift_value'] : '';
    $giftDescription = !empty($mcSettings['gift_description']) ? $mcSettings['gift_description'] : '';
    $giftQuote = !empty($mcSettings['gift_quote']) ? $mcSettings['gift_quote'] : '';
    $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : '';
    $giftCtaText = !empty($mcSettings['gift_cta_text']) ? $mcSettings['gift_cta_text'] : $heroBtnText;
    $giftCtaLink = !empty($mcSettings['gift_cta_link']) ? $mcSettings['gift_cta_link'] : '';
@endphp

@if($showSpecialGift && (!empty($giftTitle) || !empty($giftBadge) || !empty($giftDescription)))
<style>
    .mc-special-gift-card {
        background-color: transparent;
        border: none;
        padding: 0;
        margin-bottom: 0;
        position: relative;
    }

    .mc-gift-price-corner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
        background: linear-gradient(135deg, #092c74 0%, #0056d2 55%, #0077ff 100%);
        padding: 26px 36px;
        border-radius: 5px;
        box-shadow: 0 14px 35px rgba(0, 86, 210, 0.3), inset 0 1px 1px rgba(255, 255, 255, 0.25);
        border: 1px solid rgba(255, 255, 255, 0.2);
        position: relative;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .mc-gift-price-corner:hover {
        transform: translateY(-3px);
        box-shadow: 0 18px 40px rgba(0, 86, 210, 0.4), inset 0 1px 1px rgba(255, 255, 255, 0.3);
    }

    .mc-gift-taka-circle {
        width: 56px;
        height: 56px;
        background: rgba(255, 255, 255, 0.16);
        border: 1.5px solid rgba(255, 255, 255, 0.4);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 2px;
        box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
        backdrop-filter: blur(4px);
    }

    .mc-gift-regular-price {
        display: flex;
        align-items: center;
        gap: 8px;
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.05rem;
        font-weight: 600;
        white-space: nowrap;
    }

    .mc-price-label {
        color: rgba(255, 255, 255, 0.85);
        font-size: 0.98rem;
        font-weight: 600;
    }

    .mc-strike-price {
        font-size: 1.65rem;
        font-weight: 800;
        color: #ffffff;
        text-decoration: line-through;
        text-decoration-color: #ff4d4d;
        text-decoration-thickness: 3px;
        opacity: 0.95;
    }

    .mc-gift-crossed-price {
        font-size: 1.65rem;
        font-weight: 800;
        color: #ffffff;
        position: relative;
        display: inline-block;
        white-space: nowrap;
        line-height: 1;
        text-decoration: line-through;
        text-decoration-color: #ff4d4d;
        text-decoration-thickness: 3px;
    }

    .mc-gift-pill {
        display: inline-block;
        background-color: var(--color-white, #ffffff);
        border: 1px solid var(--color-border-tint, #D9E8FC);
        color: var(--color-primary, #0056D2);
        font-size: 0.88rem;
        font-weight: 800;
        padding: 6px 18px;
        border-radius: 50px;
        margin-bottom: 16px;
    }

    .mc-gift-free-badge {
        font-size: 1.15rem !important;
        font-weight: 800 !important;
        padding: 10px 28px !important;
        line-height: 1.2 !important;
        letter-spacing: 0.5px;
        box-shadow: 0 8px 22px rgba(255, 107, 0, 0.45), inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
        display: inline-flex !important;
        align-items: center;
        justify-content: center;
        gap: 6px;
        text-transform: uppercase;
        vertical-align: middle;
        background: linear-gradient(135deg, #FF6B00 0%, #FF8800 100%) !important;
        color: #ffffff !important;
        border-radius: 50px !important;
        border: 1px solid rgba(255, 255, 255, 0.3) !important;
        transition: transform 0.2s ease, box-shadow 0.2s ease !important;
    }

    .mc-gift-free-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 12px 28px rgba(255, 107, 0, 0.55), inset 0 1px 0 rgba(255, 255, 255, 0.4) !important;
    }

    .mc-gift-subtitle {
        color: var(--color-text-secondary, #4B5A72);
        font-size: 15px;
        line-height: 1.7;
        margin-bottom: 12px;
    }

    .mc-special-gift-title {
        color: var(--color-text-ink, #0A1E3F);
        font-size: 26px;
        line-height: 1.4;
        max-width: 820px;
        margin-left: auto;
        margin-right: auto;
    }

    .mc-callout-quote {
        background: var(--color-white, #ffffff);
        border-left: 4px solid var(--color-primary, #0056D2);
        border-radius: 5px;
        padding: 16px 20px;
        color: var(--color-text-secondary, #4B5A72);
        margin-top: 0;
        margin-bottom: 0;
        box-shadow: 0 4px 12px rgba(0, 31, 92, 0.04);
        transition: transform 0.2s ease, box-shadow 0.2s ease;
    }

    .mc-callout-quote:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(0, 31, 92, 0.08);
    }

    .mc-callout-quote .quote-text {
        font-style: italic;
    }

    .mc-callout-quote .gift-item-img {
        transition: transform 0.2s ease;
    }

    .mc-callout-quote:hover .gift-item-img {
        transform: scale(1.02);
    }

    .mc-gift-only-image {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 !important;
        background: transparent !important;
        box-shadow: none !important;
        border: none !important;
        overflow: hidden;
        border-radius: 5px;
        margin-top: 0;
        margin-bottom: 0;
        width: 100%;
    }

    .mc-gift-only-image img {
        width: 100%;
        max-width: 100%;
        height: auto;
        border-radius: 5px;
        display: block;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
        transition: transform 0.3s ease;
    }

    .mc-gift-only-image a:hover img {
        transform: scale(1.01);
    }
    
    /* Border Wrapper (Static) */
    .mc-gift-animated-border-wrapper {
        position: relative;
        padding: 2px;
        border-radius: 5px;
        overflow: hidden;
        background: #eaf2fe;
        border: 1px solid #c7dcfa;
    }

    .mc-gift-animated-border-inner {
        position: relative;
        z-index: 2;
        background: #ffffff;
        border-radius: 5px;
        padding: 16px;
        height: 100%;
        width: 100%;
    }

    /* Pro Gift Cards & Zigzag Grid */
    .mc-gift-card-image {
        position: relative;
        background: #ffffff;
        border: 1px solid var(--color-border-tint, #C7DCFA);
        border-radius: 5px;
        overflow: hidden;
        box-shadow: 0 8px 24px rgba(0, 31, 92, 0.06);
        width: 100%;
        height: 100%;
        min-height: 250px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease;
    }

    .mc-gift-card-image:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 36px rgba(0, 86, 210, 0.14);
        border-color: var(--color-primary, #0056D2);
    }

    .mc-gift-card-image img {
        width: 100%;
        height: 100%;
        min-height: 250px;
        max-height: 360px;
        object-fit: cover;
        display: block;
        transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1);
    }

    .mc-gift-card-image:hover img {
        transform: scale(1.03);
    }


    /* Content Card (Brand Relatable - Premium Light Ice Glow) */
    .mc-gift-card-content {
        position: relative;
        background: linear-gradient(150deg, #FFFFFF 0%, #F4F8FE 50%, #E6F0FC 100%);
        border: 2px solid #BFDBFE;
        border-radius: 5px;
        padding: 36px 30px;
        box-shadow: 0 10px 28px rgba(0, 86, 210, 0.08), inset 0 1px 0 rgba(255, 255, 255, 0.95);
        width: 100%;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        gap: 26px;
        transition: transform 0.3s cubic-bezier(0.16, 1, 0.3, 1), box-shadow 0.3s ease, border-color 0.3s ease;
        overflow: hidden;
    }

    .mc-gift-card-content::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 6px;
        height: 100%;
        background: linear-gradient(180deg, var(--color-primary, #0056D2) 0%, #38BDF8 100%);
        border-radius: 5px 0 0 5px;
    }

    .mc-gift-card-content:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(0, 86, 210, 0.16);
        border-color: var(--color-primary, #0056D2);
    }

    /* Course Name / Title (Highlighted Hero) */
    .mc-gift-course-title-wrapper {
        flex-grow: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        padding: 8px 0;
    }

    .mc-gift-course-title {
        color: var(--color-text-ink, #0A1E3F);
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif);
        font-size: 1.65rem;
        font-weight: 800;
        line-height: 1.45;
        letter-spacing: -0.3px;
        margin: 0;
        width: 100%;
        text-align: center;
    }

    .mc-gift-title-main {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif);
        font-size: 1.7rem;
        font-weight: 800;
        color: var(--color-text-ink, #0A1E3F);
        line-height: 1.35;
        display: block;
        margin-bottom: 2px;
    }

    .mc-gift-sub-line {
        width: 44px;
        height: 3px;
        background: linear-gradient(90deg, #0056D2 0%, #38BDF8 100%);
        border-radius: 3px;
        margin: 8px auto 12px auto;
    }

    .mc-gift-title-sub {
        font-size: 1.05rem;
        font-weight: 500;
        color: var(--color-text-secondary, #4B5A72);
        line-height: 1.6;
        display: block;
    }

    .mc-gift-course-title p {
        margin: 0 !important;
        color: inherit !important;
        font-size: inherit !important;
        font-weight: inherit !important;
        line-height: inherit !important;
        text-align: center !important;
    }

    .mc-gift-course-title span {
        color: inherit !important;
    }

    .mc-gift-separator {
        width: 80px;
        height: 2px;
        background-color: #BFDBFE;
        margin: 0 auto;
        border-radius: 2px;
    }

    /* Price Display (Clean Highlighted Text - No Button) */
    .mc-gift-price-box {
        background: transparent !important;
        border: none !important;
        border-radius: 0 !important;
        padding: 0 !important;
        box-shadow: none !important;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        transition: transform 0.2s ease;
    }

    .mc-gift-price-box:hover {
        transform: scale(1.04);
        box-shadow: none !important;
    }

    .mc-gift-price-value {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif);
        font-size: 2.25rem;
        font-weight: 900;
        color: #ff7a00 !important;
        line-height: 1.1;
        letter-spacing: -0.3px;
    }
    
    @media (max-width: 767px) {
        .mc-special-gift-card {
            padding: 22px 14px;
        }
        .mc-gift-card-content {
            padding: 24px 16px;
            gap: 18px;
        }
        .mc-gift-course-title-wrapper {
            padding: 8px 0 !important;
            min-height: auto !important;
        }
        .mc-gift-course-title {
            font-size: 1.3rem !important;
        }
        .mc-gift-price-box {
            padding: 0 !important;
        }
        .mc-gift-price-value {
            font-size: 1.75rem !important;
        }
        .mc-gift-card-image img {
            min-height: 180px;
            max-height: 240px;
        }
        .mc-gift-price-corner {
            top: 14px;
            right: 14px;
            gap: 8px;
        }
        .mc-gift-crossed-price {
            font-size: 1.15rem;
        }
        .mc-gift-free-badge {
            font-size: 0.9rem !important;
            padding: 3px 12px !important;
        }
        .mc-special-gift-title {
            font-size: var(--mobile-font-heading-main, 20px) !important;
            line-height: 1.35 !important;
        }
        .mc-gift-pill {
            margin-top: 36px;
        }
        .mc-special-gift-title.mc-title-no-badge {
            margin-top: 32px;
        }
        .mc-callout-quote {
            flex-direction: column !important;
            align-items: flex-start !important;
            gap: 12px !important;
            padding: 14px 14px !important;
        }
        .mc-callout-quote .quote-main-content {
            width: 100% !important;
            margin-right: 0 !important;
        }
        .mc-callout-quote .quote-price {
            align-self: flex-start !important;
        }
    }
</style>
<section class="special-gift-section p-t-60 p-b-60 position-relative overflow-hidden" style="background-color: #F0F6FF !important;">
    <!-- Background Network Node Design -->
    <div style="position: absolute; top: 3%; right: -5%; width: 500px; height: 500px; z-index: 0; opacity: 0.05; pointer-events: none;">
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
    <div style="position: absolute; bottom: 3%; left: -5%; width: 500px; height: 500px; z-index: 0; opacity: 0.05; pointer-events: none;">
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
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-12">
                <div class="mc-special-gift-card" data-aos="fade-up">
                    <div class="row align-items-center mb-4">
                        <div class="col-lg-8 text-start">
                            @if($giftBadge)
                                <span class="mc-gift-pill">
                                    {!! format_title_highlight($formatCurrencyText($giftBadge)) !!}
                                </span>
                            @endif

                            @if($giftTitle)
                                <h2 class="fw-bold mb-3 mc-special-gift-title {{ !$giftBadge ? 'mc-title-no-badge' : '' }}" style="margin-left: 0; margin-right: 0; max-width: 100%;">
                                    {!! format_title_highlight($formatCurrencyText($giftTitle)) !!}
                                </h2>
                            @endif

                            @if(!empty($giftSubtitle))
                                <div class="mc-gift-subtitle">{!! $giftSubtitle !!}</div>
                            @endif

                            @if($giftDescription)
                                <div class="text-secondary leading-relaxed fs-6 w-100">
                                    {!! $giftDescription !!}
                                </div>
                            @endif
                        </div>
                        
                        @if($giftValue)
                            <div class="col-lg-4 d-flex justify-content-lg-end justify-content-center mt-4 mt-lg-0">
                                <div class="mc-gift-price-corner">
                                    <div class="mc-gift-taka-circle">৳</div>
                                    <div class="mc-gift-regular-price">
                                        <span class="mc-price-label">মূল্য:</span>
                                        <span class="mc-strike-price">{{ $formatCurrencyText($giftValue) }}</span>
                                    </div>
                                    <span class="badge mc-gift-free-badge rounded-pill">
                                        <i class="las la-gift me-1"></i> সম্পূর্ণ ফ্রি
                                    </span>
                                </div>
                            </div>
                        @endif
                    </div>

                    @php
                        $giftQuotesList = !empty($mcSettings['gift_quotes_list']) ? $mcSettings['gift_quotes_list'] : [];
                        if (!is_array($giftQuotesList)) $giftQuotesList = [];

                        $pairedRows = [];
                        $standaloneImages = [];
                        $standaloneTextPrices = [];

                        foreach ($giftQuotesList as $quote) {
                            $t = trim($quote['text'] ?? '');
                            $img = trim($quote['image'] ?? '');
                            $p = trim($quote['price'] ?? '');
                            $l = trim($quote['link'] ?? '');
                            $hasT = !empty(strip_tags($t)) || (!empty($t) && str_contains($t, '<img'));
                            $hasI = !empty($img);
                            $hasP = !empty($p);

                            if ($hasI && ($hasT || $hasP)) {
                                $pairedRows[] = [
                                    'image' => $img,
                                    'price' => $p,
                                    'text'  => $t,
                                    'link'  => $l,
                                ];
                            } elseif ($hasI && !$hasT && !$hasP) {
                                $standaloneImages[] = [
                                    'image' => $img,
                                    'price' => '',
                                    'text'  => '',
                                    'link'  => $l,
                                ];
                            } elseif (!$hasI && ($hasT || $hasP)) {
                                $standaloneTextPrices[] = [
                                    'image' => '',
                                    'price' => $p,
                                    'text'  => $t,
                                    'link'  => $l,
                                ];
                            }
                        }

                        // Pair remaining standalone images with standalone text/prices
                        while (!empty($standaloneImages) && !empty($standaloneTextPrices)) {
                            $imgItem = array_shift($standaloneImages);
                            $textItem = array_shift($standaloneTextPrices);
                            $pairedRows[] = [
                                'image' => $imgItem['image'],
                                'price' => $textItem['price'],
                                'text'  => $textItem['text'],
                                'link'  => $textItem['link'] ?: $imgItem['link'],
                            ];
                        }
                    @endphp

                    @if(count($pairedRows) > 0 || count($standaloneImages) > 0 || count($standaloneTextPrices) > 0)
                        <div class="w-100 mt-4 mb-4">
                            @foreach($pairedRows as $rIdx => $row)
                                @php
                                    $isEven = ($rIdx % 2 === 0);
                                    $bonusIndexStr = str_pad($rIdx + 1, 2, '0', STR_PAD_LEFT);
                                    $bonusIndexDisplay = $toBengaliNum($bonusIndexStr);
                                @endphp
                                <div class="mc-gift-animated-border-wrapper w-100 mb-4 mx-0">
                                    <div class="mc-gift-animated-border-inner">
                                        <div class="row g-4 w-100 align-items-stretch justify-content-center mx-0">
                                    <!-- Image Card -->
                                    <div class="col-md-6 col-12 d-flex {{ $isEven ? 'order-1 order-md-1' : 'order-1 order-md-2' }}">
                                        <div class="mc-gift-card-image w-100 h-100 position-relative overflow-hidden">
                                            <!-- Background Network Node Design -->
                                            <div style="position: absolute; top: -10%; right: -10%; width: 250px; height: 250px; z-index: 0; opacity: 0.12; pointer-events: none;">
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
                                            @if(!empty($row['link']))
                                                <a href="{{ $row['link'] }}" class="d-block w-100 h-100 overflow-hidden text-decoration-none position-relative" style="z-index: 1;">
                                            @endif
                                            <img src="{{ dynamic_asset($row['image']) }}" 
                                                 alt="Bonus Gift Image" 
                                                 class="img-fluid w-100 h-100 position-relative" style="z-index: 1;">
                                            @if(!empty($row['link']))
                                                </a>
                                            @endif
                                        </div>
                                    </div>

                                    <!-- Price & Text Card -->
                                    <div class="col-md-6 col-12 d-flex {{ $isEven ? 'order-2 order-md-2' : 'order-2 order-md-1' }}">
                                        <div class="mc-gift-card-content w-100 h-100 position-relative overflow-hidden">
                                            <!-- Background Network Node Design -->
                                            <div style="position: absolute; bottom: -10%; left: -10%; width: 250px; height: 250px; z-index: 0; opacity: 0.08; pointer-events: none;">
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
                                            <!-- Course Name / Title (Highlighted Hero) -->
                                            <div class="mc-gift-course-title-wrapper position-relative" style="z-index: 1;">
                                                <div class="mc-gift-course-title">
                                                    @if(!empty($row['text']))
                                                        {!! $formatDashTitle($row['text']) !!}
                                                    @else
                                                        এক্সক্লুসিভ স্পেশাল বোনাস কোর্স
                                                    @endif
                                                </div>
                                            </div>

                                            @if(!empty($row['price']))
                                                <div class="mc-gift-separator position-relative" style="z-index: 1;"></div>
                                                <!-- Price Box (Pure Highlighted) -->
                                                <div class="mc-gift-price-box position-relative" style="z-index: 1;">
                                                    <span class="mc-gift-price-value">{{ $formatPriceDisplay($row['price']) }}</span>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- Render any leftover standalone images --}}
                            @if(count($standaloneImages) > 0)
                                <div class="mc-gift-animated-border-wrapper w-100 mb-3 mx-0">
                                    <div class="mc-gift-animated-border-inner">
                                        <div class="row g-4 w-100 justify-content-center mx-0">
                                    @foreach($standaloneImages as $imgItem)
                                        <div class="col-md-6 col-12 d-flex">
                                            <div class="mc-gift-card-image w-100 h-100 position-relative overflow-hidden">
                                                <!-- Background Network Node Design -->
                                                <div style="position: absolute; top: -10%; right: -10%; width: 250px; height: 250px; z-index: 0; opacity: 0.12; pointer-events: none;">
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
                                                @if(!empty($imgItem['link']))
                                                    <a href="{{ $imgItem['link'] }}" class="d-block w-100 h-100 overflow-hidden text-decoration-none position-relative" style="z-index: 1;">
                                                @endif
                                                <img src="{{ dynamic_asset($imgItem['image']) }}" 
                                                     alt="Bonus Gift Image" 
                                                     class="img-fluid w-100 h-100 position-relative" style="z-index: 1;">
                                                @if(!empty($imgItem['link']))
                                                    </a>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif

                            {{-- Render any leftover standalone text/prices --}}
                            @if(count($standaloneTextPrices) > 0)
                                <div class="mc-gift-animated-border-wrapper w-100 mb-3 mx-0">
                                    <div class="mc-gift-animated-border-inner">
                                        <div class="row g-4 w-100 justify-content-center mx-0">
                                    @foreach($standaloneTextPrices as $sIdx => $textItem)
                                        <div class="col-md-6 col-12 d-flex">
                                            <div class="mc-gift-card-content w-100 h-100 position-relative overflow-hidden">
                                                <!-- Background Network Node Design -->
                                                <div style="position: absolute; bottom: -10%; left: -10%; width: 250px; height: 250px; z-index: 0; opacity: 0.08; pointer-events: none;">
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
                                                <!-- Course Name / Title (Highlighted Hero) -->
                                                <div class="mc-gift-course-title-wrapper position-relative" style="z-index: 1;">
                                                    <div class="mc-gift-course-title">
                                                        {!! $formatDashTitle($textItem['text']) !!}
                                                    </div>
                                                </div>
                                                @if(!empty($textItem['price']))
                                                    <div class="mc-gift-separator position-relative" style="z-index: 1;"></div>
                                                    <div class="mc-gift-price-box position-relative" style="z-index: 1;">
                                                        <span class="mc-gift-price-value">{{ $formatPriceDisplay($textItem['price']) }}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </div>
                    @elseif(!empty($giftQuote))
                        <div class="mc-callout-quote w-100 text-start">
                            <div class="quote-text">{!! $formatCurrencyText($giftQuote) !!}</div>
                        </div>
                    @endif

                    @php
                        $heroBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : ((request()->is('/') || request()->is('home*') || isHome()) ? '#register' : url('/#register'));
                        $finalGiftCtaLink = !empty($giftCtaLink) ? $giftCtaLink : $heroBtnUrl;
                    @endphp
                    @if(!empty($giftCtaText))
                    <div class="text-center w-100 mt-4">
                        <a href="{{ $finalGiftCtaLink }}" class="template-btn get-access-btn">
                            {{ $giftCtaText }}
                        </a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif
