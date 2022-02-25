<header>
    <div class="container">
        <nav>
            <span class="group">
                <a href="#" class="menu-toggle">
                    <span></span>
                    <span></span>
                    <span></span>
                </a>
                @desktop <a class="links" href="{{ route('test') }}">@lang('index.header.catch')</a> @enddesktop
            </span>
            <a class="logo-container" href="{{ route('index') }}">
                <img class="logo" src="{{ url('/i/logo_twix.png') }}" alt="logo">
            </a>
            <span class="group">
                @desktop <a class="links" href="{{ route('check_register.index') }}">@lang('index.header.upload-check')</a> @enddesktop
                 @if(app()->getLocale() == 'ru')
                    <a href="{{ route('lang', 'kk') }}" class="lang">КАЗ</a>
                @else
                    <a href="{{ route('lang', 'ru') }}" class="lang">РУС</a>
                @endif
            </span>
        </nav>
        <ul class="menu-nav">
            @handheld  <li class="go-wrapper"><a class="btn-catch" href="{{ route('test') }}">@lang('index.header.catch')</a></li> @endhandheld
            <li><a class="scroll-to" href="{{ url('/#rules') }}">@lang('index.header.about')</a></li>
            <li><a class="scroll-to" href="{{ url('/#winners') }}">@lang('index.main.winners')</a></li>
            <li><a class="scroll-to" href="{{ url('/#faq') }}">@lang('index.main.faq-title')</a></li>
{{--            <li><a href="{{ url('/buy') }}">@lang('index.header.buy-twix')</a></li>--}}
            <li><a href="{{ route('profile') }}">@lang('index.header.cabinet')</a></li>
            @auth  <li><form class="nav-link" method="POST" action="{{ route('logout') }}"> @csrf <a href="{{ route('logout') }}"  onclick="event.preventDefault(); this.closest('form').submit();">@lang('index.header.exit')</a> </form></li> @endauth
            @handheld  <li class="go-wrapper"><a class="btn-catch" href="{{ route('check_register.index') }}">@lang('index.header.upload-check')</a></li> @endhandheld
        </ul>
    </div>
</header>
