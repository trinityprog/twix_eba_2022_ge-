@guest
    <div class="remodal" data-remodal-id="login">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3>
            @lang('index.auth.enter')
        </h3>
        @livewire('auth.login')
        <div class="footer">
            <p>
                @lang('index.auth.not-registered')
            </p>
            <div class="go-wrapper"><a href="{{ url('#register') }}" class="btn-catch">@lang('index.auth.register')</a></div>
        </div>
    </div>

    <div class="remodal" data-remodal-id="register">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3>
            @lang('index.auth.register')
        </h3>
        @livewire('auth.register')
        <p class="warn">
            @lang('index.auth.register-warn')
        </p>
        <div class="footer">
            <p>
                @lang('index.auth.already-registered')
            </p>
            <div class="go-wrapper"><a href="{{ url('#login') }}" class="btn-catch">@lang('index.auth.login')</a></div>
        </div>
    </div>

    <div class="remodal" data-remodal-id="register-submit">
        @php $phone = (request()->has('phone') && !empty(request()->input('phone'))) ? request()->input('phone') : '+X XXX XXX XX XX' @endphp
        <button data-remodal-action="close" class="remodal-close"></button>
        <p class="notification">
            @lang('index.auth.register-notification', ['phone' => blink()->beautify($phone)])
        </p>
        @livewire('auth.phone-verification', ['phone' => $phone])
        <div class="footer">
            <p>
                <span>@lang('index.modal.call-was-not')</span>
            </p>
            @livewire('auth.sms-send-again', ['phone' => $phone])
        </div>
    </div>

    <div class="remodal" data-remodal-id="sms_forgot">
        <button data-remodal-action="close" class="remodal-close"></button>
        <p class="notification">
            @lang('index.modal.sms_forgot.title')
        </p>
        @livewire('auth.sms-forgot')
        <div class="footer">
            <div class="go-wrapper"><a href="{{ url('#login') }}" class="btn-catch">@lang('index.modal.sms_forgot.footer_button')</a></div>
        </div>
    </div>
@else
    <div class="remodal" data-remodal-id="already-uploaded">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3>
            @lang('index.modal.already-uploaded.4-checks')
        </h3>
        <p>
            @lang('index.modal.already-uploaded.come-tomorrow')
        </p>
        <div class="go-wrapper">
            <a href="#" data-remodal-action="close" class="btn-catch">@lang('index.modal.ok')</a>
        </div>
    </div>

    <div class="remodal" data-remodal-id="test-limit">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3>
            @lang('index.modal.test-limit.today-limit')
        </h3>
        <p>
            @lang('index.modal.test-limit.come-tomorrow')
        </p>
        <div class="go-wrapper">
            <a href="#" data-remodal-action="close" class="btn-catch">@lang('index.modal.ok')</a>
        </div>
    </div>

    <div class="remodal" data-remodal-id="delivery-success">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3>
            @lang('index.modal.delivery.filled')
        </h3>
        <p>
            @lang('index.modal.delivery.address')
        </p>
        <div class="go-wrapper">
            <a href="#" data-remodal-action="close" class="btn-catch">@lang('index.modal.ok')</a>
        </div>
    </div>

    <div class="remodal" data-remodal-id="check-success">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h3>
            @lang('index.modal.check-success.accepted')
        </h3>
        <p>
            @lang('index.modal.check-success.after-moderation')
        </p>
        <div class="go-wrapper">
            <a href="#" data-remodal-action="close" class="btn-catch">@lang('index.modal.ok')</a>
        </div>
        <input type="hidden" name="phone" value="{{ auth()->user()->phone }}">
        @isset($type)
            <input type="hidden" name="type" value="{{ $type }}">
        @endisset
    </div>

    <div class="remodal" data-remodal-id="rm-scanner-wrong">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h2 class="text_1">
            @if(Str::contains(URL::current(), 'scan/'))
                @lang('index.scan.popup.title1s')
            @else
                @lang('index.scan.popup.title2s')
            @endif
        </h2>

        <span class="text_span">
        @if(Str::contains(URL::current(), 'scan/'))
                @lang('index.scan.popup.text1')
            @else
                @lang('index.scan.popup.text2')
            @endif
    </span>

        <div class="go-wrapper">
            <a href="{{ url('scanner/select/twix') }}" class="btn-catch">
                @lang('index.scan.popup.scan_again')
            </a>
        </div>

        @if(isset($prize) && isset($scanner_type))
            <div class="go-wrapper">
                <a href="{{ url('scanner/file/'.$scanner_type.'/'.$prize) }} }}" class="btn-catch">@lang('index.scan.popup.btn_file')</a>
            </div>
        @endif
    </div>

    <div class="remodal" data-remodal-id="main-prize">
        <button data-remodal-action="close" class="remodal-close"></button>
        <h2>
            @lang('index.scan.popup.prize.title')
        </h2>
        <div id="card" class="el">
            <div id="card_inner" class="el">
                <img src="{{ url('../i/card.png') }}" id="card_img"/>
                <div class="text-box">
                    <span class="amount">@lang('index.main.amount')</span>
                    <span class="text">@lang('index.main.for-me')</span>
                </div>
                <img src="{{ url('../i/grad.png') }}" id="card_grad"/>
            </div>
        </div>
        <p class="footer-modal">
            @lang('index.scan.popup.prize.footer')
        </p>
        <div class="go-wrapper">
            <a href="#" class="btn-catch">
                @lang('index.btn_scan')
            </a>
        </div>
    </div>
@endguest
<div class="remodal" data-remodal-id="age-filter">
    @if(app()->getLocale() == 'ru')
        <a href="{{ route('lang', 'kk') }}" class="lang">КАЗ</a>
    @else
        <a href="{{ route('lang', 'ru') }}" class="lang">РУС</a>
    @endif
    <h3>@lang('index.modal.age-filter.age')</h3>
    <div class="go-wrapper">
        <a href="#" class="btn-catch btn" data-value="0">@lang('index.modal.age-filter.no')</a>
        <a href="#" class="btn-catch btn" data-value="1">@lang('index.modal.age-filter.yes')</a>
    </div>
    <a href="#" class="promise">@lang('index.modal.age-filter.promise')</a>
    <p class="promise_text">
        @lang('index.modal.age-filter.promise-text')
    </p>
</div>

<div class="remodal" data-remodal-id="faq-success">
    <button data-remodal-action="close" class="remodal-close"></button>
    <h3>@lang('index.modal.faq-success.sent')</h3>
    <p>
        @lang('index.modal.faq-success.answer')
    </p>
    <div class="go-wrapper">
        <a href="#" data-remodal-action="close" class="btn-catch">@lang('index.modal.ok')</a>
    </div>
</div>


<div class="remodal footer-modal" data-remodal-id="privacy">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="content">
        <div class="header">@lang('index.footer.links.privacy')</div>
        <div class="body">@lang('index.modal.privacy')</div>
    </div>
</div>

<div class="remodal footer-modal" data-remodal-id="owner">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="content">
        <div class="header">@lang('index.footer.links.owner')</div>
        <div class="body">@lang('index.modal.owner')</div>
    </div>
</div>

<div class="remodal footer-modal" data-remodal-id="parents">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="content">
        <div class="header">@lang('index.footer.links.parents')</div>
        <div class="body">@lang('index.modal.parents')</div>
    </div>
</div>

<div class="remodal footer-modal" data-remodal-id="terms">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="content">
        <div class="header">@lang('index.footer.links.terms')</div>
        <div class="body">@lang('index.modal.terms')</div>
    </div>
</div>

<div class="remodal footer-modal" data-remodal-id="contacts">
    <button data-remodal-action="close" class="remodal-close"></button>
    <div class="content">
        <div class="header">@lang('index.footer.links.contacts')</div>
        <div class="body">@lang('index.modal.contacts')</div>
    </div>
</div>

