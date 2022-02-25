<form class="form" wire:submit.prevent="submit">
    @error('failed')
    <span class="error general">{{ $message }}</span>
    @enderror

    <div class="form-group">
        <input type="tel" placeholder="@lang('index.auth.phone')"
               @class(['error' => $errors->has('phone')])
               wire:ignore onchange="@this.set('phone', this.value);">
        @error('phone') <span class="error">{{ $message }}</span> @enderror
    </div>
    <div class="form-group">
        <input type="text" placeholder="@lang('index.auth.code')"
               @class(['error' => $errors->has('sms')])
               wire:model="sms">
        @error('sms') <span class="error">{{ $message }}</span> @enderror

        <a href="{{ url('#sms_forgot') }}" class="forgot">@lang('index.auth.forgot')</a>
    </div>



    <div class="go-wrapper">
        <button class="btn-catch" type="submit">@lang('index.auth.login')</button>
        <p class="or">@lang('index.auth.or')</p>
        <a href="{{ route('telegram') }}" class="btn-catch tme">@lang('index.auth.tme')</a>
    </div>
</form>
