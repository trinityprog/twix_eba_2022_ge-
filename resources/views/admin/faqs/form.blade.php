<div>
    <label for="question" class="block text-sm text-gray-700">Вопрос</label>
    <input type="text" id="question" name="question" value="{{ isset($faq->question) ? $faq->question : old('question')}}"
           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('question') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}"/>
    {!! $errors->first('question', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
</div>

<div class="mt-4">
    <label for="answer" class="block text-sm text-gray-700">Ответ</label>
    <textarea rows="5" id="answer" name="answer"
        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('answer') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}">
    {{ isset($faq->answer) ? $faq->answer : old('answer')}}
    </textarea>
    {!! $errors->first('answer', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
</div>

<div class="mt-4">
    <label for="locale" class="block text-sm text-gray-700">Язык</label>
    <select name="locale" id="locale"
            class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('locale') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}">
        <option value="ru" {{ isset($faq->locale) && $faq->locale == 'ru' ? 'selected' : ''}}>Русский</option>
        <option value="kk" {{ isset($faq->locale) && $faq->locale == 'kk' ? 'selected' : ''}}>Казахский</option>
    </select>
    {!! $errors->first('locale', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
</div>

<div class="mt-4">
    <label for="order" class="block text-sm text-gray-700">Порядок</label>
    <input type="number" id="order" name="order" value="{{ isset($faq->order) ? $faq->order : old('order', '1')}}"
           class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('order') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}"/>
    {!! $errors->first('order', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
</div>

<div class="mt-8">
    <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
            type="submit">
        Сохранить
    </button>
</div>
