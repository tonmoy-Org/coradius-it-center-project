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

                @if(hasPermission('footer.social-links'))

                    <li>
                        <a href="{{ route('footer.content') }}"
                           class="@if(request()->routeIs('footer.content') || request()->routeIs('footer.social-links') || request()->routeIs('footer.newsletter-settings') || request()->routeIs('footer.useful-links') || request()->routeIs('footer.resource-links') || request()->routeIs('footer.quick-links') || request()->routeIs('footer.apps-links') || request()->routeIs('footer.payment-banner-settings') || request()->routeIs('footer.copyright')) active @endif">
                            <span class="icon"><i class="las la-memory"></i></span>
                            <span>{{ __('footer_content') }}</span>
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

