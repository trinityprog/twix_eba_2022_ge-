<form wire:submit.prevent="submit" class="faq">

    <div class="row">
        <div class="ceil">
            <input type="text" placeholder="@lang('index.form.name')"
                   @class(['error' => $errors->has('name')])
                   wire:model="name">
            @error('name') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="ceil">
            <input type="tel" placeholder="@lang('index.auth.phone')"
                   @class(['error' => $errors->has('phone')])
                   wire:ignore onchange="@this.set('phone', this.value);">
            @error('phone') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="ceil">
            <input type="email" placeholder="@lang('index.form.email')"
                   @class(['error' => $errors->has('email')])
                   wire:model="email">
            @error('email') <span class="error">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="row">
        @error('question') <span class="error">{{ $message }}</span> @enderror
         <textarea rows="3" placeholder="@lang('index.form.question')"
                   @class(['error' => $errors->has('question')])
                   wire:model="question">
        </textarea>
    </div>
    <div class="go-wrapper">
        <button class="btn-catch" type="submit"> @lang('index.main.send') </button>
    </div>
</form>
