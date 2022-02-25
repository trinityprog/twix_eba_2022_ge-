<div class="left">
    <h3>@lang('index.tests.you-won')</h3>
    <div class="divided">
        <div class="inner-left">
            <div class="bg"></div>
            <img src="{{ $test->prize->imagePath }}" alt="prize">
        </div>
        <div class="inner-right">
            <div class="go-wrapper"><a class="btn-catch" href="{{ route('telegram_take_prize') }}">@lang('index.profile.take')</a></div>
            <p class="description">
                @lang('index.profile.instructions')
            </p>
        </div>
    </div>
    <p class="warn">
        @lang('index.tests.saved')
    </p>
</div>
<div class="right">
    <h3>
        @lang('index.tests.wanna-more')
    </h3>
    <p class="description instructions">
        @if($canAction)
            @lang('index.tests.upload')
        @else
            @lang('index.tests.tomorrow')
        @endif
    </p>
    <h1>
        @lang('index.main.amount')
    </h1>
    <h4>
        @lang('index.main.for-me')
    </h4>
    @if($canAction)
        <div class="go-wrapper"><a class="btn-catch" href="{{ route('telegram_check_register') }}">@lang('index.header.upload-check')</a></div>
    @else
        <div class="go-wrapper"><a class="btn-catch" href="{{ route('telegram_return') }}">@lang('index.profile.main')</a></div>
    @endif
</div>
