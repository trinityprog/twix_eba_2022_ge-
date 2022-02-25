<x-app-layout>
    <x-slot name="header">
        Изменение #{{ $question->id }} Вопроса от пользователя
    </x-slot>

    <div class="px-4 py-3 mb-8 bg-white rounded-lg shadow-md dark:bg-gray-800">
        <div class="mb-8">
            <a href="{{ url()->previous() }}" class="inline-block px-4 py-2 text-sm font-medium leading-5 text-white transition-colors duration-150 bg-purple-600 border border-transparent rounded-lg active:bg-purple-600 hover:bg-purple-700 focus:outline-none focus:shadow-outline-purple">
                <svg class="w-5 h-5 inline-block align-text-bottom" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Назад
            </a>
        </div>
        <form method="POST" action="{{ route('admin.questions.update', $question->id) }}">
            @csrf
            @method('PUT')

            <div>
                <label for="name" class="block text-sm text-gray-700">Имя</label>
                <input type="text" id="name" name="name" value="{{ $question->name }}" readonly
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"/>
            </div>

            <div class="mt-4">
                <label for="phone" class="block text-sm text-gray-700">Телефон</label>
                <input type="text" id="phone" name="phone" value="{{ blink()->beautify($question->phone) }}" readonly
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600"/>
            </div>

            <div class="mt-4">
                <label for="question" class="block text-sm text-gray-700">Вопрос</label>
                <textarea rows="3" id="question" readonly
                       class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600">{{ $question->question }}</textarea>
            </div>

            <div class="mt-4">
                <label for="question_answer" class="block text-sm text-gray-700">Ответ</label>
                <textarea rows="5" id="question_answer" name="answer"
                          class="block w-full mt-1 border-gray-300 rounded-md shadow-sm focus:border-primary-300 focus:ring focus:ring-primary-200 focus:ring-opacity-50 focus-within:text-primary-600
                {{ $errors->has('answer') ? 'focus:border-red-400 focus:outline-none focus:shadow-outline-red' : ''}}">{{ isset($question->answer) ? $question->answer : old('answer')}}</textarea>
                {!! $errors->first('answer', '<p class="text-xs text-red-600 dark:text-red-400">:message</p>') !!}
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
