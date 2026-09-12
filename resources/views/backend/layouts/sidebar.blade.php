<header class="navbar-dark-v1">
    <div class="header-position">
        <span class="sidebar-toggler">
            <i class="las la-times"></i>
        </span>
        <div class="dashboard-logo d-flex justify-content-center align-items-center py-20">
            <a class="logo" href="{{ route('admin.dashboard') }}">
                <img
                    src="{{ setting('admin_logo') && @is_file_exists(setting('admin_logo')['original_image']) ? get_media(setting('admin_logo')['original_image']) : get_media('images/default/logo/logo-green-white.png') }}"
                    alt="Logo">
            </a>
            <a class="logo-icon" href="{{ route('admin.dashboard') }}">
                <img
                    src="{{ setting('admin_mini_logo') && @is_file_exists(setting('admin_mini_logo')['original_image']) ? get_media(setting('admin_mini_logo')['original_image']) : get_media('images/default/logo/logo-green-mini.png') }}"
                    alt="Logo">
            </a>
        </div>
        <nav class="side-nav">
            <ul>
                @if(hasPermission('admin.dashboard'))
                    <li class="{{ menuActivation(['admin/dashboard', 'admin'], 'active') }}">
                        <a href="{{ route('admin.dashboard') }}" role="button" aria-expanded="false"
                           aria-controls="dashboard">
                            <i class="las la-tachometer-alt"></i>
                            <span>{{ __('dashboard') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('courses.index') || hasPermission('category.index') || hasPermission('subjects.index') || hasPermission('tag.index') || hasPermission('level.index'))
                    <li class="{{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tags/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*'], 'active') }}">
                        <a href="#course" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tag/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*'], 'true', 'false') }}"
                           aria-controls="course">
                            <i class="las la-book"></i>
                            <span>{{ __('course') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tag/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*'], 'show') }}"
                            id="course">
                            @if(hasPermission('courses.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/courses/*', 'admin/courses', 'admin/quizzes*'], 'active') }}"
                                       href="{{ route('courses.index') }}">{{ __('course_list') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('category.index'))
                                <li><a class="{{ menuActivation(['admin/category/*', 'admin/category'], 'active') }}"
                                       href="{{ route('category.index') }}">{{ __('category') }}</a></li>
                            @endif

                            @if(hasPermission('subjects.index'))
                                <li><a class="{{ menuActivation(['admin/subjects/*', 'admin/subjects'], 'active') }}"
                                       href="{{ route('subjects.index') }}">{{ __('subject') }}</a></li>
                            @endif
                            @if(hasPermission('tag.index'))
                                <li><a class="{{ menuActivation(['admin/tag/*', 'admin/tag'], 'active') }}"
                                       href="{{ route('tag.index') }}">{{ __('tags') }}</a></li>
                            @endif

                            @if(hasPermission('level.index'))
                                <li><a class="{{ menuActivation(['admin/level/*', 'admin/level'], 'active') }}"
                                       href="{{ route('level.index') }}">{{ __('levels') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('media-library.index'))
                    <li class="{{ menuActivation('admin/media-library', 'active') }}">
                        <a href="{{ route('media-library.index') }}">
                            <i class="las la-images"></i>
                            <span>{{ __('media_library') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('coupons.index') && setting('coupon_system'))
                    <li class="{{ menuActivation(['admin/coupons', 'admin/coupons/*', 'admin/coupons/create'], 'active') }}">
                        <a href="#coupon" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/coupons', 'admin/coupons/*', 'admin/coupons/create'], 'true', 'false') }}"
                           aria-controls="coupon">
                            <i class="las la-th"></i>
                            <span>{{ __('marketing') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/coupons', 'admin/coupons/*', 'admin/coupons/create'], 'show') }}"
                            id="coupon">
                            <li>
                                <a class="{{ menuActivation(['admin/coupons', 'admin/coupons/*'], 'active') }}"
                                   href="{{ route('coupons.index') }}">{{ __('all_coupons') }}</a>
                            </li>
                        </ul>
                    </li>
                @endif

                @if (addon_is_activated('accounts_system') && (hasPermission('accounts.index') || hasPermission('bank-accounts.index') || hasPermission('incomes.index') || hasPermission('expenses.index') || hasPermission('transfers.index')))
                    <li
                        class="{{ menuActivation(
                            [
                                'admin/accounts',
                                'admin/accounts/*',
                                'admin/bank-accounts',
                                'admin/bank-accounts/*',
                                'admin/incomes',
                                'admin/incomes/*',
                                'admin/expenses',
                                'admin/expenses/*',
                                'admin/transfers',
                                'admin/transfers/*',
                            ],
                            'active',
                        ) }}">
                        <a href="#accounts" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(
                                [
                                    'admin/accounts',
                                    'admin/accounts/*',
                                    'admin/bank-accounts',
                                    'admin/bank-accounts/*',
                                    'admin/incomes',
                                    'admin/incomes/*',
                                    'admin/expenses',
                                    'admin/expenses/*',
                                    'admin/transfers',
                                    'admin/transfers/*',
                                ],
                                'true',
                                'false',
                            ) }}"
                           aria-controls="accounts">
                            <i class="las la-dollar-sign"></i>
                            <span>{{ __('accounts') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(
                            [
                                'admin/accounts',
                                'admin/accounts/*',
                                'admin/bank-accounts',
                                'admin/bank-accounts/*',
                                'admin/incomes',
                                'admin/incomes/*',
                                'admin/expenses',
                                'admin/expenses/*',
                                'admin/transfers',
                                'admin/transfers/*',
                            ],
                            'show',
                        ) }}"
                            id="accounts">
                            @if(hasPermission('accounts.index'))
                                <li><a class="{{ menuActivation(['admin/accounts', 'admin/accounts/*'], 'active') }}"
                                       href="{{ route('accounts.index') }}">{{ __('accounts') }}</a></li>
                            @endif

                            @if(hasPermission('bank-accounts.index'))
                                <li>
                                    <a class="{{ menuActivation(['admin/bank-accounts', 'admin/bank-accounts/*'], 'active') }}"
                                       href="{{ route('bank-accounts.index') }}">{{ __('bank_accounts') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('incomes.index'))
                                <li><a class="{{ menuActivation(['admin/incomes', 'admin/incomes/*'], 'active') }}"
                                       href="{{ route('incomes.index') }}">{{ __('income') }}</a></li>
                            @endif

                            @if(hasPermission('expenses.index'))
                                <li><a class="{{ menuActivation(['admin/expenses', 'admin/expenses/*'], 'active') }}"
                                       href="{{ route('expenses.index') }}">{{ __('expense') }}</a></li>
                            @endif

                            @if(hasPermission('transfers.index'))
                                <li><a class="{{ menuActivation(['admin/transfers', 'admin/transfers/*'], 'active') }}"
                                       href="{{ route('transfers.index') }}">{{ __('transfer') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(hasPermission('pages.index') || hasPermission('success-stories.index') || hasPermission('testimonials.index') || hasPermission('brands.index'))
                    <li class="{{ menuActivation(['admin/success-stories*', 'admin/pages', 'admin/create-404*', 'admin/pages*', 'admin/testimonials*', 'admin/brands*'], 'active') }}">
                        <a href="#cms_settings" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/success-stories*', 'admin/create-404*', 'admin/pages', 'admin/pages*', 'admin/testimonials*', 'admin/brands*'], 'true', 'false') }}"
                           aria-controls="cms_settings">
                            <i class="las la-layer-group"></i>
                            <span>{{ __('cms') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/success-stories*', 'admin/create-404*', 'admin/pages', 'admin/pages*', 'admin/testimonials*', 'admin/brands*'], 'show') }}"
                            id="cms_settings">

                            @if(hasPermission('pages.index'))
                                <li><a class="{{ menuActivation('admin/pages*', 'active') }}"
                                       href="{{ route('pages.index') }}">{{ __('all_pages') }}</a></li>
                            @endif

                            @if(hasPermission('success-stories.index'))
                                <li><a class="{{ menuActivation('admin/success-stories*', 'active') }}"
                                       href="{{ route('success-stories.index') }}">{{ __('success_story') }}</a></li>
                            @endif

                            @if(hasPermission('testimonials.index'))
                                <li><a class="{{ menuActivation('admin/testimonials*', 'active') }}"
                                       href="{{ route('testimonials.index') }}">{{ __('testimonial') }}</a></li>
                            @endif
                            @if(hasPermission('brands.index'))
                                <li><a class="{{ menuActivation('admin/brands*', 'active') }}"
                                       href="{{ route('brands.index') }}">{{ __('brands') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif

                @if(hasPermission('website.themes') || hasPermission('theme.options') || hasPermission('header.logo') || hasPermission('hero.section') || hasPermission('footer.social-links') ||
                    hasPermission('website.cta') || hasPermission('website.popup') || hasPermission('website.seo') || hasPermission('custom.js') || hasPermission('website.instructor_content') ||
                    hasPermission('custom.css') || hasPermission('admin.firebase') || hasPermission('chat.messenger') || hasPermission('google.setup') || hasPermission('fb.pixel') || hasPermission('gdpr') ||
                    hasPermission('home.page.builder'))

                    <li class="{{ menuActivation(
                        [
                            'admin/home-page',
                            'admin/call-to-action',
                            'admin/social-link-setting',
                            'admin/newsletter-setting',
                            'admin/useful-link-setting',
                            'admin/resource-link-setting',
                            'admin/quick-link-setting',
                            'admin/apps-link-setting',
                            'admin/payment-banner-setting',
                            'admin/copyright-setting',
                            'admin/become-instructor-content',
                            'admin/categories-of-work-section',
                            'admin/header-logo',
                            'admin/theme-options',
                            'admin/website-themes',
                            'admin/website-popup',
                            'admin/website-seo',
                            'admin/google-setup',
                            'admin/custom-js',
                            'admin/custom-css',
                            'admin/facebook-pixel',
                            'admin/gdpr',
                            'admin/header-menu',
                            'admin/hero-section',
                            'admin/header-topbar',
                            'admin/header-footer',
                            'admin/header-content',
                            'admin/footer-menu',
                            'admin/firebase',
                            'admin/storage-setting',
                            'admin/chat-messenger',
                        ],
                        'active',
                    ) }}">
                        <a href="#website_settings" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(
                            [
                                'admin/home-page',
                                'admin/social-link-setting',
                                'admin/newsletter-setting',
                                'admin/useful-link-setting',
                                'admin/resource-link-setting',
                                'admin/quick-link-setting',
                                'admin/apps-link-setting',
                                'admin/payment-banner-setting',
                                'admin/copyright-setting',
                                'admin/become-instructor-content',
                                'admin/categories-of-work-section',
                                'admin/call-to-action',
                                'admin/header-logo',
                                'admin/theme-options',
                                'admin/website-themes',
                                'admin/website-popup',
                                'admin/website-seo',
                                'admin/google-setup',
                                'admin/custom-js',
                                'admin/custom-css',
                                'admin/header-topbar',
                                'admin/facebook-pixel',
                                'admin/header-menu',
                                'admin/hero-section',
                                'admin/gdpr',
                                'admin/header-footer',
                                'admin/header-content',
                                'admin/footer-menu',
                                'admin/firebase',
                                'admin/storage-setting',
                                'admin/chat-messenger',
                            ],
                            'true',
                            'false',
                        ) }}"
                           aria-controls="website_settings">
                            <i class="las la-tools"></i>
                            <span>{{ __('website_settings') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(
                        [
                            'admin/home-page',
                            'admin/become-instructor-content',
                            'admin/call-to-action',
                            'admin/categories-of-work-section',
                            'admin/social-link-setting',
                            'admin/newsletter-setting',
                            'admin/useful-link-setting',
                            'admin/resource-link-setting',
                            'admin/quick-link-setting',
                            'admin/apps-link-setting',
                            'admin/payment-banner-setting',
                            'admin/copyright-setting',
                            'admin/header-topbar',
                            'admin/header-logo',
                            'admin/theme-options',
                            'admin/website-themes',
                            'admin/website-popup',
                            'admin/website-seo',
                            'admin/google-setup',
                            'admin/custom-js',
                            'admin/custom-css',
                            'admin/facebook-pixel',
                            'admin/gdpr',
                            'admin/header-topbar',
                            'admin/header-menu',
                            'admin/header-footer',
                            'admin/header-content',
                            'admin/hero-section',
                            'admin/footer-menu',
                            'admin/firebase',
                            'admin/storage-setting',
                            'admin/chat-messenger',
                        ],
                        'show',
                    ) }}"
                            id="website_settings">

                            @if(hasPermission('website.themes'))
                                <li><a class="{{ menuActivation('admin/website-themes', 'active') }}"
                                       href="{{ route('website.themes') }}">{{ __('website_themes') }}</a></li>
                            @endif

                            @if(hasPermission('theme.options'))
                                <li><a class="{{ menuActivation('admin/theme-options', 'active') }}"
                                       href="{{ route('theme.options') }}">{{ __('theme_options') }}</a></li>
                            @endif

                            @if(hasPermission('header.logo'))
                                <li>
                                    <a class="{{ menuActivation(['admin/header-logo', 'admin/header-topbar', 'admin/header-menu'], 'active') }}"
                                       href="{{ route('header.logo') }}">{{ __('header_content') }}</a></li>
                            @endif

                            @if(hasPermission('hero.section'))
                                <li><a class="{{ menuActivation('admin/hero-section', 'active') }}"
                                       href="{{ route('hero.section') }}">{{ __('hero_section') }}</a></li>
                            @endif

                            @if(hasPermission('footer.social-links'))
                                <li><a class="{{ menuActivation([
                                'admin/social-link-setting',
                                'admin/newsletter-setting',
                                'admin/useful-link-setting',
                                'admin/resource-link-setting',
                                'admin/quick-link-setting',
                                'admin/apps-link-setting',
                                'admin/payment-banner-setting',
                                'admin/copyright-setting'
                            ], 'active') }}"
                                       href="{{ route('footer.social-links') }}">{{ __('footer_content') }}</a></li>
                            @endif

                            @if(hasPermission('website.cta'))
                                <li><a class="{{ menuActivation('admin/call-to-action', 'active') }}"
                                       href="{{ route('website.cta') }}">{{ __('call_to_action_content') }}</a></li>
                            @endif

                            @if(hasPermission('website.popup'))
                                <li><a class="{{ menuActivation('admin/website-popup', 'active') }}"
                                       href="{{ route('website.popup') }}">{{ __('website_popup') }}</a></li>
                            @endif

                            @if(hasPermission('website.seo'))
                                <li><a class="{{ menuActivation('admin/website-seo', 'active') }}"
                                       href="{{ route('website.seo') }}">{{ __('website_seo') }}</a></li>
                            @endif
                            @if(hasPermission('custom.css'))
                                <li><a class="{{ menuActivation('admin/custom-css', 'active') }}"
                                       href="{{ route('custom.css') }}">{{ __('custom_css') }}</a></li>
                            @endif
                            @if(hasPermission('custom.js'))
                                <li><a class="{{ menuActivation('admin/custom-js', 'active') }}"
                                       href="{{ route('custom.js') }}">{{ __('custom_js') }}</a></li>
                            @endif

                            @if(hasPermission('website.instructor_content'))
                                <li><a class="{{ menuActivation('admin/become-instructor-content', 'active') }}"
                                       href="{{ route('website.instructor_content') }}">{{ __('instructor_content') }}</a>
                                </li>
                            @endif

                            @if(hasPermission('google.setup'))
                                <li><a class="{{ menuActivation('admin/google-setup', 'active') }}"
                                       href="{{ route('google.setup') }}">{{ __('google_setup') }}</a></li>
                            @endif

                            @if(hasPermission('fb.pixel'))
                                <li><a class="{{ menuActivation('admin/facebook-pixel', 'active') }}"
                                       href="{{ route('fb.pixel') }}">{{ __('fb_pixel') }}</a></li>
                            @endif

                            @if(hasPermission('gdpr'))
                                <li><a class="{{ menuActivation('admin/gdpr', 'active') }}"
                                       href="{{ route('gdpr') }}">{{ __('gdpr') }}</a></li>
                            @endif
                            @if(hasPermission('admin.firebase'))
                                <li><a class="{{ menuActivation('admin/firebase', 'active') }}"
                                       href="{{ route('admin.firebase') }}">{{ __('firebase') }}</a></li>
                            @endif
                            @if(hasPermission('chat.messenger'))
                                <li><a class="{{ menuActivation('admin/chat-messenger', 'active') }}"
                                       href="{{ route('chat.messenger') }}">{{ __('chat_messenger') }}</a></li>
                            @endif
                            @if(hasPermission('home.page.builder'))
                                <li><a class="{{ menuActivation('admin/home-page', 'active') }}"
                                       href="{{ route('home.page.builder') }}">{{ __('home_page_builder') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>

