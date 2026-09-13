<div class="col-xxl-3 col-lg-4 col-md-4">
    <h3 class="section-title"{{ __('theme_option') }}></h3>
    <div class="bg-white redious-border py-3 py-sm-30 mb-30">
        <div class="email-tamplate-sidenav">
            <ul class="default-sidenav">
                @if(hasPermission('theme.options'))
                    <li>
                        <a href="{{ route('theme.options') }}"
                           class="{{ request()->routeIs('theme.options') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-palette"></i></span>
                            <span>{{ __('theme_options') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('hero.section'))
                    <li>
                        <a href="{{ route('hero.section') }}"
                           class="{{ request()->routeIs('hero.section') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-hand-point-up"></i></span>
                            <span>{{ __('hero_section') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('footer.social-links'))

                    <li>
                        <a href="{{ route('footer.content') }}"
                           class="@if(request()->routeIs('footer.content') || request()->routeIs('footer.social-links') || request()->routeIs('footer.newsletter-settings') || request()->routeIs('footer.useful-links') || request()->routeIs('footer.resource-links') || request()->routeIs('footer.quick-links') || request()->routeIs('footer.apps-links') || request()->routeIs('footer.payment-banner-settings') || request()->routeIs('footer.copyright')) active @endif">
                            <span class="icon"><i class="las la-memory"></i></span>
                            <span>{{ __('footer_content') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('website.seo'))
                    <li>
                        <a href="{{ route('website.seo') }}"
                           class="{{ request()->routeIs('website.seo') ? 'active' : '' }}">
                            <span class="icon"><i class="las la-bullhorn"></i></span>
                            <span>{{ __('website_seo') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('custom.js'))
                    <li>
                        <a href="{{ route('custom.js') }}"
                           class="{{ request()->routeIs('custom.js') ? 'active' : '' }}">
                            <span class="icon"><i class="lab la-js-square"></i></span>
                            <span>{{ __('custom_js') }}</span>
                        </a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('website.counter_section') }}"
                       class="{{ request()->routeIs('website.counter_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-calculator"></i></span>
                        <span>{{ __('Counter Section') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('website.about_section') }}"
                       class="{{ request()->routeIs('website.about_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-user-tie"></i></span>
                        <span>{{ __('about_me_section') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('website.categories_of_work_section') }}"
                       class="{{ request()->routeIs('website.categories_of_work_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-list"></i></span>
                        <span>{{ __('Categories of Work Section') }}</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('website.success_video_section') }}"
                       class="{{ request()->routeIs('website.success_video_section') ? 'active' : '' }}">
                        <span class="icon"><i class="las la-play-circle"></i></span>
                        <span>{{ __('success_video_section') }}</span>
                    </a>
                </li>

                @if(hasPermission('google.setup'))
                    <li>
                        <a href="{{ route('google.setup') }}"
                           class="{{ request()->routeIs('google.setup') ? 'active' : '' }}">
                            <span class="icon"><i class="lab la-google"></i></span>
                            <span>{{ __('google_setup') }}</span>
                        </a>
                    </li>
                @endif
                @if(hasPermission('fb.pixel'))
                    <li>
                        <a href="{{ route('fb.pixel') }}" class="{{ request()->routeIs('fb.pixel') ? 'active' : '' }}">
                            <span class="icon"><i class="lab la-facebook-square"></i></span>
                            <span>{{ __('fb_pixel') }}</span>
                        </a>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
