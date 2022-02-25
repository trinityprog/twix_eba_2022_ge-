<form class="form" wire:submit.prevent="submit">

    <div class="form-group">
        <input type="text" placeholder="@lang('index.delivery.name')"
               @class(['error' => $errors->has('name')])
               wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <input type="tel" placeholder="@lang('index.auth.phone')"
               @class(['error' => $errors->has('phone')])
               wire:ignore onchange="@this.set('phone', this.value);">
        @error('phone') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="form-group">
        <input type="email" placeholder="@lang('index.auth.email')"
               @class(['error' => $errors->has('email')])
               wire:model="email">
        @error('email') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="go-wrapper">
        <button class="btn-catch" type="submit">
            @lang('index.auth.register')
        </button>
    </div>
</form>
