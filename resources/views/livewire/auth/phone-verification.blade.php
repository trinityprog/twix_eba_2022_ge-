<form class="form" wire:submit.prevent="submit">

    @error('failed')
    <span class="error general">{{ $message }}</span>
    @enderror

    <div class="form-group">
        <input type="text" placeholder="@lang('index.auth.code')"
               @class(['error' => $errors->has('sms')])
               wire:model="sms">
        @error('sms') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="go-wrapper">
        <button class="btn-catch" type="submit">
            @lang('index.auth.submit')
        </button>
    </div>
</form>
