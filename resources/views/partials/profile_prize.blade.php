@if(($hasNotActivatedPrize || $isWinner) && ($test_prize->check || ($test_prize->created_at > now()->subDays(10) && $test_prize->created_at < now())))
    <div class="prize">
        <h3>
            {{ $test_prize->created_at->format('d.m.Y H:i') }} <br>
            @lang('index.delivery.your-prize')
        </h3>
        <img src="{{ $test_prize->prize->imagePath }}" alt="">

        @if(auth()->user()->napWithNoCheck())
            <div class="go-wrapper"><a class="btn-catch"
                                       href="{{ route('check_register.index', 'confirm') }}">@lang('index.profile.take')</a>
            </div>
            <p class="info">
                @lang('index.profile.info')
            </p>
        @elseif(auth()->user()->napWithModeratingCheck())
            <h3>
                @lang('index.profile.moderation')
            </h3>
            <img src="{{ url('/i/moderation.png') }}" alt="Moderation" class="bill-sample">
        @elseif(auth()->user()->napWithDeclinedCheck())
            <h3 data-check-status="{{ auth()->user()->checks()->typeConfirm()->first()->status ?? '' }}" data-check-comment="{{ auth()->user()->checks()->typeConfirm()->first()->comment ?? '' }}">
                @lang('index.profile.declined')
            </h3>
            <img src="{{ url('/i/rejected.png') }}" alt="rejected" class="bill-sample">
        @elseif(auth()->user()->napWithAcceptedCheck())
            @if($test_prize->prize->delivery_by == "giftcode")

            @elseif($test_prize->prize->delivery_by == "delivery")
                @if(auth()->user()->delivery)
                    <h3>
                        @lang('index.profile.form-filled')
                    </h3>
                    <p class="info">
                        @lang('index.profile.prize-info')
                    </p>
                @else
                    <h3>
                        @lang('index.profile.form')
                    </h3>
                    <div class="go-wrapper"><a class="btn-catch" href="{{ route('delivery') }}">@lang('index.profile.fill')</a></div>
                @endif
            @elseif($test_prize->prize->delivery_by == "text_money")
                <h3>
                    @lang('index.delivery.contact')
                </h3>
            @elseif($test_prize->prize->delivery_by == "text_balance")
                <h3>
                    @lang('index.delivery.balance')
                </h3>
            @endif
        @endif
    </div>
@endif
