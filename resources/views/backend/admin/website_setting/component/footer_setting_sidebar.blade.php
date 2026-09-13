<ul class="nav pb-12 mb-20" id="pills-tab" role="tablist">
    @if(hasPermission('footer.newsletter-settings'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.newsletter-settings') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.newsletter-settings') ? 'active' : '' }}">
                <span>{{ __('newsletter_settings') }}</span>
            </a>
        </li>
    @endif
    <li class="nav-item" role="presentation">
        <a href="{{ route('footer.social-links') }}"
           class="nav-link ps-0 {{ request()->routeIs('footer.social-links') ? 'active' : '' }}">
            <span>{{ __('social_links') }}</span>
        </a>
    </li>
    @if(hasPermission('footer.useful-links'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.useful-links') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.useful-links') ? 'active' : '' }}">
                <span>{{ __('useful_links') }}</span>
            </a>
        </li>
    @endif

    @if(hasPermission('footer.copyright'))
        <li class="nav-item" role="presentation">
            <a href="{{ route('footer.copyright') }}"
               class="nav-link ps-0 {{ request()->routeIs('footer.copyright') ? 'active' : '' }}">
                <span>{{ __('copyright') }}</span>
            </a>
        </li>
    @endif
</ul>
