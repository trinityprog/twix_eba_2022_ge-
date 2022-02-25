<form class="search-form" wire:submit.prevent="submit">
    <input type="tel" name="phone" placeholder=" @lang('index.main.search-phone') " wire:ignore onchange="@this.set('phone', this.value);">
    <button type="submit"><img src="{{ url('/i/loop.png') }}" alt="magnifier"></button>
</form>
