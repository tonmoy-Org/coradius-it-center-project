@php
    if (!isset($meta) || !is_array($meta)) {
        $meta = [
            'meta_title'          => setting('meta_title'),
            'meta_description'    => setting('meta_description'),
            'meta_keywords'       => setting('meta_keywords'),
            'meta_published_time' => now(),
            'meta_url'            => url()->current(),
            'meta_section'        => 'Home',
            'image_size'          => '1200',
            'meta_image'          => getFileLink('1200x630', setting('og_image')),
        ];
    }
@endphp
<!DOCTYPE html>
<html lang="{{ systemLanguage() ? systemLanguage()->locale : 'en' }}"
      dir="{{ systemLanguage() ? systemLanguage()->text_direction : 'ltr' }}">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="paginate" content="{{ setting('paginate') }}"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') | {{ setting('system_name') != '' ? setting('system_name') : 'Coradius IT Center' }}</title>

    <!-- SEO -->
    <meta name="title" content="{{ $meta['meta_title'] }}"/>
    <meta name="description" content="{{ $meta['meta_description'] }}"/>
    <meta name="keywords" content="{{ $meta['meta_keywords'] }}"/>
    <meta property="article:published_time" content="{{ $meta['meta_published_time'] }}"/>
    <meta property="article:section" content="{{ $meta['meta_section'] }}"/>
    <!-- END SEO -->

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $meta['meta_title'] }}"/>
    <meta property="og:description" content="{{ $meta['meta_description'] }}"/>
    <meta property="og:url" content="{{ $meta['meta_url'] }}"/>
    <meta property="og:type" content="{{ $meta['meta_section'] }}"/>
    <meta property="og:locale" content="{{ app()->getLocale() }}"/>
    <meta property="og:site_name" content="{{ setting('system_name') }}"/>
    <meta property="og:image" content="{{ $meta['meta_image'] }}"/>
    <meta property="og:image:size" content="{{ $meta['image_size'] }}"/>
    <!-- END Open Graph -->

    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary"/>
    <meta name="twitter:title" content="{{ $meta['meta_title'] }}"/>
    <meta name="twitter:site" content="{{ $meta['meta_url'] }}"/>

    @php
        $icon = setting('favicon');
    @endphp

    @if ($icon)
        <link rel="apple-touch-icon" sizes="57x57"
              href="{{ $icon != [] && @is_file_exists($icon['image_57x57_url']) ? static_asset($icon['image_57x57_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="apple-touch-icon" sizes="60x60"
              href="{{ $icon != [] && @is_file_exists($icon['image_60x60_url']) ? static_asset($icon['image_60x60_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="apple-touch-icon" sizes="72x72"
              href="{{ $icon != [] && @is_file_exists($icon['image_72x72_url']) ? static_asset($icon['image_72x72_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="apple-touch-icon" sizes="76x76"
              href="{{ $icon != [] && @is_file_exists($icon['image_76x76_url']) ? static_asset($icon['image_76x76_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="apple-touch-icon" sizes="114x114"
              href="{{ $icon != [] && @is_file_exists($icon['image_114x114_url']) ? static_asset($icon['image_114x114_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="apple-touch-icon" sizes="120x120"
              href="{{ $icon != [] && @is_file_exists($icon['image_120x120_url']) ? static_asset($icon['image_120x120_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="apple-touch-icon" sizes="144x144"
              href="{{ $icon != [] && @is_file_exists($icon['image_144x144_url']) ? static_asset($icon['image_144x144_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="apple-touch-icon" sizes="152x152"
              href="{{ $icon != [] && @is_file_exists($icon['image_152x152_url']) ? static_asset($icon['image_152x152_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="apple-touch-icon" sizes="180x180"
              href="{{ $icon != [] && @is_file_exists($icon['image_180x180_url']) ? static_asset($icon['image_180x180_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="icon" type="image/png" sizes="192x192"
              href="{{ $icon != [] && @is_file_exists($icon['image_192x192_url']) ? static_asset($icon['image_192x192_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="icon" type="image/png" sizes="32x32"
              href="{{ $icon != [] && @is_file_exists($icon['image_32x32_url']) ? static_asset($icon['image_32x32_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="icon" type="image/png" sizes="96x96"
              href="{{ $icon != [] && @is_file_exists($icon['image_96x96_url']) ? static_asset($icon['image_96x96_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="icon" type="image/png" sizes="16x16"
              href="{{ $icon != [] && @is_file_exists($icon['image_16x16_url']) ? static_asset($icon['image_16x16_url']) : static_asset('images/default/favicon/faviocns.png') }}">
        <link rel="manifest" href="{{ static_asset('images/default/favicon/manifest.json') }}">

        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage"
              content="{{ $icon != [] && @is_file_exists($icon['image_144x144_url']) ? static_asset($icon['image_144x144_url']) : static_asset('images/default/favicon/faviocns.png') }}">
    @else
        <link rel="shortcut icon" href="{{ static_asset('images/default/favicon/faviocns.png') }}">
    @endif
    <!--====== Performance Preconnect & Preload ======-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!--====== Critical Bootstrap & Core CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('frontend/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/style.css') }}?v={{ setting('current_version') }}">

    <!--====== Async Non-Critical CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('frontend/css/slick.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/magnific-popup.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/select2.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/nice-select.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/plyr.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ static_asset('frontend/fonts/fontawesome/css/all.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ static_asset('frontend/fonts/boxicons/css/boxicons.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/spacing.min.css') }}" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ static_asset('frontend/css/aos.css') }}" media="print" onload="this.media='all'">

    <style>
        :root {
            --body-font: '{{ setting("body_font") }}', sans-serif;
            --header-font: '{{ setting("header_font") }}', sans-serif;

            /* Coradius IT Center Brand Palette (Extracted from Logo) */
            --color-primary: #0056D2;
            --color-primary-hover: #FF7A00;
            --color-secondary: #3B8AF2;
            --color-accent-orange: #FF7A00;
            --color-accent-gold: #FFB800;
            --color-navy: #001F5C;
            --color-footer-bg: #111120;
            --color-hero-bg-start: #001F5C;
            --color-hero-bg-end: #0B1226;
            --color-blue-tint: #EAF2FE;
            --theme-blue-tint: #EAF2FE;
            --color-border-tint: #D9E8FC;
            --color-border-hover: #C7DCFA;
            --color-text-ink: #0A1E3F;
            --color-text-secondary: #4B5A72;
            --color-text-muted: #8A96A8;
            --color-white: #FFFFFF;

            /* Mobile Typography System (Harmonized Scale) */
            --mobile-font-heading-main: 22px;
            --mobile-font-heading-sub: 17px;
            --mobile-font-badge: 13px;
            --mobile-font-body: 13.5px;
        }

        .form-control:focus, .nice-select:focus, input:focus, textarea:focus, select:focus {
            border-color: var(--color-primary) !important;
            box-shadow: 0 0 0 3px rgba(0, 86, 210, 0.15) !important;
        }
        
        .template-btn, .template-btn.bordered-btn, .template-btn.bordered-btn-secondary,
        .btn {
            border-radius: 8px !important;
        }

        /* Universal Performance & Aspect Ratio Fixes (CLS Prevention) */
        img {
            max-width: 100%;
            height: auto;
        }
        .hero-video-wrapper, .video-container, .yt_player, .course-intro-video {
            aspect-ratio: 16 / 9 !important;
            width: 100% !important;
        }
        .card, .course-item, .blog-post-item, .category-item, .testimonial-item,
        .course-item-thumb, .course-item-thumb img, .blog-post-thumb img,
        .video-container, .video-banner-card, .video-banner-card img,
        .faq-accordion .accordion-item, .support-card, .success-video-card,
        .about-card, .feature-card, .benefit-card, .special-gift-card,
        .ad-banner-section-1 img, .what-you-learn-card,
        .rounded, .rounded-1, .rounded-2, .rounded-3, .rounded-lg,
        .form-control, .nice-select, input, textarea, select {
            border-radius: 8px !important;
        }
        .plyr__control--overlaid {
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -50%) scale(1.15) !important;
            background: var(--color-primary) !important;
            border-radius: 50% !important;
        }
        @media (max-width: 767.98px) {
            .plyr__control--overlaid {
                top: 50% !important;
                left: 50% !important;
                transform: translate(-50%, -50%) scale(0.9) !important;
                padding: 12px !important;
            }
        }
        .recent-video-slider .template-btn {
            margin-top: 30px;
        }
        .recent-videos-section .plyr, .recent-videos-section video, .recent-videos-section iframe {
            width: 100% !important;
            max-width: 100% !important;
            min-width: 100% !important;
            height: auto;
        }
        /* Ultra Hand-Drawn Marker Pen Highlighter Style */
        mark.title-highlight, .title-highlight, h1 mark, h2 mark, h3 mark, h4 mark, .course-section-title mark {
            background: transparent !important;
            color: inherit;
            position: relative;
            display: inline-block;
            padding: 0 8px;
            margin: 0 2px;
            font-weight: 700;
            z-index: 1;
            border: none !important;
            box-shadow: none !important;
        }

        mark.title-highlight::before, .title-highlight::before, h1 mark::before, h2 mark::before, h3 mark::before, h4 mark::before, .course-section-title mark::before {
            content: "";
            position: absolute;
            left: -6px;
            right: -6px;
            top: 12%;
            bottom: 2%;
            background: linear-gradient(98deg, #D9E8FC 0%, #B4D3FE 40%, #FFD6B3 85%, #D9E8FC 100%);
            opacity: 0.95;
            z-index: -1;
            clip-path: polygon(
                0% 14%, 2% 6%, 8% 10%, 18% 4%, 32% 9%, 48% 3%, 64% 8%, 79% 2%, 92% 7%, 100% 12%,
                99% 88%, 95% 96%, 82% 91%, 66% 97%, 51% 92%, 35% 98%, 19% 93%, 6% 97%, 0% 86%
            );
            transform: rotate(-0.8deg) scaleY(1.04);
            transition: all 0.3s ease;
        }

        mark.title-highlight::after, .title-highlight::after, h1 mark::after, h2 mark::after, h3 mark::after, h4 mark::after, .course-section-title mark::after {
            content: "";
            position: absolute;
            left: -4px;
            right: -4px;
            top: 20%;
            bottom: 6%;
            background: rgba(0, 86, 210, 0.15);
            z-index: -2;
            clip-path: polygon(
                1% 8%, 15% 12%, 30% 6%, 50% 11%, 70% 5%, 88% 10%, 98% 5%,
                99% 92%, 84% 96%, 65% 90%, 45% 95%, 25% 89%, 5% 94%, 0% 85%
            );
            transform: rotate(0.4deg);
        }

        /* Universal Support-Style Elegant Global Button Design across ALL sections */
        .template-btn, 
        a.template-btn, 
        button.template-btn,
        .get-access-btn,
        .footer-btn-cta,
        .about-me-btn,
        .hero-btn,
        .hero-btns .template-btn,
        .sp-right .btn-enroll {
            font-family: var(--body-font, "Hind Siliguri", "Inter", sans-serif) !important;
            font-size: 15px !important;
            font-weight: 700 !important;
            padding: 12px 24px !important;
            border-radius: 8px !important;
            background: #0056D2 !important;
            background-color: #0056D2 !important;
            color: #ffffff !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            gap: 8px !important;
            box-shadow: 0 4px 14px rgba(0, 86, 210, 0.25) !important;
            border: none !important;
            outline: none !important;
            text-decoration: none !important;
            line-height: 1.4 !important;
            position: relative !important;
            overflow: hidden !important;
            transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1) !important;
            cursor: pointer !important;
        }

        .template-btn:hover,
        a.template-btn:hover,
        button.template-btn:hover,
        .get-access-btn:hover,
        .footer-btn-cta:hover,
        .about-me-btn:hover,
        .hero-btn:hover,
        .hero-btns .template-btn:hover,
        .sp-right .btn-enroll:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 8px 22px rgba(255, 122, 0, 0.45) !important;
            background: #FF7A00 !important;
            background-color: #FF7A00 !important;
            color: #ffffff !important;
        }

        /* Secondary & Outline Buttons */
        .template-btn.bordered-btn,
        .template-btn.bordered-btn-secondary,
        .btn-outline-primary {
            background: transparent !important;
            border: 2px solid #0056D2 !important;
            color: #0056D2 !important;
            box-shadow: none !important;
            border-radius: 8px !important;
        }
        .template-btn.bordered-btn:hover,
        .template-btn.bordered-btn-secondary:hover,
        .btn-outline-primary:hover {
            background: #FF7A00 !important;
            border-color: #FF7A00 !important;
            color: #ffffff !important;
            box-shadow: 0 8px 22px rgba(255, 122, 0, 0.45) !important;
        }

        .back-to-top {
            background-color: #0056D2 !important;
            color: #ffffff !important;
            border-radius: 50% !important;
            box-shadow: 0 4px 14px rgba(0, 86, 210, 0.25) !important;
            transition: all 0.3s ease !important;
        }
        .back-to-top:hover {
            background-color: #FF7A00 !important;
            box-shadow: 0 8px 22px rgba(255, 122, 0, 0.45) !important;
            color: #ffffff !important;
            transform: translateY(-3px) !important;
        }

        .template-btn::before,
        a.template-btn::before,
        button.template-btn::before,
        .get-access-btn::before,
        .footer-btn-cta::before,
        .about-me-btn::before,
        .hero-btn::before,
        .hero-btns .template-btn::before {
            content: '' !important;
            position: absolute !important;
            top: 0 !important;
            left: -100% !important;
            width: 100% !important;
            height: 100% !important;
            background: linear-gradient(120deg, transparent, rgba(255, 255, 255, 0.35), transparent) !important;
            transition: all 0.6s ease !important;
            pointer-events: none !important;
        }

        .template-btn:hover::before,
        a.template-btn:hover::before,
        button.template-btn:hover::before,
        .get-access-btn:hover::before,
        .footer-btn-cta:hover::before,
        .about-me-btn:hover::before,
        .hero-btn:hover::before,
        .hero-btns .template-btn:hover::before {
            left: 100% !important;
        }

        .template-btn i,
        a.template-btn i,
        button.template-btn i,
        .get-access-btn i,
        .footer-btn-cta i,
        .about-me-btn i,
        .hero-btn i,
        .hero-btns .template-btn i {
            font-size: 14px !important;
            margin-left: 6px !important;
            transition: transform 0.3s ease !important;
        }

        .template-btn:hover i,
        a.template-btn:hover i,
        button.template-btn:hover i,
        .get-access-btn:hover i,
        .footer-btn-cta:hover i,
        .about-me-btn:hover i,
        .hero-btn:hover i,
        .hero-btns .template-btn:hover i {
            transform: translateX(4px) !important;
        }

        .ad-banner-section-1 img, 
        .ad-banner-section-2 img {
            max-height: none !important;
            height: auto !important;
            object-fit: contain !important;
        }

        @media (max-width: 767.98px) {
            .template-btn, 
            a.template-btn, 
            button.template-btn,
            .get-access-btn,
            .footer-btn-cta,
            .about-me-btn,
            .sp-right .btn-enroll {
                padding: 8px 18px !important;
                font-size: 13.5px !important;
                font-weight: 600 !important;
                min-height: 38px !important;
                border-radius: 8px !important;
            }
        }

        @media (max-width: 575.98px) {
            .template-btn, 
            a.template-btn, 
            button.template-btn,
            .get-access-btn,
            .footer-btn-cta,
            .about-me-btn,
            .sp-right .btn-enroll {
                padding: 7px 16px !important;
                font-size: 13px !important;
                font-weight: 600 !important;
                min-height: 36px !important;
                border-radius: 8px !important;
            }
        }

        /* Ensure hidden loading buttons stay hidden when d-none is present */
        .template-btn.d-none,
        a.template-btn.d-none,
        button.template-btn.d-none,
        .loading_button.d-none {
            display: none !important;
        }
    </style>
    <!--====== Responsive CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('frontend/css/responsive.css') }}">
    {{-- <link rel="stylesheet" href="{{ static_asset('frontend/css/responsive.min.css') }}"> --}}
    <!--====== Color CSS ======-->
    <link rel="stylesheet" href="{{ static_asset('frontend/css/toastr.min.css') }}">
    @php
        $theme_color = setting('theme_color') ?: 'coradius';
    @endphp
    @if ($theme_color)
        <link rel="stylesheet" href="{{ static_asset('frontend/css/theme/' . $theme_color . '.css') }}">
    @endif
    @stack('css')
    <style>
        @if (base64_decode(setting('custom_css')))
            {{ base64_decode(setting('custom_css')) }}
        @endif
    </style>

    @if (setting('is_google_analytics_activated') && setting('tracking_code'))
        {!! base64_decode(setting('tracking_code')) !!}
    @endif
    @if (setting('custom_header_script'))
        {!! base64_decode(setting('custom_header_script')) !!}
    @endif
    @if (setting('is_facebook_pixel_activated') && setting('facebook_pixel_id'))
        {!! base64_decode(setting('facebook_pixel_id')) !!}
    @endif

    <!--====== Google Fonts ======-->

    {!! font_link() !!}



    @if (setting('disable_preloader') != '1')
        <script type="text/javascript">
            (function() {
                function hidePreloader() {
                    const preloader = document.querySelector(".preloader");
                    if (preloader && !preloader.classList.contains("preloader-finish")) {
                        preloader.classList.add("preloader-finish");
                    }
                }
                document.addEventListener("DOMContentLoaded", hidePreloader);
                window.addEventListener("load", hidePreloader);
                setTimeout(hidePreloader, 1200);
            })();
        </script>
    @endif
</head>
<body>
@if (setting('disable_preloader') != '1')
    <div class="preloader">
        <div class="loading">
            <img
                src="{{ setting('preloader_logo') && @is_file_exists(setting('preloader_logo')['original_image']) ? get_media(setting('preloader_logo')['original_image']) : get_media('images/default/logo/logo.png') }}"
                alt="{{ setting('system_title') }}">
        </div>
    </div>
@endif
@yield('base.content')
@if (setting('is_facebook_messenger_activated') == 1)
    <div class="fb-customerchat" attribution=setup_tool page_id="{{ (int) setting('facebook_page_id') }}"
         theme_color="{{ setting('facebook_messenger_color') }}">
    </div>
@endif
<!--====== jQuery & Core JS (Deferred for PageSpeed) ======-->
<script src="{{ static_asset('frontend/js/jquery-3.6.0.min.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/popper.min.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/bootstrap.min.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/slick.min.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/jquery.magnific-popup.min.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/plyr.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/jquery.nice-select.min.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/select2.min.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/aos.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/cookiealert.js') }}" defer></script>
<script src="{{ static_asset('frontend/js/main.js') }}?v={{ setting('current_version') }}" defer></script>
<script src="{{ static_asset('frontend/js/app.js') }}?v={{ setting('current_version') }}" defer></script>
@if (auth()->check() && auth()->user()->role_id > 1)
    <script src="{{ static_asset('admin/js/OneSignalSDK.js') }}" defer></script>
@endif
<script src="{{ static_asset('frontend/js/toastr.min.js') }}" defer></script>

{!! Toastr::message() !!}
<script src="{{ static_asset('admin/js/sweetalert211.min.js') }}"></script>
@if (setting('is_pusher_notification_active') && auth()->check())
    <script src="{{ static_asset('admin/js/pusher.min.js') }}"></script>
    <script>
        const pusher = new Pusher('{{ setting('pusher_app_key') ?: config('broadcasting.connections.pusher.key') }}', {
            cluster: '{{ setting('pusher_app_cluster') ?: config('broadcasting.connections.pusher.options.cluster') }}',
            encrypted: true
        });

        const channel = pusher.subscribe('notification-send-{{ auth()->id() }}');
        channel.bind('App\\Events\\PusherNotification', (data) => {
            toastr[data.message_type](data.message);
        });
    </script>
@endif
@stack('js')
<script>
    $(document).ready(function () {
        $(document).on('click', '.list-groups a', function (e) {
            let name = $(this).data('name');
            let value = $(this).data('value');
            $(this).closest('.list-groups').find('li').removeClass('active');
            $(this).closest('li').addClass('active');
            $(this).closest('form').find('input[name="' + name + '"]').val(value);
        });
    });
    //facebook chat
    @if (setting('is_tawk_messenger_activated') == 1)

    var Tawk_API = Tawk_API || {},
        Tawk_LoadStart = new Date();
    (function () {
        var s1 = document.createElement("script"),
            s0 = document.getElementsByTagName("script")[0];
        s1.async = true;
        s1.src = 'https://embed.tawk.to/{{ setting('tawk_property_id') }}/{{ setting('tawk_widget_id') }}';
        s1.charset = 'UTF-8';
        s1.setAttribute('crossorigin', '*');
        s0.parentNode.insertBefore(s1, s0);
    })();
    @endif

        @if (setting('is_facebook_messenger_activated') == 1)
        window.fbAsyncInit = function () {
        FB.init({
            appId: 'facebook-developer-app-id',

            autoLogAppEvents: true,
            xfbml: true,
            version: 'v3.3'
        });
    };
    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
    @endif

        @if (auth()->check() && auth()->user()->role_id > 1)
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('{{ static_asset('admin/js/OneSignalSDKWorker.js') }}')
            .then(function (registration) {
                console.log('Service Worker registered with scope:', registration.scope);
            })
            .catch(function (error) {
                console.error('Service Worker registration failed:', error);
            });
    }
        window.OneSignal = window.OneSignal || [];
    OneSignal.push(function () {
        OneSignal.init({
            appId: "{{ setting('onesignal_app_id') }}",
            safari_web_id: "{{ setting('safari_web_id') }}",
            notifyButton: {
                enable: true,
            },
            serviceWorker: {
                path: "{{ static_asset('admin/js/OneSignalSDKWorker.js') }}",
            }
        });
        OneSignal.on('subscriptionChange', function (isSubscribed) {
            if (isSubscribed) {
                OneSignal.getUserId().then(function (userId) {
                    $.ajax({
                        url: '{{ route('onesignal.update-subscription') }}',
                        method: 'POST',
                        data: {
                            player_id: userId,
                            subscribed: 1
                        }
                    });
                });
            }
            else{
                $.ajax({
                    url: '{{ route('onesignal.update-subscription') }}',
                    method: 'POST',
                    data: {
                        subscribed: 0
                    }
                });
            }
        });
    });
    @endif
</script>

@if (setting('custom_footer_script'))
    {!! base64_decode(setting('custom_footer_script')) !!}
@endif
</body>

</html>



