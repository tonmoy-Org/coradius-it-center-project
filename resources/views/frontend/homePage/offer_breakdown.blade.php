@php
    $mcSettings = [];
    if(isset($course) && $course) {
        $mcSettings = is_array($course->masterclass_settings) ? $course->masterclass_settings : json_decode($course->masterclass_settings ?? '[]', true);
    }

    $formatCurrencyText = function($text) {
        if (empty($text)) return $text;
        $sym = get_symbol();
        $code = userCurrency();
        if ($code === 'BDT') {
            return str_replace(['$', 'USD', 'TK', 'Tk'], $sym, $text);
        } else {
            return str_replace(['৳', 'TK', 'Tk', 'টাকা'], $sym, $text);
        }
    };

    $stripEmojis = function($text) {
        if (empty($text)) return '';
        return trim(preg_replace('/[\x{1F600}-\x{1F64F}\x{1F300}-\x{1F5FF}\x{1F680}-\x{1F6FF}\x{1F700}-\x{1F77F}\x{1F780}-\x{1F7FF}\x{1F800}-\x{1F8FF}\x{1F900}-\x{1F9FF}\x{1FA00}-\x{1FA6F}\x{1FA70}-\x{1FAFF}\x{2600}-\x{26FF}\x{2700}-\x{27BF}]/u', '', $text));
    };

    $rawItems = !empty($mcSettings['breakdown_items']) ? $mcSettings['breakdown_items'] : '';

    $breakdownRows = [];
    $cleanItems = str_replace(['</p>', '<br>', '<br/>', '<br />'], "\n", $rawItems);
    $cleanItems = strip_tags($cleanItems);
    $lines = array_values(array_filter(array_map('trim', explode("\n", $cleanItems))));
    
    $i = 0;
    while ($i < count($lines)) {
        $line = $lines[$i];
        if (str_contains($line, '|')) {
            $parts = explode('|', $line);
            $breakdownRows[] = [
                'title' => trim($parts[0] ?? ''),
                'val'   => trim($parts[1] ?? '')
            ];
            $i++;
        } else {
            if (isset($lines[$i+1]) && str_contains($lines[$i+1], '|')) {
                $parts = explode('|', $lines[$i+1]);
                $breakdownRows[] = [
                    'title' => $line . "\n" . trim($parts[0] ?? ''),
                    'val'   => trim($parts[1] ?? '')
                ];
                $i += 2;
            } else {
                $breakdownRows[] = [
                    'title' => $line,
                    'val'   => ''
                ];
                $i++;
            }
        }
    }

    $todayTitle = !empty($mcSettings['breakdown_today_title']) ? $mcSettings['breakdown_today_title'] : '';
    $subheading = !empty($mcSettings['breakdown_subheading']) ? $mcSettings['breakdown_subheading'] : '';
    $originalPrice = !empty($mcSettings['breakdown_original_price']) ? $mcSettings['breakdown_original_price'] : '';
    $ribbonText = !empty($mcSettings['breakdown_ribbon_text']) ? $mcSettings['breakdown_ribbon_text'] : '';

    // Strip all emojis
    $todayTitle = $stripEmojis($todayTitle);
    $subheading = $stripEmojis($subheading);
    $originalPrice = $stripEmojis($originalPrice);
    $ribbonText = $stripEmojis($ribbonText);

    $toNum = function($str) {
        $numStr = preg_replace('/[^\d]/', '', $str);
        $bengaliDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        $englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
        $numStr = str_replace($bengaliDigits, $englishDigits, $numStr);
        return is_numeric($numStr) ? (float)$numStr : 0;
    };

    $origNum = $toNum($originalPrice);
    $offerNum = $toNum($subheading);
    $savedNum = max(0, $origNum - $offerNum);
    $discountPct = ($origNum > 0 && $savedNum > 0) ? round(($savedNum / $origNum) * 100) : 0;

    $toBengaliNum = function($num) {
        $englishDigits = ['0','1','2','3','4','5','6','7','8','9'];
        $bengaliDigits = ['০','১','২','৩','৪','৫','৬','৭','৮','৯'];
        $formatted = number_format($num);
        return str_replace($englishDigits, $bengaliDigits, $formatted);
    };

    $savedText = $savedNum > 0 ? get_symbol() . $toBengaliNum($savedNum) : '';
    $discountText = $discountPct > 0 ? "({$toBengaliNum($discountPct)}% ছাড়)" : '';
@endphp

@if(isset($mcSettings['breakdown_status']) ? $mcSettings['breakdown_status'] : true)
<style>
    .offer-breakdown-section-light {
        background-color: #ffffff;
    }

    .mc-breakdown-light-card {
        background: #ffffff;
        border: 2px solid #0056D2;
        border-radius: 20px;
        padding: 28px 24px;
        box-shadow: 0 10px 35px rgba(0, 86, 210, 0.08);
        max-width: 800px;
        margin: 0 auto;
    }

    .mc-bd-light-header {
        margin-bottom: 20px;
    }

    .mc-bd-light-eyebrow {
        color: #0A1E3F;
        font-size: 26px;
        font-weight: 700;
        margin-bottom: 6px;
        line-height: 1.4;
    }

    .mc-bd-light-title {
        color: #0A1E3F;
        font-size: 26px;
        font-weight: 700;
        text-align: center;
        margin: 0 auto 16px auto;
        line-height: 1.4;
    }

    .mc-bd-light-title mark, .mc-bd-light-title .highlight {
        background: var(--color-blue-tint, #EAF2FE);
        color: var(--color-primary, #0056D2);
        padding: 2px 8px;
        border-radius: 6px;
    }

    .mc-bd-light-items-box {
        background: var(--color-white, #ffffff);
        border: 1px solid var(--color-border-tint, #D9E8FC);
        border-radius: 16px;
        padding: 4px 16px;
        margin-bottom: 20px;
    }

    .mc-bd-light-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 11px 4px;
        border-bottom: 1px solid #f1f5f9;
    }

    .mc-bd-light-row:last-child {
        border-bottom: none;
    }

    .mc-bd-light-icon-badge {
        width: 38px;
        height: 38px;
        border-radius: 50%;
        background: var(--color-blue-tint, #EAF2FE);
        border: 1px solid var(--color-border-tint, #D9E8FC);
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--color-primary, #0056D2);
        font-size: 1.1rem;
        flex-shrink: 0;
    }

    .mc-bd-light-item-title {
        font-size: 0.98rem;
        font-weight: 700;
        color: var(--color-text-ink, #0A1E3F);
        line-height: 1.35;
    }

    .mc-bd-light-item-sub {
        font-size: 0.82rem;
        color: var(--color-text-secondary, #4B5A72);
        margin-top: 2px;
        font-weight: 400;
    }

    .mc-bd-light-item-val {
        font-size: 1.1rem;
        font-weight: 800;
        color: var(--color-primary, #0056D2);
        white-space: nowrap;
    }

    /* Light Blue Offer Discount Box */
    .mc-bd-light-discount-box {
        background: var(--color-blue-tint, #EAF2FE);
        border: 2px solid var(--color-primary, #0056D2);
        border-radius: 16px;
        position: relative;
        padding: 24px 24px 20px 24px;
        margin-bottom: 20px;
    }

    .mc-bd-light-ribbon {
        position: absolute;
        top: -13px;
        left: 20px;
        background: var(--color-accent-orange, #FF7A00);
        color: #ffffff;
        font-size: 0.85rem;
        font-weight: 800;
        padding: 4px 16px;
        border-radius: 6px;
        box-shadow: 0 4px 10px rgba(255, 122, 0, 0.3);
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .mc-bd-light-ribbon i {
        font-size: 0.85rem;
        color: #ffffff;
    }

    .mc-bd-light-offer-heading {
        color: #0A1E3F;
        font-size: 1rem;
        font-weight: 700;
        margin-bottom: 4px;
    }

    .mc-bd-light-price-huge {
        font-size: 2.35rem;
        font-weight: 900;
        color: #FF7A00;
        line-height: 1.15;
        margin-bottom: 6px;
        letter-spacing: -0.5px;
    }

    .mc-bd-light-timer-text {
        font-size: 0.88rem;
        color: #0056D2;
        display: flex;
        align-items: center;
        gap: 6px;
        font-weight: 600;
    }

    .mc-bd-light-divider {
        border-right: 1px solid #C7DCFA;
    }

    .mc-bd-light-orig-label {
        color: #8A96A8;
        font-size: 0.95rem;
        font-weight: 600;
        margin-bottom: 2px;
    }

    .mc-bd-light-orig-price {
        font-size: 1.6rem;
        font-weight: 800;
        color: #8A96A8;
        position: relative;
        display: inline-block;
        margin-bottom: 8px;
        white-space: nowrap;
    }

    .mc-bd-light-saved-box {
        border: 1px dashed #0056D2;
        background: #ffffff;
        border-radius: 12px;
        padding: 10px 18px;
        text-align: center;
        width: 100%;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
    }

    .mc-bd-light-saved-label {
        font-size: 0.85rem;
        color: #4B5A72;
        font-weight: 600;
        margin-bottom: 1px;
    }

    .mc-bd-light-saved-val {
        font-size: 1.35rem;
        font-weight: 900;
        color: #0056D2;
        line-height: 1.15;
    }

    .mc-bd-light-saved-pct {
        font-size: 0.85rem;
        color: #FF7A00;
        font-weight: 700;
    }

    .mc-bd-light-security-note {
        color: #8A96A8;
        font-size: 0.88rem;
        margin-top: 10px;
        font-weight: 500;
    }



    @media (max-width: 767px) {
        .mc-breakdown-light-card {
            padding: 20px 12px;
        }
        .mc-bd-light-title,
        .mc-bd-light-title * {
            font-size: 20px !important;
            font-weight: 700 !important;
            line-height: 1.35 !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
        }
        .mc-bd-light-eyebrow,
        .mc-bd-light-eyebrow * {
            font-size: 13px !important;
            font-weight: 600 !important;
            line-height: 1.4 !important;
        }
        .mc-bd-light-price-huge {
            font-size: 1.75rem;
        }
        .mc-bd-light-divider {
            border-right: none;
            border-bottom: 1px solid #C7DCFA;
            padding-bottom: 14px;
            margin-bottom: 14px;
        }
        .mc-bd-light-items-box {
            padding: 4px 10px;
        }
        .mc-bd-light-row {
            gap: 8px;
        }
        .mc-bd-light-item-title,
        .mc-bd-light-item-title * {
            font-size: 14px !important;
            font-weight: 600 !important;
            word-break: break-word !important;
            overflow-wrap: break-word !important;
        }
        .mc-bd-light-item-sub,
        .mc-bd-light-item-sub * {
            font-size: 12.5px !important;
            font-weight: 400 !important;
        }
        .mc-bd-light-item-val {
            font-size: 0.95rem;
        }
    }
</style>

<section class="offer-breakdown-section offer-breakdown-section-light p-t-60 p-b-60 position-relative">
    <div class="container container-1278">
        <div class="mc-breakdown-light-card text-center" data-aos="fade-up">
            
            @php
                if (strip_tags($todayTitle) !== $todayTitle) {
                    $eyebrowText = '';
                    $mainTitleText = $todayTitle;
                } else {
                    $titleLines = array_values(array_filter(preg_split('/\r\n|\r|\n|<br\s*\/?>/i', $todayTitle)));
                    $eyebrowText = count($titleLines) > 1 ? trim($titleLines[0]) : '';
                    $mainTitleText = count($titleLines) > 1 ? trim($titleLines[1]) : (count($titleLines) == 1 ? trim($titleLines[0] ?? '') : $todayTitle);
                }
                
                $eyebrowText = $stripEmojis($eyebrowText);
                $mainTitleText = $stripEmojis($mainTitleText);
            @endphp
            @if(!empty($eyebrowText) || !empty($mainTitleText))
            <div class="mc-bd-light-header">
                @if(!empty($eyebrowText))
                    <div class="mc-bd-light-eyebrow">{!! format_title_highlight($formatCurrencyText($eyebrowText)) !!}</div>
                @endif
                @if(!empty($mainTitleText))
                <h3 class="mc-bd-light-title">
                    {!! format_title_highlight($formatCurrencyText($mainTitleText)) !!}
                </h3>
                @endif
            </div>
            @endif
            
            @if(count($breakdownRows) > 0)
            <div class="mc-bd-light-items-box text-start">
                @foreach($breakdownRows as $idx => $row)
                    @php
                        $cleanRowTitle = $stripEmojis($row['title']);
                        $itemLines = array_values(array_filter(preg_split('/\r\n|\r|\n|<br\s*\/?>/i', $cleanRowTitle)));
                        $itemMainTitle = trim($itemLines[0] ?? '');
                        $itemSubTitle = trim($itemLines[1] ?? '');
                        $isFree = strtolower(trim($row['val'])) === 'free';
                    @endphp
                    <div class="mc-bd-light-row">
                        <div class="d-flex align-items-center gap-3">
                            <div class="mc-bd-light-icon-badge">
                                @if(str_contains(strtolower($itemMainTitle), 'masterclass') || str_contains(strtolower($itemMainTitle), 'মাস্টারক্লাস'))
                                    <i class="fas fa-graduation-cap"></i>
                                @elseif(str_contains(strtolower($itemMainTitle), 'certificate') || str_contains(strtolower($itemMainTitle), 'সার্টিফিকেট'))
                                    <i class="fas fa-file-alt"></i>
                                @elseif(str_contains(strtolower($itemMainTitle), 'support') || str_contains(strtolower($itemMainTitle), 'সাপোর্ট'))
                                    <i class="fas fa-headphones"></i>
                                @elseif(str_contains(strtolower($itemMainTitle), 'update') || str_contains(strtolower($itemMainTitle), 'আপডেট'))
                                    <i class="fas fa-sync-alt"></i>
                                @else
                                    <i class="fas fa-gift"></i>
                                @endif
                            </div>
                            <div>
                                <div class="mc-bd-light-item-title">{{ $itemMainTitle }}</div>
                                @if(!empty($itemSubTitle))
                                    <div class="mc-bd-light-item-sub">{{ $itemSubTitle }}</div>
                                @endif
                            </div>
                        </div>
                        <div class="mc-bd-light-item-val">
                            {{ $formatCurrencyText($row['val']) }}
                        </div>
                    </div>
                @endforeach
            </div>
            @endif
            
            @if(!empty($subheading) || !empty($originalPrice))
            <div class="mc-bd-light-discount-box">
                @if(!empty($ribbonText))
                <div class="mc-bd-light-ribbon">
                    <i class="fas fa-tag"></i>
                    <span>{{ $ribbonText }}</span>
                </div>
                @endif
                
                <div class="row align-items-center gy-3">
                    @if(!empty($subheading))
                    <div class="col-md-{{ !empty($originalPrice) ? '6' : '12' }} text-center text-md-start {{ !empty($originalPrice) ? 'mc-bd-light-divider pe-md-4' : '' }}">
                        <div class="mc-bd-light-offer-heading">এখনই কোর্সটি কিনুন মাত্র</div>
                        <div class="mc-bd-light-price-huge">{!! format_title_highlight($formatCurrencyText($subheading)) !!}</div>
                        <div class="mc-bd-light-timer-text">
                            <i class="far fa-clock text-success"></i>
                            <span>সীমিত সময়ের অফার – এখনই সুযোগ নিন!</span>
                        </div>
                    </div>
                    @endif
                    
                    @if(!empty($originalPrice))
                        <div class="col-md-{{ !empty($subheading) ? '6' : '12' }} text-center ps-md-4 d-flex flex-column align-items-center justify-content-center">
                            <div class="mc-bd-light-orig-label">আসল মূল্য</div>
                            <div class="mc-bd-light-orig-price">
                                <span style="position: absolute; width: 110%; height: 2px; background: #ef4444; top: 50%; left: -5%; transform: rotate(-12deg);"></span>
                                <span>{{ $formatCurrencyText($originalPrice) }}</span>
                            </div>
                            
                            @if(!empty($savedText) || !empty($discountText))
                                <div class="mc-bd-light-saved-box">
                                    <div class="mc-bd-light-saved-label">আপনি সেভ করছেন</div>
                                    <div class="mc-bd-light-saved-val">{{ $savedText }}</div>
                                    @if(!empty($discountText))
                                        <div class="mc-bd-light-saved-pct">{{ $discountText }}</div>
                                    @endif
                                </div>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
            @endif
            
            @php
                $heroBtnText = !empty($mcSettings['overview_btn_text']) ? $mcSettings['overview_btn_text'] : '';
                $heroBtnUrl = !empty($mcSettings['overview_btn_url']) ? $mcSettings['overview_btn_url'] : ((request()->is('/') || request()->is('home*') || isHome()) ? '#register' : url('/#register'));
                $breakdownCtaText = !empty($mcSettings['breakdown_cta_text']) ? $mcSettings['breakdown_cta_text'] : $heroBtnText;
                $breakdownCtaLink = !empty($mcSettings['breakdown_cta_link']) ? $mcSettings['breakdown_cta_link'] : $heroBtnUrl;
            @endphp
            @php
                $securityNote = !empty($mcSettings['breakdown_security_note']) ? $mcSettings['breakdown_security_note'] : '';
            @endphp
            @if(!empty($breakdownCtaText))
            <div class="text-center w-100 mt-2">
                <a href="{{ $breakdownCtaLink }}" class="template-btn get-access-btn">
                    <i class="fas fa-shopping-cart me-2"></i>
                    <span>{{ $breakdownCtaText }}</span>
                    <i class="fas fa-arrow-right ms-2"></i>
                </a>
                @if(!empty($securityNote))
                <div class="mc-bd-light-security-note">
                    <i class="fas fa-lock me-1"></i> {{ $securityNote }}
                </div>
                @endif
            </div>
            @endif
        </div>
    </div>
</section>
@endif
