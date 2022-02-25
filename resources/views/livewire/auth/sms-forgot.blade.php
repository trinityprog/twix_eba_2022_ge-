<form class="form" wire:submit.prevent="submit">

    <div class="form-group">
        <input type="tel" placeholder="@lang('index.auth.phone')"
               @class(['error' => $errors->has('phone')])
               wire:ignore onchange="@this.set('phone', this.value);">
        @error('phone') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="go-wrapper"><button class="btn-catch" type="submit">@lang('index.auth.reset_sms')</button></div>
</form>
