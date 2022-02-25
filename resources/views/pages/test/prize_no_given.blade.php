<div class="left">
    <h3>
        @lang('index.tests.wanna-more')
    </h3>
    <p class="description instructions">
        @lang('index.tests.upload')
    </p>
    @desktop <div class="go-wrapper"><a class="btn-catch" href="{{ route('telegram_check_register') }}">@lang('index.header.upload-check')</a></div> @enddesktop
</div>
<div class="right">
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
    @handheld <div class="go-wrapper"><a class="btn-catch" href="{{ route('telegram_check_register') }}">@lang('index.header.upload-check')</a></div> @endhandheld
</div>
