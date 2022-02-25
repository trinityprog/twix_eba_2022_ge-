<form wire:submit.prevent="submit">

    <div class="row">
        <input type="text" placeholder="@lang('index.delivery.lastname')*"
               @class(['error' => $errors->has('surname')])
               wire:model="surname">
        @error('surname') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row">
        <input type="text" placeholder="@lang('index.delivery.name')*"
               @class(['error' => $errors->has('name')])
               wire:model="name">
        @error('name') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row">
        <input type="text" placeholder="@lang('index.delivery.index')*"
               @class(['error' => $errors->has('index')])
               wire:model="index">
        @error('index') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row">
            <select @class(['error' => $errors->has('region')])
                    wire:model="region">
                <option value="0" disabled selected>@lang('index.delivery.region')*...</option>
                @foreach($regions as $_region)
                    <option value="{{ $_region->id }}">{{ $_region->text }}</option>
                @endforeach
            </select>
        @error('region') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row">
        <input type="text" placeholder="@lang('index.delivery.locality')*"
               @class(['error' => $errors->has('locality')])
               wire:model="locality">
        @error('locality') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row">
        <input type="text" placeholder="@lang('index.delivery.street')*"
               @class(['error' => $errors->has('street')])
               wire:model="street">
        @error('street') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row double">
        <input type="text" placeholder="@lang('index.delivery.house')*"
               @class(['error' => $errors->has('building')])
               wire:model="building">
        @error('building') <span class="error">{{ $message }}</span> @enderror

        <input type="text" placeholder="@lang('index.delivery.apartment')*"
               @class(['error' => $errors->has('apartament')])
               wire:model="apartament">
        @error('apartament') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="row">
        <textarea cols="10" rows="6" placeholder="@lang('index.delivery.commentary')"
                  @class(['error' => $errors->has('commentary')])
                  wire:model="commentary"></textarea>
        @error('commentary') <span class="error">{{ $message }}</span> @enderror
    </div>

    <div class="go-wrapper">
        <button class="btn-catch" type="submit">@lang('index.main.send')</button>
    </div>
</form>
