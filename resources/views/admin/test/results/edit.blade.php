<x-app-layout>
    <x-slot name="header">
        Изменение #{{ $result->id }} Результата
    </x-slot>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-8">
            <a href="{{ url()->previous() }}" class="inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg class="w-5 h-5 inline-block align-text-bottom" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Назад
            </a>
        </div>
        <form method="POST" action="{{ route('admin.tests.results.update', $result->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div>
                <label for="general" class="block text-sm text-gray-700">Текст</label>
                <input type="text" id="general" name="general" value="{{ isset($result->general) ? $result->general : old('general')}}"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('general') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}"/>
                {!! $errors->first('general', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
            </div>

            <div class="mt-4">
                <label for="locale" class="block text-sm text-gray-700">Перевод</label>
                <input type="text" id="locale" name="locale" value="{{ isset($result->locale) ? $result->locale : old('locale')}}"
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('locale') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}"/>
                {!! $errors->first('locale', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
            </div>

            <div class="mt-4 flex image_wrapper">
                <div>
                    <label class="w-64 flex flex-col items-center px-4 py-6 bg-white rounded-md shadow-md tracking-wide uppercase border border-blue cursor-pointer hover:bg-purple-600 hover:text-white text-purple-600 ease-linear transition-all duration-150">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path></svg>
                        <span class="mt-2 text-base leading-normal">Выбрать файл</span>
                        <input type="file" class="hidden image" name="image">
                    </label>
                    {!! $errors->first('image', '<p class="mt-2 ml-2 text-xs text-red-600 dark:text-red-400">:message</p>') !!}
                </div>
                <div class="ml-8">
                    <img class="w-40 h-40 object-cover" src="{{ $result->imagePath }}" alt="">
                </div>
            </div>

            <hr class="my-4">

            <div class="mt-4">
                <label for="answers" class="block text-sm text-gray-700">Ответы</label>
                <select name="answers[]" id="answers" multiple style="height: 400px;"
                        class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                                {{ $errors->has('answers') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}">
                        @foreach($answers as $answer)
                            <option value="{{ $answer->id }}" {{ in_array($answer->id, $result->answers->pluck('id')->toArray()) ? 'selected' : ''}}>
                                {{ $answer->text }}</option>
                        @endforeach
                </select>
                {!! $errors->first('answers', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
            </div>

            <div class="mt-8">
                <button class="px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple"
                        type="submit">
                    Сохранить
                </button>
            </div>
        </form>
    </div>
</x-app-layout>
