<div>
    <label for="phone" class="block text-sm text-gray-700">Телефон</label>
    <input type="text" id="phone" name="phone" value="{{ isset($winner->user) ? $winner->user->phone : old('phone')}}"
           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('phone') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}"/>
    {!! $errors->first('phone', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
</div>

<div class="mt-4">
    <label for="prize" class="block text-sm text-gray-700">Приз</label>
    <select name="prize" id="prize"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                                {{ $errors->has('prize') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}">
        <option value>Выберите приз</option>
        @foreach($prizes as $prize)
            <option value="{{ $prize->id }}" {{ (isset($winner->prize) && $winner->prize->id == $prize->id) ? 'selected' : ''}}>
                {{ $prize->general }}</option>
        @endforeach
    </select>
    {!! $errors->first('prize', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
</div>

<div class="mt-4">
    <label for="won_at" class="block text-sm text-gray-700">Дата</label>
    <input type="date" id="won_at" name="won_at" value="{{ isset($winner->won_at) ? $winner->won_at : old('won_at')}}"
           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('won_at') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}"/>
    {!! $errors->first('won_at', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
</div>

<div class="mt-8">
    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            type="submit">
        Сохранить
    </button>
</div>
