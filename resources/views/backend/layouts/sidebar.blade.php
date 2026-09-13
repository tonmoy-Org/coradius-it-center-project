<header class="navbar-dark-v1">
    <div class="header-position">
        <span class="sidebar-toggler">
            <i class="las la-times"></i>
        </span>
        <div class="dashboard-logo d-flex justify-content-center align-items-center py-20">
            <a class="logo" href="{{ route('admin.dashboard') }}">
                <img
                    src="{{ setting('admin_logo') && @is_file_exists(setting('admin_logo')['original_image']) ? get_media(setting('admin_logo')['original_image']) : get_media('images/default/logo/logo.png') }}"
                    alt="Logo">
            </a>
            <a class="logo-icon" href="{{ route('admin.dashboard') }}">
                <img
                    src="{{ setting('admin_mini_logo') && @is_file_exists(setting('admin_mini_logo')['original_image']) ? get_media(setting('admin_mini_logo')['original_image']) : get_media('images/default/logo/logo.png') }}"
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
                @if(hasPermission('courses.index') || hasPermission('success-stories.index'))
                    <li class="{{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tags/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*', 'admin/counter-section', 'admin/about-section', 'admin/categories-of-work-section', 'admin/success-stories*', 'admin/success-story-section'], 'active') }}">
                        <a href="#home_landing" class="dropdown-icon" data-bs-toggle="collapse" role="button"
                           aria-expanded="{{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tag/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*', 'admin/counter-section', 'admin/about-section', 'admin/categories-of-work-section', 'admin/newsletter-section', 'admin/sticky-promo-section', 'admin/success-stories*', 'admin/success-story-section'], 'true', 'false') }}"
                           aria-controls="home_landing">
                            <i class="las la-desktop"></i>
                            <span>{{ __('Home Landing Page') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/category/*', 'admin/category', 'admin/subjects/*', 'admin/subjects', 'admin/tag/*', 'admin/tag', 'admin/level/*', 'admin/level', 'admin/courses/*', 'admin/courses', 'admin/quizzes*', 'admin/counter-section', 'admin/about-section', 'admin/categories-of-work-section', 'admin/newsletter-section', 'admin/sticky-promo-section', 'admin/success-stories*', 'admin/success-story-section'], 'show') }}"
                            id="home_landing">
                            @php
                                $firstCourse = \App\Models\Course::first();
                                $landingId = $firstCourse ? $firstCourse->id : 1;
                                $currTab = request()->query('tab', 'basic');
                            @endphp
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'basic' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'basic']) }}">{{ __('Basic Info') }}</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'mediaImages' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'mediaImages']) }}">{{ __('Media') }}</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'desc_right_box' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'desc_right_box']) }}">{{ __('Description') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('website.about_section') }}"
                                   class="{{ request()->routeIs('website.about_section') ? 'active' : '' }}">
                                    {{ __('About Me') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('website.categories_of_work_section') }}"
                                   class="{{ request()->routeIs('website.categories_of_work_section') ? 'active' : '' }}">
                                    {{ __('Categories') }}
                                </a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'benefits' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'benefits']) }}">{{ __('Benefits') }}</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'gift_banner' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'gift_banner']) }}">{{ __('Gift Banner') }}</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'ad_banners' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'ad_banners']) }}">{{ __('Banners') }}</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'curriculum' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'curriculum']) }}">{{ __('Curriculum') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('website.success_story_section') }}"
                                   class="{{ request()->routeIs('website.success_story_section') ? 'active' : '' }}">
                                    {{ __('Story Section') }}
                                </a>
                            </li>
                            @if(hasPermission('success-stories.index'))
                                <li>
                                    <a href="{{ route('success-stories.index') }}"
                                       class="{{ request()->routeIs('success-stories.*') ? 'active' : '' }}">
                                        {{ __('success_story') }}
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'offer_breakdown' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'offer_breakdown']) }}">{{ __('Breakdown') }}</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'faq' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'faq']) }}">{{ __('FAQ') }}</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'support' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'support']) }}">{{ __('Support') }}</a>
                            </li>
                            <li>
                                <a class="{{ request()->routeIs('courses.edit') && $currTab == 'pricing' ? 'active' : '' }}"
                                   href="{{ route('courses.edit', [$landingId, 'tab' => 'pricing']) }}">{{ __('Pricing') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('website.counter_section') }}"
                                   class="{{ request()->routeIs('website.counter_section') ? 'active' : '' }}">
                                    {{ __('Counter') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('website.newsletter_section') }}"
                                   class="{{ request()->routeIs('website.newsletter_section') ? 'active' : '' }}">
                                    {{ __('Newsletter') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('website.sticky_promo') }}"
                                   class="{{ request()->routeIs('website.sticky_promo') ? 'active' : '' }}">
                                    {{ __('Sticky Promo') }}
                                </a>
                            </li>
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
                @if(hasPermission('pages.index'))
                    <li class="{{ menuActivation(['admin/pages', 'admin/create-404*', 'admin/pages*'], 'active') }}">
                        <a href="#cms_settings" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(['admin/create-404*', 'admin/pages', 'admin/pages*'], 'true', 'false') }}"
                           aria-controls="cms_settings">
                            <i class="las la-layer-group"></i>
                            <span>{{ __('cms') }}</span>
                        </a>
                        <ul class="sub-menu collapse {{ menuActivation(['admin/create-404*', 'admin/pages', 'admin/pages*'], 'show') }}"
                            id="cms_settings">
                            @if(hasPermission('pages.index'))
                                <li><a class="{{ menuActivation('admin/pages*', 'active') }}"
                                       href="{{ route('pages.index') }}">{{ __('all_pages') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
                @if(hasPermission('theme.options') || hasPermission('hero.section') || hasPermission('footer.social-links') ||
                    hasPermission('website.seo') || hasPermission('custom.js') || 
                    hasPermission('custom.css') || hasPermission('google.setup') || hasPermission('fb.pixel') || hasPermission('gdpr')
                    )
                    <li class="{{ menuActivation(
                        [
                            'admin/call-to-action',
                            'admin/social-link-setting',
                            'admin/newsletter-setting',
                            'admin/useful-link-setting',
                            'admin/quick-link-setting',
                            'admin/copyright-setting',
                            'admin/become-instructor-content',
                            'admin/categories-of-work-section',
                            'admin/theme-options',
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
                            'admin/storage-setting',
                        ],
                        'active',
                    ) }}">
                        <a href="#website_settings" class="dropdown-icon" data-bs-toggle="collapse"
                           aria-expanded="{{ menuActivation(
                            [
                                'admin/social-link-setting',
                                'admin/newsletter-setting',
                                'admin/useful-link-setting',
                                'admin/quick-link-setting',
                                'admin/copyright-setting',
                                'admin/become-instructor-content',
                                'admin/categories-of-work-section',
                                'admin/call-to-action',
                                'admin/theme-options',
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
                                'admin/storage-setting',
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
                            'admin/become-instructor-content',
                            'admin/call-to-action',
                            'admin/categories-of-work-section',
                            'admin/social-link-setting',
                            'admin/newsletter-setting',
                            'admin/useful-link-setting',
                            'admin/quick-link-setting',
                            'admin/copyright-setting',
                            'admin/header-topbar',
                            'admin/theme-options',
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
                            'admin/storage-setting',
                        ],
                        'show',
                    ) }}"
                            id="website_settings">
                            @if(hasPermission('theme.options'))
                                <li><a class="{{ menuActivation('admin/theme-options', 'active') }}"
                                       href="{{ route('theme.options') }}">{{ __('theme_options') }}</a></li>
                            @endif
                            

                            @if(hasPermission('footer.social-links'))
                                <li><a class="{{ menuActivation([
                                'admin/social-link-setting',
                                'admin/newsletter-setting',
                                'admin/useful-link-setting',
                                'admin/quick-link-setting',
                                'admin/copyright-setting'
                            ], 'active') }}"
                                       href="{{ route('footer.social-links') }}">{{ __('footer_content') }}</a></li>
                            @endif
                            @if(hasPermission('website.seo'))
                                <li><a class="{{ menuActivation('admin/website-seo', 'active') }}"
                                       href="{{ route('website.seo') }}">{{ __('website_seo') }}</a></li>
                            @endif
                            @if(hasPermission('custom.js'))
                                <li><a class="{{ menuActivation('admin/custom-js', 'active') }}"
                                       href="{{ route('custom.js') }}">{{ __('custom_js') }}</a></li>
                            @endif
                            @if(hasPermission('google.setup'))
                                <li><a class="{{ menuActivation('admin/google-setup', 'active') }}"
                                       href="{{ route('google.setup') }}">{{ __('google_setup') }}</a></li>
                            @endif
                            @if(hasPermission('fb.pixel'))
                                <li><a class="{{ menuActivation('admin/facebook-pixel', 'active') }}"
                                       href="{{ route('fb.pixel') }}">{{ __('fb_pixel') }}</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
</header>
