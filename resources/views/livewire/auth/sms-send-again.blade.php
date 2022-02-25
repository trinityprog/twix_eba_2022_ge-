<div>
    @if($sended) <p wire:poll.1000ms="decrement">{!! __('index.modal.sms_forgot.decrement', ['countdown' => $countdown]) !!}</p>@endif
    <div class="go-wrapper"><a href="javascript:void(0);" class="btn-catch" @class(['btn', 'disabled' => $sended]) wire:click="submit">@lang('index.modal.sms_forgot.ask-again')</a></div>
</div>
