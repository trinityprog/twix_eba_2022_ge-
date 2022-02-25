<div class="left">
    <img class="moment" src="{{ $test->result->imagePath }}" alt="">
    @if(! $test->prize && ! $canAction)
        @handheld
        <div class="go-wrapper"><a class="btn-catch" href="{{ route('telegram_return') }}">@lang('index.profile.main')</a></div>
        @endhandheld
    @endif
</div>
<div class="right">
    <h3 class="moment">
        @lang('index.profile.for-you')
    </h3>
    <p class="description">
        {{ $test->result->text }}
    </p>
    @if(! $test->prize && ! $canAction)
        @desktop
        <div class="go-wrapper"><a class="btn-catch" href="{{ route('telegram_return') }}">@lang('index.profile.main')</a></div>
        @enddesktop
    @endif
</div>
