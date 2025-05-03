<aside class="my-account-sidebar">
    <div class="my-account-sidebar-item">
        <div class="my-account-sidebar-item-icon">
            <img src="{{ asset('loginLayout/site') }}/images/profile-circle.png" alt="" />
            <p class="welcome">{{ __('Hello') }} <span>{{ $user->name }}</span> !</p>
            <p class="user-email">{{ $user->email }}</p>

            <svg width="100%" height="1">
                <rect x="0" y="100%" width="150%" height=".6" fill="none" stroke="#FFC200" stroke-width="4"
                    stroke-dasharray="6, 7" />
            </svg>
        </div>

        <div class="my-account-sidebar-item-links">
            <a class="{{ isActiveRoute('site.profile' , 'link-active') }}" href="{{ route('site.profile') }}">
                <img src="{{ asset('loginLayout/site') }}/images/Profile link icon.svg" alt="" />

                <p>{{ __('my account') }}</p>
            </a>
            <a class="{{ isActiveRoute('site.myorders' , 'link-active') }}" href="{{ route('site.myorders') }}">
                <img src="{{ asset('loginLayout/site') }}/images/Profile link order1).svg" alt="" />
                <p>{{ __('My Orders') }}</p>
            </a>

            <a class="{{ isActiveRoute('site.logout', 'link-active') }}" href="{{ route('site.logout') }}">
                <img src="{{ asset('loginLayout/site') }}/images/logout.svg" alt="" />
                <p> {{ __('logout') }}</p>
            </a>
        </div>
    </div>
</aside>
