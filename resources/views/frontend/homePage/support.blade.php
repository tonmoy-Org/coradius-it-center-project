@php
    $mcSettings = [];
    if (isset($course) && !empty($course->masterclass_settings)) {
        $mcSettings = is_string($course->masterclass_settings) ? json_decode($course->masterclass_settings, true) : $course->masterclass_settings;
    } elseif (isset($hero_course) && !empty($hero_course->masterclass_settings)) {
        $mcSettings = is_string($hero_course->masterclass_settings) ? json_decode($hero_course->masterclass_settings, true) : $hero_course->masterclass_settings;
    }
    if (!is_array($mcSettings)) $mcSettings = [];

    $supportStatus = !isset($mcSettings['support_status']) || !empty($mcSettings['support_status']);

    if ($supportStatus) {
        $supportTitle = !empty($mcSettings['support_title']) ? $mcSettings['support_title'] : '';
        $supportTitleIcon = !empty($mcSettings['support_title_icon']) ? $mcSettings['support_title_icon'] : 'fas fa-headset';
        if (preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $supportTitleIcon) || str_starts_with($supportTitleIcon, 'http') || str_contains($supportTitleIcon, 'images/') || str_contains($supportTitleIcon, 'uploads/')) {
            $supportTitleIcon = 'fas fa-headset';
        }
        $supportSubtitle = !empty($mcSettings['support_subtitle']) ? $mcSettings['support_subtitle'] : '';
        $supportDescription = !empty($mcSettings['support_description']) ? $mcSettings['support_description'] : '';

        $supportImageUrl = !empty($mcSettings['support_image_url']) 
            ? dynamic_asset($mcSettings['support_image_url']) 
            : '';

        // Feature Cards (Dynamic List)
        $featureCards = [];
        if (!empty($mcSettings['support_features_list']) && is_array($mcSettings['support_features_list'])) {
            $featureCards = array_values(array_filter($mcSettings['support_features_list'], function($item) {
                return !empty($item['title']) || !empty($item['desc']) || !empty($item['icon']) || !empty($item['media_id']);
            }));
        } else {
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($mcSettings["support_feature_{$i}_title"]) || !empty($mcSettings["support_feature_{$i}_desc"])) {
                    $featureCards[] = [
                        'title' => $mcSettings["support_feature_{$i}_title"] ?? '',
                        'icon'  => $mcSettings["support_feature_{$i}_icon"] ?? 'fas fa-check-circle',
                        'media_id' => $mcSettings["support_feature_{$i}_media_id"] ?? '',
                        'desc'  => $mcSettings["support_feature_{$i}_desc"] ?? '',
                    ];
                }
            }
        }

        // Divider
        $supportDividerText = !empty($mcSettings['support_divider_text']) ? $mcSettings['support_divider_text'] : __('সাপোর্ট নিতে যোগাযোগ করুন');

        // Channels List (Dynamic)
        $channelCards = [];
        if (!empty($mcSettings['support_channels_list']) && is_array($mcSettings['support_channels_list'])) {
            $channelCards = array_values(array_filter($mcSettings['support_channels_list'], function($ch) {
                return !empty($ch['title']) || !empty($ch['desc']) || !empty($ch['url']) || !empty($ch['icon']) || !empty($ch['media_id']);
            }));
        } else {
            for ($i = 1; $i <= 3; $i++) {
                if (!empty($mcSettings["support_channel_{$i}_title"]) || !empty($mcSettings["support_channel_{$i}_url"])) {
                    $channelCards[] = [
                        'title' => $mcSettings["support_channel_{$i}_title"] ?? '',
                        'desc' => $mcSettings["support_channel_{$i}_desc"] ?? '',
                        'icon' => $mcSettings["support_channel_{$i}_icon"] ?? 'fas fa-comments',
                        'media_id' => $mcSettings["support_channel_{$i}_media_id"] ?? '',
                        'team_avatar' => $mcSettings["support_channel_{$i}_team_avatar"] ?? '',
                        'team_label' => $mcSettings["support_channel_{$i}_team_label"] ?? '',
                        'btn_text' => $mcSettings["support_channel_{$i}_btn_text"] ?? '',
                        'url' => $mcSettings["support_channel_{$i}_url"] ?? '#',
                        'is_highlighted' => !empty($mcSettings["support_channel_{$i}_is_highlighted"]) ? 1 : 0
                    ];
                }
            }
        }


        $renderIcon = function($icon, $defaultClass = '', $mediaId = '') {
            if (!empty($mediaId)) {
                $media = \App\Models\MediaLibrary::find($mediaId);
                if ($media && !empty($media->image_variants)) {
                    $imgUrl = getFileLink('original_image', $media->image_variants);
                    return '<img src="' . dynamic_asset($imgUrl) . '" alt="icon" style="max-width: 100%; max-height: 100%; object-fit: contain; display: inline-block; vertical-align: middle;">';
                }
            }
            $icon = trim($icon ?: $defaultClass);
            if (is_numeric($icon)) {
                $media = \App\Models\MediaLibrary::find($icon);
                if ($media && !empty($media->image_variants)) {
                    $imgUrl = getFileLink('original_image', $media->image_variants);
                    return '<img src="' . dynamic_asset($imgUrl) . '" alt="icon" style="max-width: 100%; max-height: 100%; object-fit: contain; display: inline-block; vertical-align: middle;">';
                }
            }
            if (preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $icon) || str_starts_with($icon, 'http') || str_starts_with($icon, '/') || str_contains($icon, 'uploads/') || str_contains($icon, 'images/')) {
                return '<img src="' . dynamic_asset($icon) . '" alt="icon" style="max-width: 100%; max-height: 100%; object-fit: contain; display: inline-block; vertical-align: middle;">';
            }
            return '<i class="' . e($icon) . '"></i>';
        };
    }
@endphp

@if(isset($supportStatus) && $supportStatus)
<style>
    /* Support Section Styles - Standard typography & previous image size */
    .mc-support-section-wrapper {
        background-color: var(--color-blue-tint, #EAF2FE);
        background-image: linear-gradient(rgba(0, 86, 210, 0.04) 1px, transparent 1px), linear-gradient(90deg, rgba(0, 86, 210, 0.04) 1px, transparent 1px);
        background-size: 20px 20px;
        border-top: 1px solid var(--color-border-tint, #C7DCFA);
        border-bottom: 1px solid var(--color-border-tint, #C7DCFA);
        padding-top: 50px;
        padding-bottom: 50px;
        margin-top: 0 !important;
        width: 100%;
        position: relative;
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif);
    }

    /* Heading - Balanced primary font size matching other sections */
    .mc-support-title {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 32px !important;
        font-weight: 700 !important;
        color: var(--color-text-ink, #0A1E3F) !important;
        line-height: 1.3 !important;
        margin-bottom: 12px !important;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        flex-wrap: wrap;
        gap: 8px;
    }

    .mc-support-title-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        color: #00A66C;
        font-size: 26px;
        line-height: 1;
        max-width: 36px;
        max-height: 36px;
        flex-shrink: 0;
        vertical-align: middle;
    }

    .mc-support-title-icon img {
        width: 30px !important;
        height: 30px !important;
        max-width: 32px !important;
        max-height: 32px !important;
        object-fit: contain !important;
        display: inline-block !important;
        vertical-align: middle !important;
    }

    /* Subtitle / Semi-heading */
    .mc-support-subtitle {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 17px !important;
        font-weight: 700 !important;
        color: var(--color-primary, #0056D2) !important;
        margin-bottom: 12px !important;
        line-height: 1.5 !important;
        text-align: center;
    }

    /* Description */
    .mc-support-description,
    .mc-support-description p {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 15.5px !important;
        line-height: 1.8 !important;
        color: var(--color-text-secondary, #4B5A72) !important;
        margin-bottom: 22px !important;
        text-align: center;
    }

    .mc-support-description {
        max-width: 820px;
        margin-left: auto;
        margin-right: auto;
    }

    /* Dynamic Feature Cards */
    .mc-support-feature-cards {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 14px;
        margin: 10px auto 25px auto;
        max-width: 820px;
        width: 100%;
    }

    .mc-support-feature-card {
        background: var(--color-white, #ffffff);
        border: 1px solid var(--color-border-tint, #D9E8FC);
        border-radius: 14px;
        padding: 18px 12px 16px 12px;
        text-align: center;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        align-items: center;
    }

    .mc-support-feature-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 10px 22px rgba(0, 86, 210, 0.08);
        border-color: var(--color-border-hover, #C7DCFA);
    }

    .mc-feature-icon-circle {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        background-color: var(--color-blue-tint, #EAF2FE);
        color: var(--color-primary, #0056D2);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 16px;
        margin-bottom: 10px;
        padding: 6px;
    }

    .mc-feature-icon-circle img {
        width: 24px;
        height: 24px;
        object-fit: contain;
    }

    .mc-feature-title {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 14.5px !important;
        font-weight: 700 !important;
        color: var(--color-text-ink, #0A1E3F) !important;
        margin-bottom: 6px !important;
    }

    .mc-feature-desc {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 12px !important;
        line-height: 1.5 !important;
        color: #64748b !important;
        margin: 0 !important;
    }

    /* Showcase Full Width Image */
    .mc-support-img-wrapper {
        width: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 15px 0 25px 0;
        text-align: center;
    }

    .mc-support-img {
        max-height: 480px;
        max-width: 100%;
        width: auto;
        display: inline-block;
        object-fit: contain;
        margin: 0 auto;
        transition: transform 0.3s ease;
    }

    /* Section Divider */
    .mc-support-divider-section {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 40px 0 30px 0;
        position: relative;
    }

    .mc-support-divider-line {
        flex: 1;
        height: 1px;
        background: #cbd5e1;
    }

    .mc-support-divider-text {
        padding: 0 18px;
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 16px;
        font-weight: 700;
        color: #1a1b4b;
        display: flex;
        align-items: center;
        gap: 8px;
        background: transparent;
    }

    .mc-divider-bullet {
        color: #0056D2;
        font-size: 15px;
    }

    /* Dynamic Channel Support Cards Grid */
    .mc-channel-cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 18px;
    }

    .mc-avatar-default {
        background: var(--color-blue-tint, #EAF2FE);
        color: var(--color-primary, #0056D2);
    }

    .mc-channel-card {
        background: #ffffff;
        border: 1px solid #D9E8FC;
        border-radius: 14px;
        padding: 24px 20px 22px 20px;
        min-height: 205px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        transition: all 0.25s ease;
    }

    .mc-channel-card:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 22px rgba(0, 86, 210, 0.08);
        border-color: #C7DCFA;
    }

    .mc-channel-card.highlighted-channel {
        border-color: #3B8AF2;
        box-shadow: 0 4px 18px rgba(0, 86, 210, 0.08);
    }

    .mc-channel-card-top {
        display: flex;
        align-items: center;
        gap: 12px;
        margin-bottom: 14px;
    }

    .mc-channel-avatar-circle {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 20px;
        color: #ffffff;
        flex-shrink: 0;
    }

    .mc-channel-avatar-circle img {
        width: 26px;
        height: 26px;
        object-fit: contain;
    }

    .mc-avatar-fb {
        background-color: #ffffff;
        color: #1877F2;
        border: 1px solid #E2E8F0;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.04);
    }

    .mc-avatar-wa {
        background-color: #25D366;
    }

    .mc-avatar-tg {
        background-color: #0088cc;
    }

    .mc-channel-info-title {
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 16px !important;
        font-weight: 700 !important;
        color: #0f172a !important;
        margin: 0 0 2px 0 !important;
        line-height: 1.3 !important;
    }

    .mc-channel-info-desc {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 12.5px !important;
        color: #64748b !important;
        margin: 0 !important;
        line-height: 1.4 !important;
    }

    /* Team Avatars Row */
    .mc-channel-team-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
        padding-left: 56px;
    }

    .mc-team-avatars-img {
        height: 20px;
        width: auto;
        object-fit: contain;
    }

    .mc-team-status-label {
        font-family: var(--body-font, "Inter", "Hind Siliguri", sans-serif) !important;
        font-size: 12px;
        color: #475569;
        font-weight: 500;
    }




    /* ==========================================================================
       RESPONSIVE DESIGN BREAKPOINTS
       1. Large / High-Resolution Screens (min-width: 1400px)
       2. Standard Desktop Monitors (1200px - 1399px) [Base styles]
       3. Laptops & Compact Desktops (992px - 1199px)
       4. Tablets (768px - 991px)
       5. Small Tablets & Landscape Mobile (576px - 767px)
       6. Mobile Phones (max-width: 575px)
       7. Extra-Small Mobile Screens (max-width: 380px)
       ========================================================================== */

    /* 1. Large / High-Resolution Screens (1400px+) */
    @media (min-width: 1400px) {
        .mc-support-section-wrapper {
            padding-top: 60px;
            padding-bottom: 60px;
        }

        .mc-support-title {
            font-size: 34px !important;
            margin-bottom: 14px !important;
        }

        .mc-support-title-icon img {
            width: 32px !important;
            height: 32px !important;
        }

        .mc-support-img {
            max-height: 520px;
        }

        .mc-channel-cards-grid {
            gap: 22px;
        }
    }

    /* 2. Laptops & Compact Desktops (992px - 1199px) */
    @media (min-width: 992px) and (max-width: 1199px) {
        .mc-support-section-wrapper {
            padding-top: 45px;
            padding-bottom: 45px;
        }

        .mc-support-title {
            font-size: 28px !important;
            line-height: 1.3 !important;
        }

        .mc-support-title-icon {
            font-size: 24px;
        }

        .mc-support-title-icon img {
            width: 28px !important;
            height: 28px !important;
        }

        .mc-support-subtitle {
            font-size: 15.5px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: 14.5px !important;
            line-height: 1.7 !important;
            margin-bottom: 18px !important;
        }

        .mc-support-feature-cards {
            grid-template-columns: repeat(3, 1fr);
            gap: 8px;
        }

        .mc-support-feature-card {
            padding: 14px 8px 12px 8px;
        }

        .mc-feature-icon-circle {
            width: 36px;
            height: 36px;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .mc-feature-icon-circle img {
            width: 20px;
            height: 20px;
        }

        .mc-feature-title {
            font-size: 13.5px !important;
            margin-bottom: 4px !important;
        }

        .mc-feature-desc {
            font-size: 11px !important;
            line-height: 1.4 !important;
        }

        .mc-support-img {
            max-height: 420px;
        }

        .mc-channel-cards-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .mc-channel-card {
            padding: 20px 14px 18px 14px;
            min-height: 205px;
        }

        .mc-channel-avatar-circle {
            width: 38px;
            height: 38px;
            font-size: 17px;
        }

        .mc-channel-info-title {
            font-size: 15px !important;
        }

        .mc-channel-info-desc {
            font-size: 11.5px !important;
        }

        .mc-channel-team-row {
            padding-left: 50px;
            margin-bottom: 16px;
        }

        .mc-team-avatars-img {
            height: 18px;
        }

        .mc-team-status-label {
            font-size: 11px;
        }


    }

    /* 3. Tablets (768px - 991px) */
    @media (min-width: 768px) and (max-width: 991px) {
        .mc-support-section-wrapper {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        .mc-support-title {
            font-size: 28px !important;
            line-height: 1.35 !important;
        }

        .mc-support-subtitle {
            font-size: 16px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: 15px !important;
            line-height: 1.7 !important;
            margin-bottom: 20px !important;
        }

        .mc-support-feature-cards {
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }

        .mc-support-feature-card {
            padding: 16px 10px 14px 10px;
        }

        .mc-support-img-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center !important;
        }

        .mc-support-img {
            max-height: 380px;
        }

        .mc-support-divider-section {
            margin: 32px 0 24px 0;
        }

        .mc-channel-cards-grid {
            grid-template-columns: repeat(3, 1fr);
            gap: 14px;
        }

        .mc-channel-card {
            padding: 20px 14px 18px 14px;
            min-height: 200px;
        }

        .mc-channel-team-row {
            padding-left: 54px;
            margin-bottom: 16px;
        }

        .mc-channel-info-title {
            font-size: 15px !important;
        }

        .mc-channel-info-desc {
            font-size: 12px !important;
        }



    }

    /* 4. Small Tablets & Landscape Mobile (576px - 767px) */
    @media (min-width: 576px) and (max-width: 767px) {
        .mc-support-section-wrapper {
            padding-top: 35px;
            padding-bottom: 35px;
        }

        .mc-support-title {
            font-size: var(--mobile-font-heading-main, 22px) !important;
            line-height: 1.35 !important;
            margin-bottom: 10px !important;
        }

        .mc-support-title-icon {
            font-size: 22px;
        }

        .mc-support-title-icon img {
            width: 24px !important;
            height: 24px !important;
        }

        .mc-support-subtitle {
            font-size: var(--mobile-font-heading-sub, 17px) !important;
            margin-bottom: 10px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: var(--mobile-font-body, 13.5px) !important;
            line-height: 1.65 !important;
            margin-bottom: 18px !important;
        }

        .mc-support-feature-cards {
            grid-template-columns: repeat(3, 1fr);
            gap: 10px;
        }

        .mc-support-feature-card {
            padding: 14px 8px 12px 8px;
        }

        .mc-feature-title {
            font-size: var(--mobile-font-heading-sub, 17px) !important;
        }

        .mc-feature-desc {
            font-size: var(--mobile-font-body, 13.5px) !important;
        }

        .mc-support-img-wrapper {
            margin-top: 20px;
            display: flex;
            justify-content: center !important;
        }

        .mc-support-img {
            max-height: 300px;
        }

        .mc-support-divider-section {
            margin: 28px 0 20px 0;
        }

        .mc-channel-cards-grid {
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 12px;
        }

        .mc-channel-card {
            padding: 20px 16px 18px 16px;
            min-height: 195px;
        }

        .mc-channel-team-row {
            padding-left: 54px;
            margin-bottom: 16px;
        }

    }

    /* 5. Mobile Phones (max-width: 575px) */
    @media (max-width: 575px) {
        .mc-support-section-wrapper {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .mc-support-title {
            font-size: var(--mobile-font-heading-main, 22px) !important;
            line-height: 1.35 !important;
            margin-bottom: 8px !important;
            gap: 6px;
        }

        .mc-support-title-icon {
            font-size: 20px;
        }

        .mc-support-title-icon img {
            width: 22px !important;
            height: 22px !important;
        }

        .mc-support-subtitle {
            font-size: var(--mobile-font-heading-sub, 17px) !important;
            line-height: 1.5 !important;
            margin-bottom: 8px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: var(--mobile-font-body, 13.5px) !important;
            line-height: 1.65 !important;
            margin-bottom: 16px !important;
        }

        /* Feature Cards on Mobile: Compact vertical centered look, stacked one by one */
        .mc-support-feature-cards {
            grid-template-columns: 1fr;
            gap: 10px;
            margin-top: 10px;
        }

        .mc-support-feature-card {
            flex-direction: column;
            text-align: center;
            align-items: center;
            padding: 14px 14px 12px 14px;
            border-radius: 12px;
        }

        .mc-feature-icon-circle {
            margin-bottom: 8px;
            width: 36px;
            height: 36px;
            font-size: 14px;
            padding: 5px;
        }

        .mc-feature-icon-circle img {
            width: 20px;
            height: 20px;
        }

        .mc-feature-title {
            font-size: var(--mobile-font-heading-sub, 17px) !important;
            margin-bottom: 4px !important;
            text-align: center !important;
        }

        .mc-feature-desc {
            font-size: var(--mobile-font-body, 13.5px) !important;
            line-height: 1.55 !important;
            text-align: center !important;
        }

        .mc-support-img-wrapper {
            margin-top: 18px;
            display: flex;
            justify-content: center !important;
        }

        .mc-support-img {
            max-height: 250px;
        }

        .mc-support-divider-section {
            margin: 24px 0 18px 0;
        }

        .mc-support-divider-text {
            font-size: 13.5px;
            padding: 0 8px;
        }

        .mc-channel-cards-grid {
            grid-template-columns: 1fr;
            gap: 14px;
        }

        .mc-channel-card {
            padding: 18px 16px 16px 16px;
            min-height: auto;
            border-radius: 12px;
        }

        .mc-channel-card-top {
            gap: 10px;
            margin-bottom: 12px;
        }

        .mc-channel-avatar-circle {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .mc-channel-avatar-circle img {
            width: 24px;
            height: 24px;
        }

        .mc-channel-info-title {
            font-size: var(--mobile-font-heading-sub, 17px) !important;
            margin-bottom: 2px !important;
        }

        .mc-channel-info-desc {
            font-size: var(--mobile-font-body, 13.5px) !important;
            line-height: 1.45 !important;
        }

        .mc-channel-team-row {
            padding-left: 50px;
            margin-bottom: 16px;
            gap: 6px;
        }

        .mc-team-avatars-img {
            height: 18px;
        }

        .mc-team-status-label {
            font-size: 11.5px;
        }

    }

    /* 6. Extra-Small Mobile Screens (max-width: 380px) */
    @media (max-width: 380px) {
        .mc-support-title {
            font-size: 20px !important;
        }

        .mc-support-title-icon img {
            width: 20px !important;
            height: 20px !important;
        }

        .mc-support-subtitle {
            font-size: 13.5px !important;
        }

        .mc-support-description,
        .mc-support-description p {
            font-size: 13px !important;
        }

        .mc-support-feature-cards {
            gap: 8px;
        }

        .mc-support-feature-card {
            padding: 12px 10px 10px 10px;
            border-radius: 10px;
        }

        .mc-feature-icon-circle {
            width: 32px;
            height: 32px;
            font-size: 13px;
            margin-bottom: 6px;
        }

        .mc-feature-icon-circle img {
            width: 18px;
            height: 18px;
        }

        .mc-feature-title {
            font-size: 13px !important;
            margin-bottom: 3px !important;
        }

        .mc-feature-desc {
            font-size: 11px !important;
            line-height: 1.4 !important;
        }

        .mc-support-img {
            max-height: 200px;
        }

        .mc-channel-card {
            padding: 16px 12px 14px 12px;
        }

        .mc-channel-team-row {
            padding-left: 0;
            margin-top: 6px;
            margin-bottom: 14px;
        }



    }
</style>

<section class="mc-support-section-wrapper">
    <div class="container container-1278">
        <!-- Top Tier: Centered Header, Subtitle, Description & Feature Cards -->
        <div class="row justify-content-center text-center">
            <div class="col-lg-10 col-xl-9">
                @if(!empty($supportTitle))
                <!-- Main Title with Headset Icon -->
                <h2 class="mc-support-title" data-aos="fade-up">
                    <span>{!! format_title_highlight($supportTitle) !!}</span>
                    <span class="mc-support-title-icon"><i class="{{ (!empty($supportTitleIcon) && !str_starts_with($supportTitleIcon, 'http') && !preg_match('/\.(png|jpg|jpeg|svg|webp)$/i', $supportTitleIcon)) ? $supportTitleIcon : 'fas fa-headset' }}"></i></span>
                </h2>
                @endif

                @if(!empty($supportSubtitle))
                <!-- Subtitle -->
                <p class="mc-support-subtitle" data-aos="fade-up" data-aos-delay="50">
                    {{ $supportSubtitle }}
                </p>
                @endif

                @if(!empty($supportDescription))
                <!-- Description -->
                <div class="mc-support-description" data-aos="fade-up" data-aos-delay="100">
                    {!! $supportDescription !!}
                </div>
                @endif

                @if(!empty($featureCards) && count($featureCards) > 0)
                    <!-- Dynamic Feature Cards -->
                    <div class="mc-support-feature-cards" data-aos="fade-up" data-aos-delay="150">
                        @foreach($featureCards as $fCard)
                            @php
                                $fcTitle = $fCard['title'] ?? '';
                                $fcIcon = $fCard['icon'] ?? 'fas fa-check-circle';
                                $fcMediaId = $fCard['media_id'] ?? '';
                                $fcDesc = $fCard['desc'] ?? '';
                            @endphp
                            <div class="mc-support-feature-card">
                                <div class="mc-feature-icon-circle">
                                    {!! $renderIcon($fcIcon, 'fas fa-check-circle', $fcMediaId) !!}
                                </div>
                                @if(!empty($fcTitle))
                                    <h4 class="mc-feature-title">{{ $fcTitle }}</h4>
                                @endif
                                @if(!empty($fcDesc))
                                    <p class="mc-feature-desc">{{ $fcDesc }}</p>
                                @endif
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if(!empty($supportImageUrl))
        <!-- Middle Tier: Full Width Showcase Image -->
        <div class="row justify-content-center">
            <div class="col-12 text-center mc-support-img-wrapper" data-aos="zoom-in" data-aos-delay="180">
                <img src="{{ $supportImageUrl }}" alt="{{ $supportTitle ?: 'Support' }}" class="mc-support-img img-fluid">
            </div>
        </div>
        @endif

        @if(!empty($supportDividerText))
        <!-- Middle Section: Divider with Title -->
        <div class="mc-support-divider-section" data-aos="fade-up">
            <span class="mc-support-divider-line"></span>
            <div class="mc-support-divider-text">
                <span class="mc-divider-bullet">•</span>
                <span>{{ $supportDividerText }}</span>
                <span class="mc-divider-bullet">•</span>
            </div>
            <span class="mc-support-divider-line"></span>
        </div>
        @endif

        @if(!empty($channelCards) && count($channelCards) > 0)
            <!-- Bottom Row: Dynamic Support Channel Cards -->
            <div class="mc-channel-cards-grid" data-aos="fade-up" data-aos-delay="100">
                @foreach($channelCards as $chCard)
                    @php
                        $cTitle = $chCard['title'] ?? '';
                        $cDesc = $chCard['desc'] ?? '';
                        $cIcon = $chCard['icon'] ?? 'fas fa-comments';
                        $cAvatar = !empty($chCard['team_avatar']) ? dynamic_asset($chCard['team_avatar']) : '';
                        $cLabel = $chCard['team_label'] ?? '';
                        $cBtnText = $chCard['btn_text'] ?? __('Contact Us');
                        $cUrl = $chCard['url'] ?? '#';
                        $isHigh = !empty($chCard['is_highlighted']);

                        $lower = strtolower($cTitle . ' ' . $cIcon . ' ' . $cUrl);
                        $avatarClass = 'mc-avatar-default';
                        if (str_contains($lower, 'face') || str_contains($lower, 'fb')) {
                            $avatarClass = 'mc-avatar-fb';
                        } elseif (str_contains($lower, 'whats') || str_contains($lower, 'wa.me')) {
                            $avatarClass = 'mc-avatar-wa';
                        } elseif (str_contains($lower, 'tele') || str_contains($lower, 't.me')) {
                            $avatarClass = 'mc-avatar-tg';
                        }
                    @endphp
                    <div class="mc-channel-card {{ $isHigh ? 'highlighted-channel' : '' }}">
                        <div>
                            <div class="mc-channel-card-top">
                                <div class="mc-channel-avatar-circle {{ $avatarClass }}">
                                    {!! $renderIcon($cIcon, 'fas fa-comments', $chCard['media_id'] ?? '') !!}
                                </div>
                                <div>
                                    @if(!empty($cTitle))
                                    <h4 class="mc-channel-info-title">{{ $cTitle }}</h4>
                                    @endif
                                    @if(!empty($cDesc))
                                    <p class="mc-channel-info-desc">{{ $cDesc }}</p>
                                    @endif
                                </div>
                            </div>
                            @if(!empty($cAvatar) || !empty($cLabel))
                            <div class="mc-channel-team-row">
                                @if(!empty($cAvatar))
                                <img src="{{ $cAvatar }}" alt="{{ $cLabel }}" class="mc-team-avatars-img">
                                @endif
                                @if(!empty($cLabel))
                                <span class="mc-team-status-label">{{ $cLabel }}</span>
                                @endif
                            </div>
                            @endif
                        </div>
                        @if(!empty($cBtnText))
                        <a href="{{ $cUrl }}" target="_blank" rel="noopener noreferrer" class="template-btn w-100">
                            <span>{{ $cBtnText }}</span>
                            <i class="fas fa-arrow-right ms-2"></i>
                        </a>
                        @endif
                    </div>
                @endforeach
            </div>
        @endif

    </div>
</section>
@endif
