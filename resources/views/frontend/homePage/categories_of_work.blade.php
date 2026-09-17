@if(setting('categories_of_work_status') !== '0')
@php
    $cards = setting('categories_of_work_cards');
    $cards = is_array($cards) ? $cards : [];
    $title = setting('categories_of_work_title');
    $subtitle = setting('categories_of_work_subtitle');
@endphp

@if(count($cards) > 0 || $title)
<style>
    .cow-wrapper {
        background-color: transparent;
        border: none;
        border-radius: 0;
        padding: 20px 0;
        margin-bottom: 0px;
    }
    .cow-title { 
        color: var(--color-text-ink, #0A1E3F);
        font-family: var(--header-font, "Outfit", "Hind Siliguri", sans-serif) !important;
        font-size: 32px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 10px;
    }
    .cow-subtitle {
        color: var(--color-text-secondary, #4B5A72);
        font-size: 16px;
        text-align: center;
        margin-bottom: 40px;
        max-width: 800px;
        margin-left: auto;
        margin-right: auto;
    }
    .cow-subtitle p {
        margin-bottom: 0;
    }
    .cow-card {
        background-color: var(--color-white, #ffffff);
        border-radius: 8px;
        border: 1px solid var(--color-border-tint, #D9E8FC);
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.03);
        padding: 20px;
        height: 100%;
        display: flex;
        flex-direction: column;
        position: relative;
        overflow: hidden;
    }
    .cow-card:not(.cow-card-only-image)::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 70px;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 1440 320'%3E%3Cpath fill='%23F0F6FF' fill-opacity='1' d='M0,256L60,245.3C120,235,240,213,360,208C480,203,600,213,720,218.7C840,224,960,224,1080,218.7C1200,213,1320,203,1380,197.3L1440,192L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z'%3E%3C/path%3E%3C/svg%3E");
        background-size: cover;
        background-position: bottom center;
        background-repeat: no-repeat;
        z-index: 0;
        pointer-events: none;
    }
    .cow-card-title {
        position: relative;
        z-index: 1;
        background-color: var(--color-blue-tint, #EAF2FE);
        color: var(--color-primary, #0056D2);
        border: 1px solid var(--color-border-tint, #D9E8FC);
        padding: 12px 16px;
        border-radius: 8px;
        font-size: 16px;
        font-weight: 700;
        margin-bottom: 16px;
        text-align: center;
    }
    .cow-card-body-wrapper {
        position: relative;
        z-index: 1;
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        padding-top: 5px;
    }
    .cow-card-content {
        color: var(--color-text-secondary, #4B5A72);
        font-size: 14px;
        line-height: 1.8;
        padding-left: 10px;
        padding-right: 10px; 
        min-height: 80px;
    }
    .cow-card-content.has-image {
        padding-right: 140px; /* leaves room for absolute image */
    }
    .cow-card-content strong, .cow-card-content b {
        color: var(--color-text-ink, #0A1E3F);
    }
    .cow-card-content p {
        margin-bottom: 12px;
    }
    .cow-card-content ul, .cow-card-content ol {
        padding-left: 0 !important; 
        margin-bottom: 15px !important;
    }
    .cow-card-content li {
        margin-left: 25px !important; /* Pushes the li to the right, giving space for the outside bullet */
        margin-bottom: 8px !important;
        list-style-position: outside !important;
    }
    .cow-card-img-floating-wrapper {
        position: absolute;
        bottom: -5px;
        right: -10px;
        width: 140px;
        height: auto;
        z-index: 10;
        border-radius: 8px;
        overflow: hidden;
    }
    .cow-card-img-floating {
        width: 100%;
        height: auto;
        object-fit: cover;
    }
    .cow-card-only-image {
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0;
        background: transparent;
        box-shadow: none;
    }
    .cow-card-only-image img {
        max-width: 100%;
        border-radius: 8px;
    }
    .cow-title p,
    .cow-card-title p {
        display: inline !important;
        margin: 0 !important;
        padding: 0 !important;
        line-height: inherit !important;
    }
    @media (max-width: 768px) {
        .cow-wrapper {
            padding: 20px 0;
            border-radius: 0;
        }
        .cow-title,
        .cow-title * {
            font-size: 22px !important;
            line-height: 1.35 !important;
            margin-bottom: 15px !important;
            word-break: break-word;
            overflow-wrap: break-word;
        }
        .cow-subtitle,
        .cow-subtitle * {
            font-size: 15px !important;
            margin-bottom: 30px !important;
        }
        .cow-card-title,
        .cow-card-title * {
            font-size: 17px !important;
            line-height: 1.4 !important;
            margin-bottom: 16px !important;
            padding: 12px 18px !important;
            word-break: break-word;
            overflow-wrap: break-word;
        }
        .cow-card-content {
            padding-right: 0;
        }
        .cow-card-img-floating-wrapper {
            position: relative;
            transform: none;
            right: 0;
            top: 0;
            margin-top: 25px;
            display: block;
            text-align: center;
        }
    }
</style>

<section class="categories-of-work-section p-t-60 p-b-60" style="background-color: #F6F9FE !important;">
    <div class="container container-1278">
        @if($title)
            <h3 class="cow-title" data-aos="fade-up">{!! format_title_highlight($title) !!}</h3>
        @endif
        @if($subtitle)
            <div class="cow-subtitle" data-aos="fade-up" data-aos-delay="100">
                {!! $subtitle !!}
            </div>
        @endif
        <div class="cow-wrapper">

            <div class="row g-4 justify-content-center">
                @foreach($cards as $card)
                    @php
                        $hasTitle = !empty($card['title']);
                        $hasContent = !empty($card['content']);
                        $hasImage = !empty($card['image']);
                        $hasLink = !empty($card['link']);
                        $onlyImage = !$hasTitle && !$hasContent && $hasImage;
                        
                        $imagePath = '';
                        if ($hasImage) {
                            $imagePath = $card['image'];
                            if (!str_starts_with($imagePath, 'public/') && !str_starts_with($imagePath, 'http')) {
                                $imagePath = 'public/' . ltrim($imagePath, '/');
                            }
                        }
                    @endphp
                    <div class="col-lg-6 col-md-12" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        @if($onlyImage)
                            <div class="cow-card cow-card-only-image h-100">
                                @if($hasLink)
                                    <a href="{{ $card['link'] }}" {{ str_starts_with($card['link'], '#') ? '' : 'target="_blank"' }}>
                                        <img src="{{ asset($imagePath) }}" alt="Category Image">
                                    </a>
                                @else
                                    <img src="{{ asset($imagePath) }}" alt="Category Image">
                                @endif
                            </div>
                        @else
                            <div class="cow-card">
                                @if($hasTitle)
                                    <div class="cow-card-title">
                                        {!! format_title_highlight($card['title']) !!}
                                    </div>
                                @endif

                                <div class="cow-card-body-wrapper">
                                    @if($hasContent)
                                        <div class="cow-card-content {{ $hasImage ? 'has-image' : '' }}">
                                            {!! $card['content'] !!}
                                        </div>
                                    @endif

                                    @if($hasImage)
                                        @if($hasLink)
                                            <a href="{{ $card['link'] }}" {{ str_starts_with($card['link'], '#') ? '' : 'target="_blank"' }} class="cow-card-img-floating-wrapper">
                                                <img src="{{ asset($imagePath) }}" class="cow-card-img-floating" alt="{{ $card['title'] ?? 'Category Image' }}">
                                            </a>
                                        @else
                                            <div class="cow-card-img-floating-wrapper">
                                                <img src="{{ asset($imagePath) }}" class="cow-card-img-floating" alt="{{ $card['title'] ?? 'Category Image' }}">
                                            </div>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>

            @if(setting('categories_of_work_button_text'))
                <div class="row mt-5" data-aos="fade-up" data-aos-delay="200">
                    <div class="col-12 text-center">
                        <a href="{{ setting('categories_of_work_button_link') ?? route('register') }}" class="template-btn">
                            <span>{{ setting('categories_of_work_button_text') }}</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            @endif

        </div>
    </div>
</section>
@endif

@endif

